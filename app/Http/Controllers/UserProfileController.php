<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function index()
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem thông tin tài khoản');
        }
        
        // Lấy thông tin người dùng
        $user = User::find(Session::get('user_id'));
        
        // Lấy danh mục sản phẩm để hiển thị menu
        $category = DB::table('category_product')->where('category_status', 1)->orderBy('category_id', 'desc')->get();
        
        return view('layouts.account.account_settings', compact('user', 'category'));
    }
    
    public function updateProfile(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để cập nhật thông tin tài khoản');
        }
        
        // Validate dữ liệu
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);
        
        // Cập nhật thông tin người dùng
        $user = User::find(Session::get('user_id'));
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();
        
        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }
    
    public function updateAddress(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để cập nhật địa chỉ');
        }
        
        // Validate dữ liệu
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
        ]);
        
        // Cập nhật địa chỉ người dùng
        $user = User::find(Session::get('user_id'));
        $user->address = $request->address;
        $user->city = $request->city;
        $user->district = $request->district;
        $user->ward = $request->ward;
        $user->postal_code = $request->postal_code;
        $user->save();
        
        return redirect()->back()->with('success', 'Cập nhật địa chỉ thành công');
    }
    
    public function updatePayment(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để cập nhật phương thức thanh toán');
        }
        
        // Validate dữ liệu
        $request->validate([
            'card_number' => 'required|string|max:255',
            'card_expiry' => 'required|string|max:10',
        ]);
        
        // Cập nhật phương thức thanh toán
        $user = User::find(Session::get('user_id'));
        $user->card_number = $request->card_number;
        $user->card_expiry = $request->card_expiry;
        $user->save();
        
        return redirect()->back()->with('success', 'Cập nhật phương thức thanh toán thành công');
    }
    
    public function changePassword(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để đổi mật khẩu');
        }
        
        // Validate dữ liệu
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        // Kiểm tra mật khẩu hiện tại
        $user = User::find(Session::get('user_id'));
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác']);
        }
        
        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
    }
    
    public function myOrders()
    {
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem đơn hàng');
        }
        
        $userId = Session::get('user_id');
        $orders = DB::table('orders')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
        
        $category = DB::table('category_product')->where('category_status', 1)->orderBy('category_id', 'desc')->get();
        
        return view('layouts.account.my_orders', compact('orders', 'category'));
    }
    
    public function orderDetail($id)
    {
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem chi tiết đơn hàng');
        }
        
        $userId = Session::get('user_id');
        $order = DB::table('orders')
            ->where('order_id', $id)
            ->where('user_id', $userId)
            ->first();
        
        if (!$order) {
            return redirect()->route('user.orders')->with('error', 'Đơn hàng không tồn tại hoặc bạn không có quyền xem');
        }
        
        $orderDetails = DB::table('order_details')
            ->where('order_id', $id)
            ->get();
        
        $category = DB::table('category_product')->where('category_status', 1)->orderBy('category_id', 'desc')->get();
        
        return view('layouts.account.order_detail', compact('order', 'orderDetails', 'category'));
    }
    
    public function cancelOrder($id)
    {
        if (!Session::has('user_id')) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để hủy đơn hàng');
        }
        
        $userId = Session::get('user_id');
        $order = DB::table('orders')
            ->where('order_id', $id)
            ->where('user_id', $userId)
            ->first();
        
        if (!$order) {
            return redirect()->route('user.orders')->with('error', 'Đơn hàng không tồn tại hoặc bạn không có quyền hủy');
        }
        
        // Chỉ cho phép hủy đơn hàng khi đang ở trạng thái "Đang xử lý"
        if ($order->order_status != 0) {
            return redirect()->route('user.order.detail', $id)->with('error', 'Chỉ có thể hủy đơn hàng khi đang ở trạng thái đang xử lý');
        }
        
        // Cập nhật trạng thái đơn hàng thành "Đã hủy"
        DB::table('orders')
            ->where('order_id', $id)
            ->update([
                'order_status' => 3, // 3: Đã hủy
                'updated_at' => now()
            ]);
        
        return redirect()->route('user.order.detail', $id)->with('success', 'Đơn hàng đã được hủy thành công');
    }
}
