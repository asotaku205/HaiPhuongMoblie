<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tạo người dùng mẫu
        User::factory(10)->create(); 
        
        // Tạo tài khoản admin
        DB::table('users')->insert([
            'fullname' => 'Đỗ Trần Anh Sơn',
            'username' => 'asotaku205',
            'phone' => '0926395770',
            'email' => 'sonotaku555@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        DB::table('admin')->insert([
            'admusername'=>'asotaku',
            'admemail'=> '123@123.com',
            'admpassword'=> bcrypt('123456'),
            'admphone'=>'12312321',
            'remember_token' => null,
        ]);
        
        // Tạo danh mục cha theo thứ tự menu mới
        // 1. iPhone
        DB::table('category_product')->insert([
            'category_name' => 'iPhone',
            'category_description' => 'Tất cả các dòng iPhone',
            'category_status' => 1,
            'parent_id' => null,
        ]);
        
        // 2. Android
        DB::table('category_product')->insert([
            'category_name' => 'Android',
            'category_description' => 'Các sản phẩm điện thoại Android',
            'category_status' => 1,
            'parent_id' => null,
        ]);

        // 3. Laptop
        DB::table('category_product')->insert([
            'category_name' => 'Laptop',
            'category_description' => 'Các sản phẩm laptop Dell, HP, Asus, Lenovo...',
            'category_status' => 1,
            'parent_id' => null,
        ]);

        // 4. Máy tính bảng
        DB::table('category_product')->insert([
            'category_name' => 'Máy tính bảng',
            'category_description' => 'Các sản phẩm máy tính bảng',
            'category_status' => 1,
            'parent_id' => null,
        ]);

        // 5. Phụ kiện
        DB::table('category_product')->insert([
            'category_name' => 'Phụ kiện',
            'category_description' => 'Các loại phụ kiện điện thoại, laptop',
            'category_status' => 1,
            'parent_id' => null,
        ]);

        // Lấy ID của các danh mục cha
        $iphone_id = DB::getPdo()->lastInsertId() - 4; // ID của iPhone
        $android_id = DB::getPdo()->lastInsertId() - 3; // ID của Android
        $laptop_id = DB::getPdo()->lastInsertId() - 2; // ID của Laptop
        $tablet_id = DB::getPdo()->lastInsertId() - 1; // ID của Máy tính bảng
        $accessory_id = DB::getPdo()->lastInsertId(); // ID của Phụ kiện

        // Thêm danh mục con cho iPhone
        DB::table('category_product')->insert([
            'category_name' => 'iPhone 15',
            'category_description' => 'Các sản phẩm điện thoại iPhone 15 của Apple',
            'category_status' => 1,
            'parent_id' => $iphone_id,
        ]);
        DB::table('category_product')->insert([
            'category_name' => 'iPhone 14',
            'category_description' => 'Các sản phẩm điện thoại iPhone 14 của Apple',
            'category_status' => 1,
            'parent_id' => $iphone_id,
        ]);
        DB::table('category_product')->insert([
            'category_name' => 'iPhone 13',
            'category_description' => 'Các sản phẩm điện thoại iPhone 13 của Apple',
            'category_status' => 1,
            'parent_id' => $iphone_id,
        ]);
        DB::table('category_product')->insert([
            'category_name' => 'iPhone 12',
            'category_description' => 'Các sản phẩm điện thoại iPhone 12 của Apple',
            'category_status' => 1,
            'parent_id' => $iphone_id,
        ]);
        
        // Thêm danh mục con cho Android
        DB::table('category_product')->insert([
            'category_name' => 'Samsung',
            'category_description' => 'Các sản phẩm điện thoại Samsung Galaxy',
            'category_status' => 1,
            'parent_id' => $android_id,
        ]);

        DB::table('category_product')->insert([
            'category_name' => 'Xiaomi',
            'category_description' => 'Các sản phẩm điện thoại Xiaomi',
            'category_status' => 1,
            'parent_id' => $android_id,
        ]);

        DB::table('category_product')->insert([
            'category_name' => 'Oppo',
            'category_description' => 'Các sản phẩm điện thoại Oppo',
            'category_status' => 1,
            'parent_id' => $android_id,
        ]);

        DB::table('category_product')->insert([
            'category_name' => 'Vivo',
            'category_description' => 'Các sản phẩm điện thoại Vivo',
            'category_status' => 1,
            'parent_id' => $android_id,
        ]);

        // Thêm danh mục con cho laptop
        DB::table('category_product')->insert([
            'category_name' => 'Dell',
            'category_description' => 'Các sản phẩm laptop Dell',
            'category_status' => 1,
            'parent_id' => $laptop_id,
        ]);

        DB::table('category_product')->insert([
            'category_name' => 'HP',
            'category_description' => 'Các sản phẩm laptop HP',
            'category_status' => 1,
            'parent_id' => $laptop_id,
        ]);

        DB::table('category_product')->insert([
            'category_name' => 'Asus',
            'category_description' => 'Các sản phẩm laptop Asus',
            'category_status' => 1,
            'parent_id' => $laptop_id,
        ]);

        DB::table('category_product')->insert([
            'category_name' => 'Lenovo',
            'category_description' => 'Các sản phẩm laptop Lenovo',
            'category_status' => 1,
            'parent_id' => $laptop_id,
        ]);

        DB::table('category_product')->insert([
            'category_name' => 'Acer',
            'category_description' => 'Các sản phẩm laptop Acer',
            'category_status' => 1,
            'parent_id' => $laptop_id,
        ]);

        // Thêm danh mục con cho máy tính bảng
        DB::table('category_product')->insert([
            'category_name' => 'iPad',
            'category_description' => 'Các sản phẩm iPad của Apple',
            'category_status' => 1,
            'parent_id' => $tablet_id,
        ]);

        DB::table('category_product')->insert([
            'category_name' => 'Samsung Galaxy Tab',
            'category_description' => 'Các sản phẩm máy tính bảng Samsung',
            'category_status' => 1,
            'parent_id' => $tablet_id,
        ]);

        DB::table('category_product')->insert([
            'category_name' => 'Xiaomi Pad',
            'category_description' => 'Các sản phẩm máy tính bảng Xiaomi',
            'category_status' => 1,
            'parent_id' => $tablet_id,
        ]);
        
        // Thêm danh mục con cho phụ kiện
        DB::table('category_product')->insert([
            'category_name' => 'Tai nghe',
            'category_description' => 'Các loại tai nghe có dây và không dây',
            'category_status' => 1,
            'parent_id' => $accessory_id,
        ]);
        
        DB::table('category_product')->insert([
            'category_name' => 'Sạc dự phòng',
            'category_description' => 'Các loại sạc dự phòng',
            'category_status' => 1,
            'parent_id' => $accessory_id,
        ]);
        
        DB::table('category_product')->insert([
            'category_name' => 'Ốp lưng',
            'category_description' => 'Các loại ốp lưng điện thoại',
            'category_status' => 1,
            'parent_id' => $accessory_id,
        ]);

        // Gọi các seeder khác
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            ProductSeeder::class,
            AccessorySeeder::class,
        ]);
    }
}