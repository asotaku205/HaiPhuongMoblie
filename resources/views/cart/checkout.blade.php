@extends('layouts.main')

@section('title', 'Thanh Toán - Hải Phương Mobile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-8">Thanh Toán</h1>
    
    @if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <p>{{ session('error') }}</p>
    </div>
    @endif
    
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Form thanh toán -->
        <div class="w-full md:w-2/3">
            <form action="{{ route('checkout') }}" method="POST" class="bg-white rounded-lg shadow p-6">
                @csrf
                <h2 class="text-xl font-semibold mb-6">Thông tin giao hàng</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Họ tên -->
                    <div>
                        <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">Họ tên</label>
                        <input type="text" id="fullname" name="fullname" value="{{ $user->fullname ?? '' }}" class="w-full border rounded px-3 py-2" required>
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email ?? '' }}" class="w-full border rounded px-3 py-2" required>
                    </div>
                    
                    <!-- Số điện thoại -->
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" value="{{ $user->phone ?? '' }}" class="w-full border rounded px-3 py-2" required>
                    </div>
                    
                    <!-- Địa chỉ -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                        <input type="text" id="address" name="address" value="{{ $user->address ?? '' }}" class="w-full border rounded px-3 py-2" required>
                    </div>
                    
                    <!-- Phường/Xã -->
                    <div>
                        <label for="ward" class="block text-sm font-medium text-gray-700 mb-1">Phường/Xã</label>
                        <input type="text" id="ward" name="ward" value="{{ $user->ward ?? '' }}" class="w-full border rounded px-3 py-2" required>
                    </div>
                    
                    <!-- Quận/Huyện -->
                    <div>
                        <label for="district" class="block text-sm font-medium text-gray-700 mb-1">Quận/Huyện</label>
                        <input type="text" id="district" name="district" value="{{ $user->district ?? '' }}" class="w-full border rounded px-3 py-2" required>
                    </div>
                    
                    <!-- Tỉnh/Thành phố -->
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Tỉnh/Thành phố</label>
                        <input type="text" id="city" name="city" value="{{ $user->city ?? '' }}" class="w-full border rounded px-3 py-2" required>
                    </div>
                    
                    <!-- Mã bưu điện -->
                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Mã bưu điện</label>
                        <input type="text" id="postal_code" name="postal_code" value="{{ $user->postal_code ?? '' }}" class="w-full border rounded px-3 py-2">
                    </div>
                </div>
                
                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-6">Phương thức thanh toán</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input type="radio" id="cod" name="payment_method" value="COD" class="h-4 w-4 text-blue-600" checked>
                            <label for="cod" class="ml-2 text-sm font-medium text-gray-700">Thanh toán khi nhận hàng (COD)</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="radio" id="bank_transfer" name="payment_method" value="Bank Transfer" class="h-4 w-4 text-blue-600">
                            <label for="bank_transfer" class="ml-2 text-sm font-medium text-gray-700">Chuyển khoản ngân hàng</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="radio" id="credit_card" name="payment_method" value="Credit Card" class="h-4 w-4 text-blue-600">
                            <label for="credit_card" class="ml-2 text-sm font-medium text-gray-700">Thẻ tín dụng/Ghi nợ</label>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8">
                    <label for="order_note" class="block text-sm font-medium text-gray-700 mb-1">Ghi chú đơn hàng</label>
                    <textarea id="order_note" name="order_note" rows="3" class="w-full border rounded px-3 py-2"></textarea>
                </div>
                
                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                        Đặt hàng
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Tóm tắt đơn hàng -->
        <div class="w-full md:w-1/3">
            <div class="bg-white rounded-lg shadow p-6 sticky top-20">
                <h2 class="text-xl font-semibold mb-6">Đơn hàng của bạn</h2>
                
                <div class="space-y-4 mb-6">
                    @foreach($cart as $item)
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('uploads/products/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded">
                        <div class="flex-1">
                            <h3 class="text-sm font-medium">{{ $item['name'] }}</h3>
                            <div class="flex justify-between mt-1">
                                <span class="text-sm text-gray-600">{{ number_format($item['price']) }}đ x {{ $item['quantity'] }}</span>
                                <span class="text-sm font-medium">{{ number_format($item['price'] * $item['quantity']) }}đ</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="border-t border-gray-200 pt-4">
                    <div class="flex justify-between mb-2">
                        <span class="text-sm text-gray-600">Tạm tính</span>
                        <span class="font-medium">{{ number_format($totalPrice) }}đ</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-sm text-gray-600">Phí vận chuyển</span>
                        <span class="font-medium">0đ</span>
                    </div>
                    <div class="flex justify-between pt-2 border-t border-gray-200">
                        <span class="text-base font-semibold">Tổng cộng</span>
                        <span class="text-base font-bold">{{ number_format($totalPrice) }}đ</span>
                    </div>
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('cart_view') }}" class="block text-center text-blue-600 hover:underline">
                        Quay lại giỏ hàng
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection