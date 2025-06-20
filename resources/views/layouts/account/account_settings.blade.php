@extends('layouts.main')

@section('title', 'Cài Đặt Tài Khoản - Hải Phương Mobile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Tiêu đề trang -->
    <div class="bg-gray-100 py-4 px-6 mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">Tài Khoản</h1>
        <a href="{{ route('logout') }}" class="text-blue-600 hover:underline">Đăng Xuất &rsaquo;</a>
    </div>

    <!-- Thông báo -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-6">Xin chào {{ $user->fullname }}!</h2>
        
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('user.settings') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Thông tin tài khoản
            </a>
            <a href="{{ route('user.orders') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                Đơn hàng của tôi
            </a>
        </div>
    </div>

    <div class="max-w-5xl mx-auto">
        <h1 class="text-3xl font-bold mb-10 text-center">Cài Đặt Tài Khoản</h1>

        <!-- Vận chuyển -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Vận chuyển</h2>

            <!-- Địa chỉ giao hàng -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-semibold">Địa chỉ giao hàng</h3>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-lg">
                    <p>{{ $user->fullname ?? 'Tên' }}</p>
                    <p>{{ $user->address ?? 'Địa chỉ' }}</p>
                    <p>{{ $user->ward ?? 'Phường/Xã' }}</p>
                    <p>{{ $user->district ?? 'Quận/Huyện' }}</p>
                    <p>{{ $user->city ?? 'Tỉnh/Thành phố' }}</p>
                    <p>{{ $user->postal_code ?? 'Mã bưu điện' }}</p>
                    <div class="mt-2">
                        <a href="#" class="text-blue-600 hover:underline" data-modal-target="addressModal">Chỉnh sửa</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thông tin liên hệ -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Thông tin liên hệ</h2>
            <div class="bg-white p-4 rounded-xl shadow-lg">
                <p>{{ $user->email ?? 'Email' }}</p>
                <p>{{ $user->phone ?? 'Số điện thoại' }}</p>
                <div class="mt-2">
                    <a href="#" class="text-blue-600 hover:underline" data-modal-target="contactModal">Chỉnh sửa</a>
                </div>
            </div>
        </div>

        <!-- Thanh toán -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Thanh toán</h2>

            <!-- Thông tin liên hệ thanh toán -->
            <div class="mb-8">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="text-lg font-semibold">Thông tin liên hệ thanh toán</h3>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-lg">
                    <p>{{ $user->fullname ?? 'Tên' }}</p>
                    <p>{{ $user->phone ?? 'Số điện thoại' }}</p>
                    <div class="mt-2">
                        <a href="#" class="text-blue-600 hover:underline" data-modal-target="paymentContactModal">Chỉnh sửa</a> |
                        <a href="#" class="text-blue-600 hover:underline">Xóa</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Địa chỉ giao hàng -->
<div id="addressModal" class="fixed inset-0 bg-opacity-50 z-50 hidden items-center justify-center backdrop-blur-sm">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Cập nhật địa chỉ giao hàng</h3>
            <button class="modal-close text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <form action="{{ route('user.update.address') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                <input type="text" id="address" name="address" value="{{ $user->address ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="ward" class="block text-sm font-medium text-gray-700 mb-1">Phường/Xã</label>
                <input type="text" id="ward" name="ward" value="{{ $user->ward ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="district" class="block text-sm font-medium text-gray-700 mb-1">Quận/Huyện</label>
                <input type="text" id="district" name="district" value="{{ $user->district ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Tỉnh/Thành phố</label>
                <input type="text" id="city" name="city" value="{{ $user->city ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Mã bưu điện</label>
                <input type="text" id="postal_code" name="postal_code" value="{{ $user->postal_code ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="flex justify-end">
                <button type="button" class="modal-close bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2">Hủy</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Lưu</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Thông tin liên hệ -->
<div id="contactModal" class="fixed inset-0 bg-opacity-50 z-50 hidden items-center justify-center backdrop-blur-sm">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Cập nhật thông tin liên hệ</h3>
            <button class="modal-close text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <form action="{{ route('user.update.profile') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                <input type="text" id="phone" name="phone" value="{{ $user->phone ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="flex justify-end">
                <button type="button" class="modal-close bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2">Hủy</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Lưu</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Phương thức thanh toán -->
<div id="paymentMethodModal" class="fixed inset-0 bg-opacity-50 z-50 hidden items-center justify-center backdrop-blur-sm">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Cập nhật phương thức thanh toán</h3>
            <button class="modal-close text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <form action="{{ route('user.update.payment') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="card_number" class="block text-sm font-medium text-gray-700 mb-1">Số thẻ</label>
                <input type="text" id="card_number" name="card_number" value="{{ $user->card_number ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="card_expiry" class="block text-sm font-medium text-gray-700 mb-1">Ngày hết hạn (MM/YY)</label>
                <input type="text" id="card_expiry" name="card_expiry" value="{{ $user->card_expiry ?? '' }}" placeholder="MM/YY" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="flex justify-end">
                <button type="button" class="modal-close bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2">Hủy</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Lưu</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal thông tin liên hệ thanh toán -->
<div id="paymentContactModal" class="fixed inset-0 bg-opacity-50 z-50 hidden items-center justify-center backdrop-blur-sm">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Cập nhật thông tin liên hệ thanh toán</h3>
            <button class="modal-close text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <form action="{{ route('user.update.profile') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="payment_name" class="block text-sm font-medium text-gray-700 mb-1">Tên</label>
                <input type="text" id="payment_name" name="payment_name" value="{{ $user->fullname ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="payment_phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                <input type="text" id="payment_phone" name="payment_phone" value="{{ $user->phone ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="flex justify-end">
                <button type="button" class="modal-close bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2">Hủy</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Lưu</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal địa chỉ thanh toán -->
<div id="billingAddressModal" class="fixed inset-0 bg-opacity-50 z-50 hidden items-center justify-center backdrop-blur-sm   ">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">Cập nhật địa chỉ thanh toán</h3>
            <button class="modal-close text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
        </div>
        <form action="{{ route('user.update.address') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="billing_address" class="block text-sm font-medium text-gray-700 mb-1">Địa chỉ</label>
                <input type="text" id="billing_address" name="address" value="{{ $user->address ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="billing_ward" class="block text-sm font-medium text-gray-700 mb-1">Phường/Xã</label>
                <input type="text" id="billing_ward" name="ward" value="{{ $user->ward ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="billing_district" class="block text-sm font-medium text-gray-700 mb-1">Quận/Huyện</label>
                <input type="text" id="billing_district" name="district" value="{{ $user->district ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="billing_city" class="block text-sm font-medium text-gray-700 mb-1">Tỉnh/Thành phố</label>
                <input type="text" id="billing_city" name="city" value="{{ $user->city ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="billing_postal_code" class="block text-sm font-medium text-gray-700 mb-1">Mã bưu điện</label>
                <input type="text" id="billing_postal_code" name="postal_code" value="{{ $user->postal_code ?? '' }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="flex justify-end">
                <button type="button" class="modal-close bg-gray-300 text-gray-800 px-4 py-2 rounded mr-2">Hủy</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Lưu</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Modal handling
    document.addEventListener('DOMContentLoaded', function() {
        const modalTriggers = document.querySelectorAll('[data-modal-target]');
        const modalCloses = document.querySelectorAll('.modal-close');

        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                const modal = document.getElementById(this.dataset.modalTarget);
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
            });
        });

        modalCloses.forEach(close => {
            close.addEventListener('click', function() {
                const modal = this.closest('[id]');
                modal.classList.remove('flex');
                modal.classList.add('hidden');
                document.body.style.overflow = ''; // Re-enable scrolling
            });
        });

        // Close modal when clicking outside
        window.addEventListener('click', function(e) {
            document.querySelectorAll('[id$="Modal"]').forEach(modal => {
                if (e.target === modal) {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                    document.body.style.overflow = ''; // Re-enable scrolling
                }
            });
        });
    });
</script>
@endsection