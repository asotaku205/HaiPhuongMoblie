<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.admin_user');
    }
    public function infor_user()
    {
       $infor_user = DB::table('users')->paginate(15);
        return view('admin.admin_user', compact('infor_user'));
    }
    
    public function search(Request $request)
    {
        $search = $request->search;
        
        $infor_user = DB::table('users')
            ->where('fullname', 'like', '%'.$search.'%')
            ->orWhere('username', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')
            ->orWhere('phone', 'like', '%'.$search.'%')
            ->paginate(15);
            
        $infor_user->appends(['search' => $search]);
        
        return view('admin.admin_user', compact('infor_user'));
    }
    
    /**
     * Xử lý bulk actions cho người dùng
     */
    public function bulkAction(Request $request)
    {
        $action = $request->input('bulk_action');
        $selectedItems = $request->input('selected_items', []);
        
        if (empty($selectedItems)) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng chọn ít nhất một người dùng!'
            ]);
        }
        
        try {
            switch ($action) {
                case 'delete':
                    return $this->bulkDeleteUser($selectedItems);
                    
                case 'activate':
                    return $this->bulkActivateUser($selectedItems);
                    
                case 'deactivate':
                    return $this->bulkDeactivateUser($selectedItems);
                    
                case 'export':
                    return $this->bulkExportUser($selectedItems);
                    
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
     * Xóa hàng loạt người dùng
     */
    private function bulkDeleteUser($selectedItems)
    {
        try {
            // Kiểm tra xem có đơn hàng nào liên quan không
            $hasOrders = DB::table('orders')
                ->whereIn('user_id', $selectedItems)
                ->exists();
                
            if ($hasOrders) {
                Session::flash('error', 'Không thể xóa người dùng vì có đơn hàng liên quan!');
                return redirect()->back();
            }
            
            // Xóa người dùng
            $deleted = DB::table('users')
                ->whereIn('id', $selectedItems)
                ->delete();
            
            Session::flash('success', "Đã xóa thành công {$deleted} người dùng!");
            
            return redirect()->back();
            
        } catch (\Exception $e) {
            Session::flash('error', 'Có lỗi xảy ra khi xóa người dùng: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    
    /**
     * Kích hoạt hàng loạt người dùng
     */
    private function bulkActivateUser($selectedItems)
    {
        try {
            $updated = DB::table('users')
                ->whereIn('id', $selectedItems)
                ->update(['status' => 1]);
            
            Session::flash('success', "Đã kích hoạt thành công {$updated} người dùng!");
            
            return redirect()->back();
            
        } catch (\Exception $e) {
            Session::flash('error', 'Có lỗi xảy ra khi kích hoạt người dùng: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    
    /**
     * Vô hiệu hóa hàng loạt người dùng
     */
    private function bulkDeactivateUser($selectedItems)
    {
        try {
            $updated = DB::table('users')
                ->whereIn('id', $selectedItems)
                ->update(['status' => 0]);
            
            Session::flash('success', "Đã vô hiệu hóa thành công {$updated} người dùng!");
            
            return redirect()->back();
            
        } catch (\Exception $e) {
            Session::flash('error', 'Có lỗi xảy ra khi vô hiệu hóa người dùng: ' . $e->getMessage());
            return redirect()->back();
        }
    }
    
    /**
     * Xuất dữ liệu người dùng đã chọn
     */
    private function bulkExportUser($selectedItems)
    {
        try {
            $users = DB::table('users')
                ->whereIn('id', $selectedItems)
                ->get();
            
            $filename = 'users_export_' . date('Y-m-d_H-i-s') . '.csv';
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
                'Họ tên',
                'Tên người dùng',
                'Email',
                'Số điện thoại',
                'Địa chỉ',
                'Ngày tạo'
            ]);
            
            // CSV data
            foreach ($users as $user) {
                fputcsv($handle, [
                    $user->id,
                    $user->fullname ?? '',
                    $user->username ?? '',
                    $user->email ?? '',
                    $user->phone ?? '',
                    $user->address ?? '',
                    $user->created_at ?? ''
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
