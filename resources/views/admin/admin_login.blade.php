<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Đăng nhập Admin - Hải Phương Mobile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Trang đăng nhập quản trị viên Hải Phương Mobile" />
    <!-- Tailwind CSS -->
    @vite('resources/css/app.css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Đăng nhập Admin</h2>
                <p class="mt-2 text-sm text-gray-600">Nhập thông tin đăng nhập để truy cập hệ thống</p>
            </div>
            
            <form class="mt-8 space-y-6" action="{{route('admin_authlogin')}}" method="post">
                @csrf
                
                <div class="rounded-md -space-y-px">
                    <div class="mb-5">
                        <label for="admusername" class="block text-sm font-medium text-gray-700 mb-1">Tên đăng nhập</label>
                        <input id="admusername" name="admusername" type="text" class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Tên đăng nhập">
                        @error('admusername')
                            <div class="text-red-600 text-sm mt-1">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="admpassword" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                        <input id="admpassword" name="admpassword" type="password" class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Mật khẩu">
                        @error('admpassword')
                            <div class="text-red-600 text-sm mt-1">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Ghi nhớ đăng nhập
                        </label>
                    </div>

                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Quên mật khẩu?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-sign-in-alt"></i>
                        </span>
                        Đăng Nhập
                    </button>
                </div>
            </form>
            
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">
                            Hoặc
                        </span>
                    </div>
                </div>
                <div class="mt-6 text-center text-sm">
                    <p>Chưa có tài khoản? <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Tạo tài khoản mới</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>