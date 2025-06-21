@extends('admin.admin_layout')
@section('title', 'Danh sách sản phẩm - Hải Phương Mobile')
@section('page_title', 'Danh sách sản phẩm')
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
        <div class="flex flex-col space-y-4 sm:space-y-0 sm:flex-row sm:justify-between sm:items-center">
            <div class="order-2 sm:order-1">
                <a href="{{ route('add_product') }}"
                    class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <i class="fas fa-plus mr-1"></i> Thêm sản phẩm
                </a>
            </div>

            <div class="order-1 sm:order-2 w-full sm:w-auto">
                <form action="{{ route('product.search') }}" method="GET" class="w-full sm:w-80">
                    <div class="relative">
                        <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm transition duration-150 ease-in-out"
                               value="{{ request('search') }}">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <button type="submit" class="p-2 focus:outline-none focus:shadow-outline hover:text-blue-500">
                                <span class="sr-only">Tìm kiếm</span>
                                <svg class="h-5 w-5 text-gray-500 hover:text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
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
                        Hình ảnh
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tên sản phẩm
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Danh mục
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Giá
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tồn kho
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Trạng thái
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Thao tác
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if(isset($all_product) && count($all_product) > 0)
                @foreach ($all_product as $key => $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex-shrink-0 h-10 w-10">
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('uploads/products/' . $product->product_image) }}" alt="{{ $product->product_name }}">
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $product->product_name }}</div>
                        @if(!empty($product->capacity))
                            <div class="text-xs text-gray-500">{{ $product->capacity }}</div>
                        @endif
                        @if(!empty($product->color))
                            <div class="text-xs text-gray-500">{{ $product->color }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $product->category_name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ number_format($product->product_price) }}đ</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            @if(isset($product->stock_quantity))
                                @if($product->stock_quantity > 0)
                                    <span class="text-green-600">{{ $product->stock_quantity }}</span>
                                @else
                                    <span class="text-red-600">0</span>
                                @endif
                            @else
                                <span class="text-gray-400">--</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($product->product_status == 1)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Hiển thị
                        </span>
                        @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Ẩn
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('edit_product', ['id' => $product->product_id] ) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('delete_product', ['id' => $product->product_id]) }}" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </a>
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
        @if(isset($all_product) && count($all_product) > 0)
            <div class="space-y-4 p-4">
                @foreach ($all_product as $product)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <img class="h-16 w-16 rounded-lg object-cover" src="{{ asset('uploads/products/' . $product->product_image) }}" alt="{{ $product->product_name }}">
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex-1">
                                    <h3 class="text-sm font-medium text-gray-900 truncate">{{ $product->product_name }}</h3>
                                    <p class="text-xs text-gray-500 mt-1">{{ $product->category_name }}</p>
                                    @if(!empty($product->capacity))
                                        <p class="text-xs text-gray-500">{{ $product->capacity }}</p>
                                    @endif
                                    @if(!empty($product->color))
                                        <p class="text-xs text-gray-500">{{ $product->color }}</p>
                                    @endif
                                </div>
                                <div class="flex space-x-2 ml-2">
                                    <a href="{{ route('edit_product', ['id' => $product->product_id] ) }}" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-edit text-sm"></i>
                                    </a>
                                    <a href="{{ route('delete_product', ['id' => $product->product_id]) }}" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash text-sm"></i>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div>
                                    <span class="text-gray-500">Giá:</span>
                                    <div class="font-medium text-gray-900">{{ number_format($product->product_price) }}đ</div>
                                </div>
                                <div>
                                    <span class="text-gray-500">Tồn kho:</span>
                                    <div class="font-medium">
                                        @if(isset($product->stock_quantity))
                                            @if($product->stock_quantity > 0)
                                                <span class="text-green-600">{{ $product->stock_quantity }}</span>
                                            @else
                                                <span class="text-red-600">0</span>
                                            @endif
                                        @else
                                            <span class="text-gray-400">--</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-2">
                                @if ($product->product_status == 1)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Hiển thị
                                </span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Ẩn
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="p-8 text-center text-gray-500">
                <i class="fas fa-box-open text-4xl mb-4"></i>
                <p>Không có sản phẩm nào</p>
            </div>
        @endif
    </div>

    <!-- Phân trang -->
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        <div class="flex flex-col space-y-3 sm:space-y-0 sm:flex-row sm:items-center sm:justify-between">
            <div class="order-2 sm:order-1">
                <p class="text-sm text-gray-700 text-center sm:text-left">
                    Hiển thị <span class="font-medium">{{ $all_product->firstItem() }}</span> đến <span class="font-medium">{{ $all_product->lastItem() }}</span> của <span class="font-medium">{{ $all_product->total() }}</span> kết quả
                </p>
            </div>
            <div class="order-1 sm:order-2">
                {{ $all_product->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>
@endsection 