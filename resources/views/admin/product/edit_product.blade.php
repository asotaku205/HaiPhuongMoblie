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
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-6">
                <!-- Tên sản phẩm -->
                <div>
                    <label for="product_name" class="block text-sm font-medium text-gray-700">Tên sản phẩm <span class="text-red-500">*</span></label>
                    <input type="text" name="product_name" id="product_name" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ $product->product_name }}">
                    @error('product_name')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Danh mục sản phẩm -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục <span class="text-red-500">*</span></label>
                    <select name="category_id" id="category_id" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Chọn danh mục</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->category_id }}" {{ $product->category_id == $category->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Giá sản phẩm -->
                <div>
                    <label for="product_price" class="block text-sm font-medium text-gray-700">Giá sản phẩm <span class="text-red-500">*</span></label>
                    <input type="text" name="product_price" id="product_price" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ $product->product_price }}">
                    @error('product_price')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Màu sắc -->
                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700">Màu sắc</label>
                    <input type="text" name="color" id="color"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ $product->color }}">
                    @error('color')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Dung lượng -->
                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-700">Dung lượng</label>
                    <input type="text" name="capacity" id="capacity"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ $product->capacity }}">
                    @error('capacity')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Số lượng tồn kho -->
                <div>
                    <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Số lượng tồn kho <span class="text-red-500">*</span></label>
                    <input type="number" name="stock_quantity" id="stock_quantity" min="0" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ $product->stock_quantity ?? 0 }}">
                    @error('stock_quantity')
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
                
                <!-- Hình ảnh chính -->
                <div>
                    <label for="product_image" class="block text-sm font-medium text-gray-700">Hình ảnh chính</label>
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
                
                <!-- Nhiều hình ảnh -->
                <div>
                    <label for="product_images" class="block text-sm font-medium text-gray-700">Hình ảnh bổ sung</label>
                    @if(!empty($product->product_images))
                        <div class="flex flex-wrap gap-2 mt-2 mb-4">
                            @foreach($product->product_images as $image)
                                <div class="relative">
                                    <img src="{{ asset('uploads/products/' . $image) }}" alt="{{ $product->product_name }}" class="h-20 w-20 object-cover rounded">
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <input type="file" name="product_images[]" id="product_images" multiple
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <p class="text-xs text-gray-500 mt-1">Có thể chọn nhiều ảnh cùng lúc. Tải lên sẽ thay thế tất cả ảnh bổ sung hiện tại.</p>
                    @error('product_images')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            
            <div class="space-y-6">
                <!-- Mô tả ngắn -->
                <div>
                    <label for="product_description" class="block text-sm font-medium text-gray-700">Mô tả ngắn <span class="text-red-500">*</span></label>
                    <textarea name="product_description" id="product_description" rows="3" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $product->product_description }}</textarea>
                    @error('product_description')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Nội dung chi tiết -->
                <div>
                    <label for="product_content" class="block text-sm font-medium text-gray-700">Nội dung chi tiết <span class="text-red-500">*</span></label>
                    <textarea name="product_content" id="product_content" rows="4" required
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $product->product_content }}</textarea>
                    @error('product_content')
                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>
                
                <!-- Thông số kỹ thuật -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Thông số kỹ thuật</label>
                    <div id="specs-container" class="space-y-3">
                        @if(!empty($product->product_specs))
                            @foreach($product->product_specs as $key => $value)
                            <div class="grid grid-cols-5 gap-3">
                                <div class="col-span-2">
                                    <input type="text" name="spec_name[]" placeholder="Tên thông số (vd: Màn hình)" value="{{ $key }}"
                                        class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-2">
                                    <input type="text" name="spec_value[]" placeholder="Giá trị (vd: 6.1 inch)" value="{{ $value }}"
                                        class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="flex items-center justify-center">
                                    <button type="button" class="remove-spec px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="grid grid-cols-5 gap-3">
                                <div class="col-span-2">
                                    <input type="text" name="spec_name[]" placeholder="Tên thông số (vd: Màn hình)"
                                        class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="col-span-2">
                                    <input type="text" name="spec_value[]" placeholder="Giá trị (vd: 6.1 inch)"
                                        class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="flex items-center justify-center">
                                    <button type="button" class="add-spec px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="mt-3">
                        <button type="button" class="add-spec px-3 py-2 bg-indigo-100 text-indigo-700 text-sm rounded-md hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Thêm thông số
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Nút lưu -->
        <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
            <a href="{{ route('product') }}" class="px-6 py-3 bg-gray-200 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                Hủy
            </a>
            <button type="submit"
                class="px-6 py-3 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Cập nhật sản phẩm
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const specsContainer = document.getElementById('specs-container');
        
        // Thêm thông số kỹ thuật
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('add-spec') || e.target.closest('.add-spec')) {
                const specRow = document.createElement('div');
                specRow.className = 'grid grid-cols-5 gap-3';
                specRow.innerHTML = `
                    <div class="col-span-2">
                        <input type="text" name="spec_name[]" placeholder="Tên thông số (vd: Màn hình)"
                            class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="col-span-2">
                        <input type="text" name="spec_value[]" placeholder="Giá trị (vd: 6.1 inch)"
                            class="block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div class="flex items-center justify-center">
                        <button type="button" class="remove-spec px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                `;
                
                specsContainer.appendChild(specRow);
            }
            
            // Xóa thông số kỹ thuật
            if (e.target.classList.contains('remove-spec') || e.target.closest('.remove-spec')) {
                const button = e.target.classList.contains('remove-spec') ? e.target : e.target.closest('.remove-spec');
                const row = button.closest('.grid');
                row.remove();
            }
        });
    });
</script>

@endsection 