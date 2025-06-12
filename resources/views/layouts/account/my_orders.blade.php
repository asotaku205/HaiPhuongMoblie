@extends('layouts.main')

@section('title', 'Đơn Hàng Của Tôi - Hải Phương Mobile')

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

        <!-- Danh sách đơn hàng -->
        <div class="w-full md:w-3/4">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-semibold mb-6">Đơn hàng của tôi</h2>
                
                @if(count($orders) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mã đơn hàng
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Ngày đặt
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tổng tiền
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Trạng thái đơn hàng
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Trạng thái thanh toán
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Chi tiết
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $order->order_code }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ date('d/m/Y H:i', strtotime($order->created_at)) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ number_format($order->order_total) }}đ</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($order->payment_status == 0)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Chưa thanh toán
                                    </span>
                                    @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Đã thanh toán
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('user.order.detail', $order->order_id) }}" class="text-blue-600 hover:text-blue-900">Xem chi tiết</a>
                                    @if($order->order_status == 0)
                                    <span class="mx-1">|</span>
                                    <form action="{{ route('user.order.cancel', $order->order_id) }}" method="POST" class="inline" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hủy đơn hàng</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-8">
                    <p class="text-gray-500">Bạn chưa có đơn hàng nào.</p>
                    <a href="{{ route('home') }}" class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Mua sắm ngay
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 