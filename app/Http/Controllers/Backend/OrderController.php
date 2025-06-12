<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();
        
        // Tìm kiếm theo mã đơn hàng
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_code', 'like', '%'.$search.'%')
                  ->orWhere('fullname', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%')
                  ->orWhere('phone', 'like', '%'.$search.'%');
            });
        }
        
        // Lọc theo trạng thái đơn hàng
        if ($request->has('status') && $request->status != 'all') {
            $query->where('order_status', $request->status);
        }
        
        // Lọc theo trạng thái thanh toán
        if ($request->has('payment_status') && $request->payment_status != 'all') {
            $query->where('payment_status', $request->payment_status);
        }
        
        // Sắp xếp theo thời gian tạo mới nhất
        $orders = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('admin.orders.index', compact('orders'));
    }
    
    public function show($id)
    {
        $order = Order::with('orderDetails')->find($id);
        
        if (!$order) {
            return redirect()->route('admin.orders.index')->with('error', 'Đơn hàng không tồn tại');
        }
        
        return view('admin.orders.show', compact('order'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $order = Order::find($id);
        
        if (!$order) {
            return redirect()->route('admin.orders.index')->with('error', 'Đơn hàng không tồn tại');
        }
        
        $order->order_status = $request->order_status;
        $order->save();
        
        return redirect()->back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }
    
    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::find($id);
        
        if (!$order) {
            return redirect()->route('admin.orders.index')->with('error', 'Đơn hàng không tồn tại');
        }
        
        $order->payment_status = $request->payment_status;
        $order->save();
        
        return redirect()->back()->with('success', 'Cập nhật trạng thái thanh toán thành công');
    }
    
    public function destroy($id)
    {
        $order = Order::find($id);
        
        if (!$order) {
            return redirect()->route('admin.orders.index')->with('error', 'Đơn hàng không tồn tại');
        }
        
        // Xóa chi tiết đơn hàng
        OrderDetail::where('order_id', $id)->delete();
        
        // Xóa đơn hàng
        $order->delete();
        
        return redirect()->route('admin.orders.index')->with('success', 'Xóa đơn hàng thành công');
    }
} 