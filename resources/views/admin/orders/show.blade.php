@extends('admin.admin_layout')
@section('title', 'Chi tiết đơn hàng - Hải Phương Mobile')
@section('page_title', 'Chi tiết đơn hàng #' . $order->order_code)
@section('content')
<div class="space-y-6">
    <!-- Thông báo lỗi hoặc thành công -->
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif
    
    <!-- Nút quay lại -->
    <div class="flex justify-between items-center">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
            <i class="fas fa-arrow-left mr-2"></i>
            Quay lại danh sách
        </a>
        
        <div class="flex space-x-2">
            <form action="{{ route('admin.orders.destroy', ['id' => $order->order_id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <i class="fas fa-trash mr-2"></i>
                    Xóa đơn hàng
                </button>
            </form>
        </div>
    </div>
    
    <!-- Thông tin đơn hàng và khách hàng -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Thông tin đơn hàng -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold">Thông tin đơn hàng</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Mã đơn hàng:</span>
                    <span class="font-medium">{{ $order->order_code }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Ngày đặt hàng:</span>
                    <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Tổng giá trị:</span>
                    <span class="font-medium">{{ number_format($order->order_total) }}đ</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Phương thức thanh toán:</span>
                    <span>{{ $order->payment_method }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Ghi chú:</span>
                    <span>{{ $order->order_note ?? 'Không có' }}</span>
                </div>
                
                <!-- Trạng thái đơn hàng -->
                <div class="pt-4 border-t border-gray-200">
                    <form action="{{ route('admin.orders.update-status', ['id' => $order->order_id]) }}" method="POST">
                        @csrf
                        <div class="flex flex-col space-y-2">
                            <label for="order_status" class="text-sm font-medium text-gray-700">Trạng thái đơn hàng:</label>
                            <div class="flex space-x-2">
                                <select id="order_status" name="order_status" class="flex-grow px-3 py-2 border border-gray-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="0" {{ $order->order_status == 0 ? 'selected' : '' }}>Đang xử lý</option>
                                    <option value="1" {{ $order->order_status == 1 ? 'selected' : '' }}>Đang giao hàng</option>
                                    <option value="2" {{ $order->order_status == 2 ? 'selected' : '' }}>Đã giao hàng</option>
                                    <option value="3" {{ $order->order_status == 3 ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Cập nhật
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Trạng thái thanh toán -->
                <div class="pt-4 border-t border-gray-200">
                    <form action="{{ route('admin.orders.update-payment', ['id' => $order->order_id]) }}" method="POST">
                        @csrf
                        <div class="flex flex-col space-y-2">
                            <label for="payment_status" class="text-sm font-medium text-gray-700">Trạng thái thanh toán:</label>
                            <div class="flex space-x-2">
                                <select id="payment_status" name="payment_status" class="flex-grow px-3 py-2 border border-gray-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="0" {{ $order->payment_status == 0 ? 'selected' : '' }}>Chưa thanh toán</option>
                                    <option value="1" {{ $order->payment_status == 1 ? 'selected' : '' }}>Đã thanh toán</option>
                                </select>
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Cập nhật
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Thông tin khách hàng -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4">
                <h3 class="text-lg font-semibold">Thông tin khách hàng</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between">
                    <span class="text-gray-600">Tên khách hàng:</span>
                    <span class="font-medium">{{ $order->fullname }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Email:</span>
                    <span>{{ $order->email }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Số điện thoại:</span>
                    <span>{{ $order->phone }}</span>
                </div>
                <div class="pt-4 border-t border-gray-200">
                    <h4 class="text-base font-medium mb-2">Địa chỉ giao hàng:</h4>
                    <p>{{ $order->address }}</p>
                    <p>{{ $order->ward }}, {{ $order->district }}</p>
                    <p>{{ $order->city }}{{ $order->postal_code ? ', ' . $order->postal_code : '' }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chi tiết sản phẩm -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-lg font-semibold">Chi tiết sản phẩm</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sản phẩm
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Giá
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Số lượng
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thành tiền
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($order->orderDetails as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('uploads/products/' . $item->product_image) }}" alt="{{ $item->product_name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->product_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ number_format($item->product_price) }}đ</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $item->product_quantity }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ number_format($item->product_price * $item->product_quantity) }}đ</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-medium">
                            Tổng cộng:
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-bold">
                            {{ number_format($order->order_total) }}đ
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection