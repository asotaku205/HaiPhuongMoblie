@extends('admin.admin_layout')
@section('title', 'Xóa danh mục - Hải Phương Mobile')
@section('page_title', 'Xóa danh mục sản phẩm')

@section('content')
<div class="fixed inset-0 bg-opacity-50 z-50 hidden items-center justify-center backdrop-blur-sm">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Xác nhận xóa danh mục</h2>
        
        @if($has_children)
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p class="font-bold">Cảnh báo!</p>
            <p>Danh mục này có chứa danh mục con. Bạn không thể xóa danh mục này.</p>
            <p>Vui lòng xóa tất cả danh mục con trước khi xóa danh mục này.</p>
        </div>
        @endif
        
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
            <p class="font-bold">Thông báo!</p>
            <p>Bạn có chắc chắn muốn xóa danh mục <strong>"{{ $category->category_name }}"</strong> không?</p>
            <p>Hành động này không thể hoàn tác.</p>
        </div>
    </div>

    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-2">Thông tin danh mục</h3>
        <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
            <div>
                <dt class="text-sm font-medium text-gray-500">Tên danh mục</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $category->category_name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Loại danh mục</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    @if($category->parent_id === null)
                        Danh mục cha
                    @else
                        Danh mục con của "{{ $category->parent->category_name }}"
                    @endif
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Mô tả</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $category->category_description }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Trạng thái</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    @if($category->category_status == 1)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Hiển thị</span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ẩn</span>
                    @endif
                </dd>
            </div>
        </dl>
    </div>

    <div class="flex justify-end space-x-3">
        <a href="{{ route('category') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
            Quay lại
        </a>
        @if(!$has_children)
        <a href="{{ route('destroy_category', ['id' => $category->category_id]) }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
            Xác nhận xóa
        </a>
        @endif
    </div>
</div>
@endsection

