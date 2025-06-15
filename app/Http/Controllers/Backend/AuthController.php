<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function __construct()
    {
        // Constructor code here
    }
    public function login(Request $request)
    {
        // Handle login logic here
        return view('layouts.login');
    }

    public function auth_login(AuthRequest $request)
    {
        // Xác định xem người dùng đang sử dụng loại thông tin nào để đăng nhập
        $login = $request->input('login_identifier');
        $password = $request->input('password');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : (is_numeric($login) ? 'phone' : 'username');

        // Tạo mảng thông tin đăng nhập với trường tương ứng
        $credentials = [
            $fieldType => $login,
            'password' => $password
        ];
        
        // Lấy giá trị checkbox remember
        $remember = $request->has('remember');
        
        // Thêm tham số remember vào Auth::attempt
        if (Auth::attempt($credentials, $remember)) {
            // Lưu user_id vào session
            Session::put('user_id', Auth::id());
            
            // Đồng bộ giỏ hàng từ database vào session hoặc ngược lại
            $this->syncCart(Auth::id());
            
            // Kiểm tra nếu có URL chuyển hướng sau khi đăng nhập
            if (Session::has('redirect_after_login')) {
                $redirectUrl = Session::get('redirect_after_login');
                Session::forget('redirect_after_login');
                return redirect($redirectUrl)->with('success', 'Đăng nhập thành công');
            }
            
            // Nếu không có URL chuyển hướng, về trang chủ
            return redirect()->intended('home')->with('success', 'Đăng nhập thành công');
        }
        
        // Đăng nhập thất bại, quay lại trang trước với thông báo lỗi
        return redirect()->back()
            ->withInput($request->except('password'))
            ->withErrors([
                'login_identifier' => 'Thông tin đăng nhập không chính xác.'
            ]);
    }
    
    public function logout(Request $request)
    {
        // Lưu giỏ hàng vào database trước khi đăng xuất
        if (Session::has('user_id') && Session::has('cart')) {
            $this->saveCartToDB(Session::get('cart'), Session::get('user_id'));
        }
        
        Auth::logout();

        $request->session()->invalidate();
        
        // Xóa user_id khỏi session nhưng giữ lại giỏ hàng
        Session::forget('user_id');

        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Đã đăng xuất thành công');
    }

    public function register(Request $request)
    {
        // Handle registration logic here
        return view('layouts.register');
    }
    public function auth_register(RegisterRequest $request)
    {
        $user = User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Đăng nhập người dùng sau khi đăng ký
        Auth::login($user);
        
        // Lưu user_id vào session
        Session::put('user_id', $user->id);
        
        // Lưu giỏ hàng hiện tại vào database nếu có
        if (Session::has('cart')) {
            $this->saveCartToDB(Session::get('cart'), $user->id);
        }
        
        // Kiểm tra nếu có URL chuyển hướng sau khi đăng nhập
        if (Session::has('redirect_after_login')) {
            $redirectUrl = Session::get('redirect_after_login');
            Session::forget('redirect_after_login');
            return redirect($redirectUrl)->with('success', 'Đăng ký và đăng nhập thành công');
        }

        // Chuyển hướng đến trang chủ
        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }
    
    // Phương thức đồng bộ giỏ hàng khi đăng nhập
    private function syncCart($userId)
    {
        // Lấy giỏ hàng từ session và database
        $sessionCart = Session::get('cart', []);
        $dbCart = Cart::where('user_id', $userId)->get();
        
        // Nếu cả hai đều có dữ liệu, hợp nhất giỏ hàng
        if (!empty($sessionCart) && $dbCart->count() > 0) {
            $mergedCart = $sessionCart;
            
            // Thêm các sản phẩm từ database vào session nếu chưa có
            foreach ($dbCart as $item) {
                $productId = $item->product_id;
                
                // Nếu sản phẩm đã có trong session, cộng số lượng
                if (isset($mergedCart[$productId])) {
                    $mergedCart[$productId]['quantity'] += $item->quantity;
                } else {
                    // Nếu chưa có, thêm mới
                    $mergedCart[$productId] = [
                        'id' => $productId,
                        'name' => $item->product_name,
                        'price' => $item->product_price,
                        'quantity' => $item->quantity,
                        'image' => $item->product_image
                    ];
                }
            }
            
            // Cập nhật giỏ hàng session
            Session::put('cart', $mergedCart);
            
            // Cập nhật giỏ hàng database
            $this->saveCartToDB($mergedCart, $userId);
        } 
        // Nếu chỉ có giỏ hàng database, cập nhật session
        else if (empty($sessionCart) && $dbCart->count() > 0) {
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
        // Nếu chỉ có giỏ hàng session, lưu vào database
        else if (!empty($sessionCart) && $dbCart->count() == 0) {
            $this->saveCartToDB($sessionCart, $userId);
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
}