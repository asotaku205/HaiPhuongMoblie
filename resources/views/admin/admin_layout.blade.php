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
        <!-- Mobile sidebar overlay -->
        <div id="mobile-sidebar-overlay" class="fixed inset-0 z-40 bg-gray-600 bg-opacity-50 transition-opacity duration-300 ease-linear lg:hidden opacity-0 pointer-events-none"></div>
        
        <!-- Sidebar -->
        <div id="mobile-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex flex-col w-64 bg-gray-800">
                <!-- Sidebar header -->
                <div class="flex items-center justify-between h-16 px-4 bg-gray-900 text-white">
                    <a href="{{ route('admin_index') }}" class="flex-shrink-0 flex items-center">
                        <span class="text-xl font-bold">HẢI PHƯƠNG MOBILE</span>
                    </a>
                    <button id="close-sidebar" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-600">
                        <i class="fas fa-times"></i>
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
                                    class="sidebar-dropdown-button group w-full flex items-center px-2 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">
                                    <i class="fas fa-mobile-alt mr-3 text-gray-400 group-hover:text-gray-300"></i>
                                    <span class="flex-1">Quản Lý Danh Mục</span>
                                    <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
                                </button>
                                <div class="pl-6 space-y-1 hidden">
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
                            <div class="space-y-1">
                                <button type="button"
                                    class="sidebar-dropdown-button group w-full flex items-center px-2 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">
                                    <i class="fas fa-mobile-alt mr-3 text-gray-400 group-hover:text-gray-300"></i>
                                    <span class="flex-1">Quản Lý Sản Phẩm</span>
                                    <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200"></i>
                                </button>
                                <div class="pl-6 space-y-1 hidden">
                                    <a href="{{ route('add_product') }}"
                                        class="group flex items-center px-2 py-2 text-sm font-medium text-gray-300 rounded-md {{ request()->routeIs('add_product') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                        Thêm Sản Phẩm
                                    </a>
                                    
                                        <a href="{{ route('product') }}"
                                            class="group flex items-center px-2 py-2 text-sm font-medium text-gray-300 rounded-md {{ request()->routeIs('product') ? 'bg-gray-700 text-white' : 'hover:bg-gray-700 hover:text-white' }}">
                                            Sản Phẩm
                                        </a>
                                    
                                </div>
                            </div>

                            <!-- Orders -->
                            <a href="{{ route('admin.orders.index') }}"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.orders.*') ? 'bg-gray-700 text-white' : '' }}">
                                <i class="fas fa-shopping-cart mr-3 text-gray-400 group-hover:text-gray-300"></i>
                                Đơn hàng
                            </a>

                            <!-- Users -->
                            <a href="{{ route('admin_user') }}"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin_user') ? 'bg-gray-700 text-white' : '' }}">
                                <i class="fas fa-users mr-3 text-gray-400 group-hover:text-gray-300"></i>
                                Người dùng
                            </a>

                            <!-- Blog Management -->
                            <a href="{{ route('admin.blogs.index') }}"
                                class="group flex items-center px-2 py-2 text-sm font-medium rounded-md text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.blogs.*') ? 'bg-gray-700 text-white' : '' }}">
                                <i class="fas fa-blog mr-3 text-gray-400 group-hover:text-gray-300"></i>
                                Blog Sửa Chữa
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
                <button type="button" id="mobile-menu-button" class="px-4 text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 lg:hidden">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Search bar -->
                <div class="flex-1 px-4 flex justify-between">
                    <div class="flex-1 flex">
                        
                    </div>

                    <!-- User dropdown -->
                    <div class="ml-2 sm:ml-4 flex items-center">
                        <div class="relative">
                            <button type="button"
                                class="flex items-center max-w-xs text-sm rounded-full text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                id="user-menu-button">
                                <span class="sr-only">Mở menu người dùng</span>
                                <img class="h-8 w-8 rounded-full"
                                    src="https://ui-avatars.com/api/?name={{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->admusername : 'Admin' }}&background=random"
                                    alt="">
                                <span class="ml-2 text-gray-700 hidden sm:block">
                                    {{ Auth::guard('admin')->user()->admusername ?? 'Admin' }}
                                </span>
                                <i class="fas fa-chevron-down ml-1 text-gray-500 hidden sm:block"></i>
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
                        <h1 class="text-2xl font-semibold text-gray-900">@yield('page_title')</h1>
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
    <script src="{{ asset('js/admin-drop.js') }}"></script>
    <script src="{{ asset('js/admin-sidebar.js') }}"></script>
    @yield('js')
</body>

</html>