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
            'product_name' => 'iPhone 15 Pro Max',
            'category_id' => 6,     
            'product_description' => 'iPhone 15 Pro Max, màu Titan Tự nhiên',
            'product_content' => 'iPhone 15 Pro Max là chiếc iPhone cao cấp nhất của Apple với màn hình 6.7 inch, chip A17 Pro, camera 48MP và khung viền titan bền bỉ.',
            'product_price' => 34990000,
            'product_image' => 'ip15prm.jpg',
            'product_images' => json_encode(['ip15prm.jpg', '14prm256.jpg']),
            'product_status' => 1,
            'stock_quantity' => 15,
            'in_stock' => true,
            'color' => 'Titan Tự nhiên',
            'capacity' => '512GB',
            'product_specs' => json_encode([
                'Màn hình' => 'Super Retina XDR OLED, 6.7 inch, 2796 x 1290 pixel',
                'Chip' => 'A17 Pro',
                'RAM' => '8 GB',
                'Bộ nhớ trong' => '512 GB',
                'Camera sau' => 'Chính 48 MP, Ultra Wide 12 MP, Telephoto 12 MP',
                'Camera trước' => '12 MP, f/1.9',
                'Pin' => '4422 mAh, sạc nhanh 20W, sạc không dây 15W',
                'Hệ điều hành' => 'iOS 17',
                'Kích thước' => '159.9 x 76.7 x 8.25 mm',
                'Trọng lượng' => '221 g',
                'Màu sắc' => 'Titan Tự nhiên, Titan Xanh, Titan Trắng, Titan Đen'
            ])
        ]);
        
        DB::table('product')->insert([
            'product_name' => 'iPhone 15 Pro',
            'category_id' => 6, 
            'product_description' => 'iPhone 15 Pro phiên bản, màu Titan Xanh',
            'product_content' => 'iPhone 15 Pro với màn hình 6.1 inch, chip A17 Pro, camera 48MP và khung viền titan cao cấp.',
            'product_price' => 28990000,
            'product_image' => 'ip15prm.jpg',
            'product_images' => json_encode(['ip15prm.jpg']),
            'product_status' => 1,
            'stock_quantity' => 10,
            'in_stock' => true,
            'color' => 'Titan Xanh',
            'capacity' => '256GB',
            'product_specs' => json_encode([
                'Màn hình' => 'Super Retina XDR OLED, 6.1 inch, 2556 x 1179 pixel',
                'Chip' => 'A17 Pro',
                'RAM' => '8 GB',
                'Bộ nhớ trong' => '256 GB',
                'Camera sau' => 'Chính 48 MP, Ultra Wide 12 MP, Telephoto 12 MP',
                'Camera trước' => '12 MP, f/1.9',
                'Pin' => '3274 mAh, sạc nhanh 20W, sạc không dây 15W',
                'Hệ điều hành' => 'iOS 17',
                'Kích thước' => '146.6 x 70.6 x 8.25 mm',
                'Trọng lượng' => '187 g',
                'Màu sắc' => 'Titan Xanh, Titan Tự nhiên, Titan Trắng, Titan Đen'
            ])
        ]);
        
        // iPhone 14 Series
        DB::table('product')->insert([
            'product_name' => 'iPhone 14 Pro Max 256GB',
            'category_id' => 7, 
            'product_description' => 'iPhone 14 Pro Max phiên bản 256GB, màu Tím Deep Purple',
            'product_content' => 'iPhone 14 Pro Max với màn hình 6.7 inch, chip A16 Bionic, camera 48MP và tính năng Dynamic Island.',
            'product_price' => 29990000,
            'product_image' => '14prm256.jpg',
            'product_images' => json_encode(['14prm256.jpg', '1750004140_ip16.jpg']),
            'product_status' => 1,
            'stock_quantity' => 8,
            'in_stock' => true,
            'color' => 'Tím Deep Purple',
            'capacity' => '256GB',
            'product_specs' => json_encode([
                'Màn hình' => 'Super Retina XDR OLED, 6.7 inch, 2796 x 1290 pixel',
                'Chip' => 'A16 Bionic',
                'RAM' => '6 GB',
                'Bộ nhớ trong' => '256 GB',
                'Camera sau' => 'Chính 48 MP, Ultra Wide 12 MP, Telephoto 12 MP',
                'Camera trước' => '12 MP, f/1.9',
                'Pin' => '4323 mAh, sạc nhanh 20W, sạc không dây 15W',
                'Hệ điều hành' => 'iOS 16',
                'Màu sắc' => 'Tím Deep Purple, Vàng, Bạc, Đen'
            ])
        ]);
        
        DB::table('product')->insert([
            'product_name' => 'iPhone 14 128GB',
            'category_id' => 7, 
            'product_description' => 'iPhone 14 phiên bản 128GB, màu Xanh dương',
            'product_content' => 'iPhone 14 với màn hình 6.1 inch, chip A15 Bionic, camera kép 12MP và nhiều tính năng an toàn mới.',
            'product_price' => 21990000,
            'product_image' => '14prm256.jpg', 
            'product_images' => json_encode(['14prm256.jpg']),
            'product_status' => 1,
            'stock_quantity' => 20,
            'in_stock' => true,
            'color' => 'Xanh dương',
            'capacity' => '128GB',
            'product_specs' => json_encode([
                'Màn hình' => 'Super Retina XDR OLED, 6.1 inch, 2532 x 1170 pixel',
                'Chip' => 'A15 Bionic',
                'RAM' => '6 GB',
                'Bộ nhớ trong' => '128 GB',
                'Camera sau' => 'Chính 12 MP, Ultra Wide 12 MP',
                'Camera trước' => '12 MP, f/1.9',
                'Pin' => '3279 mAh, sạc nhanh 20W, sạc không dây 15W',
                'Hệ điều hành' => 'iOS 16',
                'Màu sắc' => 'Xanh dương, Tím nhạt, Đỏ, Trắng, Đen'
            ])
        ]);
        
        // Samsung
        DB::table('product')->insert([
            'product_name' => 'Samsung Galaxy Z Flip5 5G',
            'category_id' => 10,
            'product_description' => 'Samsung Galaxy Z Flip5 với thiết kế gập độc đáo',
            'product_content' => 'Samsung Galaxy Z Flip5 với màn hình gập 6.7 inch, chip Snapdragon 8 Gen 2, camera kép 12MP và màn hình ngoài 3.4 inch.',
            'product_price' => 25990000,
            'product_image' => 'z4flip5g.jpg',
            'product_images' => json_encode(['z4flip5g.jpg']),
            'product_status' => 1,
            'stock_quantity' => 12,
            'in_stock' => true,
            'color' => 'Xanh Mint',
            'capacity' => '256GB',
            'product_specs' => json_encode([
                'Màn hình' => 'Dynamic AMOLED 2X, 6.7 inch, 2640 x 1080 pixel, 120Hz',
                'Màn hình ngoài' => 'Super AMOLED, 3.4 inch, 720 x 748 pixel',
                'Chip' => 'Snapdragon 8 Gen 2',
                'RAM' => '8 GB',
                'Bộ nhớ trong' => '256 GB',
                'Camera sau' => 'Camera chính 12 MP, Ultra Wide 12 MP',
                'Camera trước' => '10 MP',
                'Pin' => '3700 mAh, sạc nhanh 25W',
                'Hệ điều hành' => 'Android 13, One UI 5.1.1',
                'Màu sắc' => 'Xanh Mint, Xám, Tím Lavender, Kem'
            ])
        ]);
        
        // Oppo
        DB::table('product')->insert([
            'product_name' => 'OPPO A60',
            'category_id' => 12, 
            'product_description' => 'OPPO A60 - Smartphone tầm trung hiệu năng cao',
            'product_content' => 'OPPO A60 với màn hình 6.67 inch, chip Snapdragon 680, camera chính 50MP và pin 5000mAh với sạc nhanh 45W.',
            'product_price' => 4990000,
            'product_image' => 'oppoa60.jpg',
            'product_images' => json_encode(['oppoa60.jpg']),
            'product_status' => 1,
            'stock_quantity' => 25,
            'in_stock' => true,
            'color' => 'Đen',
            'capacity' => '128GB',
            'product_specs' => json_encode([
                'Màn hình' => 'IPS LCD, 6.67 inch, Full HD+, 90Hz',
                'Chip' => 'Snapdragon 680',
                'RAM' => '8 GB',
                'Bộ nhớ trong' => '128 GB',
                'Camera sau' => 'Chính 50 MP, Macro 2 MP, Depth 2 MP',
                'Camera trước' => '16 MP',
                'Pin' => '5000 mAh, sạc nhanh 45W',
                'Hệ điều hành' => 'Android 14, ColorOS 14',
                'Màu sắc' => 'Đen, Xanh'
            ])
        ]);
        
        // Laptop Dell
        DB::table('product')->insert([
            'product_name' => 'Dell XPS 13 Plus',
            'category_id' => 14, 
            'product_description' => 'Dell XPS 13 Plus - Laptop cao cấp mỏng nhẹ',
            'product_content' => 'Dell XPS 13 Plus với màn hình 13.4 inch 4K, chip Intel Core i7 thế hệ 12, 16GB RAM, 512GB SSD và thiết kế bàn phím zero-lattice độc đáo.',
            'product_price' => 39990000,
            'product_image' => 'dellxpl.jpg',
            'product_images' => json_encode(['dellxpl.jpg']),
            'product_status' => 1,
            'stock_quantity' => 5,
            'in_stock' => true,
            'color' => 'Bạc',
            'capacity' => '512GB',
            'product_specs' => json_encode([
                'Màn hình' => '13.4 inch, 4K UHD+, 3840 x 2400 pixel, cảm ứng',
                'CPU' => 'Intel Core i7-1260P, 12 nhân, 16 luồng',
                'RAM' => '16 GB LPDDR5',
                'Ổ cứng' => '512 GB SSD NVMe',
                'Card đồ họa' => 'Intel Iris Xe Graphics',
                'Cổng kết nối' => '2x Thunderbolt 4 USB-C',
                'Hệ điều hành' => 'Windows 11 Home',
                'Trọng lượng' => '1.26 kg',
                'Kích thước' => '295.3 x 199.04 x 15.28 mm',
                'Màu sắc' => 'Bạc, Xám đen'
            ])
        ]);
        
        DB::table('product')->insert([
            'product_name' => 'Dell Latitude 7280',
            'category_id' => 14, 
            'product_description' => 'Dell Latitude 7280 - Laptop doanh nhân nhỏ gọn',
            'product_content' => 'Dell Latitude 7280 với màn hình 12.5 inch, chip Intel Core i5, 8GB RAM, 256GB SSD và thiết kế bền bỉ đạt chuẩn quân đội.',
            'product_price' => 18990000,
            'product_image' => 'dell7280.jpg',
            'product_images' => json_encode(['dell7280.jpg']),
            'product_status' => 1,
            'stock_quantity' => 3,
            'in_stock' => true,
            'color' => 'Đen',
            'capacity' => '256GB',
            'product_specs' => json_encode([
                'Màn hình' => '12.5 inch, Full HD, 1920 x 1080 pixel',
                'CPU' => 'Intel Core i5-7300U, 2 nhân 4 luồng',
                'RAM' => '8 GB DDR4',
                'Ổ cứng' => '256 GB SSD',
                'Card đồ họa' => 'Intel HD Graphics 620',
                'Cổng kết nối' => 'USB-A, USB-C, HDMI, SmartCard',
                'Hệ điều hành' => 'Windows 10 Pro',
                'Trọng lượng' => '1.18 kg',
                'Kích thước' => '305.1 x 211.3 x 18.1 mm',
                'Độ bền' => 'Chuẩn MIL-STD-810G',
                'Màu sắc' => 'Đen'
            ])
        ]);
    }
}