<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CartController extends Controller
{
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
        }
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }
    
    public function clear_cart()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Đã xóa toàn bộ giỏ hàng');
    }
    
    public function checkout()
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
        
        // Tiếp tục xử lý thanh toán
        // TODO: Thêm code xử lý thanh toán ở đây
        
        return redirect()->route('cart_view')->with('success', 'Đơn hàng của bạn đã được xử lý');
    }
}
