# Hải Phương Mobile

Website bán hàng điện thoại, laptop, phụ kiện, máy tính bảng, có hệ thống quản trị và phân quyền người dùng.

## Yêu cầu hệ thống

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & npm (để build assets)
- Các extension PHP phổ biến: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo, GD/ImageMagick

## Hướng dẫn cài đặt

### 1. Clone source code

```bash
git clone <link-repo>
cd HaiPhuongMobile
```

### 2. Cài đặt thư viện PHP

```bash
composer install
```

### 3. Cài đặt thư viện JS

```bash
npm install
```

### 4. Tạo file cấu hình môi trường

```bash
cp .env.example .env
```

Sau đó chỉnh sửa file `.env` cho phù hợp với cấu hình database của bạn.

### 5. Tạo key ứng dụng

```bash
php artisan key:generate
```

### 6. Tạo database và cấu hình

- Tạo database mới trong MySQL, ví dụ: `haiphuongmobile`
- Cập nhật các thông tin DB trong file `.env`:
  ```
  DB_DATABASE=haiphuongmobile
  DB_USERNAME=root
  DB_PASSWORD=yourpassword
  ```

### 7. Chạy migrate và seed dữ liệu mẫu

```bash
php artisan migrate --seed
```

### 8. Build assets

```bash
npm run build
```
Hoặc để phát triển:
```bash
npm run dev
```

### 9. Khởi động server

```bash
php artisan serve
```

Truy cập: [http://localhost:8000](http://localhost:8000)

## Truy cập trang quản trị (Admin)

- **Đường dẫn đăng nhập admin:**  
  Truy cập [http://localhost:8000/admin/login](http://localhost:8000/admin/login) để vào trang đăng nhập quản trị viên.

- **Sau khi đăng nhập thành công:**  
  Bạn sẽ được chuyển đến trang dashboard quản trị tại [http://localhost:8000/admin](http://localhost:8000/admin).

- **Tài khoản mẫu đăng nhập admin:**  
  - Username: `asotaku`
  - Email: `123@123.com`
  - Password: `123456`

- **Các chức năng trong trang admin:**
  - Quản lý người dùng
  - Quản lý danh mục sản phẩm
  - Quản lý sản phẩm
  - Quản lý đơn hàng
  - Quản lý blog sửa chữa

## Tài khoản mẫu

- **Admin:**  
  - Username: `asotaku`  
  - Email: `123@123.com`  
  - Password: `123456`
- **User:**  
  - Username: `asotaku205`  
  - Email: `sonotaku555@gmail.com`  
  - Password: `123456`

## Một số lệnh hữu ích

- Xóa cache:
  ```bash
  php artisan config:clear
  php artisan cache:clear
  php artisan route:clear
  php artisan view:clear
  ```
- Chạy test:
  ```bash
  php artisan test
  ```

## Thư mục chính

- `app/Http/Controllers`: Controller cho backend và frontend
- `app/Models`: Model Eloquent
- `resources/views`: Giao diện Blade
- `public/`: Tài nguyên tĩnh (ảnh, css, js)
- `database/migrations`: Các file migration
- `database/seeders`: Dữ liệu mẫu

## Liên hệ

- Email: sonotaku555@gmail.com

