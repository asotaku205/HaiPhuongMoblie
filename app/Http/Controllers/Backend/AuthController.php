<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
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
        if (Auth::attempt($credentials)) {
            // Lưu user_id vào session
            Session::put('user_id', Auth::id());
            
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
        Auth::logout();

        $request->session()->invalidate();
        
        // Xóa user_id khỏi session
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
        
        // Kiểm tra nếu có URL chuyển hướng sau khi đăng nhập
        if (Session::has('redirect_after_login')) {
            $redirectUrl = Session::get('redirect_after_login');
            Session::forget('redirect_after_login');
            return redirect($redirectUrl)->with('success', 'Đăng ký và đăng nhập thành công');
        }

        // Chuyển hướng đến trang chủ
        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }
}