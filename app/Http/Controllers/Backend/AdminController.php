<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Blog;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.admin_login');
    }
    public function admin_index()
    {
        // Thống kê tổng quan
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalBlogs = Blog::count();
        
        // Tính tổng doanh thu (chỉ các đơn hàng đã giao và đã thanh toán)
        $totalRevenue = Order::where('order_status', 2) // Đã giao hàng
                            ->where('payment_status', 1) // Đã thanh toán
                            ->sum('order_total');
        
        // Doanh thu tháng này
        $monthlyRevenue = Order::whereMonth('created_at', now()->month)
                               ->whereYear('created_at', now()->year)
                               ->where('order_status', 2)
                               ->where('payment_status', 1)
                               ->sum('order_total');
        
        // Doanh thu hôm nay
        $todayRevenue = Order::whereDate('created_at', now()->toDateString())
                            ->where('order_status', 2)
                            ->where('payment_status', 1)
                            ->sum('order_total');
        
        // Đơn hàng chờ xử lý
        $pendingOrders = Order::where('order_status', 0)->count();
        
        // Đơn hàng đang giao
        $shippingOrders = Order::where('order_status', 1)->count();
        
        // Đơn hàng đã hoàn thành
        $completedOrders = Order::where('order_status', 2)->count();
        
        // Sản phẩm sắp hết hàng (dưới 5 sản phẩm)
        $lowStockProducts = Product::where('stock_quantity', '<', 5)
                                 ->where('product_status', 1)
                                 ->count();
        
        // Đơn hàng gần đây
        $recentOrders = Order::with('user')
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();
        
        // Sản phẩm bán chạy (dựa vào số lượng đặt trong order_details)
        $topProducts = DB::table('order_details')
                        ->select('product_name', DB::raw('SUM(product_quantity) as total_sold'))
                        ->groupBy('product_name')
                        ->orderBy('total_sold', 'desc')
                        ->limit(5)
                        ->get();
        
        // Biểu đồ doanh thu 7 ngày gần đây
        $revenueChart = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $revenue = Order::whereDate('created_at', $date)
                          ->where('order_status', 2)
                          ->where('payment_status', 1)
                          ->sum('order_total');
            $revenueChart[] = [
                'date' => $date,
                'revenue' => $revenue
            ];
        }
        
        return view('admin.admin_index', compact(
            'totalUsers',
            'totalOrders', 
            'totalProducts',
            'totalBlogs',
            'totalRevenue',
            'monthlyRevenue',
            'todayRevenue',
            'pendingOrders',
            'shippingOrders',
            'completedOrders',
            'lowStockProducts',
            'recentOrders',
            'topProducts',
            'revenueChart'
        ));
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
        
        // Lấy giá trị checkbox remember
        $remember = $request->has('remember');
        
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
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
