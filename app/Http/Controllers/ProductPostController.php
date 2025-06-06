<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductPostController extends Controller
{
    public function product_post($id)
    {
        // Lấy danh mục sản phẩm
        $category = DB::table('category_product')
            ->where('category_status', 1)
            ->orderBy('category_id', 'desc')
            ->get();
        
        // Lấy thông tin chi tiết của sản phẩm
        $product = DB::table('product')
            ->join('category_product', 'product.category_id', '=', 'category_product.category_id')
            ->select('product.*', 'category_product.category_name')
            ->where('product_id', $id)
            ->first();
        
        // Lấy danh sách sản phẩm tương tự (cùng danh mục)
        $all_product = DB::table('product')
            ->where('category_id', $product->category_id)
            ->where('product_id', '!=', $id)
            ->where('product_status', 1)
            ->orderBy('product_id', 'desc')
            ->limit(4)
            ->get();
        
        // Nếu không đủ 4 sản phẩm tương tự, bổ sung thêm các sản phẩm khác
        if(count($all_product) < 4) {
            $more_products = DB::table('product')
                ->where('product_status', 1)
                ->where('product_id', '!=', $id)
                ->whereNotIn('product_id', $all_product->pluck('product_id')->toArray())
                ->orderBy('product_id', 'desc')
                ->limit(4 - count($all_product))
                ->get();
            
            $all_product = $all_product->merge($more_products);
        }
        
        return view('layouts.product.product_post', compact('category', 'product', 'all_product'));
    }
}
