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

class HomeController extends Controller
{
    public function index()
    {  
        $products = DB::table('product')->where('product_status', 1)->orderBy('product_id', 'desc')->get();
        // $all_product = DB::table('product')
        // ->join('category_product', 'product.category_id', '=', 'category_product.category_id')
        // ->select('product.*', 'category_product.category_name')
        // ->orderBy('product_id', 'desc')
        // ->limit(10)
        // ->get();
        $all_product = DB::table('product')->where('product_status', 1)->orderBy('product_id', 'desc')->limit(10)->get();
        return view('layouts.home', compact('products', 'all_product'));
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
            $query = DB::table('product')
                ->where('category_id', $id)
                ->where('product_status', 1);
            
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

            // Lấy các danh mục liên quan (các danh mục khác cùng trạng thái)
            $related_categories = Category::where('category_id', '!=', $id)
                ->where('category_status', 1)
                ->orderBy('category_id', 'desc')
                ->limit(5)
                ->get();
        }

        return view('layouts.product.category_product', compact('category', 'products', 'related_categories'));
    }

}
