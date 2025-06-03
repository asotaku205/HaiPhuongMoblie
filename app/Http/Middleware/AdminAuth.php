<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Kiểm tra xem người dùng đã đăng nhập vào hệ thống admin chưa
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập với guard 'admin' chưa
        if (!Auth::guard('admin')->check()) {
            // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập admin
            return redirect()->route('admin_login')->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }

        return $next($request);
    }
}