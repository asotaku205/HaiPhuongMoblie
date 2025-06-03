@extends('admin.admin_layout')

@section('title', 'Dashboard - Hải Phương Mobile Admin')

@section('page_title', 'Dashboard')

@section('content')
<!-- Stat cards -->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <!-- Total Users -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                    <i class="fas fa-users text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Tổng người dùng</p>
                    <p class="text-xl font-semibold text-gray-900">1,482</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                    <i class="fas fa-shopping-cart text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Tổng đơn hàng</p>
                    <p class="text-xl font-semibold text-gray-900">568</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Products -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                    <i class="fas fa-mobile-alt text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Tổng sản phẩm</p>
                    <p class="text-xl font-semibold text-gray-900">142</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                    <i class="fas fa-chart-line text-white"></i>
                </div>
                <div class="ml-5">
                    <p class="text-sm font-medium text-gray-500 truncate">Doanh thu</p>
                    <p class="text-xl font-semibold text-gray-900">₫64.2M</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection