<!DOCTYPE html>
<html lang="vi">

<head>
    <title>@yield('title', 'Hải Phương Mobile - Quản trị')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="@yield('description', 'Trang quản trị Hải Phương Mobile')" />
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    <link href="{{ asset('js/app.js') }}" rel="script" />
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .sidebar-active {
            @apply bg-indigo-700 text-white;
        }
    </style>
    @yield('css')
</head>

<body class="bg-gray-100">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-gray-800">
                <!-- Sidebar header -->
                <div class="flex items-center h-16 px-4 bg-gray-900 text-white">
                    <a href="{{ route('admin_index') }}" class="flex-shrink-0 flex items-center">
                        <span class="text-xl font-bold">HẢI PHƯƠNG</span>
                    </a>
                    <button class="md:hidden p-2 rounded-md lg:hidden">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

                <!-- Sidebar content -->
                <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
                    <div class="flex-grow flex flex-col">
                        <nav class="flex-1 px-2 space-y-1">
                            <!-- Dashboard -->
                            <a href="{{ route('admin_index') }}"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin_index') ? 'bg-indigo-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                                <i
                                    class="fas fa-tachometer-alt mr-3 {{ request()->routeIs('admin_index') ? 'text-indigo-300' : 'text-gray-400 group-hover:text-gray-300' }}"></i>
                                Dashboard
                            </a>

                            <!-- Products -->
                            <div class="space-y-1">
                                <button type="button"
                                    class="group w-full flex items-center px-2 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">
                                    <i class="fas fa-mobile-alt mr-3 text-gray-400 group-hover:text-gray-300"></i>
                                    <span class="flex-1">Sản phẩm</span>
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </button>
                                <div class="pl-6 space-y-1">
                                    <a href="{{ route('add_category') }}"
                                        class="group flex items-center px-2 py-2 text-sm font-medium text-gray-300 rounded-md {{ request()->routeIs('add_category') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                        Thêm danh mục sản phẩm
                                    </a>
                                    
                                        <a href="{{ route('category') }}"
                                            class="group flex items-center px-2 py-2 text-sm font-medium text-gray-300 rounded-md {{ request()->routeIs('category') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                            Danh mục
                                        </a>
                                    
                                </div>
                            </div>

                            <!-- Orders -->
                            <a href="#"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-shopping-cart mr-3 text-gray-400 group-hover:text-gray-300"></i>
                                Đơn hàng
                            </a>

                            <!-- Users -->
                            <a href="{{ route('admin_user') }}"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin_user') ? 'bg-gray-700 text-white' : '' }}">
                                <i class="fas fa-users mr-3 text-gray-400 group-hover:text-gray-300"></i>
                                Người dùng
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        @yield('sidebar')

        <!-- Main content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top bar -->
            <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
                <button type="button" class="px-4 md:hidden">
                    <i class="fas fa-bars text-gray-500"></i>
                </button>

                <!-- Search bar -->
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1 flex">
                        <form class="w-full flex md:ml-0" action="#" method="GET">
                            <label for="search-field" class="sr-only">Tìm kiếm</label>
                            <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none">
                                    <i class="fas fa-search ml-3"></i>
                                </div>
                                <input id="search-field"
                                    class="block w-full h-full pl-10 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-0 focus:border-transparent sm:text-sm"
                                    placeholder="Tìm kiếm" type="search">
                            </div>
                        </form>
                    </div>

                    <!-- User dropdown -->
                    <div class="ml-4 flex items-center md:ml-6">
                        <div class="relative">
                            <button type="button"
                                class="flex items-center max-w-xs text-sm rounded-full text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                id="user-menu-button">
                                <span class="sr-only">Mở menu người dùng</span>
                                <img class="h-8 w-8 rounded-full"
                                    src="https://ui-avatars.com/api/?name={{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->admusername : 'Admin' }}&background=random"
                                    alt="">
                                <span class="ml-2 text-gray-700">
                                    {{ Auth::guard('admin')->user()->admusername ?? 'Admin' }}
                                </span>
                                <i class="fas fa-chevron-down ml-1 text-gray-500"></i>
                            </button>

                            <!-- Dropdown menu -->
                            <div class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">
                                    <i class="fas fa-user mr-2"></i> Hồ sơ
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                    role="menuitem">
                                    <i class="fas fa-cog mr-2"></i> Cài đặt
                                </a>
                                @if(Route::has('admin_logout'))
                                    <form action="{{ route('admin_logout') }}" method="POST" class="block">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('admin_login') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('topbar')

            <!-- Main content area -->
            <main class="flex-1 overflow-y-auto focus:outline-none bg-gray-50">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <h1 class="text-2xl font-semibold text-gray-900">@yield('page_title', 'Dashboard')</h1>
                    </div>
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <!-- Phần nội dung chính -->
                        <div class="py-4">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
            @yield('admin_content')
        </div>
    </div>

</body>

</html>