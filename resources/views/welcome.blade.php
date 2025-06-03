<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <title>Hai Phuong Mobile</title>
    @vite('resources/css/app.css')
</head>
<body>
    @include('layouts.header')
    <main class="p-6 mt-24">
        <section class="p-6 bg-gray-100 mb-6 rounded-lg">
            <div class="container mx-auto">
                <!-- Tiêu đề -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Iphone bán chạy</h2>
                    <div class="flex items-center gap-2 text-red-500">
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m0 0L3 10m6-7l6 7" />
                            </svg>
                            Miễn phí giao hàng
                        </span>
                    </div>
                </div>

                <!-- Danh sách sản phẩm -->
                <div class="grid grid-cols-5 gap-4">
                    <!-- Sản phẩm -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <img src="{{ asset('pic/ip15prm.jpg') }}" alt="iphone" class="w-full h-60 object-cover rounded-lg mb-4">
                        <h3 class="text-lg font-semibold mb-2">iPhone 15 Pro Max</h3>
                        <ul class="text-sm text-gray-600 mb-2">
                            <li><strong>CPU:</strong> e5-13420H</li>
                            <li><strong>RAM:</strong> 160GB</li>
                            <li><strong>SSD:</strong> 2TB</li>
                            <li><strong>Màn hình:</strong> 14 inch FHD IPS</li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-red-500 font-bold text-lg">13.490.000đ</span>
                            <span class="text-gray-500 line-through text-sm">14.990.000đ</span>
                        </div>
                        <div class="text-sm text-red-500 font-semibold">-10%</div>
                    </div>

                    <!-- Lặp lại sản phẩm -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <img src="{{ asset('pic/14prm256.jpg') }}" alt="iphone" class="w-full h-60 object-cover rounded-lg mb-4">
                        <h3 class="text-lg font-semibold mb-2">Iphone 14 Pro Max</h3>
                        <ul class="text-sm text-gray-600 mb-2">
                            <li><strong>CPU:</strong> R7-6800U</li>
                            <li><strong>RAM:</strong> 16GB</li>
                            <li><strong>SSD:</strong> 1TB</li>
                            <li><strong>Màn hình:</strong> 16 inch WQXGA OLED</li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-red-500 font-bold text-lg">19.990.000đ</span>
                            <span class="text-gray-500 line-through text-sm">37.990.000đ</span>
                        </div>
                        <div class="text-sm text-red-500 font-semibold">-47%</div>
                    </div>

                    <!-- Thêm các sản phẩm khác tương tự -->
                </div>
            </div>
        </section>
        <section class="p-6 bg-gray-100 mb-6 rounded-lg">
            <div class="container mx-auto">
                <!-- Tiêu đề -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Laptop văn phòng bán chạy</h2>
                    <div class="flex items-center gap-2 text-red-500">
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m0 0L3 10m6-7l6 7" />
                            </svg>
                            Miễn phí giao hàng
                        </span>
                    </div>
                </div>

                <!-- Danh sách sản phẩm -->
                <div class="grid grid-cols-5 gap-4">
                    <!-- Sản phẩm -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <img src="{{ asset('pic/dell7280.jpg') }}" alt="Laptop" class="w-full h-60 object-cover rounded-lg mb-4">
                        <h3 class="text-lg font-semibold mb-2">Laptop Dell 7280</h3>
                        <ul class="text-sm text-gray-600 mb-2">
                            <li><strong>CPU:</strong> i5-13420H</li>
                            <li><strong>RAM:</strong> 16GB</li>
                            <li><strong>SSD:</strong> 512GB</li>
                            <li><strong>Màn hình:</strong> 14 inch FHD IPS</li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-red-500 font-bold text-lg">13.490.000đ</span>
                            <span class="text-gray-500 line-through text-sm">14.990.000đ</span>
                        </div>
                        <div class="text-sm text-red-500 font-semibold">-10%</div>
                    </div>

                    <!-- Lặp lại sản phẩm -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <img src="{{ asset('pic/dellxpl.jpg') }}" alt="Laptop" class="w-full h-60  object-cover rounded-lg mb-4">
                        <h3 class="text-lg font-semibold mb-2">Laptop Dell XPL</h3>
                        <ul class="text-sm text-gray-600 mb-2">
                            <li><strong>CPU:</strong> R7-6800U</li>
                            <li><strong>RAM:</strong> 16GB</li>
                            <li><strong>SSD:</strong> 1TB</li>
                            <li><strong>Màn hình:</strong> 16 inch WQXGA OLED</li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-red-500 font-bold text-lg">19.990.000đ</span>
                            <span class="text-gray-500 line-through text-sm">37.990.000đ</span>
                        </div>
                        <div class="text-sm text-red-500 font-semibold">-47%</div>
                    </div>

                    <!-- Thêm các sản phẩm khác tương tự -->
                </div>
            </div>
        </section>
        <section class="p-6 bg-gray-100 mb-6 rounded-lg">
            <div class="container mx-auto">
                <!-- Tiêu đề -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Android</h2>
                    <div class="flex items-center gap-2 text-red-500">
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m0 0L3 10m6-7l6 7" />
                            </svg>
                            Miễn phí giao hàng
                        </span>
                    </div>
                </div>

                <!-- Danh sách sản phẩm -->
                <div class="grid grid-cols-5 gap-4">
                    <!-- Sản phẩm -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <img src="{{ asset('pic/oppoa60.jpg') }}" alt="Laptop" class="w-full h-60 object-cover rounded-lg mb-4">
                        <h3 class="text-lg font-semibold mb-2">Oppo A60</h3>
                        <ul class="text-sm text-gray-600 mb-2">
                            <li><strong>CPU:</strong> i5-13420H</li>
                            <li><strong>RAM:</strong> 16GB</li>
                            <li><strong>SSD:</strong> 512GB</li>
                            <li><strong>Màn hình:</strong> 14 inch FHD IPS</li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-red-500 font-bold text-lg">13.490.000đ</span>
                            <span class="text-gray-500 line-through text-sm">14.990.000đ</span>
                        </div>
                        <div class="text-sm text-red-500 font-semibold">-10%</div>
                    </div>

                    <!-- Lặp lại sản phẩm -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <img src="{{ asset('pic/z4flip5g.jpg') }}" alt="Laptop" class="w-full h-60 object-cover rounded-lg mb-4">
                        <h3 class="text-lg font-semibold mb-2">Z Flip 4 5G</h3>
                        <ul class="text-sm text-gray-600 mb-2">
                            <li><strong>CPU:</strong> R7-6800U</li>
                            <li><strong>RAM:</strong> 16GB</li>
                            <li><strong>SSD:</strong> 1TB</li>
                            <li><strong>Màn hình:</strong> 16 inch WQXGA OLED</li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-red-500 font-bold text-lg">19.990.000đ</span>
                            <span class="text-gray-500 line-through text-sm">37.990.000đ</span>
                        </div>
                        <div class="text-sm text-red-500 font-semibold">-47%</div>
                    </div>

                    <!-- Thêm các sản phẩm khác tương tự -->
                </div>
            </div>
        </section>
        <section class="p-6 bg-gray-100 mb-6 rounded-lg">
            <div class="container mx-auto">
                <!-- Tiêu đề -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Apple Watch</h2>
                    <div class="flex items-center gap-2 text-red-500">
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m0 0L3 10m6-7l6 7" />
                            </svg>
                            Miễn phí giao hàng
                        </span>
                    </div>
                </div>

                <!-- Danh sách sản phẩm -->
                <div class="grid grid-cols-5 gap-4">
                    <!-- Sản phẩm -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <img src="{{ asset('pic/sr8.jpg') }}" alt="Laptop" class="w-full h-60 object-cover rounded-lg mb-4">
                        <h3 class="text-lg font-semibold mb-2">Seri 8</h3>
                        <ul class="text-sm text-gray-600 mb-2">
                            <li><strong>CPU:</strong> i5-13420H</li>
                            <li><strong>RAM:</strong> 16GB</li>
                            <li><strong>SSD:</strong> 512GB</li>
                            <li><strong>Màn hình:</strong> 14 inch FHD IPS</li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-red-500 font-bold text-lg">13.490.000đ</span>
                            <span class="text-gray-500 line-through text-sm">14.990.000đ</span>
                        </div>
                        <div class="text-sm text-red-500 font-semibold">-10%</div>
                    </div>

                    <!-- Lặp lại sản phẩm -->
                    <div class="bg-white rounded-lg shadow p-4">
                        <img src="{{ asset('pic/sr7.jpg') }}" alt="Laptop" class="w-full h-60 object-cover rounded-lg mb-4">
                        <h3 class="text-lg font-semibold mb-2">Seri 7</h3>
                        <ul class="text-sm text-gray-600 mb-2">
                            <li><strong>CPU:</strong> R7-6800U</li>
                            <li><strong>RAM:</strong> 16GB</li>
                            <li><strong>SSD:</strong> 1TB</li>
                            <li><strong>Màn hình:</strong> 16 inch WQXGA OLED</li>
                        </ul>
                        <div class="flex items-center justify-between">
                            <span class="text-red-500 font-bold text-lg">19.990.000đ</span>
                            <span class="text-gray-500 line-through text-sm">37.990.000đ</span>
                        </div>
                        <div class="text-sm text-red-500 font-semibold">-47%</div>
                    </div>

                    <!-- Thêm các sản phẩm khác tương tự -->
                </div>
            </div>
        </section>
        
    </main>
    <!-- Footer -->
    @include('layouts.footer')
</body>
</html>