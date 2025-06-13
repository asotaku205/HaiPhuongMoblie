<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/mobile-menu.js') }}"></script>
    <title>@yield('title', 'Hải Phương Mobile')</title>
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
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Mua iPhone</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Phụ Kiện iPhone</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Apple Trade In</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Hỗ Trợ iPhone</a></li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Danh Mục iPhone</h3>
                                        <ul class="space-y-2">
                                            @if(isset($categories))
                                                @foreach ($categories as $key => $item)
                                                    @if(strpos(strtolower($item->category_name), 'iphone') !== false)
                                                    <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">iPad</a>
                            <div class="absolute top-full left-0 w-80 bg-white shadow-lg rounded-lg p-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Khám Phá iPad</h3>
                                        <ul class="space-y-2">
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Mua iPad</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Phụ Kiện iPad</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Apple Pencil</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Hỗ Trợ iPad</a></li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Danh Mục iPad</h3>
                                        <ul class="space-y-2">
                                            @foreach ($categories as $key => $item)
                                            @if(strpos(strtolower($item->category_name), 'ipad') !== false)
                                            <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">Mac</a>
                            <div class="absolute top-full left-0 w-80 bg-white shadow-lg rounded-lg p-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Khám Phá Mac</h3>
                                        <ul class="space-y-2">
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Mua Mac</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Phụ Kiện Mac</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Apple Trade In</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Hỗ Trợ Mac</a></li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Danh Mục Mac</h3>
                                        <ul class="space-y-2">
                                            @foreach ($categories as $key => $item)
                                            @if(strpos(strtolower($item->category_name), 'mac') !== false)
                                            <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">Watch</a>
                            <div class="absolute top-full left-0 w-80 bg-white shadow-lg rounded-lg p-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Khám Phá Watch</h3>
                                        <ul class="space-y-2">
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Mua Watch</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Phụ Kiện Watch</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Apple Trade In</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Hỗ Trợ Watch</a></li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Danh Mục Watch</h3>
                                        <ul class="space-y-2">
                                            @foreach ($categories as $key => $item)
                                            @if(strpos(strtolower($item->category_name), 'watch') !== false)
                                            <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">Android</a>
                            <div class="absolute top-full left-0 w-80 bg-white shadow-lg rounded-lg p-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Khám Phá Android</h3>
                                        <ul class="space-y-2">
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Khám Phá Tất Cả Android</a></li>
                                            @foreach ($categories as $key => $item)
                                            @if(strpos(strtolower($item->category_name), 'samsung') !== false)
                                            <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Danh Mục Android</h3>
                                        <ul class="space-y-2">
                                            @foreach ($categories as $key => $item)
                                            @if(strpos(strtolower($item->category_name), 'xiaomi') !== false ||
                                            strpos(strtolower($item->category_name), 'oppo') !== false ||
                                            strpos(strtolower($item->category_name), 'vivo') !== false ||
                                            strpos(strtolower($item->category_name), 'realme') !== false ||
                                            strpos(strtolower($item->category_name), 'samsung') !== false)
                                            <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">Phụ Kiện</a>
                            <div class="absolute top-full left-0 w-80 bg-white shadow-lg rounded-lg p-6 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Khám Phá Phụ Kiện</h3>
                                        <ul class="space-y-2">
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Phụ Kiện iPhone</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Phụ Kiện iPad</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Phụ Kiện Mac</a></li>
                                            <li><a href="#" class="text-gray-600 hover:text-blue-600 text-sm">Phụ Kiện Watch</a></li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="text-gray-900 font-semibold mb-3">Danh Mục Phụ Kiện</h3>
                                        <ul class="space-y-2">
                                            @foreach ($categories as $key => $item)
                                            @if(strpos(strtolower($item->category_name), 'phụ kiện') !== false ||
                                            strpos(strtolower($item->category_name), 'tai nghe') !== false ||
                                            strpos(strtolower($item->category_name), 'sạc') !== false)
                                            <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative group">
                            <a href="#" class="text-black hover:text-gray-300 text-sm py-3 block">Sửa chữa</a>
                        </div>
                    </div>

                    <!-- Right Icons -->
                    <div class="flex items-center space-x-4">
                        <button class="text-black hover:text-gray-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16.65 11a5.65 5.65 0 11-11.3 0 5.65 5.65 0 0111.3 0z" />
                            </svg>
                        </button>

                        <div class="relative group">
                            <a href="{{ route('cart_view') }}" class="text-black hover:text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l-1 12H6L5 9z" />
                                </svg>
                                @if(session('cart') && count(session('cart')) > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center">
                                    {{ count(session('cart')) }}
                                </span>
                                @endif
                            </a>

                            <!-- Mini Cart -->
                            <div class="absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg p-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                @if(session('cart') && count(session('cart')) > 0)
                                <div class="max-h-64 overflow-y-auto">
                                    @php $totalMini = 0; @endphp
                                    @foreach(session('cart') as $id => $item)
                                    @php $totalMini += $item['price'] * $item['quantity']; @endphp
                                    <div class="flex items-center py-2 border-b border-gray-100">
                                        <div class="w-16 h-16 mr-4">
                                            <img src="{{ asset('uploads/products/'.$item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain">
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-sm font-medium">{{ $item['name'] }}</h3>
                                            <p class="text-xs text-gray-500">{{ $item['quantity'] }} x {{ number_format($item['price'], 0, ',', '.') }} VND</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 pt-2 border-t border-gray-100">
                                    <div class="flex justify-between mb-2">
                                        <span class="font-medium">Tổng cộng:</span>
                                        <span class="font-bold">{{ number_format($totalMini, 0, ',', '.') }} VND</span>
                                    </div>
                                    <a href="{{ route('cart_view') }}" class="block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200">
                                        Xem giỏ hàng
                                    </a>
                                </div>
                                @else
                                <div class="text-center py-4">
                                    <p class="text-gray-500">Giỏ hàng trống</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        @if(Auth::check())
                        <div class="relative group">
                            <button class="text-black hover:text-gray-300 text-sm">
                                {{ Auth::user()->fullname }}
                            </button>
                            <div class="absolute top-full right-0 w-48 bg-white shadow-lg rounded-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                                <a href="{{ route('user.settings') }}" class="block px-4 py-2 text-black hover:bg-gray-100">Tài khoản</a>
                                <a href="{{ route('cart_view') }}" class="block px-4 py-2 text-black hover:bg-gray-100">Đơn hàng</a>
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
                            <ul class="space-y-2">
                                @foreach ($categories as $key => $item)
                                    @if(strpos(strtolower($item->category_name), 'iphone') !== false)
                                    <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="relative">
                        <button class="mobile-submenu-button w-full flex justify-between items-center px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">
                            <span>iPad</span>
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="mobile-submenu hidden bg-gray-50 px-4 py-2 space-y-1">
                            <ul class="space-y-2">
                                @foreach ($categories as $key => $item)
                                @if(strpos(strtolower($item->category_name), 'ipad') !== false)
                                <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="relative">
                        <button class="mobile-submenu-button w-full flex justify-between items-center px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">
                            <span>Mac</span>
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="mobile-submenu hidden bg-gray-50 px-4 py-2 space-y-1">
                            <ul class="space-y-2">
                                @foreach ($categories as $key => $item)
                                @if(strpos(strtolower($item->category_name), 'mac') !== false)
                                <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="relative">
                        <button class="mobile-submenu-button w-full flex justify-between items-center px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">
                            <span>Watch</span>
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="mobile-submenu hidden bg-gray-50 px-4 py-2 space-y-1">
                            <ul class="space-y-2">
                                @foreach ($categories as $key => $item)
                                @if(strpos(strtolower($item->category_name), 'watch') !== false)
                                <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="relative">
                        <button class="mobile-submenu-button w-full flex justify-between items-center px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">
                            <span>Android</span>
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="mobile-submenu hidden bg-gray-50 px-4 py-2 space-y-1">
                            <ul class="space-y-2">
                                @foreach ($categories as $key => $item)
                                @if(strpos(strtolower($item->category_name), 'xiaomi') !== false ||
                                strpos(strtolower($item->category_name), 'oppo') !== false ||
                                strpos(strtolower($item->category_name), 'vivo') !== false ||
                                strpos(strtolower($item->category_name), 'realme') !== false ||
                                strpos(strtolower($item->category_name), 'samsung') !== false )
                                <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="relative">
                        <button class="mobile-submenu-button w-full flex justify-between items-center px-3 py-2 text-black hover:bg-gray-100 rounded-md text-base">
                            <span>Phụ Kiện</span>
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="mobile-submenu hidden bg-gray-50 px-4 py-2 space-y-1">
                            <ul class="space-y-2">
                                @foreach ($categories as $key => $item)
                                @if(strpos(strtolower($item->category_name), 'phụ kiện') !== false ||
                                strpos(strtolower($item->category_name), 'tai nghe') !== false ||
                                strpos(strtolower($item->category_name), 'sạc') !== false)
                                <li><a href="{{ route('category.products', $item->category_id) }}" class="text-gray-600 hover:text-blue-600 text-sm">{{ $item->category_name }}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
        </nav>
        @yield('header')
    </header>
    <main class="pt-6 mt-10">
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