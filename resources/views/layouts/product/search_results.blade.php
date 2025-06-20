@extends('layouts.main')
@section('title', 'Kết quả tìm kiếm - Hải Phương Mobile')
@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold mb-6">Kết quả tìm kiếm cho: "{{ $keyword }}"</h1>
    
    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="text-xl font-semibold mb-4 h-16 overflow-hidden">{{ $product->product_name }}</h3>
                <div class="relative mb-4 h-[200px] w-full flex items-center justify-center overflow-hidden group">
                    <img src="{{ asset('uploads/products/'.$product->product_image) }}" alt="{{ $product->product_name }}" class="max-h-[180px] w-auto object-contain transition-transform duration-300 group-hover:scale-110">
                </div>
                <div class="text-lg font-semibold text-red-600 mb-4">
                    {{ number_format($product->product_price, 0, ',', '.') }}đ
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <a href="{{route('product_post', $product->product_id)}}" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition-colors">Chi tiết</a>
                    <form action="{{ route('save_cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id_hidden" value="{{ $product->product_id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" name="buy_now" value="1" class="text-blue-600 hover:text-blue-800 px-4 py-2">Mua ngay</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Phân trang -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="bg-gray-100 p-8 rounded-lg text-center">
            <p class="text-lg mb-4">Không tìm thấy sản phẩm nào phù hợp với từ khóa "{{ $keyword }}"</p>
            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition-colors inline-block">Quay lại trang chủ</a>
        </div>
    @endif
</div>

@endsection 