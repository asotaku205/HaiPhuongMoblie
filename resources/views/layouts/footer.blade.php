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
    <footer class="bg-gray-100 py-8">
        <div class="container mx-auto grid grid-cols-5 gap-8">
            <!-- Cột 1 -->
            <div>
                <h3 class="text-lg font-bold mb-4">VỀ HAIPHUONGMOBILE</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li><a href="#" class="hover:text-blue-500">Giới thiệu</a></li>
                    <li><a href="#" class="hover:text-blue-500">Tuyển dụng</a></li>
                    <li><a href="#" class="hover:text-blue-500">Liên hệ</a></li>
                </ul>
            </div>

            <!-- Cột 2: Chính sách -->
            <div>
                <h3 class="text-lg font-bold mb-4">CHÍNH SÁCH</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li><a href="#" class="hover:text-blue-500">Chính sách bảo hành</a></li>
                    <li><a href="#" class="hover:text-blue-500">Chính sách giao hàng</a></li>
                    <li><a href="#" class="hover:text-blue-500">Chính sách bảo mật</a></li>
                </ul>
            </div>

            <!-- Cột 3: Thông tin -->
            <div>
                <h3 class="text-lg font-bold mb-4">THÔNG TIN</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li><a href="#" class="hover:text-blue-500">Hệ thống cửa hàng</a></li>
                    <li><a href="#" class="hover:text-blue-500">Hướng dẫn mua hàng</a></li>
                    <li><a href="#" class="hover:text-blue-500">Hướng dẫn thanh toán</a></li>
                    <li><a href="#" class="hover:text-blue-500">Hướng dẫn trả góp</a></li>
                    <li><a href="#" class="hover:text-blue-500">Tra cứu địa chỉ bảo hành</a></li>
                </ul>
            </div>

            <!-- Cột 4: Tổng đài hỗ trợ -->
            <div>
                <h3 class="text-lg font-bold mb-4">HỖ TRỢ</h3>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>Mua hàng: <a href="tel:19005301" class="text-blue-500">1900.5301</a></li>
                    <li>Bảo hành: <a href="tel:19005325" class="text-blue-500">1900.5325</a></li>
                    <li>Kiếu nại: <a href="tel:18006173" class="text-blue-500">1800.6173</a></li>
                    <li>Email: <a href="mailto:cskh@gearvn.com" class="text-blue-500">sonotaku555@gmail.com</a></li>
                </ul>
            </div>

            <!-- Cột 5: Kết nối -->
            <div>
                <h3 class="text-lg font-bold mb-4">KẾT NỐI VỚI CHÚNG TÔI</h3>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-600 hover:text-blue-500">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-blue-500">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-blue-500">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-blue-500">
                        <i class="fab fa-zalo"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Đơn vị vận chuyển và thanh toán -->
        <div class="container mx-auto mt-8">
            <div class="grid grid-cols-2 gap-8">
                <!-- Đơn vị vận chuyển -->
                <div>
                    <h3 class="text-lg font-bold mb-4">ĐƠN VỊ VẬN CHUYỂN</h3>
                    <div class="flex space-x-4">
                        <img src="https://via.placeholder.com/50x30" alt="GHN">
                        <img src="https://via.placeholder.com/50x30" alt="Giao hàng nhanh">
                        <img src="https://via.placeholder.com/50x30" alt="VNPost">
                    </div>
                </div>

                <!-- Cách thức thanh toán -->
                <div>
                    <h3 class="text-lg font-bold mb-4">CÁCH THỨC THANH TOÁN</h3>
                    <div class="flex space-x-4">
                        <img src="https://via.placeholder.com/50x30" alt="Visa">
                        <img src="https://via.placeholder.com/50x30" alt="MasterCard">
                        <img src="https://via.placeholder.com/50x30" alt="ZaloPay">
                        <img src="https://via.placeholder.com/50x30" alt="MoMo">
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>