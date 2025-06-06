@extends('layouts.main')
@section('title', 'Trang Chủ - Hải Phương Mobile')
@section('content')
<section class="max-w-7xl mx-auto px-4 py-8 relative overflow-hidden">
    <h2 class="text-3xl font-semibold mb-6">Mọi phiên bản. Hãy chọn mẫu bạn thích.</h2>
    <div class="flex transition-transform duration-300 ease-in-out" id="iphone-slider">
        @foreach ($all_product as $key => $item)
        <div class="min-w-[280px] md:min-w-[320px] p-4">
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
@endsection