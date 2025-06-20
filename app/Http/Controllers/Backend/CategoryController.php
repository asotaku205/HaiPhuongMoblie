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
            
        return view('admin.category.add_category', compact('parent_categories'));
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
            
        $all_category->appends(['search' => $search]);
        
        return view('admin.category.category', compact('all_category'));
    }
    
    public function edit_category($id)
    {
        $category = Category::findOrFail($id);
        
        // Lấy danh mục cha để hiển thị trong dropdown
        $parent_categories = Category::where('parent_id', null)
            ->where('category_id', '!=', $id) // Loại trừ danh mục hiện tại
            ->where('category_status', 1)
            ->orderBy('category_name', 'asc')
            ->get();
            
        return view('admin.category.update_category', compact('category', 'parent_categories'));
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
        
        return view('admin.category.delete_category', compact('category', 'has_children'));
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
    
    /**
     * Xử lý bulk actions cho danh mục
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('bulk_action');
        $selectedItems = $request->input('selected_items', []);
        
        if (empty($selectedItems)) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng chọn ít nhất một danh mục!'
            ]);
        }
        
        try {
            switch ($action) {
                case 'delete':
                    return $this->bulkDeleteCategory($selectedItems);
                    
                case 'activate':
                    return $this->bulkActivateCategory($selectedItems);
                    
                case 'deactivate':
                    return $this->bulkDeactivateCategory($selectedItems);
                    
                case 'bulk_edit':
                    return $this->bulkEditCategory($request, $selectedItems);
                    
                case 'export':
                    return $this->bulkExportCategory($selectedItems);
                    
                default:
                    return response()->json([
                        'success' => false,
                        'message' => 'Hành động không hợp lệ!'
                    ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Xóa hàng loạt danh mục
     */
    private function bulkDeleteCategory($selectedItems)
    {
        try {
            // Kiểm tra xem có danh mục nào đang được sử dụng không
            $usedCategories = DB::table('product')
                ->whereIn('category_id', $selectedItems)
                ->pluck('category_id')
                ->toArray();
                
            if (!empty($usedCategories)) {
                $usedCount = count($usedCategories);
                Session::flash('error', "Không thể xóa {$usedCount} danh mục vì đang có sản phẩm sử dụng!");
                return redirect()->back();
            }
            
            // Kiểm tra danh mục con
            $hasChildren = DB::table('category_product')
                ->whereIn('parent_id', $selectedItems)
                ->exists();
                
            if ($hasChildren) {
                Session::flash('error', 'Không thể xóa danh mục vì còn danh mục con!');
                return redirect()->back();
            }
            
            // Xóa danh mục
            $deleted = DB::table('category_product')
                ->whereIn('category_id', $selectedItems)
                ->delete();
            
            Session::flash('success', "Đã xóa thành công {$deleted} danh mục!");
            
            return redirect()->back();
            
        } catch (\Exception $e) {
            Session::flash('error', 'Có lỗi xảy ra khi xóa danh mục: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    
    /**
     * Kích hoạt hàng loạt danh mục
     */
    private function bulkActivateCategory($selectedItems)
    {
        try {
            $updated = DB::table('category_product')
                ->whereIn('category_id', $selectedItems)
                ->update(['category_status' => 1]);
            
            Session::flash('success', "Đã kích hoạt thành công {$updated} danh mục!");
            
            return redirect()->back();
            
        } catch (\Exception $e) {
            Session::flash('error', 'Có lỗi xảy ra khi kích hoạt danh mục: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    
    /**
     * Vô hiệu hóa hàng loạt danh mục
     */
    private function bulkDeactivateCategory($selectedItems)
    {
        try {
            $updated = DB::table('category_product')
                ->whereIn('category_id', $selectedItems)
                ->update(['category_status' => 0]);
            
            Session::flash('success', "Đã vô hiệu hóa thành công {$updated} danh mục!");
            
            return redirect()->back();
            
        } catch (\Exception $e) {
            Session::flash('error', 'Có lỗi xảy ra khi vô hiệu hóa danh mục: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    
    /**
     * Chỉnh sửa hàng loạt danh mục
     */
    private function bulkEditCategory(Request $request, $selectedItems)
    {
        try {
            $updateData = [];
            
            // Kiểm tra và cập nhật trạng thái
            if ($request->filled('status') && $request->status !== '') {
                $updateData['category_status'] = (int)$request->status;
            }
            
            if (empty($updateData)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không có thông tin nào được cập nhật!'
                ]);
            }
            
            $updated = DB::table('category_product')
                ->whereIn('category_id', $selectedItems)
                ->update($updateData);
            
            return response()->json([
                'success' => true,
                'message' => "Đã cập nhật thành công {$updated} danh mục!"
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật danh mục: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Xuất dữ liệu danh mục đã chọn
     */
    private function bulkExportCategory($selectedItems)
    {
        try {
            $categories = Category::with('parent')
                ->whereIn('category_id', $selectedItems)
                ->get();
            
            $filename = 'categories_export_' . date('Y-m-d_H-i-s') . '.csv';
            $handle = fopen('php://output', 'w');
            
            // Set headers for file download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Pragma: no-cache');
            header('Expires: 0');
            
            // Add BOM for UTF-8
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // CSV headers
            fputcsv($handle, [
                'ID',
                'Tên danh mục',
                'Danh mục cha',
                'Mô tả',
                'Trạng thái',
                'Ngày tạo'
            ]);
            
            // CSV data
            foreach ($categories as $category) {
                fputcsv($handle, [
                    $category->category_id,
                    $category->category_name,
                    $category->parent ? $category->parent->category_name : '',
                    $category->category_description,
                    $category->category_status == 1 ? 'Hiển thị' : 'Ẩn',
                    $category->created_at ?? ''
                ]);
            }
            
            fclose($handle);
            exit;
            
        } catch (\Exception $e) {
            Session::flash('error', 'Có lỗi xảy ra khi xuất dữ liệu: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
