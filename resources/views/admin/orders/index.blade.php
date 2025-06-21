@extends('admin.admin_layout')
@section('title', 'Quản lý đơn hàng - Hải Phương Mobile')
@section('page_title', 'Quản lý đơn hàng')
@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
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
    
    <!-- Tiêu đề và công cụ -->
    <div class="p-4 sm:p-6 border-b border-gray-200">
        <div class="flex flex-col space-y-4 md:space-y-0 md:flex-row md:justify-between md:items-center">
            <div class="w-full">
                <form action="{{ route('admin.orders.index') }}" method="GET" class="space-y-3 sm:space-y-0 sm:flex sm:flex-wrap sm:items-center sm:space-x-2">
                    <div class="flex-1 min-w-0">
                        <input type="text" name="search" placeholder="Tìm kiếm đơn hàng..." 
                               value="{{ request('search') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                        <select name="status" 
                                class="px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Tất cả trạng thái</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đang giao hàng</option>
                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Đã giao hàng</option>
                            <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                        
                        <select name="payment_status" 
                                class="px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="all" {{ request('payment_status') == 'all' ? 'selected' : '' }}>Tất cả TT thanh toán</option>
                            <option value="0" {{ request('payment_status') == '0' ? 'selected' : '' }}>Chưa thanh toán</option>
                            <option value="1" {{ request('payment_status') == '1' ? 'selected' : '' }}>Đã thanh toán</option>
                        </select>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 flex items-center justify-center">
                            <i class="fas fa-search mr-1"></i> Tìm kiếm
                        </button>
                        
                        @if(request('search') || request('status') != 'all' || request('payment_status') != 'all')
                            <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 flex items-center justify-center">
                                <i class="fas fa-times mr-1"></i> Xóa bộ lọc
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Bảng dữ liệu - Desktop -->
    <div class="hidden lg:block overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Mã đơn hàng
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Khách hàng
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
                        Ngày tạo
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Thao tác
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if(isset($orders) && count($orders) > 0)
                @foreach ($orders as $key => $order)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $order->order_code }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $order->fullname }}</div>
                        <div class="text-sm text-gray-500">{{ $order->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ number_format($order->order_total) }}đ</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($order->order_status == 0)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Đang xử lý
                        </span>
                        @elseif ($order->order_status == 1)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                            Đang giao hàng
                        </span>
                        @elseif ($order->order_status == 2)
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
                        @if ($order->payment_status == 0)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Chưa thanh toán
                        </span>
                        @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Đã thanh toán
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.orders.show', ['id' => $order->order_id]) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.orders.destroy', ['id' => $order->order_id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        Không có dữ liệu
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Card view - Mobile -->
    <div class="lg:hidden">
        @if(isset($orders) && count($orders) > 0)
            <div class="space-y-4 p-4">
                @foreach ($orders as $order)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">{{ $order->order_code }}</h3>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.orders.show', ['id' => $order->order_id]) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.orders.destroy', ['id' => $order->order_id]) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Khách hàng:</span>
                            <div class="text-right">
                                <div class="text-sm font-medium text-gray-900">{{ $order->fullname }}</div>
                                <div class="text-xs text-gray-500">{{ $order->email }}</div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500">Tổng tiền:</span>
                            <span class="text-sm font-medium text-gray-900">{{ number_format($order->order_total) }}đ</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Trạng thái đơn hàng:</span>
                            @if ($order->order_status == 0)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Đang xử lý
                            </span>
                            @elseif ($order->order_status == 1)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Đang giao hàng
                            </span>
                            @elseif ($order->order_status == 2)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Đã giao hàng
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Đã hủy
                            </span>
                            @endif
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">Thanh toán:</span>
                            @if ($order->payment_status == 0)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Chưa thanh toán
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Đã thanh toán
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="p-8 text-center text-gray-500">
                <i class="fas fa-inbox text-4xl mb-4"></i>
                <p>Không có dữ liệu</p>
            </div>
        @endif
    </div>
    
    <!-- Phân trang -->
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $orders->appends(request()->query())->links() }}
    </div>
</div>
@endsection