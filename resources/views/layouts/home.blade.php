@extends('layouts.main')
@section('title', 'Trang Chủ - Hải Phương Mobile')
@section('content')
<!-- Thanh tìm kiếm với background -->
<div class="h-screen w-full bg-cover bg-bottom md:bg-center bg-no-repeat flex items-center justify-center md:items-start pt-0 md:pt-24" style="background-image: url('{{ asset('pic/cuahang.jpg') }}'); background-position: center top;">
    <div class="w-full px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white bg-opacity-90 rounded-lg shadow-lg">
                <form action="{{ route('search') }}" method="GET" class="flex items-center">
                    <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." class="w-full p-3 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg">
                    <button type="submit" class="bg-blue-600 text-white p-4 rounded-r-lg hover:bg-blue-700 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.65 11a5.65 5.65 0 11-11.3 0 5.65 5.65 0 0111.3 0z"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <h2 class="text-3xl font-semibold mb-6 text-center">Sản Phẩm Nổi Bật</h2>
    <div class="flex transition-transform duration-300 ease-in-out slider">
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
                    <form action="{{ route('save_cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id_hidden" value="{{ $item->product_id }}">
                        <input type="hidden" name="quantity" id="form-quantity" value="1">
                        <button type="submit" name="buy_now" value="1" class="text-blue-600 hover:text-blue-800">Mua ›</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <button class="prev-btn absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none opacity-50 cursor-not-allowed">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button class="next-btn absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none opacity-100 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</section>



<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold mb-6">iPhone</h2>
        @if($iphone_category)
        <a href="{{ route('category.products', $iphone_category->category_id) }}" class="text-blue-600 hover:text-blue-800">Xem tất cả</a>
        @endif
    </div>
    <div class="flex transition-transform duration-300 ease-in-out slider">
        @foreach ($iphone_products as $key => $item)
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
                    <form action="{{ route('save_cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id_hidden" value="{{ $item->product_id }}">
                        <input type="hidden" name="quantity" id="form-quantity" value="1">
                        <button type="submit" name="buy_now" value="1" class="text-blue-600 hover:text-blue-800">Mua ›</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Navigation Buttons -->
    <button class="prev-btn absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none opacity-50 cursor-not-allowed">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button class="next-btn absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none opacity-100 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</section>



<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold mb-6">Android</h2>
        @if($phone_category)
        <a href="{{ route('category.products', $phone_category->category_id) }}" class="text-blue-600 hover:text-blue-800">Xem tất cả</a>
        @endif
    </div>
    <div class="flex transition-transform duration-300 ease-in-out slider">
        @foreach ($phone_products as $key => $item)
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
                    <form action="{{ route('save_cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id_hidden" value="{{ $item->product_id }}">
                        <input type="hidden" name="quantity" id="form-quantity" value="1">
                        <button type="submit" name="buy_now" value="1" class="text-blue-600 hover:text-blue-800">Mua ›</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Navigation Buttons -->
    <button class="prev-btn absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none opacity-50 cursor-not-allowed">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button class="next-btn absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none opacity-100 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</section>



<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold mb-6">Laptop</h2>
        @if($laptop_category)
        <a href="{{ route('category.products', $laptop_category->category_id) }}" class="text-blue-600 hover:text-blue-800">Xem tất cả</a>
        @endif
    </div>
    <div class="flex transition-transform duration-300 ease-in-out slider">
        @foreach ($laptop_products as $key => $item)
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
                    <form action="{{ route('save_cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id_hidden" value="{{ $item->product_id }}">
                        <input type="hidden" name="quantity" id="form-quantity" value="1">
                        <button type="submit" name="buy_now" value="1" class="text-blue-600 hover:text-blue-800">Mua ›</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <button class="prev-btn absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none opacity-50 cursor-not-allowed">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button class="next-btn absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none opacity-100 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</section>


<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold mb-6">Máy tính bảng</h2>
        @if($tablet_category)
        <a href="{{ route('category.products', $tablet_category->category_id) }}" class="text-blue-600 hover:text-blue-800">Xem tất cả</a>
        @endif
    </div>
    <div class="flex transition-transform duration-300 ease-in-out slider">
        @foreach ($tablet_products as $key => $item)
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
                    <form action="{{ route('save_cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id_hidden" value="{{ $item->product_id }}">
                        <input type="hidden" name="quantity" id="form-quantity" value="1">
                        <button type="submit" name="buy_now" value="1" class="text-blue-600 hover:text-blue-800">Mua ›</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <button class="prev-btn absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none opacity-50 cursor-not-allowed">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button class="next-btn absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none opacity-100 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</section>

<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-semibold mb-6">Phụ kiện</h2>
        <a href="{{ route('category.products', $accessory_category->category_id) }}" class="text-blue-600 hover:text-blue-800">Xem tất cả</a>
    </div>
    <div class="flex transition-transform duration-300 ease-in-out slider">
        @foreach ($accessory_products as $key => $item)
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
                    <form action="{{ route('save_cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id_hidden" value="{{ $item->product_id }}">
                        <input type="hidden" name="quantity" id="form-quantity" value="1">
                        <button type="submit" name="buy_now" value="1" class="text-blue-600 hover:text-blue-800">Mua ›</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <button class="prev-btn absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none opacity-50 cursor-not-allowed">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button class="next-btn absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-200 rounded-full w-10 h-10 flex items-center justify-center shadow-md hover:bg-gray-300 focus:outline-none opacity-100 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
</section>
@endsection