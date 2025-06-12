<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function __construct()
    {
        // Đồng bộ giỏ hàng từ database vào session khi người dùng đăng nhập
        $this->syncCartFromDB();
    }
    
    // Phương thức đồng bộ giỏ hàng từ database vào session
    private function syncCartFromDB()
    {
        if (Session::has('user_id')) {
            $userId = Session::get('user_id');
            
            // Lấy giỏ hàng hiện tại từ session
            $sessionCart = Session::get('cart', []);
            
            // Nếu giỏ hàng session trống, lấy từ database
            if (empty($sessionCart)) {
                $dbCart = Cart::where('user_id', $userId)->get();
                
                if ($dbCart->count() > 0) {
                    $newCart = [];
                    foreach ($dbCart as $item) {
                        $newCart[$item->product_id] = [
                            'id' => $item->product_id,
                            'name' => $item->product_name,
                            'price' => $item->product_price,
                            'quantity' => $item->quantity,
                            'image' => $item->product_image
                        ];
                    }
                    Session::put('cart', $newCart);
                }
            } 
            // Nếu giỏ hàng session không trống, lưu vào database
            else {
                $this->saveCartToDB($sessionCart, $userId);
            }
        }
    }
    
    // Phương thức lưu giỏ hàng từ session vào database
    private function saveCartToDB($cart, $userId)
    {
        if (!empty($cart)) {
            // Xóa giỏ hàng cũ trong database
            Cart::where('user_id', $userId)->delete();
            
            // Thêm các mục mới từ session vào database
            foreach ($cart as $item) {
                Cart::create([
                    'user_id' => $userId,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'product_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'product_image' => $item['image']
                ]);
            }
        }
    }
    
    public function save_cart(Request $request)
    {
        $product_id = $request->product_id_hidden;
        $quantity = $request->quantity;
        
        // Lấy thông tin sản phẩm
        $product = DB::table('product')->where('product_id', $product_id)->first();
        
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại');
        }
        
        // Lấy giỏ hàng hiện tại từ session hoặc tạo mới nếu chưa có
        $cart = Session::get('cart', []);
        
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        if (isset($cart[$product_id])) {
            // Nếu đã có, tăng số lượng
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            // Nếu chưa có, thêm sản phẩm mới vào giỏ hàng
            $cart[$product_id] = [
                'id' => $product_id,
                'name' => $product->product_name,
                'price' => $product->product_price,
                'quantity' => $quantity,
                'image' => $product->product_image
            ];
        }
        
        // Lưu giỏ hàng vào session
        Session::put('cart', $cart);
        
        // Nếu người dùng đã đăng nhập, lưu giỏ hàng vào database
        if (Session::has('user_id')) {
            $this->saveCartToDB($cart, Session::get('user_id'));
        }
        
        // Nếu là mua ngay, chuyển đến trang giỏ hàng
        if ($request->buy_now == 1) {
            return redirect()->route('cart_view');
        }
        
        // Nếu chỉ thêm vào giỏ hàng, quay lại trang trước
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng');
    }
    
    public function view_cart()
    {
        // Lấy danh mục sản phẩm để hiển thị menu
        $category = DB::table('category_product')->where('category_status', 1)->orderBy('category_id', 'desc')->get();
        
        // Lấy giỏ hàng từ session
        $cart = Session::get('cart', []);
        
        // Tính tổng tiền
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        
        // Tổng cộng (có thể thêm thuế, phí vận chuyển nếu cần)
        $grandTotal = $totalPrice;
        
        return view('cart.cart', compact('cart', 'category', 'totalPrice', 'grandTotal'));
    }
    
    public function update_cart(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = Session::get('cart', []);
            $cart[$request->id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
            
            // Nếu người dùng đã đăng nhập, cập nhật giỏ hàng trong database
            if (Session::has('user_id')) {
                $this->saveCartToDB($cart, Session::get('user_id'));
            }
            
            return redirect()->back()->with('success', 'Đã cập nhật giỏ hàng');
        }
        return redirect()->back();
    }
    
    public function remove_cart($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
            
            // Nếu người dùng đã đăng nhập, cập nhật giỏ hàng trong database
            if (Session::has('user_id')) {
                $this->saveCartToDB($cart, Session::get('user_id'));
            }
        }
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }
    
    public function clear_cart()
    {
        Session::forget('cart');
        
        // Nếu người dùng đã đăng nhập, xóa giỏ hàng trong database
        if (Session::has('user_id')) {
            Cart::where('user_id', Session::get('user_id'))->delete();
        }
        
        return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng');
    }
    
    public function checkout(Request $request)
    {
        // Kiểm tra đăng nhập
        if (!Session::has('user_id')) {
            // Lưu URL hiện tại vào session để sau khi đăng nhập có thể quay lại
            Session::put('redirect_after_login', route('checkout'));
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để tiến hành thanh toán');
        }
        
        // Kiểm tra giỏ hàng
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart_view')->with('error', 'Giỏ hàng của bạn đang trống');
        }
        
        // Nếu là form submit để tạo đơn hàng
        if ($request->isMethod('post')) {
            $userId = Session::get('user_id');
            $user = DB::table('users')->where('id', $userId)->first();
            
            // Tạo mã đơn hàng ngẫu nhiên
            $orderCode = 'HPM' . time() . rand(1000, 9999);
            
            // Tính tổng tiền
            $totalPrice = 0;
            foreach ($cart as $item) {
                $totalPrice += $item['price'] * $item['quantity'];
            }
            
            // Tạo đơn hàng
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'order_code' => $orderCode,
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'ward' => $request->ward,
                'district' => $request->district,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'order_total' => $totalPrice,
                'payment_method' => $request->payment_method,
                'payment_status' => 0, // Chưa thanh toán
                'order_status' => 0, // Đang xử lý
                'order_note' => $request->order_note,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            
            // Tạo chi tiết đơn hàng
            foreach ($cart as $item) {
                DB::table('order_details')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'product_price' => $item['price'],
                    'product_quantity' => $item['quantity'],
                    'product_image' => $item['image'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            
            // Xóa giỏ hàng sau khi đặt hàng thành công
            Session::forget('cart');
            
            // Nếu người dùng đã đăng nhập, xóa giỏ hàng trong database
            if (Session::has('user_id')) {
                Cart::where('user_id', Session::get('user_id'))->delete();
            }
            
            return redirect()->route('home')->with('success', 'Đặt hàng thành công! Mã đơn hàng của bạn là ' . $orderCode);
        }
        
        // Hiển thị form thanh toán
        $category = DB::table('category_product')->where('category_status', 1)->orderBy('category_id', 'desc')->get();
        
        // Lấy thông tin người dùng
        $user = DB::table('users')->where('id', Session::get('user_id'))->first();
        
        // Tính tổng tiền
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        
        return view('cart.checkout', compact('cart', 'category', 'user', 'totalPrice'));
    }
}
