<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    // Hàm truy vấn sản phẩm theo danh mục
    private function getProductsByCategory($categoryName, $limit = 10)
    {
        $query = DB::table('product')
            ->join('category_product', 'product.category_id', '=', 'category_product.category_id')
            ->where('product_status', 1);
            
        if (is_array($categoryName)) {
            $query->where(function($q) use ($categoryName) {
                foreach ($categoryName as $index => $name) {
                    if ($index === 0) {
                        $q->where('category_product.category_name', 'like', "%{$name}%");
                    } else {
                        $q->orWhere('category_product.category_name', 'like', "%{$name}%");
                    }
                }
            });
        } else {
            $query->where('category_product.category_name', 'like', "%{$categoryName}%");
        }
        
        return $query->orderBy('product_id', 'desc')
            ->limit($limit)
            ->get();
    }
    
    // Hàm lấy danh mục theo tên
    private function getCategoryByName($categoryName)
    {
        $query = DB::table('category_product');
        
        if (is_array($categoryName)) {
            $query->where(function($q) use ($categoryName) {
                foreach ($categoryName as $index => $name) {
                    if ($index === 0) {
                        $q->where('category_name', 'like', "%{$name}%");
                    } else {
                        $q->orWhere('category_name', 'like', "%{$name}%");
                    }
                }
            });
        } else {
            $query->where('category_name', 'like', "%{$categoryName}%");
        }
        
        return $query->first();
    }
    
    // Hàm lấy sản phẩm theo danh mục cha và tất cả danh mục con
    private function getProductsByParentCategory($categoryName, $limit = 10)
    {
        // Tìm danh mục cha
        $parentCategory = Category::where('category_name', 'like', "%{$categoryName}%")
            ->where('parent_id', null)
            ->where('category_status', 1)
            ->first();
            
        if (!$parentCategory) {
            return collect(); // Trả về collection rỗng nếu không tìm thấy danh mục cha
        }
        
        // Lấy tất cả ID của danh mục con
        $categoryIds = $parentCategory->getAllChildrenIds();
        // Thêm ID của danh mục cha vào danh sách
        $categoryIds[] = $parentCategory->category_id;
        
        // Truy vấn sản phẩm thuộc các danh mục
        return Product::whereIn('category_id', $categoryIds)
            ->where('product_status', 1)
            ->orderBy('product_id', 'desc')
            ->limit($limit)
            ->get();
    }
    
    public function index()
    {  
        // Sản phẩm nổi bật
        $all_product = DB::table('product')->where('product_status', 1)->orderBy('product_id', 'desc')->limit(10)->get();
            
        // Lấy danh mục cha
        $iphone_category = Category::where('category_name', 'like', "%iPhone%")
            ->where('parent_id', null)
            ->where('category_status', 1)
            ->first();
            
        $phone_category = Category::where('category_name', 'like', "%Android%")
            ->where('parent_id', null)
            ->where('category_status', 1)
            ->first();
            
        $laptop_category = Category::where('category_name', 'like', "%Laptop%")
            ->where('parent_id', null)
            ->where('category_status', 1)
            ->first();
            
        $tablet_category = Category::where('category_name', 'like', "%Máy tính bảng%")
            ->where('parent_id', null)
            ->where('category_status', 1)
            ->first();
            
        $accessory_category = Category::where('category_name', 'like', "%Phụ kiện%")
            ->where('parent_id', null)
            ->where('category_status', 1)
            ->first();
            
        // Lấy danh mục con của phụ kiện
        $accessory_subcategories = collect();
        if ($accessory_category) {
            $accessory_subcategories = Category::where('parent_id', $accessory_category->category_id)
                ->where('category_status', 1)
                ->orderBy('category_name', 'asc')
                ->get();
        }
        
        // Lấy sản phẩm theo danh mục cha
        $iphone_products = $this->getProductsByParentCategory('iPhone');
        $phone_products = $this->getProductsByParentCategory('Android');
        $laptop_products = $this->getProductsByParentCategory('Laptop');
        $tablet_products = $this->getProductsByParentCategory('Máy tính bảng');
            
        return view('layouts.home', compact(
            'all_product', 
            'iphone_products',
            'phone_products', 
            'laptop_products', 
            'tablet_products',
            'iphone_category',
            'phone_category',
            'laptop_category',
            'tablet_category',
            'accessory_category',
            'accessory_subcategories'
        ));
    }
    
    public function show_products(Request $request, $id)
    {
        // Lấy danh mục hiện tại
        $category = Category::where('category_id', $id)
            ->where('category_status', 1)
            ->first();

        // Khởi tạo biến mặc định
        $products = collect();
        $related_categories = collect();

        if ($category) {
            // Khởi tạo query
            $query = null;
            
            // Nếu là danh mục cha, lấy sản phẩm của tất cả danh mục con hoặc theo subcategory_id nếu có
            if ($category->parent_id === null) {
                if ($request->has('subcategory_id') && !empty($request->subcategory_id)) {
                    // Nếu có chọn danh mục con, chỉ lấy sản phẩm của danh mục con đó
                    $subcategoryId = $request->subcategory_id;
                    $subcategory = Category::find($subcategoryId);
                    
                    if ($subcategory && $subcategory->parent_id == $category->category_id) {
                        $query = DB::table('product')
                            ->where('category_id', $subcategoryId)
                            ->where('product_status', 1);
                    } else {
                        // Nếu không tìm thấy danh mục con hợp lệ, lấy tất cả sản phẩm của danh mục cha và danh mục con
                        $categoryIds = $category->getAllChildrenIds();
                        $categoryIds[] = $category->category_id;
                        
                        $query = DB::table('product')
                            ->whereIn('category_id', $categoryIds)
                            ->where('product_status', 1);
                    }
                } else {
                    // Lấy tất cả ID của danh mục con
                    $categoryIds = $category->getAllChildrenIds();
                    // Thêm ID của danh mục cha vào danh sách
                    $categoryIds[] = $category->category_id;
                    
                    $query = DB::table('product')
                        ->whereIn('category_id', $categoryIds)
                        ->where('product_status', 1);
                }
            } else {
                // Nếu là danh mục con, chỉ lấy sản phẩm của danh mục đó
                $query = DB::table('product')
                    ->where('category_id', $id)
                    ->where('product_status', 1);
            }
            
            // Lọc theo tên sản phẩm
            if ($request->has('search') && !empty($request->search)) {
                $query->where('product_name', 'like', '%' . $request->search . '%');
            }
            
            // Lọc theo khoảng giá
            if ($request->has('price_range') && !empty($request->price_range)) {
                switch ($request->price_range) {
                    case 'under_5m':
                        $query->where('product_price', '<', 5000000);
                        break;
                    case '5m_10m':
                        $query->where('product_price', '>=', 5000000)
                              ->where('product_price', '<', 10000000);
                        break;
                    case '10m_15m':
                        $query->where('product_price', '>=', 10000000)
                              ->where('product_price', '<', 15000000);
                        break;
                    case '15m_20m':
                        $query->where('product_price', '>=', 15000000)
                              ->where('product_price', '<', 20000000);
                        break;
                    case 'over_20m':
                        $query->where('product_price', '>=', 20000000);
                        break;
                }
            }
            
            // Sắp xếp
            if ($request->has('sort')) {
                switch ($request->sort) {
                    case 'price_asc':
                        $query->orderBy('product_price', 'asc');
                        break;
                    case 'price_desc':
                        $query->orderBy('product_price', 'desc');
                        break;
                    case 'name_asc':
                        $query->orderBy('product_name', 'asc');
                        break;
                    case 'name_desc':
                        $query->orderBy('product_name', 'desc');
                        break;
                    default:
                        $query->orderBy('product_id', 'desc');
                        break;
                }
            } else {
                $query->orderBy('product_id', 'desc');
            }
            
            // Thực hiện truy vấn với phân trang
            $products = $query->paginate(12)->appends($request->query());

            // Lấy các danh mục liên quan
            if ($category->parent_id === null) {
                // Nếu là danh mục cha, lấy các danh mục cha khác
                $related_categories = Category::where('category_id', '!=', $id)
                    ->where('parent_id', null)
                    ->where('category_status', 1)
                    ->orderBy('category_id', 'desc')
                    ->limit(5)
                    ->get();
            } else {
                // Nếu là danh mục con, lấy các danh mục con cùng cấp (cùng danh mục cha)
                $related_categories = Category::where('category_id', '!=', $id)
                    ->where('parent_id', $category->parent_id)
                    ->where('category_status', 1)
                    ->orderBy('category_id', 'desc')
                    ->limit(5)
                    ->get();
            }
        }

        // Lấy tất cả danh mục cha cho menu
        $parent_categories = Category::where('parent_id', null)
            ->where('category_status', 1)
            ->with('children')
            ->orderBy('category_name', 'asc')
            ->get();

        return view('layouts.product.category_product', compact('category', 'products', 'related_categories', 'parent_categories'));
    }

}
