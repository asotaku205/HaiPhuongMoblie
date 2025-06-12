@extends('layouts.main')

@section('title', 'Chi Tiết Đơn Hàng - Hải Phương Mobile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Tiêu đề trang -->
    <div class="bg-gray-100 py-4 px-6 mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Tài Khoản</h1>
        <a href="{{ route('logout') }}" class="text-blue-600 hover:underline">Đăng Xuất &rsaquo;</a>
    </div>

    <!-- Thông báo -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Menu tài khoản -->
        <div class="w-full md:w-1/4">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold mb-4">Tài khoản của tôi</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('user.settings') }}" class="text-gray-600 hover:text-blue-600">
                            Thông tin tài khoản
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.orders') }}" class="text-blue-600 font-medium">
                            Đơn hàng của tôi
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Chi tiết đơn hàng -->
        <div class="w-full md:w-3/4">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold">Chi tiết đơn hàng #{{ $order->order_code }}</h2>
                    <div class="flex items-center gap-4">
                        @if($order->order_status == 0)
                        <form action="{{ route('user.order.cancel', $order->order_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700">
                                Hủy đơn hàng
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('user.orders') }}" class="text-blue-600 hover:underline">
                            &lsaquo; Quay lại
                        </a>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Thông tin đơn hàng -->
                    <div class="border rounded-lg p-4">
                        <h3 class="text-lg font-medium mb-3">Thông tin đơn hàng</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Mã đơn hàng:</span>
                                <span class="font-medium">{{ $order->order_code }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Ngày đặt hàng:</span>
                                <span>{{ date('d/m/Y H:i', strtotime($order->created_at)) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Phương thức thanh toán:</span>
                                <span>{{ $order->payment_method }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Trạng thái đơn hàng:</span>
                                <span>
                                    @if($order->order_status == 0)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Đang xử lý
                                        </span>
                                    @elseif($order->order_status == 1)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Đang giao hàng
                                        </span>
                                    @elseif($order->order_status == 2)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Đã giao hàng
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Đã hủy
                                        </span>
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Trạng thái thanh toán:</span>
                                <span>
                                    @if($order->payment_status == 0)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Chưa thanh toán
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Đã thanh toán
                                        </span>
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Ghi chú:</span>
                                <span>{{ $order->order_note ?? 'Không có' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Thông tin giao hàng -->
                    <div class="border rounded-lg p-4">
                        <h3 class="text-lg font-medium mb-3">Thông tin giao hàng</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Người nhận:</span>
                                <span>{{ $order->fullname }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Email:</span>
                                <span>{{ $order->email }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Số điện thoại:</span>
                                <span>{{ $order->phone }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Địa chỉ:</span>
                                <span>{{ $order->address }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Phường/Xã:</span>
                                <span>{{ $order->ward }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Quận/Huyện:</span>
                                <span>{{ $order->district }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tỉnh/Thành phố:</span>
                                <span>{{ $order->city }}</span>
                            </div>
                            @if($order->postal_code)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Mã bưu điện:</span>
                                <span>{{ $order->postal_code }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Chi tiết sản phẩm -->
                <div class="border rounded-lg overflow-hidden">
                    <h3 class="text-lg font-medium p-4 bg-gray-50 border-b">Chi tiết sản phẩm</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Sản phẩm
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Giá
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Số lượng
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Thành tiền
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($orderDetails as $item)
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
        </div>
    </div>
</div>
@endsection