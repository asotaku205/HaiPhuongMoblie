@extends('admin.admin_layout')
@section('title', 'Danh mục - Hải Phương Mobile')
@section('page_title', 'Danh mục sản phẩm')
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
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
            <div class="flex items-center">
                <select
                    class="mr-2 px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="0">Chọn hành động</option>
                    <option value="1">Xóa mục đã chọn</option>
                    <option value="2">Chỉnh sửa hàng loạt</option>
                    <option value="3">Xuất dữ liệu</option>
                </select>
                <button        
                    class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Áp dụng
                </button>
            </div>
            <!-- Nút thêm danh mục -->
            <div class="w-full md:w-auto">
                <a href="{{ route('add_category') }}"
                    class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <i class="fas fa-plus mr-1"></i> Thêm danh mục
                </a>
            </div>
            <!-- Tìm kiếm danh mục -->
            <form action="{{ route('category.search') }}" method="GET" class="flex items-center w-full md:w-auto">
                    <div class="relative flex-grow md:w-80">
                        <input type="text" name="search" placeholder="Tìm kiếm danh mục..." 
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition duration-150 ease-in-out"
                               value="{{ request('search') }}">
                        <div class="absolute inset-y-0 right-0 flex items-center">
                            <button type="submit" class="p-1 focus:outline-none focus:shadow-outline hover:text-blue-500 mr-2">
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

    <!-- Bảng dữ liệu -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <input type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tên danh mục
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Loại
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Danh mục cha
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Mô tả
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Ngày tạo
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Trạng thái
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Thao tác
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if(isset($all_category) && count($all_category) > 0)
                @foreach ($all_category as $key => $category)
                <tr class="{{ $category->parent_id === null ? 'bg-gray-50' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                            @if($category->parent_id !== null)
                                <span class="ml-4">└ </span>
                            @endif
                            {{ $category->category_name }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            @if($category->parent_id === null)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Danh mục cha
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Danh mục con
                                </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">
                            @if($category->parent)
                                {{ $category->parent->category_name }}
                            @else
                                -
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500 truncate max-w-xs">{{ $category->category_description }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-500">{{ $category->created_at }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($category->category_status == 1)
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Hiển thị
                        </span>
                        @else
                        <span
                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Ẩn
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('edit_category', ['id' => $category->category_id] ) }}" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('delete_category', ['id' => $category->category_id]) }}" class="text-red-600 hover:text-red-900">
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

    <!-- Phân trang -->
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        <div class="flex items-center justify-between">
            <div class="flex-1 flex justify-between sm:hidden">
                <a href="#"
                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Trước
                </a>
                <a href="#"
                    class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Sau
                </a>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Hiển thị <span class="font-medium">1</span> đến <span class="font-medium">3</span> của <span
                            class="font-medium">3</span> kết quả
                    </p>
                </div>
                <div class="mt-4 ">
                    {{ $all_category->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection