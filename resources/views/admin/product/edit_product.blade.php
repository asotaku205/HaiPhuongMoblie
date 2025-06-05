@extends('admin.admin_layout')

@section('title', 'Chỉnh Sửa Sản Phẩm - Hải Phương Mobile')

@section('page_title', 'Chỉnh Sửa Sản Phẩm')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden p-6">
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

    <!-- Form chỉnh sửa sản phẩm -->
    <form action="{{ route('update_product', ['id' => $product->product_id]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Tên sản phẩm -->
        <div>
            <label for="product_name" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
            <input type="text" name="product_name" id="product_name" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                value="{{ $product->product_name }}">
            @error('product_name')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Danh mục sản phẩm -->
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục</label>
            <select name="category_id" id="category_id" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Chọn danh mục</option>
                @foreach($all_category as $category)
                <option value="{{ $category->category_id }}" {{ $product->category_id == $category->category_id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Mô tả ngắn -->
        <div>
            <label for="product_description" class="block text-sm font-medium text-gray-700">Mô tả ngắn</label>
            <textarea name="product_description" id="product_description" rows="3" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $product->product_description }}</textarea>
            @error('product_description')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Nội dung chi tiết -->
        <div>
            <label for="product_content" class="block text-sm font-medium text-gray-700">Nội dung chi tiết</label>
            <textarea name="product_content" id="product_content" rows="6" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $product->product_content }}</textarea>
            @error('product_content')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Giá sản phẩm -->
        <div>
            <label for="product_price" class="block text-sm font-medium text-gray-700">Giá sản phẩm</label>
            <input type="text" name="product_price" id="product_price" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                value="{{ $product->product_price }}">
            @error('product_price')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Hình ảnh sản phẩm -->
        <div>
            <label for="product_image" class="block text-sm font-medium text-gray-700">Hình ảnh sản phẩm</label>
            <div class="mt-2 mb-4">
                <img src="{{ asset('uploads/products/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="h-32 w-32 object-cover rounded">
            </div>
            <input type="file" name="product_image" id="product_image"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <p class="text-xs text-gray-500 mt-1">Để trống nếu không muốn thay đổi hình ảnh</p>
            @error('product_image')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Trạng thái -->
        <div>
            <label for="product_status" class="block text-sm font-medium text-gray-700">Trạng thái</label>
            <select name="product_status" id="product_status" 
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="1" {{ $product->product_status == 1 ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ $product->product_status == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
            @error('product_status')
                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
        </div>
        
        <!-- Nút lưu -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('product') }}" class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                Hủy
            </a>
            <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Cập nhật sản phẩm
            </button>
        </div>
    </form>
</div>

@endsection 