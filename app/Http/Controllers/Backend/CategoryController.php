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
        return view('admin.add_category');
    }

    public function category()
    {
        return view('admin.category');
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
        $all_category = DB::table('category_product')->get();
        return view('admin.category', compact('all_category'));
    }
}
