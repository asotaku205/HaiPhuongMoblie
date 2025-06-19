<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductPostController extends Controller
{
    public function product_post($id)
    {
        // Lấy danh mục sản phẩm
        $categories = Category::where('category_status', 1)
            ->orderBy('category_id', 'desc')
            ->get();
        
        // Lấy thông tin chi tiết của sản phẩm
        $product = Product::with('category')
            ->findOrFail($id);
        
        // Lấy danh sách sản phẩm tương tự (cùng danh mục)
        $similar_products = Product::where('category_id', $product->category_id)
            ->where('product_id', '!=', $id)
            ->where('product_status', 1)
            ->orderBy('product_id', 'desc')
            ->limit(4)
            ->get();
        
        // Nếu không đủ 4 sản phẩm tương tự, bổ sung thêm các sản phẩm khác
        if(count($similar_products) < 4) {
            $more_products = Product::where('product_status', 1)
                ->where('product_id', '!=', $id)
                ->whereNotIn('product_id', $similar_products->pluck('product_id')->toArray())
                ->orderBy('product_id', 'desc')
                ->limit(4 - count($similar_products))
                ->get();
            
            $all_product = $similar_products->merge($more_products);
        } else {
            $all_product = $similar_products;
        }
        
        return view('layouts.product.product_post', compact('categories', 'product', 'all_product'));
    }
}
