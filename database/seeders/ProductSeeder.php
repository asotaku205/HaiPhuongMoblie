<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // iPhone 15 Series
        DB::table('product')->insert([
            'product_name' => 'iPhone 15 Pro Max ',
            'category_id' => 6,     
            'product_description' => 'iPhone 15 Pro Max , màu Titan Tự nhiên',
            'product_content' => 'iPhone 15 Pro Max là chiếc iPhone cao cấp nhất của Apple với màn hình 6.7 inch, chip A17 Pro, camera 48MP và khung viền titan bền bỉ.',
            'product_price' => 34990000,
            'product_image' => 'ip15prm.jpg',
            'product_status' => 1,
        ]);
        
        DB::table('product')->insert([
            'product_name' => 'iPhone 15 Pro ',
            'category_id' => 6, 
            'product_description' => 'iPhone 15 Pro phiên bản , màu Titan Xanh',
            'product_content' => 'iPhone 15 Pro với màn hình 6.1 inch, chip A17 Pro, camera 48MP và khung viền titan cao cấp.',
            'product_price' => 28990000,
            'product_image' => 'ip15prm.jpg',
            'product_status' => 1,
        ]);
        
        // iPhone 14 Series
        DB::table('product')->insert([
            'product_name' => 'iPhone 14 Pro Max 256GB',
            'category_id' => 7, 
            'product_description' => 'iPhone 14 Pro Max phiên bản 256GB, màu Tím Deep Purple',
            'product_content' => 'iPhone 14 Pro Max với màn hình 6.7 inch, chip A16 Bionic, camera 48MP và tính năng Dynamic Island.',
            'product_price' => 29990000,
            'product_image' => '14prm256.jpg',
            'product_status' => 1,
        ]);
        
        DB::table('product')->insert([
            'product_name' => 'iPhone 14 128GB',
            'category_id' => 7, 
            'product_description' => 'iPhone 14 phiên bản 128GB, màu Xanh dương',
            'product_content' => 'iPhone 14 với màn hình 6.1 inch, chip A15 Bionic, camera kép 12MP và nhiều tính năng an toàn mới.',
            'product_price' => 21990000,
            'product_image' => '14prm256.jpg', 
            'product_status' => 1,
        ]);
        
        // Samsung
        DB::table('product')->insert([
            'product_name' => 'Samsung Galaxy Z Flip5 5G',
            'category_id' => 10,
            'product_description' => 'Samsung Galaxy Z Flip5 với thiết kế gập độc đáo',
            'product_content' => 'Samsung Galaxy Z Flip5 với màn hình gập 6.7 inch, chip Snapdragon 8 Gen 2, camera kép 12MP và màn hình ngoài 3.4 inch.',
            'product_price' => 25990000,
            'product_image' => 'z4flip5g.jpg',
            'product_status' => 1,
        ]);
        
        // Oppo
        DB::table('product')->insert([
            'product_name' => 'OPPO A60',
            'category_id' => 12 , 
            'product_description' => 'OPPO A60 - Smartphone tầm trung hiệu năng cao',
            'product_content' => 'OPPO A60 với màn hình 6.67 inch, chip Snapdragon 680, camera chính 50MP và pin 5000mAh với sạc nhanh 45W.',
            'product_price' => 4990000,
            'product_image' => 'oppoa60.jpg',
            'product_status' => 1,
        ]);
        
        // Laptop Dell
        DB::table('product')->insert([
            'product_name' => 'Dell XPS 13 Plus',
            'category_id' => 14, 
            'product_description' => 'Dell XPS 13 Plus - Laptop cao cấp mỏng nhẹ',
            'product_content' => 'Dell XPS 13 Plus với màn hình 13.4 inch 4K, chip Intel Core i7 thế hệ 12, 16GB RAM, 512GB SSD và thiết kế bàn phím zero-lattice độc đáo.',
            'product_price' => 39990000,
            'product_image' => 'dellxpl.jpg',
            'product_status' => 1,
        ]);
        
        DB::table('product')->insert([
            'product_name' => 'Dell Latitude 7280',
            'category_id' => 14, 
            'product_description' => 'Dell Latitude 7280 - Laptop doanh nhân nhỏ gọn',
            'product_content' => 'Dell Latitude 7280 với màn hình 12.5 inch, chip Intel Core i5, 8GB RAM, 256GB SSD và thiết kế bền bỉ đạt chuẩn quân đội.',
            'product_price' => 18990000,
            'product_image' => 'dell7280.jpg',
            'product_status' => 1,
        ]);
    }
}