@extends('layouts.main')
@section('title', 'Trang Chủ - Hải Phương Mobile')
@section('content')

<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <h2 class="text-3xl font-semibold mb-6 text-center">Sản Phẩm Nổi Bật</h2>
    <div class="flex transition-transform duration-300 ease-in-out" id="iphone-slider">
        @foreach ($all_product as $key => $item)
        <div class="min-w-[280px] md:min-w-[320px] p-4 ">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-xl font-semibold mb-4">{{ $item->product_name }}</h3>
                <div class="relative mb-4 h-[200px] w-[200px] mx-auto flex items-center justify-center">
                    <img src="{{ asset('uploads/products/'.$item->product_image) }}" alt="{{ $item->product_name }}" class="max-h-[180px] w-auto object-contain">
                </div>
                <div class="text-sm text-gray-600 mb-4">
                    {{ number_format($item->product_price, 0, ',', '.') }}đ
                </div>
                <div class="mt-4 flex items-center gap-4">
                    <a href="{{route('product_post', $item->product_id)}}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">Tìm hiểu thêm</a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Mua ›</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <button id="prev-btn" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button id="next-btn" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</section>



<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold mb-6">Iphone</h2>
        <a href="#" class="text-blue-600 hover:text-blue-800">Xem tất cả</a>
    </div>
    <div class="flex transition-transform duration-300 ease-in-out" id="iphone-slider">
        @foreach ($all_product as $key => $item)
        <div class="min-w-[280px] md:min-w-[320px] p-4 ">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-xl font-semibold mb-4">{{ $item->product_name }}</h3>
                <div class="relative mb-4 h-[200px] w-[200px] mx-auto flex items-center justify-center">
                    <img src="{{ asset('uploads/products/'.$item->product_image) }}" alt="{{ $item->product_name }}" class="max-h-[180px] w-auto object-contain">
                </div>
                <div class="text-sm text-gray-600 mb-4">
                    {{ number_format($item->product_price, 0, ',', '.') }}đ
                </div>
                <div class="mt-4 flex items-center gap-4">
                    <a href="{{route('product_post', $item->product_id)}}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">Tìm hiểu thêm</a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Mua ›</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Navigation Buttons -->
    <button id="prev-btn" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button id="next-btn" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</section>



<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold mb-6">Android</h2>
        <a href="#" class="text-blue-600 hover:text-blue-800">Xem tất cả</a>
    </div>
    <div class="flex transition-transform duration-300 ease-in-out" id="iphone-slider">
        @foreach ($all_product as $key => $item)
        <div class="min-w-[280px] md:min-w-[320px] p-4 ">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-xl font-semibold mb-4">{{ $item->product_name }}</h3>
                <div class="relative mb-4 h-[200px] w-[200px] mx-auto flex items-center justify-center">
                    <img src="{{ asset('uploads/products/'.$item->product_image) }}" alt="{{ $item->product_name }}" class="max-h-[180px] w-auto object-contain">
                </div>
                <div class="text-sm text-gray-600 mb-4">
                    {{ number_format($item->product_price, 0, ',', '.') }}đ
                </div>
                <div class="mt-4 flex items-center gap-4">
                    <a href="{{route('product_post', $item->product_id)}}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">Tìm hiểu thêm</a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Mua ›</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <button id="prev-btn" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button id="next-btn" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</section>


<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold mb-6">Laptop</h2>
        <a href="#" class="text-blue-600 hover:text-blue-800">Xem tất cả</a>
    </div>
    <div class="flex transition-transform duration-300 ease-in-out" id="iphone-slider">
        @foreach ($all_product as $key => $item)
        <div class="min-w-[280px] md:min-w-[320px] p-4 ">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-xl font-semibold mb-4">{{ $item->product_name }}</h3>
                <div class="relative mb-4 h-[200px] w-[200px] mx-auto flex items-center justify-center">
                    <img src="{{ asset('uploads/products/'.$item->product_image) }}" alt="{{ $item->product_name }}" class="max-h-[180px] w-auto object-contain">
                </div>
                <div class="text-sm text-gray-600 mb-4">
                    {{ number_format($item->product_price, 0, ',', '.') }}đ
                </div>
                <div class="mt-4 flex items-center gap-4">
                    <a href="{{route('product_post', $item->product_id)}}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">Tìm hiểu thêm</a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Mua ›</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <button id="prev-btn" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button id="next-btn" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</section>


<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold mb-6">Máy tính bảng</h2>
        <a href="#" class="text-blue-600 hover:text-blue-800">Xem tất cả</a>
    </div>
    <div class="flex transition-transform duration-300 ease-in-out" id="iphone-slider">
        @foreach ($all_product as $key => $item)
        <div class="min-w-[280px] md:min-w-[320px] p-4 ">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-xl font-semibold mb-4">{{ $item->product_name }}</h3>
                <div class="relative mb-4 h-[200px] w-[200px] mx-auto flex items-center justify-center">
                    <img src="{{ asset('uploads/products/'.$item->product_image) }}" alt="{{ $item->product_name }}" class="max-h-[180px] w-auto object-contain">
                </div>
                <div class="text-sm text-gray-600 mb-4">
                    {{ number_format($item->product_price, 0, ',', '.') }}đ
                </div>
                <div class="mt-4 flex items-center gap-4">
                    <a href="{{route('product_post', $item->product_id)}}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">Tìm hiểu thêm</a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Mua ›</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <button id="prev-btn" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button id="next-btn" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</section>


<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold mb-6">Các Sản Phẩm Khác</h2>
        <a href="#" class="text-blue-600 hover:text-blue-800">Xem tất cả</a>
    </div>
    <div class="flex transition-transform duration-300 ease-in-out" id="iphone-slider">
        @foreach ($all_product as $key => $item)
        <div class="min-w-[280px] md:min-w-[320px] p-4 ">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-xl font-semibold mb-4">{{ $item->product_name }}</h3>
                <div class="relative mb-4 h-[200px] w-[200px] mx-auto flex items-center justify-center">
                    <img src="{{ asset('uploads/products/'.$item->product_image) }}" alt="{{ $item->product_name }}" class="max-h-[180px] w-auto object-contain">
                </div>
                <div class="text-sm text-gray-600 mb-4">
                    {{ number_format($item->product_price, 0, ',', '.') }}đ
                </div>
                <div class="mt-4 flex items-center gap-4">
                    <a href="{{route('product_post', $item->product_id)}}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">Tìm hiểu thêm</a>
                    <a href="#" class="text-blue-600 hover:text-blue-800">Mua ›</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <button id="prev-btn" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button id="next-btn" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</section>


<section class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold">PHỤ KIỆN</h2>
        <a href="#" class="text-blue-600 hover:text-blue-800">Xem tất cả</a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
      

        <div class="bg-gray-200 rounded-lg p-4 text-center hover:shadow-lg transition-shadow">
            <img src="{{ asset('png/sac.png') }}" alt="Cáp, sạc" class="w-20 h-20 mx-auto mb-2 object-contain">
            <p class="font-medium">Cáp, sạc</p>
        </div>

        <div class="bg-gray-200 rounded-lg p-4 text-center hover:shadow-lg transition-shadow">
            <img src="{{ asset('png/sacduphong.png') }}" alt="Pin sạc dự phòng" class="w-20 h-20 mx-auto mb-2 object-contain">
            <p class="font-medium">Pin sạc dự phòng</p>
        </div>

        <div class="bg-gray-200 rounded-lg p-4 text-center hover:shadow-lg transition-shadow">
            <img src="{{ asset('png/oplung.png') }}" alt="Ốp lưng - Bao da" class="w-20 h-20 mx-auto mb-2 object-contain">
            <p class="font-medium">Ốp lưng - Bao da</p>
        </div>

        <div class="bg-gray-200 rounded-lg p-4 text-center hover:shadow-lg transition-shadow">
            <img src="{{ asset('png/kinh.png') }}" alt="Dán màn hình" class="w-20 h-20 mx-auto mb-2 object-contain">
            <p class="font-medium">Dán màn hình</p>
        </div>

        <div class="bg-gray-200 rounded-lg p-4 text-center hover:shadow-lg transition-shadow">
            <img src="{{ asset('png/usb.png') }}" alt="Thẻ nhớ, USB" class="w-20 h-20 mx-auto mb-2 object-contain">
            <p class="font-medium">Thẻ nhớ, USB</p>
        </div>


        <div class="bg-gray-200 rounded-lg p-4 text-center hover:shadow-lg transition-shadow">
            <img src="{{ asset('png/sim.png') }}" alt="Sim 4G" class="w-20 h-20 mx-auto mb-2 object-contain">
            <p class="font-medium">Sim 4G</p>
        </div>

        <div class="bg-gray-200 rounded-lg p-4 text-center hover:shadow-lg transition-shadow">
            <img src="{{ asset('png/cap.jpg') }}" alt="Thiết bị mạng" class="w-20 h-20 mx-auto mb-2 object-contain">
            <p class="font-medium">Thiết bị mạng</p>
        </div>

        <div class="bg-gray-200 rounded-lg p-4 text-center hover:shadow-lg transition-shadow">
            <img src="{{ asset('png/camera.png') }}" alt="Máy ảnh" class="w-20 h-20 mx-auto mb-2 object-contain">
            <p class="font-medium">Máy ảnh</p>
        </div>


        <div class="bg-gray-200 rounded-lg p-4 text-center hover:shadow-lg transition-shadow">
            <img src="{{ asset('png/item_phone.png') }}" alt="Phụ kiện điện thoại" class="w-20 h-20 mx-auto mb-2 object-contain">
            <p class="font-medium">Phụ kiện điện thoại</p>
        </div>

        <div class="bg-gray-200 rounded-lg p-4 text-center hover:shadow-lg transition-shadow">
            <img src="{{ asset('png/item_laptop.png') }}" alt="Phụ kiện Laptop" class="w-20 h-20 mx-auto mb-2 object-contain">
            <p class="font-medium">Phụ kiện Laptop</p>
        </div>
    </div>
</section>
@endsection