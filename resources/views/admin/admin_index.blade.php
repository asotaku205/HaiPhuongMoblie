@extends('admin.admin_layout')

@section('title', 'Dashboard - Hải Phương Mobile Admin')

@section('css')
<link href="{{ asset('css/admin-dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
<!-- Dashboard Header với thời gian -->
<div class="mb-6 bg-white overflow-hidden shadow rounded-lg">
    <div class="p-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Hải Phương Mobile</h1>
                <p class="text-sm text-gray-600 mt-1">Chào mừng bạn quay trở lại! Đây là tổng quan về hoạt động cửa hàng.</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Cập nhật lần cuối</p>
                <p class="text-lg font-semibold text-gray-900" id="currentTime">{{ date('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Stat cards -->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <!-- Total Users -->
    <div class="bg-white overflow-hidden shadow rounded-lg stat-card">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                    <i class="fas fa-users text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Tổng người dùng</p>
                    <p class="text-xl font-semibold text-gray-900 counter-animate">{{ number_format($totalUsers) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="bg-white overflow-hidden shadow rounded-lg stat-card">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                    <i class="fas fa-shopping-cart text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Tổng đơn hàng</p>
                    <p class="text-xl font-semibold text-gray-900 counter-animate">{{ number_format($totalOrders) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Products -->
    <div class="bg-white overflow-hidden shadow rounded-lg stat-card">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                    <i class="fas fa-mobile-alt text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Tổng sản phẩm</p>
                    <p class="text-xl font-semibold text-gray-900 counter-animate">{{ number_format($totalProducts) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white overflow-hidden shadow rounded-lg stat-card stat-glow">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                    <i class="fas fa-chart-line text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Tổng doanh thu</p>
                    <p class="text-xl font-semibold text-gray-900 counter-animate">{{ number_format($totalRevenue) }}đ</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Revenue Cards -->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-3 mt-6">
    <!-- Monthly Revenue -->
    <div class="bg-white overflow-hidden shadow rounded-lg stat-card stat-glow">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                    <i class="fas fa-calendar-alt text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Doanh thu tháng này</p>
                    <p class="text-xl font-semibold text-gray-900 counter-animate">{{ number_format($monthlyRevenue) }}đ</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Today Revenue -->
    <div class="bg-white overflow-hidden shadow rounded-lg stat-card stat-glow">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                    <i class="fas fa-calendar-day text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Doanh thu hôm nay</p>
                    <p class="text-xl font-semibold text-gray-900 counter-animate">{{ number_format($todayRevenue) }}đ</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Blogs -->
    <div class="bg-white overflow-hidden shadow rounded-lg stat-card">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-orange-500 rounded-md p-3">
                    <i class="fas fa-blog text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Tổng blog sửa chữa</p>
                    <p class="text-xl font-semibold text-gray-900 counter-animate">{{ number_format($totalBlogs) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Status Cards -->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-4 mt-6">
    <!-- Pending Orders -->
    <div class="bg-white overflow-hidden shadow rounded-lg stat-card">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                    <i class="fas fa-clock text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Chờ xử lý</p>
                    <p class="text-xl font-semibold text-gray-900 counter-animate">{{ number_format($pendingOrders) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Shipping Orders -->
    <div class="bg-white overflow-hidden shadow rounded-lg stat-card">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                    <i class="fas fa-truck text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Đang giao</p>
                    <p class="text-xl font-semibold text-gray-900 counter-animate">{{ number_format($shippingOrders) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Completed Orders -->
    <div class="bg-white overflow-hidden shadow rounded-lg stat-card">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                    <i class="fas fa-check text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Hoàn thành</p>
                    <p class="text-xl font-semibold text-gray-900 counter-animate">{{ number_format($completedOrders) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Products -->
    <div class="bg-white overflow-hidden shadow rounded-lg stat-card">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                    <i class="fas fa-exclamation-triangle text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Sắp hết hàng</p>
                    <p class="text-xl font-semibold text-gray-900 counter-animate">{{ number_format($lowStockProducts) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts and Tables -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">    <!-- Revenue Chart -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Doanh thu 7 ngày qua</h3>
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Sản phẩm bán chạy</h3>
            <div class="space-y-3">
                @forelse($topProducts as $index => $product)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg top-product-item">
                    <div class="flex items-center">
                        <span class="inline-flex items-center justify-center w-8 h-8 bg-blue-500 text-white text-sm font-medium rounded-full mr-3 top-product-rank">
                            {{ $index + 1 }}
                        </span>
                        <span class="text-sm font-medium text-gray-900">{{ substr($product->product_name, 0, 30) }}{{ strlen($product->product_name) > 30 ? '...' : '' }}</span>
                    </div>
                    <span class="text-sm font-semibold text-blue-600">{{ $product->total_sold }} đã bán</span>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Chưa có dữ liệu bán hàng</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders -->
<div class="bg-white overflow-hidden shadow rounded-lg mt-8">
    <div class="p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Đơn hàng gần đây</h3>
            <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Xem tất cả
            </a>
        </div>        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 recent-orders-table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mã đơn hàng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Khách hàng</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tổng tiền</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ngày tạo</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentOrders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.orders.show', $order->order_id) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                {{ $order->order_code }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $order->fullname }}</div>
                            <div class="text-sm text-gray-500">{{ $order->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ number_format($order->order_total) }}đ
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($order->order_status == 0)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 status-badge">
                                    Đang xử lý
                                </span>
                            @elseif($order->order_status == 1)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 status-badge">
                                    Đang giao hàng
                                </span>
                            @elseif($order->order_status == 2)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 status-badge">
                                    Đã giao hàng
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 status-badge">
                                    Đã hủy
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Chưa có đơn hàng nào
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/admin-dashboard-chart.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lưu dữ liệu chart vào window object để có thể truy cập từ file JS khác
    window.revenueChartData = {!! json_encode($revenueChart) !!};
    
    // Khởi tạo biểu đồ doanh thu
    initRevenueChart(window.revenueChartData);
});
</script>
<script src="{{ asset('js/admin-dashboard.js') }}"></script>
@endsection