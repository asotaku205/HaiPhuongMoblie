<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
        $all_category = DB::table('category_product')->where('category_status', 1)->get();
        return view('admin.product.add_product', compact('all_category'));
    }
    
    public function save_product(ProductRequest $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['product_description'] = $request->product_description;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        
        // Xử lý hình ảnh
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $name = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/products');
            $image->move($destinationPath, $name);
            $data['product_image'] = $name;
        }
        
        DB::table('product')->insert($data);
        Session::put('success', 'Thêm sản phẩm thành công');
        return redirect()->back()->with('success', 'Thêm sản phẩm thành công');
    }
    
    public function edit_product($id)
    {
        $product = DB::table('product')->where('product_id', $id)->first();
        $all_category = DB::table('category_product')->where('category_status', 1)->get();
        return view('admin.product.edit_product', compact('product', 'all_category'));
    }
    
    public function update_product(ProductRequest $request, $id)
    {
        
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['product_description'] = $request->product_description;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        
        // Xử lý hình ảnh
        if ($request->hasFile('product_image')) {
            $product = DB::table('product')->where('product_id', $id)->first();
            if ($product && $product->product_image && file_exists(public_path('uploads/products/' . $product->product_image))) {
                unlink(public_path('uploads/products/' . $product->product_image));
            }
            
            // Thêm ảnh mới
            $image = $request->file('product_image');
            $name = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('uploads/products');
            $image->move($destinationPath, $name);
            $data['product_image'] = $name;
        }
        
        DB::table('product')->where('product_id', $id)->update($data);
        Session::put('success', 'Cập nhật sản phẩm thành công');
        return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công');
    }
    
    public function delete_product($id)
    {
        $product = DB::table('product')->where('product_id', $id)->first();
        
        // Xóa hình ảnh
        if ($product && $product->product_image && file_exists(public_path('uploads/products/' . $product->product_image))) {
            unlink(public_path('uploads/products/' . $product->product_image));
        }
        
        DB::table('product')->where('product_id', $id)->delete();
        Session::put('success', 'Xóa sản phẩm thành công');
        return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
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
    