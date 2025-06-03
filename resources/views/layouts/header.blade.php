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
    <header class="fixed top-0 left-0 right-0 bg-white shadow-md z-50">
        <nav class="bg-blue-900 p-2 flex items-center justify-between">
            <div class="flex items-center w-full justify-center gap-2">
                <a href="{{ route('home') }}" class="text-white no-underline text-m">HaiPhuong Mobile</a>
                <input type="text" placeholder="Bạn tìm gì?"
                    class="w-[300px] p-1 border border-gray-300 rounded-full bg-white text-m">
                <div class="flex items-center gap-2">
                    @if(Auth::check())
                        <span class="text-white px-2">{{ Auth::user()->fullname }}</span>
                        <a href="{{ route('logout') }}" class="text-white no-underline px-2 bg-blue-900 hover:bg-sky-500 rounded-full py-1 text-m">Đăng Xuất</a>
                    @else
                        <a href="{{ route('login') }}" class="text-white no-underline px-2 bg-blue-900 hover:bg-sky-500 rounded-full py-1 text-m">Đăng Nhập</a>
                    @endif
                    <a href="#" class="text-white no-underline px-2 bg-blue-900 hover:bg-sky-500 rounded-full py-1 text-m">Giỏ
                        hàng</a>
                </div>
            </div>
        </nav>
        <nav class="bg-blue-900 p-2 flex gap-2 flex-wrap">
            <ul class="list-none flex gap-2 p-0 m-0 mx-auto">
                <li><a href="#" class="text-white no-underline px-2 bg-blue-900 hover:bg-sky-500 rounded-full py-1 text-m">Điện
                        thoại</a></li>
                <li><a href="#" class="text-white no-underline px-2 bg-blue-900 hover:bg-sky-500 rounded-full py-1 text-m">Phụ
                        kiện</a></li>
                <li><a href="#"
                        class="text-white no-underline px-2 bg-blue-900 hover:bg-sky-500 rounded-full py-1 text-m">Tablet</a>
                </li>
                <li><a href="#" class="text-white no-underline px-2 bg-blue-900 hover:bg-sky-500 rounded-full py-1 text-m">Máy
                        cũ, Thu cũ</a></li>
                <li><a href="#" class="text-white no-underline px-2 bg-blue-900 hover:bg-sky-500 rounded-full py-1 text-m">Sim,
                        Thẻ</a></li>
            </ul>
        </nav>
    </header>
</body>

</html>