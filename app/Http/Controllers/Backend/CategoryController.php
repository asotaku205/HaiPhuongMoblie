<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\AddCategoryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
session_start();
class CategoryController extends Controller
{
    public function __construct()
    {
        // Constructor code here if needed
    }

    public function add_category()
    {
        // Lấy danh mục cha để hiển thị trong dropdown
        $parent_categories = Category::where('parent_id', null)
            ->where('category_status', 1)
            ->orderBy('category_name', 'asc')
            ->get();
            
        return view('admin.category.category', compact('parent_categories'));
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
        $data['parent_id'] = $request->parent_id ?: null;
        
        DB::table('category_product')->insert($data);
        Session::put('success', 'Thêm danh mục thành công');
        return redirect()->back()->with('success', 'Thêm danh mục thành công');
    }
    
    public function all_category()
    {
        // Sử dụng model Category để lấy thông tin danh mục và danh mục cha
        $all_category = Category::with('parent')
            ->orderBy('parent_id', 'asc')
            ->orderBy('category_name', 'asc')
            ->paginate(15);
            
        return view('admin.category.category', compact('all_category'));
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        
        $all_category = Category::with('parent')
            ->where('category_name', 'like', '%'.$search.'%')
            ->orWhere('category_description', 'like', '%'.$search.'%')
            ->orderBy('parent_id', 'asc')
            ->orderBy('category_name', 'asc')
            ->paginate(15);
            
        return view('admin.category.category', compact('category', 'parent_categories'));
    }
    
    public function update_category(Request $request, $id)
    {
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['category_status'] = $request->category_status;
        $data['parent_id'] = $request->parent_id ?: null;
        
        // Kiểm tra không cho phép chọn chính nó làm danh mục cha
        if ($data['parent_id'] == $id) {
            Session::put('error', 'Không thể chọn chính danh mục này làm danh mục cha');
            return redirect()->back()->with('error', 'Không thể chọn chính danh mục này làm danh mục cha');
        }
        
        // Kiểm tra không cho phép chọn danh mục con của nó làm danh mục cha
        $category = Category::find($id);
        $childIds = $category->getAllChildrenIds();
        if (in_array($data['parent_id'], $childIds)) {
            Session::put('error', 'Không thể chọn danh mục con làm danh mục cha');
            return redirect()->back()->with('error', 'Không thể chọn danh mục con làm danh mục cha');
        }
        
        DB::table('category_product')->where('category_id', $id)->update($data);
        Session::put('success', 'Cập nhật danh mục thành công');
        return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
    }
    
    public function delete_category($id)
    {
        $category = Category::findOrFail($id);
        
        // Kiểm tra xem danh mục có danh mục con không
        $has_children = Category::where('parent_id', $id)->exists();
        
        return view('admin.category.category', compact('category', 'has_children'));
    }
    
    public function destroy_category($id)
    {
        $category = Category::findOrFail($id);
        
        // Kiểm tra xem danh mục có danh mục con không
        $has_children = Category::where('parent_id', $id)->exists();
        if ($has_children) {
            Session::put('error', 'Không thể xóa danh mục này vì có chứa danh mục con');
            return redirect()->route('category')->with('error', 'Không thể xóa danh mục này vì có chứa danh mục con');
        }
        
        // Kiểm tra xem danh mục có sản phẩm không
        $has_products = DB::table('product')->where('category_id', $id)->exists();
        if ($has_products) {
            Session::put('error', 'Không thể xóa danh mục này vì có chứa sản phẩm');
            return redirect()->route('category')->with('error', 'Không thể xóa danh mục này vì có chứa sản phẩm');
        }
        
        $category->delete();
        Session::put('success', 'Xóa danh mục thành công');
        return redirect()->route('category')->with('success', 'Xóa danh mục thành công');
    }
}
