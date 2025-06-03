<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <title>Đăng Ký - Hai Phuong Mobile</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex min-h-screen bg-blue-50">
        <!-- Form đăng ký - Cột trái -->
        <div class="w-full lg:w-1/2 p-8 flex flex-col justify-center items-center">
            <div class="max-w-md w-full">
                <!-- Logo -->
                <div class="mb-8">
                    <button
                        class="hover:bg-indigo-600 text-white bg-indigo-700 px-4 py-2 rounded-full transition duration-200 ease-in-out">
                        <a href="{{ route('home') }}" class="no-underline text-white">Trang Chủ</a>
                    </button>
                </div>

                <!-- Tiêu đề -->
                <h1 class="text-3xl font-bold mb-2">Tạo tài khoản mới</h1>
                <p class="text-gray-600 mb-6">Đã có tài khoản? <a href="{{ route('login') }}"
                        class="text-indigo-600 hover:text-indigo-800">Đăng nhập ngay</a></p>

                <!-- Form -->
                <form method="POST" action="{{ route('auth_register') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="fullname" class="block text-sm font-medium text-gray-700 mb-1">Họ và tên</label>
                        <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}"
                            class="w-full px-3 py-2 border @error('fullname') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                        @error('fullname')
                            <div class="text-red-700 mt-1">
                                <strong class="font-bold italic text-sm">{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            class="w-full px-3 py-2 border @error('username') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                        @error('username')
                            <div class="text-red-700 mt-1">
                                <strong class="font-bold italic text-sm">{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full px-3 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                        @error('email')
                            <div class="text-red-700 mt-1">
                                <strong class="font-bold italic text-sm">{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                            class="w-full px-3 py-2 border @error('phone') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                        @error('phone')
                            <div class="text-red-700 mt-1">
                                <strong class="font-bold italic text-sm">{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mật khẩu</label>
                        <input type="password" id="password" name="password"
                            class="w-full px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                        @error('password')
                            <div class="text-red-700 mt-1">
                                <strong class="font-bold italic text-sm">{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Xác nhận
                            mật khẩu</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-3 py-2 border @error('password_confirmation') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                    </div>

                    <div class="flex items-center mb-6">
                        <input type="checkbox" id="terms" name="terms"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-700">Tôi đồng ý với <a href="#"
                                class="text-indigo-600 hover:text-indigo-800">điều khoản sử dụng</a> và <a href="#"
                                class="text-indigo-600 hover:text-indigo-800">chính sách bảo mật</a></label>
                        @error('terms')
                            <div class="text-red-700 ml-2">
                                <strong class="font-bold italic text-sm">{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full font-medium py-2 px-4 rounded-md hover:bg-indigo-600 text-white bg-indigo-700 transition duration-200 ease-in-out">
                        Đăng Ký
                    </button>
                </form>

                <!-- Divider -->
                <div class="my-6 flex items-center">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="px-4 text-gray-500 text-sm">Đăng ký với</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <!-- Social register buttons -->
                <div class="grid grid-cols-2 gap-3">
                    <button
                        class="flex justify-center items-center py-2 px-4 rounded-md hover:bg-gray-50 border border-gray-300">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12.24 10.285V14.4h6.806c-.275 1.765-2.056 5.174-6.806 5.174-4.095 0-7.439-3.389-7.439-7.574s3.345-7.574 7.439-7.574c2.33 0 3.891.989 4.785 1.849l3.254-3.138C18.189 1.186 15.479 0 12.24 0c-6.635 0-12 5.365-12 12s5.365 12 12 12c6.926 0 11.52-4.869 11.52-11.726 0-.788-.085-1.39-.189-1.989H12.24z"
                                fill="#4285F4" />
                        </svg>
                        Google
                    </button>
                    <button
                        class="flex justify-center items-center py-2 px-4 rounded-md hover:bg-gray-50 border border-gray-300">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22.675 0H1.325C.593 0 0 .593 0 1.326v21.348C0 23.407.593 24 1.325 24h11.495v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.464.099 2.795.143v3.24h-1.918c-1.504 0-1.796.715-1.796 1.763v2.31h3.59l-.467 3.622h-3.123V24h6.116c.73 0 1.324-.593 1.324-1.326V1.326C24 .593 23.407 0 22.675 0z"
                                fill="#1877F2" />
                            <path
                                d="M16.671 24v-9.294h3.123l.467-3.622h-3.59v-2.31c0-1.048.292-1.763 1.796-1.763h1.918v-3.24c-.331-.044-1.47-.143-2.795-.143-2.765 0-4.659 1.688-4.659 4.788v2.31H9.692v3.622h3.128V24h3.851z"
                                fill="#FFF" />
                        </svg>
                        Facebook
                    </button>
                </div>
            </div>
        </div>

        <!-- Hình ảnh - Cột phải -->
        <div class="hidden lg:block lg:w-1/2 overflow-hidden">
            <img src="{{ asset('pic/cuahang.jpg') }}" alt="Workspace" class="h-screen w-full object-cover">
        </div>
    </div>
</body>

</html>