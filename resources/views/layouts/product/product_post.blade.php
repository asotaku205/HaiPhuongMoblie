@extends('layouts.main')
@section('title', 'Sản Phẩm - Hải Phương Mobile')
@section('content')
<!-- Banner Section -->
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 flex justify-center relative">
                <!-- Nút điều hướng trái -->
                <button id="prevImage" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 z-10">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                
                <div class="relative flex items-center justify-center w-full h-[500px]">
                    <img id="mainImage" src="{{ asset('uploads/products/'.$product->product_image) }}" alt="{{ $product->product_name }}" class="max-h-full max-w-full object-contain">
                </div>
                
                <!-- Nút điều hướng phải -->
                <button id="nextImage" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 z-10">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <div class="md:w-1/2 px-6 mt-8 md:mt-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $product->product_name }}</h1>

                <!-- Tình trạng sản phẩm -->
                <div class="mb-4">
                    @if($product->in_stock && $product->stock_quantity > 0)
                        <span class="inline-block bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Còn hàng ({{ $product->stock_quantity }})
                        </span>
                    @else
                        <span class="inline-block bg-red-100 text-red-800 text-sm font-semibold px-3 py-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Hết hàng
                        </span>
                    @endif
                </div>

                <!-- Dung lượng -->
                @if($product->capacity)
                <div class="mb-6">
                    <h3 class="text-lg mb-3">Dung lượng</h3>
                    <div class="flex flex-wrap gap-3">
                        <button class="bg-gray-200 px-6 py-2 rounded-md hover:bg-gray-300 focus-within:shadow-lg focus:border-gray-800 focus:border-2">{{ $product->capacity }}</button>
                    </div>
                </div>
                @endif

                <!-- Màu sắc -->
                @php
                    $availableColors = $product->getAvailableColors();
                @endphp
                @if(count($availableColors) > 0)
                <div class="mb-6">
                    <h3 class="text-lg mb-3">Màu sắc: <span id="selected-color-name" class="font-medium"></span></h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($availableColors as $index => $colorName)
                            <div class="flex flex-col items-center space-y-1">
                                <div class="color-option w-10 h-10 rounded-full border-2 border-gray-200 hover:border-blue-500 cursor-pointer {{ $index === 0 ? 'active border-blue-500' : '' }}" 
                                    data-color="{{ $colorName }}"
                                    title="{{ $colorName }}">
                                </div>
                                <span class="text-xs">{{ $colorName }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Giá -->
                <div class="text-3xl font-bold mb-6">{{ number_format($product->product_price, 0, ',', '.') }}₫</div>

                <!-- Nút mua hàng -->
                <div class="flex flex-col space-y-4">
                    <div class="flex items-center space-x-4 mb-2">
                        <label for="quantity" class="font-semibold">Số lượng:</label>
                        <div class="flex items-center rounded-lg">
                            <button type="button" onclick="decreaseQuantity()" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-l">-</button>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock_quantity }}" class="w-16 text-center py-1 focus:outline-none">
                            <button type="button" onclick="increaseQuantity()" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-r">+</button>
                        </div>
                    </div>
                    
                    <div class="flex space-x-4">
                        <form action="{{ route('save_cart') }}" method="POST" class="flex space-x-4 w-full">
                            @csrf
                            <input type="hidden" name="product_id_hidden" value="{{ $product->product_id }}">
                            <input type="hidden" name="quantity" id="form-quantity" value="1">
                            <input type="hidden" name="selected_color" id="form-color" value="">
                            <button type="submit" name="buy_now" value="1" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors w-full text-center font-semibold" {{ !$product->in_stock || $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                                MUA NGAY
                            </button>
                            <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors w-full text-center font-semibold" {{ !$product->in_stock || $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                                Thêm vào giỏ hàng
                            </button>
                            
                        </form>
                        <script src="{{ asset('js/quantity.js') }}"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Thumbnails -->
    <div class="container mx-auto px-4 mt-8">
        <div class="flex justify-center gap-3 flex-wrap">
            <div class="thumbnail-item cursor-pointer border-2 border-blue-500 rounded-md overflow-hidden w-20 h-20">
                <img src="{{ asset('uploads/products/'.$product->product_image) }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover" data-src="{{ asset('uploads/products/'.$product->product_image) }}">
            </div>
            
            @if(!empty($product->product_images))
                @foreach($product->product_images as $image)
                <div class="thumbnail-item cursor-pointer border-2 border-gray-200 hover:border-blue-500 rounded-md overflow-hidden w-20 h-20">
                    <img src="{{ asset('uploads/products/'.$image) }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover" data-src="{{ asset('uploads/products/'.$image) }}">
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<!-- Đặc điểm nổi bật -->
<div class="bg-gray-100 py-16 m-10 rounded-lg">
    <div class="container mx-auto px-4 ">
        <h2 class="text-3xl font-bold text-center mb-12">Đặc điểm nổi bật</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="flex flex-col items-center text-center">
                <img src="{{ asset('uploads/products/'.$product->product_image) }}" alt="Thiết kế" class="max-h-[300px] w-auto mb-6">
                <h3 class="text-2xl font-semibold mb-4">Thiết kế sang trọng</h3>
                <p class="text-gray-600">{{ $product->product_description }}</p>
            </div>
            <div class="flex flex-col items-center text-center">
                <img src="{{ !empty($product->product_images) ? asset('uploads/products/'.$product->product_images[0]) : asset('uploads/products/'.$product->product_image) }}" alt="Hiệu năng" class="max-h-[300px] w-auto mb-6">
                <h3 class="text-2xl font-semibold mb-4">Hiệu năng vượt trội</h3>
                <p class="text-gray-600">{{ $product->product_content }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Thông số kỹ thuật -->
<div class="bg-gray-100 py-16 m-10 rounded-lg">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Thông số kỹ thuật</h2>
        <div class="bg-white rounded-xl shadow-sm max-w-3xl mx-auto overflow-hidden">
            <div class="grid grid-cols-1 divide-y">
                @if(!empty($product->product_specs))
                    @foreach($product->product_specs as $key => $value)
                    <div class="grid grid-cols-3 p-4">
                        <div class="font-semibold">{{ $key }}</div>
                        <div class="col-span-2">{{ $value }}</div>
                    </div>
                    @endforeach
                @else
                    <div class="grid grid-cols-3 p-4">
                        <div class="font-semibold">Màn hình</div>
                        <div class="col-span-2">Chưa có thông tin</div>
                    </div>
                    <div class="grid grid-cols-3 p-4">
                        <div class="font-semibold">Chip</div>
                        <div class="col-span-2">Chưa có thông tin</div>
                    </div>
                    <div class="grid grid-cols-3 p-4">
                        <div class="font-semibold">RAM</div>
                        <div class="col-span-2">Chưa có thông tin</div>
                    </div>
                    <div class="grid grid-cols-3 p-4">
                        <div class="font-semibold">Bộ nhớ trong</div>
                        <div class="col-span-2">Chưa có thông tin</div>
                    </div>
                    <div class="grid grid-cols-3 p-4">
                        <div class="font-semibold">Camera sau</div>
                        <div class="col-span-2">Chưa có thông tin</div>
                    </div>
                    <div class="grid grid-cols-3 p-4">
                        <div class="font-semibold">Camera trước</div>
                        <div class="col-span-2">Chưa có thông tin</div>
                    </div>
                    <div class="grid grid-cols-3 p-4">
                        <div class="font-semibold">Pin</div>
                        <div class="col-span-2">Chưa có thông tin</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


<!-- Sản phẩm tương tự -->
<div class="bg-gray-100 py-16 m-10 rounded-lg">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Sản phẩm tương tự</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($all_product as $key => $item)
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <div class="relative mb-4 h-[200px] flex items-center justify-center">
                    <img src="{{ asset('uploads/products/'.$item->product_image) }}" alt="{{ $item->product_name }}" class="max-h-[180px] w-auto object-contain">
                </div>
                <h3 class="text-lg font-semibold mb-2">{{ $item->product_name }}</h3>
                <div class="text-lg font-bold text-blue-600 mb-4">
                    {{ number_format($item->product_price, 0, ',', '.') }}₫
                </div>
                <div class="mt-4">
                    <a href="{{route('product_post', $item->product_id)}}" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition-colors block text-center">
                        Xem chi tiết
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    // Xử lý chuyển đổi hình ảnh
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail-item img');
        let currentImageIndex = 0;
        const images = [];
        
        // Thu thập tất cả các đường dẫn hình ảnh
        thumbnails.forEach(thumb => {
            images.push(thumb.getAttribute('data-src'));
        });
        
        // Xử lý khi click vào thumbnail
        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', function() {
                mainImage.src = this.getAttribute('data-src');
                currentImageIndex = index;
                
                // Cập nhật border cho thumbnail đang được chọn
                document.querySelectorAll('.thumbnail-item').forEach(item => {
                    item.classList.remove('border-blue-500');
                    item.classList.add('border-gray-200');
                });
                this.parentElement.classList.remove('border-gray-200');
                this.parentElement.classList.add('border-blue-500');
            });
        });
        
        // Xử lý nút next/prev
        document.getElementById('nextImage').addEventListener('click', function() {
            if (images.length > 1) {
                currentImageIndex = (currentImageIndex + 1) % images.length;
                mainImage.src = images[currentImageIndex];
                updateThumbnailSelection(currentImageIndex);
            }
        });
        
        document.getElementById('prevImage').addEventListener('click', function() {
            if (images.length > 1) {
                currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                mainImage.src = images[currentImageIndex];
                updateThumbnailSelection(currentImageIndex);
            }
        });
        
        function updateThumbnailSelection(index) {
            document.querySelectorAll('.thumbnail-item').forEach((item, i) => {
                if (i === index) {
                    item.classList.remove('border-gray-200');
                    item.classList.add('border-blue-500');
                } else {
                    item.classList.remove('border-blue-500');
                    item.classList.add('border-gray-200');
                }
            });
        }
        
        // Xử lý giới hạn số lượng
        const quantityInput = document.getElementById('quantity');
        const formQuantityInput = document.getElementById('form-quantity');
        const maxQuantity = parseInt("{{ $product->stock_quantity ?? 0 }}");
        
        window.decreaseQuantity = function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                formQuantityInput.value = quantityInput.value;
            }
        };
        
        window.increaseQuantity = function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < maxQuantity) {
                quantityInput.value = currentValue + 1;
                formQuantityInput.value = quantityInput.value;
            }
        };
        
        quantityInput.addEventListener('change', function() {
            let currentValue = parseInt(this.value);
            if (isNaN(currentValue) || currentValue < 1) {
                this.value = 1;
            } else if (currentValue > maxQuantity) {
                this.value = maxQuantity;
            }
            formQuantityInput.value = this.value;
        });
        
        // Xử lý hiển thị màu sắc
        const colorOptions = document.querySelectorAll('.color-option');
        
        if (colorOptions.length > 0) {
            colorOptions.forEach(option => {
                // Thiết lập màu nền cho các tùy chọn màu
                const colorName = option.dataset.color.toLowerCase().trim();
                option.style.backgroundColor = translateColorToHex(colorName);
                
                // Thêm sự kiện click để chọn màu
                option.addEventListener('click', function() {
                    // Loại bỏ trạng thái active của tất cả các màu
                    colorOptions.forEach(opt => {
                        opt.classList.remove('active');
                        opt.classList.remove('border-blue-500');
                        opt.classList.add('border-gray-200');
                    });
                    
                    // Thêm trạng thái active cho màu được chọn
                    this.classList.add('active');
                    this.classList.remove('border-gray-200');
                    this.classList.add('border-blue-500');
                    
                    // Hiển thị tên màu đã chọn
                    const selectedColorElement = document.querySelector('#selected-color-name');
                    if (selectedColorElement) {
                        selectedColorElement.textContent = this.dataset.color;
                    }
                    
                    // Gửi giá trị màu đã chọn vào form nếu cần
                    const colorInput = document.querySelector('input[name="selected_color"]');
                    if (colorInput) {
                        colorInput.value = this.dataset.color;
                    }
                });
            });
            
            // Mặc định chọn màu đầu tiên
            if (colorOptions[0]) {
                colorOptions[0].click();
            }
        }
        
        // Hàm chuyển đổi tên màu tiếng Việt sang mã màu
        function translateColorToHex(colorName) {
            const colorMap = {
                'đen': '#000000',
                'trắng': '#FFFFFF',
                'đỏ': '#FF0000',
                'xanh lá': '#00FF00',
                'xanh dương': '#0000FF',
                'xanh': '#0000FF',  // mặc định xanh là xanh dương
                'xanh nước': '#00FFFF',
                'xanh da trời': '#87CEEB',
                'xanh lục': '#008000',
                'vàng': '#FFFF00',
                'cam': '#FFA500',
                'tím': '#800080',
                'hồng': '#FFC0CB',
                'nâu': '#A52A2A',
                'xám': '#808080',
                'bạc': '#C0C0C0',
                'vàng đồng': '#DAA520',
                'đỏ tươi': '#FF0000',
                'đỏ đậm': '#8B0000',
                'hồng nhạt': '#FFB6C1',
                'đỏ cam': '#FF4500',
                'tím nhạt': '#E6E6FA',
                'xanh navy': '#000080',
                'xanh ngọc': '#40E0D0',
                'xanh rêu': '#556B2F',
                'xanh mint': '#98FB98',
                'trắng ngà': '#FFFFF0',
                'trắng sữa': '#FDFFF5',
                'đen nhám': '#0A0A0A',
                'xám đậm': '#696969',
                'xám nhạt': '#D3D3D3',
                'vàng nhạt': '#FFE4B5',
                'nâu đậm': '#8B4513'
            };
            
            // Tìm màu phù hợp
            for (const [key, value] of Object.entries(colorMap)) {
                if (colorName.includes(key)) {
                    return value;
                }
            }
            
            // Nếu không tìm thấy màu phù hợp, trả về màu xám
            return '#CCCCCC';
        }
    });
</script>

@endsection