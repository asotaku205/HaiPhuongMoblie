@extends('layouts.main')

@section('title', 'Tạo bài viết mới')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Tạo bài viết mới</h1>
            <p class="mt-2 text-gray-600">Chia sẻ vấn đề kỹ thuật của bạn để nhận được sự trợ giúp</p>
        </div> <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm">
            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Tiêu đề bài viết <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Mô tả ngắn gọn vấn đề bạn gặp phải..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                    @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Device and Error Type -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="device_type" class="block text-sm font-medium text-gray-700 mb-2">
                            Loại thiết bị
                        </label>
                        <select id="device_type"
                            name="device_type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">-- Chọn loại thiết bị --</option>
                            <option value="iPhone" {{ old('device_type') == 'iPhone' ? 'selected' : '' }}>iPhone</option>
                            <option value="Android" {{ old('device_type') == 'Android' ? 'selected' : '' }}>Android</option>
                            <option value="Laptop" {{ old('device_type') == 'Laptop' ? 'selected' : '' }}>Laptop</option>
                            <option value="iPad" {{ old('device_type') == 'iPad' ? 'selected' : '' }}>iPad</option>
                            <option value="Máy tính bảng" {{ old('device_type') == 'Máy tính bảng' ? 'selected' : '' }}>Máy tính bảng</option>
                            <option value="Phụ kiện" {{ old('device_type') == 'Phụ kiện' ? 'selected' : '' }}>Phụ kiện</option>
                            <option value="Khác" {{ old('device_type') == 'Khác' ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>

                    <div>
                        <label for="error_type" class="block text-sm font-medium text-gray-700 mb-2">
                            Loại lỗi
                        </label>
                        <select id="error_type"
                            name="error_type"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">-- Chọn loại lỗi --</option>
                            <option value="Phần cứng" {{ old('error_type') == 'Phần cứng' ? 'selected' : '' }}>Phần cứng</option>
                            <option value="Phần mềm" {{ old('error_type') == 'Phần mềm' ? 'selected' : '' }}>Phần mềm</option>
                            <option value="Màn hình" {{ old('error_type') == 'Màn hình' ? 'selected' : '' }}>Màn hình</option>
                            <option value="Pin" {{ old('error_type') == 'Pin' ? 'selected' : '' }}>Pin</option>
                            <option value="Âm thanh" {{ old('error_type') == 'Âm thanh' ? 'selected' : '' }}>Âm thanh</option>
                            <option value="Mạng" {{ old('error_type') == 'Mạng' ? 'selected' : '' }}>Mạng</option>
                            <option value="Camera" {{ old('error_type') == 'Camera' ? 'selected' : '' }}>Camera</option>
                            <option value="Sạc" {{ old('error_type') == 'Sạc' ? 'selected' : '' }}>Sạc</option>
                            <option value="Khác" {{ old('error_type') == 'Khác' ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>
                </div> <!-- Content -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                        Nội dung chi tiết <span class="text-red-500">*</span>
                    </label>
                    <textarea id="content"
                        name="content"
                        rows="10"
                        placeholder="Mô tả chi tiết vấn đề:&#10;- Triệu chứng cụ thể&#10;- Khi nào bắt đầu xảy ra&#10;- Các bước bạn đã thử&#10;- Thông tin thiết bị (model, phiên bản OS...)"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                        required>{{ old('content') }}</textarea>
                    @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        Cung cấp thông tin chi tiết sẽ giúp hỗ trợ bạn tốt hơn.
                    </p>
                </div> <!-- Image Upload -->
                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700 mb-2">
                        Ảnh minh họa (tùy chọn) <span class="text-sm text-gray-500">- Tối đa 5 ảnh, mỗi ảnh không quá 3MB</span>
                    </label>
                    <div class="relative">
                        <input type="file"
                            id="images"
                            name="images[]"
                            multiple
                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                            class="hidden"
                            onchange="previewImages(this)">

                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors cursor-pointer"
                            onclick="document.getElementById('images').click()"
                            ondrop="dropHandler(event);"
                            ondragover="dragOverHandler(event);"
                            ondragenter="dragEnterHandler(event);"
                            ondragleave="dragLeaveHandler(event);">
                            <div class="space-y-2">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="text-gray-600">
                                    <span class="font-medium text-blue-600">Nhấp để chọn ảnh</span>
                                    <span> hoặc kéo thả vào đây</span>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF, WebP - Tối đa 3MB mỗi ảnh</p>
                                <p class="text-xs text-gray-500">Có thể chọn nhiều ảnh cùng lúc (tối đa 5 ảnh)</p>
                            </div>
                        </div>
                    </div>

                    @error('images')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('images.*')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <!-- Image Preview Container -->
                    <div id="imagePreview" class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 hidden"></div>

                    <!-- Upload Status -->
                    <div id="uploadStatus" class="mt-2 text-sm text-gray-600 hidden">
                        <span id="fileCount">0</span>/5 ảnh đã chọn
                    </div>

                    <p class="mt-2 text-sm text-gray-500">
                        Ảnh sẽ giúp mô tả vấn đề rõ ràng hơn và nhận được hỗ trợ nhanh chóng. Hãy chụp ảnh từ nhiều góc độ khác nhau để thể hiện vấn đề một cách đầy đủ.
                    </p>
                </div>

                <!-- Guidelines -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-blue-900 mb-2">Hướng dẫn viết bài hiệu quả:</h3>
                    <ul class="text-sm text-blue-800 space-y-1">
                        <li>• Tiêu đề ngắn gọn, mô tả chính xác vấn đề</li>
                        <li>• Mô tả chi tiết triệu chứng và hoàn cảnh xảy ra lỗi</li>
                        <li>• Cung cấp thông tin thiết bị (model, phiên bản hệ điều hành)</li>
                        <li>• Liệt kê các cách bạn đã thử khắc phục</li>
                        <li>• Đính kèm ảnh chụp màn hình hoặc ảnh thiết bị để minh họa</li>
                        <li>• Sử dụng nhiều ảnh để thể hiện vấn đề từ nhiều góc độ</li>
                    </ul>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit"
                        class="flex-1 sm:flex-none inline-flex justify-center items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                        Đăng bài viết
                    </button>

                    <a href="{{ route('blogs.index') }}"
                        class="flex-1 sm:flex-none inline-flex justify-center items-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                        Hủy bỏ
                    </a>
                </div>            </form>
        </div>
    </div>
</div>

<!-- Include Blog Create JavaScript -->
<script src="{{ asset('js/blog-create.js') }}"></script>
@endsection