<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function product_list()
    {
        $all_product = DB::table('product')
            ->join('category_product', 'product.category_id', '=', 'category_product.category_id')
            ->select('product.*', 'category_product.category_name')
            ->paginate(15);
        return view('admin.product.product_list', compact('all_product'));
    }
    
    public function product()
    {
        return view('admin.product.product');
    }
    
    public function add_product()
    {
        $categories = Category::all();
        return view('admin.product.add_product', compact('categories'));
    }
    
    public function save_product(ProductRequest $request)
    {
        $data = [
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_description' => $request->product_description,
            'product_content' => $request->product_content,
            'product_price' => $request->product_price,
            'product_status' => $request->product_status,
            'stock_quantity' => $request->stock_quantity ?? 0,
            'in_stock' => ($request->stock_quantity > 0) ? true : false,
            'color' => $request->color,
            'capacity' => $request->capacity,
        ];
        
        // Xử lý thông số kỹ thuật
        $specs = [];
        if ($request->has('spec_name') && $request->has('spec_value')) {
            $specNames = $request->spec_name;
            $specValues = $request->spec_value;
            
            for ($i = 0; $i < count($specNames); $i++) {
                if (!empty($specNames[$i]) && !empty($specValues[$i])) {
                    $specs[$specNames[$i]] = $specValues[$i];
                }
            }
            
            $data['product_specs'] = $specs;
        }
        
        // Xử lý ảnh chính
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $name = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/products');
            $image->move($destinationPath, $name);
            $data['product_image'] = $name;
        }
        
        // Xử lý nhiều ảnh
        $images = [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $name = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $destinationPath = public_path('uploads/products');
                $image->move($destinationPath, $name);
                $images[] = $name;
            }
            
            $data['product_images'] = $images;
        }
        
        Product::create($data);
        Session::put('success', 'Thêm sản phẩm thành công');
        return redirect()->route('product')->with('success', 'Thêm sản phẩm thành công');
    }
    
    public function edit_product($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit_product', compact('product', 'categories'));
    }
    
    public function update_product(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $data = [
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_description' => $request->product_description,
            'product_content' => $request->product_content,
            'product_price' => $request->product_price,
            'product_status' => $request->product_status,
            'stock_quantity' => $request->stock_quantity ?? 0,
            'in_stock' => ($request->stock_quantity > 0) ? true : false,
            'color' => $request->color,
            'capacity' => $request->capacity,
        ];
        
        // Xử lý thông số kỹ thuật
        $specs = [];
        if ($request->has('spec_name') && $request->has('spec_value')) {
            $specNames = $request->spec_name;
            $specValues = $request->spec_value;
            
            for ($i = 0; $i < count($specNames); $i++) {
                if (!empty($specNames[$i]) && !empty($specValues[$i])) {
                    $specs[$specNames[$i]] = $specValues[$i];
                }
            }
            
            $data['product_specs'] = $specs;
        }
        
        // Xử lý ảnh chính
        if ($request->hasFile('product_image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($product->product_image && file_exists(public_path('uploads/products/' . $product->product_image))) {
                unlink(public_path('uploads/products/' . $product->product_image));
            }
            
            $image = $request->file('product_image');
            $name = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/products');
            $image->move($destinationPath, $name);
            $data['product_image'] = $name;
        }
        
        // Xử lý nhiều ảnh
        if ($request->hasFile('product_images')) {
            // Xóa ảnh cũ nếu có
            if ($product->product_images) {
                foreach ($product->product_images as $oldImage) {
                    if (file_exists(public_path('uploads/products/' . $oldImage))) {
                        unlink(public_path('uploads/products/' . $oldImage));
                    }
                }
            }
            
            $images = [];
            foreach ($request->file('product_images') as $image) {
                $name = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $destinationPath = public_path('uploads/products');
                $image->move($destinationPath, $name);
                $images[] = $name;
            }
            
            $data['product_images'] = $images;
        }
        
        $product->update($data);
        Session::put('success', 'Cập nhật sản phẩm thành công');
        return redirect()->route('product')->with('success', 'Cập nhật sản phẩm thành công');
    }
    
    public function delete_product($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.delete_product', compact('product'));
    }
    
    public function destroy_product($id)
    {
        $product = Product::findOrFail($id);
        
        // Xóa ảnh chính
        if ($product->product_image && file_exists(public_path('uploads/products/' . $product->product_image))) {
            unlink(public_path('uploads/products/' . $product->product_image));
        }
        
        // Xóa các ảnh bổ sung
        if ($product->product_images) {
            foreach ($product->product_images as $image) {
                if (file_exists(public_path('uploads/products/' . $image))) {
                    unlink(public_path('uploads/products/' . $image));
                }
            }
        }
        
        $product->delete();
        Session::put('success', 'Xóa sản phẩm thành công');
        return redirect()->route('product')->with('success', 'Xóa sản phẩm thành công');
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        
        $all_product = DB::table('product')
            ->join('category_product', 'product.category_id', '=', 'category_product.category_id')
            ->select('product.*', 'category_product.category_name')
            ->where('product_name', 'like', '%'.$search.'%')
            ->orWhere('product_price', 'like', '%'.$search.'%')
            ->orWhere('category_product.category_name', 'like', '%'.$search.'%')
            ->paginate(15);
        $all_product->appends(['search' => $search]);
        
        return view('admin.product.product_list', compact('all_product'));
    }
}
    