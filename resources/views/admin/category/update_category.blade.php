@extends('admin.admin_layout')
@section('title', 'Cập nhật danh mục - Hải Phương Mobile')

@section('page_title', 'Cập nhật danh mục sản phẩm')

@section('content')
<div class="bg-gray-100 p-6 rounded-lg shadow">
    <form action="{{ route('update_category', ['id' => $category->category_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <?php
            $message = session('success');
            if ($message) {
                echo '<div class="text-green-500 mb-4">' . $message . '</div>';
                session()->forget('success');
            }
            $error = session('error');
            if ($error) {
                echo '<div class="text-red-500 mb-4">' . $error . '</div>';
                session()->forget('error');
            }
            ?>
            <label for="category_name" class="block text-sm font-medium text-gray-700">Tên danh mục</label>
            <input type="text" name="category_name" id="category_name" value="{{ $category->category_name }}"
                class="p-4 mt-1 bg-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            @error('category_name')
            <div class="text-red-700 mt-1">
                <strong class="font-bold italic text-sm">{{ $message }}</strong>
            </div>
            @enderrorb
        </div>
        
        <!-- Danh mục cha -->
        <div class="mb-4">
            <label for="parent_id" class="block text-sm font-medium text-gray-700">Danh mục cha</label>
            <select name="parent_id" id="parent_id"
                class="p-4 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">-- Không có danh mục cha --</option>
                @foreach($parent_categories as $parent)
                <option value="{{ $parent->category_id }}" {{ $category->parent_id == $parent->category_id ? 'selected' : '' }}>{{ $parent->category_name }}</option>
                @endforeach
            </select>
            <p class="text-sm text-gray-500 mt-1">
                @if($category->parent_id === null)
                    <span class="text-blue-500">Đây là danh mục cha</span>
                @else
                    <span class="text-gray-500">Đây là danh mục con</span>
                @endif
            </p>
        </div>
        
        <!-- Mô tả -->
        <div class="mb-4">
            <label for="category_description" class="block text-sm font-medium text-gray-700">Mô tả</label>
            <textarea name="category_description" id="category_description" rows="3"
                class="p-4 mt-1 bg-white focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $category->category_description }}</textarea>
            @error('category_description')
            <div class="text-red-700 mt-1">
                <strong class="font-bold italic text-sm">{{ $message }}</strong>
            </div>
            @enderror
           
        </div>
        <!-- Trạng thái -->
        <div class="mb-4">
            <label for="category_status" class="block text-sm font-medium text-gray-700">Trạng thái</label>
            <select name="category_status" id="category_status"
                class="p-4 mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="1" {{ $category->category_status == 1 ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ $category->category_status == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
        
        </div>
        <!-- Nút lưu -->
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('category') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại
            </a>
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-save mr-2"></i> Lưu danh mục
            </button>
         
        </div>
    </form>
   
</div>

@endsection