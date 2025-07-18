<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AccessorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        DB::table('category_product')->insert([
            'category_name' => 'Cáp sạc',
            'category_description' => 'Cáp sạc, củ sạc cho điện thoại và thiết bị di động',
            'category_status' => 1,
            'parent_id' => 5,
        ]);

        DB::table('category_product')->insert([
            'category_name' => 'Kính cường lực',
            'category_description' => 'Miếng dán màn hình, kính cường lực bảo vệ điện thoại',
            'category_status' => 1,
            'parent_id' => 5,
        ]);

        // Sản phẩm tai nghe
        DB::table('product')->insert([
            'product_name' => 'Tai nghe AirPods Pro 2',
            'category_id' => 22, // ID của danh mục Tai nghe
            'product_description' => 'Tai nghe không dây AirPods Pro 2 với tính năng chống ồn chủ động',
            'product_content' => 'AirPods Pro 2 mang đến trải nghiệm âm thanh đỉnh cao với công nghệ chống ồn chủ động thế hệ mới, chế độ xuyên âm, âm thanh không gian và thời lượng pin lên đến 6 giờ.',
            'product_price' => 6490000,
            'product_image' => 'airpod.jpeg',
            'product_images' => json_encode(['airpod.jpeg', 'airpod.jpeg']),
            'product_status' => 1,
            'stock_quantity' => 30,
            'in_stock' => true,
            'color' => 'Trắng',
            'capacity' => 'N/A',
            'product_specs' => json_encode([
                'Pin tai nghe' => 'Lên đến 6 giờ nghe với một lần sạc',
                'Pin hộp sạc' => 'Tổng cộng lên đến 30 giờ nghe',
                'Kết nối' => 'Bluetooth 5.3',
                'Micro' => '3 micro với thuật toán tạo chùm tia',
                'Chống nước' => 'Chuẩn IPX4',
                'Tính năng' => 'Chống ồn chủ động, Xuyên âm, Âm thanh không gian, Định vị tai nghe',
                'Chip' => 'H2',
                'Cảm biến' => 'Cảm biến lực, Cảm biến chuyển động, Phát hiện da',
                'Sạc' => 'Lightning, sạc không dây Qi hoặc MagSafe'
            ])
        ]);
        
        DB::table('product')->insert([
            'product_name' => 'Tai nghe Samsung Galaxy Buds2 Pro',
            'category_id' => 22,
            'product_description' => 'Tai nghe không dây Samsung Galaxy Buds2 Pro với chất lượng âm thanh Hi-Fi 24bit',
            'product_content' => 'Galaxy Buds2 Pro là tai nghe không dây cao cấp của Samsung với âm thanh Hi-Fi 24bit, chống ồn chủ động nâng cao và thiết kế nhỏ gọn thoải mái khi đeo.',
            'product_price' => 4990000,
            'product_image' => 'tainghess.jpg',
            'product_images' => json_encode(['tainghess.jpg']),
            'product_status' => 1,
            'stock_quantity' => 25,
            'in_stock' => true,
            'color' => 'Đen',
            'capacity' => 'N/A',
            'product_specs' => json_encode([
                'Pin tai nghe' => 'Lên đến 5 giờ nghe với ANC bật',
                'Pin hộp sạc' => 'Tổng cộng lên đến 18 giờ nghe với ANC',
                'Kết nối' => 'Bluetooth 5.3',
                'Chống nước' => 'Chuẩn IPX7',
                'Tính năng' => 'Chống ồn chủ động, Âm thanh Hi-Fi 24bit, 360 Audio',
                'Micro' => '3 micro cho chất lượng đàm thoại rõ ràng',
                'Sạc' => 'USB Type-C, sạc không dây Qi'
            ])
        ]);

        // Sản phẩm sạc dự phòng
        DB::table('product')->insert([
            'product_name' => 'Sạc dự phòng Anker PowerCore 20000mAh',
            'category_id' => 23, // ID của danh mục Sạc dự phòng
            'product_description' => 'Pin sạc dự phòng Anker PowerCore dung lượng 20000mAh công nghệ sạc nhanh Power IQ',
            'product_content' => 'Anker PowerCore 20000mAh là sạc dự phòng dung lượng cao với công nghệ sạc nhanh Power IQ và nhiều cổng sạc để đáp ứng mọi nhu cầu.',
            'product_price' => 1290000,
            'product_image' => 'sacduphonga.jpg',
            'product_images' => json_encode(['sacduphonga.jpg']),
            'product_status' => 1,
            'stock_quantity' => 50,
            'in_stock' => true,
            'color' => 'Đen',
            'capacity' => '20000mAh',
            'product_specs' => json_encode([
                'Dung lượng' => '20000mAh',
                'Đầu vào' => 'USB-C PD 18W',
                'Đầu ra' => 'USB-A: 12W, USB-C: 18W',
                'Công nghệ sạc' => 'PowerIQ, VoltageBoost',
                'Trọng lượng' => '345g',
                'Kích thước' => '166 × 62 × 22mm',
                'Chất liệu' => 'Nhựa ABS cao cấp',
                'Tính năng bảo vệ' => 'Chống quá nhiệt, chống quá dòng, chống quá áp'
            ])
        ]);
        
        DB::table('product')->insert([
            'product_name' => 'Sạc dự phòng Xiaomi Redmi 10000mAh',
            'category_id' => 23,
            'product_description' => 'Pin sạc dự phòng Xiaomi Redmi dung lượng 10000mAh công nghệ sạc nhanh 10W',
            'product_content' => 'Xiaomi Redmi 10000mAh là sạc dự phòng nhỏ gọn, tiện lợi với khả năng sạc nhanh và đảm bảo an toàn cho thiết bị.',
            'product_price' => 450000,
            'product_image' => 'sacduphong.jpg',
            'product_images' => json_encode(['sacduphong.jpg']),
            'product_status' => 1,
            'stock_quantity' => 60,
            'in_stock' => true,
            'color' => 'Trắng',
            'capacity' => '10000mAh',
            'product_specs' => json_encode([
                'Dung lượng' => '10000mAh',
                'Đầu vào' => 'Micro-USB / USB-C: 5V⎓2A',
                'Đầu ra' => '2 x USB-A: 5V⎓2.4A (MAX)',
                'Công suất sạc' => '10W',
                'Trọng lượng' => '230g',
                'Kích thước' => '147.8 × 73.6 × 15.3mm',
                'Chất liệu' => 'Nhựa ABS với lớp phủ mờ chống vân tay',
                'Đèn báo' => '4 đèn LED chỉ báo mức pin'
            ])
        ]);

        // Sản phẩm ốp lưng điện thoại
        DB::table('product')->insert([
            'product_name' => 'Ốp lưng iPhone 15 Pro Max ESR Classic Clear',
            'category_id' => 24, // ID của danh mục Ốp lưng điện thoại (Giả sử ID mới là 24)
            'product_description' => 'Ốp lưng trong suốt chống sốc ESR cho iPhone 15 Pro Max',
            'product_content' => 'Ốp lưng ESR Classic Clear cho iPhone 15 Pro Max với thiết kế trong suốt, bảo vệ toàn diện, chống va đập và chống vàng ố theo thời gian.',
            'product_price' => 350000,
            'product_image' => 'oplungip.png',
            'product_images' => json_encode(['oplungip.png', 'oplungip.png']),
            'product_status' => 1,
            'stock_quantity' => 100,
            'in_stock' => true,
            'color' => 'Trong suốt',
            'capacity' => 'N/A',
            'product_specs' => json_encode([
                'Tương thích' => 'iPhone 15 Pro Max',
                'Chất liệu' => 'Nhựa TPU cao cấp và PC',
                'Độ dày' => '1.3mm',
                'Công nghệ' => 'Chống vàng ố, chống trầy xước',
                'Thiết kế' => 'Trong suốt, viền nổi bảo vệ camera',
                'Tính năng' => 'Tương thích sạc MagSafe, nút bấm nhạy',
                'Bảo hành' => '12 tháng'
            ])
        ]);
        
        DB::table('product')->insert([
            'product_name' => 'Ốp lưng Samsung Galaxy S23 Ultra Spigen Tough Armor',
            'category_id' => 24,
            'product_description' => 'Ốp lưng Spigen Tough Armor chống sốc cho Samsung Galaxy S23 Ultra',
            'product_content' => 'Ốp lưng Spigen Tough Armor cho Samsung Galaxy S23 Ultra với thiết kế 2 lớp bảo vệ, có đế dựng và công nghệ Air Cushion chống sốc chuẩn quân đội.',
            'product_price' => 550000,
            'product_image' => 'oplungsamsung.jpg',
            'product_images' => json_encode(['oplungsamsung.jpg']),
            'product_status' => 1,
            'stock_quantity' => 80,
            'in_stock' => true,
            'color' => 'Đen',
            'capacity' => 'N/A',
            'product_specs' => json_encode([
                'Tương thích' => 'Samsung Galaxy S23 Ultra',
                'Chất liệu' => 'Lớp ngoài PC cứng, lớp trong TPU mềm',
                'Công nghệ' => 'Air Cushion Technology',
                'Tiêu chuẩn' => 'Chống sốc chuẩn quân đội MIL-STD 810G-516.6',
                'Thiết kế' => 'Có đế dựng tiện lợi',
                'Nút bấm' => 'Nút bấm phản hồi nhanh',
                'Bảo hành' => '12 tháng'
            ])
        ]);

        // Sản phẩm cáp sạc
        DB::table('product')->insert([
            'product_name' => 'Cáp sạc Anker Powerline+ II USB-C to Lightning 1.8m',
            'category_id' => 25, // ID của danh mục Cáp sạc (Giả sử ID mới là 25)
            'product_description' => 'Cáp sạc Anker Powerline+ II USB-C to Lightning MFi 1.8m hỗ trợ sạc nhanh 20W',
            'product_content' => 'Cáp sạc Anker Powerline+ II được chứng nhận MFi, hỗ trợ sạc nhanh 20W cho iPhone, có lớp bọc nylon bền bỉ và tuổi thọ cao với khả năng uốn cong 30.000 lần.',
            'product_price' => 450000,
            'product_image' => 'capsac.jpg',
            'product_images' => json_encode(['capsac.jpg']),
            'product_status' => 1,
            'stock_quantity' => 120,
            'in_stock' => true,
            'color' => 'Đen',
            'capacity' => 'N/A',
            'product_specs' => json_encode([
                'Loại cáp' => 'USB-C to Lightning',
                'Chiều dài' => '1.8m',
                'Công suất' => 'Hỗ trợ sạc nhanh 20W',
                'Tốc độ' => 'Sạc iPhone 13 lên đến 50% trong 30 phút',
                'Chất liệu vỏ' => 'Nylon bện dày chống đứt',
                'Độ bền' => 'Uốn cong 30.000 lần',
                'Chứng nhận' => 'Apple MFi',
                'Bảo hành' => '18 tháng'
            ])
        ]);
        
        DB::table('product')->insert([
            'product_name' => 'Củ sạc Samsung 25W PD Super Fast Charging',
            'category_id' => 25,
            'product_description' => 'Củ sạc nhanh Samsung 25W chuẩn USB-C Power Delivery',
            'product_content' => 'Củ sạc Samsung 25W Super Fast Charging sử dụng công nghệ Power Delivery (PD) cho phép sạc nhanh các thiết bị Samsung và các thiết bị tương thích khác.',
            'product_price' => 550000,
            'product_image' => 'sacsamsung.jpg',
            'product_images' => json_encode(['sacsamsung.jpg']),
            'product_status' => 1,
            'stock_quantity' => 90,
            'in_stock' => true,
            'color' => 'Trắng',
            'capacity' => 'N/A',
            'product_specs' => json_encode([
                'Đầu vào' => 'AC 100-240V, 50-60Hz, 0.7A',
                'Đầu ra' => 'USB-C: 5V/3A, 9V/2.77A, 3.3-5.9V/3A, 3.3-11V/2.25A (Max 25W)',
                'Công nghệ' => 'USB Power Delivery 3.0, PPS',
                'Tương thích' => 'Điện thoại Galaxy, iPhone, iPad và các thiết bị USB-C khác',
                'Bảo vệ' => 'Chống quá nhiệt, quá áp, quá dòng',
                'Kích thước' => '51.3 × 27.6 × 27mm',
                'Trọng lượng' => '55g',
                'Màu sắc' => 'Trắng'
            ])
        ]);

        // Sản phẩm kính cường lực
        DB::table('product')->insert([
            'product_name' => 'Kính cường lực iPhone 15 Pro Max Spigen Glas.tR EZ FIT',
            'category_id' => 26, // ID của danh mục Kính cường lực (Giả sử ID mới là 26)
            'product_description' => 'Kính cường lực Spigen Glas.tR EZ FIT dành cho iPhone 15 Pro Max với khung gắn tự động',
            'product_content' => 'Kính cường lực Spigen Glas.tR EZ FIT với độ cứng 9H, bảo vệ màn hình khỏi trầy xước và nứt vỡ, đi kèm khung lắp đặt tự động giúp dán kính dễ dàng và chính xác.',
            'product_price' => 490000,
            'product_image' => 'kinh15prm.jpg',
            'product_images' => json_encode(['kinh15prm.jpg', 'kinh15prm.jpg']),
            'product_status' => 1,
            'stock_quantity' => 150,
            'in_stock' => true,
            'color' => 'Trong suốt',
            'capacity' => 'N/A',
            'product_specs' => json_encode([
                'Tương thích' => 'iPhone 15 Pro Max',
                'Độ cứng' => '9H',
                'Độ dày' => '0.3mm',
                'Công nghệ' => 'Oleophobic coating chống vân tay và dấu mỡ',
                'Đặc điểm' => 'Phủ kín màn hình, độ trong suốt cao',
                'Lắp đặt' => 'Khung lắp đặt tự động EZ FIT',
                'Trong bộ sản phẩm' => '2 miếng kính, khung lắp đặt, khăn lau, hướng dẫn'
            ])
        ]);
        
        DB::table('product')->insert([
            'product_name' => 'Kính cường lực Samsung Galaxy S23 Ultra Nillkin Amazing H+Pro',
            'category_id' => 26,
            'product_description' => 'Kính cường lực Nillkin Amazing H+Pro cho Samsung Galaxy S23 Ultra, độ cứng 9H',
            'product_content' => 'Kính cường lực Nillkin Amazing H+Pro với lớp phủ nano chống dấu vân tay, đường viền bo cong 2.5D mang lại cảm giác mượt mà khi vuốt và bảo vệ tối đa cho màn hình Samsung Galaxy S23 Ultra.',
            'product_price' => 250000,
            'product_image' => 'kinhcuonglucs23.jpg',
            'product_images' => json_encode(['kinhcuonglucs23.jpg']),
            'product_status' => 1,
            'stock_quantity' => 120,
            'in_stock' => true,
            'color' => 'Trong suốt',
            'capacity' => 'N/A',
            'product_specs' => json_encode([
                'Tương thích' => 'Samsung Galaxy S23 Ultra',
                'Độ cứng' => '9H+',
                'Độ dày' => '0.33mm',
                'Đường viền' => 'Bo cong 2.5D',
                'Công nghệ' => 'Phủ Nano oleophobic chống vân tay',
                'Độ trong' => '99.9%',
                'Tính năng' => 'Chống trầy xước, chống vỡ, hạn chế dấu vân tay',
                'Trong bộ sản phẩm' => 'Miếng kính, khăn lau, hướng dẫn'
            ])
        ]);
    }
}