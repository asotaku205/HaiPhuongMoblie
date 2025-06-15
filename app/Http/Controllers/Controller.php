<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    /**
     * Lấy danh mục cha cho menu
     *
     * @return array
     */
    protected function getParentCategories()
    {
        $iphone_category = DB::table('category_product')
            ->where('category_name', 'iPhone')
            ->where('parent_id', null)
            ->where('category_status', 1)
            ->first();
            
        $phone_category = DB::table('category_product')
            ->where('category_name', 'Android')
            ->where('parent_id', null)
            ->where('category_status', 1)
            ->first();
            
        $laptop_category = DB::table('category_product')
            ->where('category_name', 'Laptop')
            ->where('parent_id', null)
            ->where('category_status', 1)
            ->first();
            
        $tablet_category = DB::table('category_product')
            ->where('category_name', 'Máy tính bảng')
            ->where('parent_id', null)
            ->where('category_status', 1)
            ->first();
            
        return [
            'iphone_category' => $iphone_category,
            'phone_category' => $phone_category,
            'laptop_category' => $laptop_category,
            'tablet_category' => $tablet_category
        ];
    }
}
