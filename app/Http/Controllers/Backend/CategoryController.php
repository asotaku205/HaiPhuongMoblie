<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AddCategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();
class CategoryController extends Controller
{
    public function __construct()
    {
        // Constructor code here if needed
    }

    public function add_category()
    {
        return view('admin.category.add_category');
    }

    public function category()
    {
        return view('admin.category.category');
    }
    public function save_category(AddCategoryRequest $request)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['category_status'] = $request->category_status;
        DB::table('category_product')->insert($data);
        Session::put('success', 'Thêm danh mục thành công');
        return redirect()->back()->with('success', 'Thêm danh mục thành công');
        
    }
    public function all_category()
    {
        $all_category = DB::table('category_product')->paginate(15);
        return view('admin.category.category', compact('all_category'));
    }
    public function search(Request $request)
    {
        $search = $request->search;
        
        $all_category = DB::table('category_product')
            ->where('category_name', 'like', '%'.$search.'%')
            ->orWhere('category_description', 'like', '%'.$search.'%')
            ->paginate(15);
        $all_category->appends(['search' => $search]);
        
        return view('admin.category.category', compact('all_category'));
    }
    public function edit_category($id)
    {
        $category = DB::table('category_product')->where('category_id', $id)->first();
        return view('admin.category.update_category', compact('category'));
    }
    public function update_category(Request $request, $id)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['category_status'] = $request->category_status;
        DB::table('category_product')->where('category_id', $id)->update($data);
        Session::put('success', 'Cập nhật danh mục thành công');
        return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
    }
    public function delete_category($id)
    {
        $category = DB::table('category_product')->where('category_id', $id)->first();
        return view('admin.category.delete_category', compact('category'));
    }
    public function destroy_category($id)
    {
        $category = DB::table('category_product')->where('category_id', $id)->first();
        
        if (!$category) {
            Session::put('error', 'Không tìm thấy danh mục');
            return redirect()->route('category')->with('error', 'Không tìm thấy danh mục');
        }
        
        DB::table('category_product')->where('category_id', $id)->delete();
        Session::put('success', 'Xóa danh mục thành công');
        return redirect()->route('category')->with('success', 'Xóa danh mục thành công');
    }
}
