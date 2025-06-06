@extends('layouts.main')
@section('title', 'Sản Phẩm - Hải Phương Mobile')
@section('content')
<!-- Banner Section -->
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 flex justify-center relative">
                <!-- Nút điều hướng trái -->
                <button class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 z-10">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                
                <div class="relative flex items-center justify-center w-full h-[500px]">
                    <img src="{{ asset('uploads/products/'.$product->product_image) }}" alt="{{ $product->product_name }}" class="max-h-full max-w-full object-contain">
                </div>
                
                <!-- Nút điều hướng phải -->
                <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 z-10">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            
            <div class="md:w-1/2 px-6 mt-8 md:mt-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $product->product_name }}</h1>

                <!-- Dung lượng -->
                <div class="mb-6">
                    <h3 class="text-lg mb-3">Dung lượng</h3>
                    <div class="flex space-x-3">
                        <button class="bg-gray-200 px-6 py-2 rounded-md hover:bg-gray-300 focus-within:shadow-lg focus:border-gray-800 focus:border-2">128GB</button>
                        <button class="bg-gray-200 px-6 py-2 rounded-md hover:bg-gray-300 focus-within:shadow-lg focus:border-gray-800 focus:border-2">256GB</button>
                        <button class="bg-gray-200 px-6 py-2 rounded-md hover:bg-gray-300 focus-within:shadow-lg focus:border-gray-800 focus:border-2">512GB</button>
                    </div>
                </div>

                <!-- Màu sắc -->
                <div class="mb-6">
                    <h3 class="text-lg mb-3">Màu: Vàng nhạt</h3>
                    <div class="flex space-x-3">
                        <button class="w-10 h-10 rounded-full bg-yellow-100   focus-within:shadow-lg focus:border-blue-500 focus:border-4"></button>
                        <button class="w-10 h-10 rounded-full bg-green-100  focus-within:shadow-lg focus:border-blue-500 focus:border-4"></button>
                        <button class="w-10 h-10 rounded-full bg-pink-100  focus-within:shadow-lg focus:border-blue-500 focus:border-4"></button>
                        <button class="w-10 h-10 rounded-full bg-blue-100 focus-within:shadow-lg focus:border-blue-500 focus:border-4"></button>
                        <button class="w-10 h-10 rounded-full bg-gray-800 focus-within:shadow-lg focus:border-blue-500 focus:border-4"></button>
                    </div>
                </div>

                <!-- Giá -->
                <div class="text-3xl font-bold mb-6">{{ number_format($product->product_price, 0, ',', '.') }}₫</div>

                <!-- Nút mua hàng -->
                <div class="flex space-x-4">
                    <a href="#" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors w-full text-center font-semibold">
                        MUA NGAY
                    </a>
                    <a href="#" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors w-full text-center font-semibold">
                        Thêm vào giỏ hàng
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Thumbnails -->
    <div class="container mx-auto px-4 mt-8">
        <div class="flex justify-center space-x-3">
            <button class="w-3 h-3 rounded-full bg-gray-500"></button>
            <button class="w-3 h-3 rounded-full bg-gray-300"></button>
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
                <p class="text-gray-600">Thiết kế tinh tế với khung viền titan cứng cáp, mặt lưng kính nhám sang trọng cùng màn hình Dynamic Island hiện đại.</p>
            </div>
            <div class="flex flex-col items-center text-center">
                <img src="{{ asset('uploads/products/'.$product->product_image) }}" alt="Hiệu năng" class="max-h-[300px] w-auto mb-6">
                <h3 class="text-2xl font-semibold mb-4">Hiệu năng vượt trội</h3>
                <p class="text-gray-600">Trang bị chip A16 Bionic mạnh mẽ, xử lý mọi tác vụ mượt mà từ cơ bản đến chơi game, chỉnh sửa hình ảnh chuyên nghiệp.</p>
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
                <div class="grid grid-cols-3 p-4">
                    <div class="font-semibold">Màn hình</div>
                    <div class="col-span-2">Super Retina XDR OLED, 6.1 inch, 2556 x 1179 pixel</div>
                </div>
                <div class="grid grid-cols-3 p-4">
                    <div class="font-semibold">Chip</div>
                    <div class="col-span-2">A16 Bionic</div>
                </div>
                <div class="grid grid-cols-3 p-4">
                    <div class="font-semibold">RAM</div>
                    <div class="col-span-2">6 GB</div>
                </div>
                <div class="grid grid-cols-3 p-4">
                    <div class="font-semibold">Bộ nhớ trong</div>
                    <div class="col-span-2">128 GB</div>
                </div>
                <div class="grid grid-cols-3 p-4">
                    <div class="font-semibold">Camera sau</div>
                    <div class="col-span-2">Chính 48 MP, Ultra Wide 12 MP, Telephoto 12 MP</div>
                </div>
                <div class="grid grid-cols-3 p-4">
                    <div class="font-semibold">Camera trước</div>
                    <div class="col-span-2">12 MP, f/1.9</div>
                </div>
                <div class="grid grid-cols-3 p-4">
                    <div class="font-semibold">Pin</div>
                    <div class="col-span-2">3349 mAh, sạc nhanh 20W, sạc không dây MagSafe 15W</div>
                </div>
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

@endsection