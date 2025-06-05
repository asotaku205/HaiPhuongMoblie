<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/mobile-menu.js') }}"></script>
    <title>Hai Phuong Mobile</title>
    @vite('resources/css/app.css')
</head>

<body>
    <header class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50 border-b border-gray-200">
        <nav class="bg-white-900 text-black">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex items-center justify-between h-12">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-black text-lg font-semibold">
                            HaiPhuong Mobile
                        </a>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center space-x-8">
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">Cửa Hàng</a>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">iPhone</a>
                            <div class="absolute top-full left-0 w-80 bg-white shadow-lg rounded-lg p-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Khám Phá iPhone</h3>
                                        <ul class="space-y-2">
                                            @foreach ($category as $key => $item)
                                            <li><a href="{{ URL::to('category/'.$item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Mua iPhone</h3>
                                        <ul class="space-y-2">
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Mua iPhone</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Phụ Kiện iPhone</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Apple Trade In</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Hỗ Trợ iPhone</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">iPad</a>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">Mac</a>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">Watch</a>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">Android</a>
                            <div class="absolute top-full left-0 w-80 bg-white shadow-lg rounded-lg p-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Khám Phá AirPods</h3>
                                        <ul class="space-y-2">
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Khám Phá Tất Cả Android</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Xiaomi</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Oppo</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Vivo</a></li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Mua Android</h3>
                                        <ul class="space-y-2">
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Mua Android</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Phụ Kiện Android</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Hỗ Trợ Android</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">Sửa chữa</a>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">Phụ Kiện</a>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">Hỗ Trợ</a>
                        </div>
                    </div>

                    <!-- Right Icons -->
                    <div class="flex items-center space-x-4">
                        <button class="text-black hover:text-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.65 11a5.65 5.65 0 11-11.3 0 5.65 5.65 0 0111.3 0z" />
                            </svg>
                        </button>

                        <a href="#" class="text-black hover:text-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l-1 12H6L5 9z" />
                            </svg>
                        </a>

                        @if(Auth::check())
                        <div class="relative group">
                            <button class="text-black hover:text-gray-300 text-sm">
                                {{ Auth::user()->fullname }}
                            </button>
                            <div class="absolute top-full right-0 w-48 bg-white shadow-lg rounded-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="#" class="block px-4 py-2 text-black hover:bg-gray-100">Tài khoản</a>
                                <a href="#" class="block px-4 py-2 text-black hover:bg-gray-100">Đơn hàng</a>
                                <hr class="my-1">
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-black hover:bg-gray-100">Đăng xuất</a>
                            </div>
                        </div>
                        @else
                        <a href="{{ route('login') }}" class="text-black hover:text-gray-300 text-sm">Đăng Nhập</a>
                        @endif

                        <!-- Mobile menu button -->
                        <button id="mobile-menu-button" class="md:hidden text-black hover:text-gray-300 focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path id="mobile-menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200">
                <div class="px-4 py-2 space-y-1">
                    <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">Cửa Hàng</a>
                    <div class="relative">
                        <button class="mobile-submenu-button w-full flex justify-between items-center px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">
                            <span>iPhone</span>
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="mobile-submenu hidden bg-gray-50 px-4 py-2 space-y-1">
                            <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-sm">iPhone 16 Pro</a>
                            <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-sm">iPhone 16</a>
                            <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-sm">iPhone 15</a>
                            <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-sm">iPhone 14</a>
                        </div>
                    </div>
                    <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">iPad</a>
                    <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">Mac</a>
                    <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">Watch</a>
                    <div class="relative">
                        <button class="mobile-submenu-button w-full flex justify-between items-center px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">
                            <span>Android</span>
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="mobile-submenu hidden bg-gray-50 px-4 py-2 space-y-1">
                            <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-sm">Xiaomi</a>
                            <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-sm">Oppo</a>
                            <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-sm">Vivo</a>
                        </div>
                    </div>
                    <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">Sửa chữa</a>
                    <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">Phụ Kiện</a>
                    <a href="#" class="block px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">Hỗ Trợ</a>
                </div>
            </div>
        </nav>
    @yield('header')
    </header>
    <main class="pt-6 mt-24">
        <!-- New iPhone Models Section -->
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
                            <a href="#" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">Tìm hiểu thêm</a>
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

    @yield('content')

    </main>
    <!-- Footer -->
    <footer class="bg-gray-100 py-8">
        <div class="container mx-auto px-4">
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                <!-- Cột 1 -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold mb-4">VỀ HAIPHUONGMOBILE</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm block">Giới thiệu</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm block">Tuyển dụng</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm block">Liên hệ</a></li>
                    </ul>
                </div>

                <!-- Cột 2: Chính sách -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold mb-4">CHÍNH SÁCH</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm block">Chính sách bảo hành</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm block">Chính sách giao hàng</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm block">Chính sách bảo mật</a></li>
                    </ul>
                </div>

                <!-- Cột 3: Thông tin -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold mb-4">THÔNG TIN</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm block">Hệ thống cửa hàng</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm block">Hướng dẫn mua hàng</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm block">Hướng dẫn thanh toán</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm block">Hướng dẫn trả góp</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm block">Tra cứu địa chỉ bảo hành</a></li>
                    </ul>
                </div>

                <!-- Cột 4: Tổng đài hỗ trợ -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold mb-4">HỖ TRỢ</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <span class="text-sm text-gray-600">Mua hàng:</span>
                            <a href="tel:19005301" class="text-blue-600 hover:text-blue-800 ml-2 text-sm">1900.5301</a>
                        </li>
                        <li class="flex items-center">
                            <span class="text-sm text-gray-600">Bảo hành:</span>
                            <a href="tel:19005325" class="text-blue-600 hover:text-blue-800 ml-2 text-sm">1900.5325</a>
                        </li>
                        <li class="flex items-center">
                            <span class="text-sm text-gray-600">Khiếu nại:</span>
                            <a href="tel:18006173" class="text-blue-600 hover:text-blue-800 ml-2 text-sm">1800.6173</a>
                        </li>
                        <li class="flex items-center">
                            <span class="text-sm text-gray-600">Email:</span>
                            <a href="mailto:sonotaku555@gmail.com" class="text-blue-600 hover:text-blue-800 ml-2 text-sm break-all">sonotaku555@gmail.com</a>
                        </li>
                    </ul>
                </div>

                <!-- Cột 5: Kết nối -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold mb-4">KẾT NỐI VỚI CHÚNG TÔI</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fab fa-facebook-f text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fab fa-tiktok text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fab fa-youtube text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-blue-600 transition-colors">
                            <i class="fab fa-zalo text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Đơn vị vận chuyển và thanh toán -->
            <div class="mt-8 border-t border-gray-200 pt-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Đơn vị vận chuyển -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold mb-4">ĐƠN VỊ VẬN CHUYỂN</h3>
                        <div class="flex flex-wrap gap-4">
                            <img src="https://via.placeholder.com/80x40" alt="GHN" class="h-10 object-contain">
                            <img src="https://via.placeholder.com/80x40" alt="Giao hàng nhanh" class="h-10 object-contain">
                            <img src="https://via.placeholder.com/80x40" alt="VNPost" class="h-10 object-contain">
                        </div>
                    </div>

                    <!-- Cách thức thanh toán -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold mb-4">CÁCH THỨC THANH TOÁN</h3>
                        <div class="flex flex-wrap gap-4">
                            <img src="https://via.placeholder.com/80x40" alt="Visa" class="h-10 object-contain">
                            <img src="https://via.placeholder.com/80x40" alt="MasterCard" class="h-10 object-contain">
                            <img src="https://via.placeholder.com/80x40" alt="ZaloPay" class="h-10 object-contain">
                            <img src="https://via.placeholder.com/80x40" alt="MoMo" class="h-10 object-contain">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-8 border-t border-gray-200 pt-8 text-center">
                <p class="text-sm text-gray-600">© 2024 HaiPhuongMobile. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
        @yield('footer')
    </footer>
</body>

</html>