@extends('layouts.main')

@section('title', 'Giỏ hàng - Hải Phương Mobile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Giỏ hàng</h1>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('cart') && count(session('cart')) > 0)
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Danh sách sản phẩm -->
            <div class="w-full md:w-2/3">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold mb-4">Bạn có {{ count(session('cart')) }} sản phẩm trong giỏ hàng</h2>

                    @foreach(session('cart') as $id => $item)
                    <div class="border-b border-gray-200 py-4 flex flex-col sm:flex-row items-center">
                        <div class="flex items-center w-full sm:w-1/2 mb-4 sm:mb-0">
                            <!-- Hình ảnh sản phẩm -->
                            <div class="w-24 h-24 mr-4">
                                <img src="{{ asset('uploads/products/'.$item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain">
                            </div>
                            
                            <!-- Thông tin sản phẩm -->
                            <div>
                                <h3 class="font-medium text-lg">{{ $item['name'] }}</h3>
                                <p class="text-gray-600 text-sm">Còn hàng</p>
                            </div>
                        </div>
                        
                        <!-- Giá và số lượng -->
                        <div class="flex items-center justify-between w-full sm:w-1/2">
                            <div class="flex items-center">
                                <form action="{{ route('cart_update') }}" method="POST" class="flex items-center">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="button" onclick="decrementQuantity('quantity-{{ $id }}')" class="border border-gray-300 rounded-l px-2 py-1">-</button>
                                    <input type="number" id="quantity-{{ $id }}" name="quantity" value="{{ $item['quantity'] }}" min="1" class="border-t border-b border-gray-300 w-12 text-center py-1">
                                    <button type="button" onclick="incrementQuantity('quantity-{{ $id }}')" class="border border-gray-300 rounded-r px-2 py-1">+</button>
                                    <button type="submit" class="ml-2 text-blue-500 text-sm">Cập nhật</button>
                                </form>
                            </div>
                            
                            <div class="text-right">
                                <p class="font-medium text-lg">{{ number_format($item['price'], 0, ',', '.') }} VND</p>
                                <form action="{{ route('cart_remove', ['id' => $id]) }}" method="GET" class="inline">
                                    <button type="submit" class="text-red-500 text-sm inline-block mt-2" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Xóa
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Tổng cộng và thanh toán -->
            <div class="w-full md:w-1/3">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-20">
                    <h2 class="text-xl font-semibold mb-6">Bản tóm tắt</h2>
                    
                    <!-- Tổng tiền hàng -->
                    <div class="flex justify-between mb-3">
                        <span class="text-gray-600">Tổng giá trước thuế</span>
                        <span class="font-medium">{{ number_format($totalPrice, 0, ',', '.') }} VND</span>
                    </div>
                    
                    <!-- Tổng cộng -->
                    <div class="flex justify-between mb-6 border-t border-gray-200 pt-3">
                        <span class="text-lg font-semibold">Tổng cộng</span>
                        <span class="text-lg font-bold">{{ number_format($grandTotal, 0, ',', '.') }} VND</span>
                    </div>
                    
                    <div class="text-center text-sm text-gray-500 mb-4">
                        Đã bao gồm thuế GTGT
                    </div>
                    <!-- Nút thanh toán -->
                    <a href="{{ route('checkout') }}" class="block w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition duration-200 text-center">
                        Thanh Toán
                    </a>
                    
                    <!-- Nút xóa giỏ hàng -->
                    <a href="{{ route('cart_clear') }}" class="block w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition duration-200 text-center mt-2" onclick="return confirm('Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng?')">
                        Xóa Toàn Bộ Giỏ Hàng
                    </a>
                    
                    @if(Session::has('user_id'))
                    <!-- Liên kết đến đơn hàng đã đặt -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('user.orders') }}" class="text-blue-600 hover:underline">
                            Xem đơn hàng đã đặt
                        </a>
                    </div>
                    @endif
                    
                    <!-- Điều khoản -->
                    <div class="mt-4 text-xs text-gray-500">
                        <p>Bằng cách gửi đơn đặt hàng, bạn đồng ý với <a href="#" class="text-blue-500">Điều khoản & điều kiện</a> và chúng tôi sẽ sử dụng dữ liệu cá nhân của bạn theo <a href="#" class="text-blue-500">Chính sách quyền riêng tư</a> của chúng tôi.</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-sm p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h2 class="text-2xl font-semibold mb-2">Giỏ hàng của bạn đang trống</h2>
            <p class="text-gray-600 mb-6">Hãy thêm sản phẩm vào giỏ hàng để tiến hành mua sắm</p>
            <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                Tiếp tục mua sắm
            </a>
            @if(Session::has('user_id'))
            <!-- Liên kết đến đơn hàng đã đặt -->
            <div class="mt-4 text-center">
                <a href="{{ route('user.orders') }}" class="text-blue-600 hover:underline">
                    Xem đơn hàng đã đặt
                </a>
            </div>
            @endif
        </div>
    @endif
</div>

<script>
    function incrementQuantity(id) {
        const input = document.getElementById(id);
        input.value = parseInt(input.value) + 1;
    }
    
    function decrementQuantity(id) {
        const input = document.getElementById(id);
        const value = parseInt(input.value);
        if (value > 1) {
            input.value = value - 1;
        }
    }
</script>
@endsection