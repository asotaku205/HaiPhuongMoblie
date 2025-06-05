@extends('admin.admin_layout')
@section('title', 'Xóa danh mục - Hải Phương Mobile')
@section('page_title', 'Xóa danh mục sản phẩm')

@section('content')
<div class="bg-gray-100 p-6 rounded-lg shadow">
    <div class="mb-4">
        <h2 class="text-lg font-medium text-gray-900">Bạn có chắc chắn muốn xóa danh mục: {{ $category->category_name }}?</h2>
        <p class="mt-2 text-sm text-gray-600">Hành động này không thể hoàn tác.</p>
    </div>

    <form action="{{ route('destroy_category', ['id' => $category->category_id]) }}" method="POST">
        @csrf
        @method('DELETE')
        
        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('category') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 mr-2">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại
            </a>
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-trash mr-2"></i> Xác nhận xóa
            </button>
        </div>
    </form>
</div>
@endsection

