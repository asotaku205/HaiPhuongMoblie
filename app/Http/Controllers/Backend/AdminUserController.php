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
}
