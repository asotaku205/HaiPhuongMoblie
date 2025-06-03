<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.admin_login');
    }
    public function admin_index()
    {
        return view('admin.admin_index');
    }
    public function admin_authlogin(AdminRequest $request)
    {
        // Xác định xem người dùng đang sử dụng loại thông tin nào để đăng nhập
        $login = $request->input( 'admusername');
        $password = $request->input('admpassword');

        // Tạo mảng thông tin đăng nhập với trường tương ứng
        $credentials = [
            'admusername' => $login,
            'password' => $password
        ];
        if (Auth::guard('admin')->attempt($credentials)) {
            // Tạo session mới để tránh session fixation
            $request->session()->regenerate();
            
            // Chuyển hướng đến trang dự định trước đó hoặc trang admin_index
            return redirect()->intended(route('admin_index'))->with('success', 'Đăng nhập thành công');
        }
        return redirect()->back()
            ->withInput($request->except('admpassword'))
            ->withErrors([
                'admusername' => 'Thông tin đăng nhập không chính xác.'
            ]);
    }
    public function admin_logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin_login')->with('success', 'Đã đăng xuất thành công');
    }
}
