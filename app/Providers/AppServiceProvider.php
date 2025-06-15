<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Chia sẻ biến categories cho tất cả các view
        view()->composer('*', function ($view) {
            // Lấy các danh mục cha (parent_id = null)
            $parent_categories = Category::where('parent_id', null)
                ->where('category_status', 1)
                ->with('children')
                ->orderBy('category_id', 'asc')
                ->get();
                
            // Lấy tất cả danh mục
            $all_categories = Category::where('category_status', 1)
                ->orderBy('category_id', 'desc')
                ->get();
            
            // Lấy các danh mục cha cụ thể cho menu
            $iphone_category = Category::where('category_name', 'iPhone')
                ->where('parent_id', null)
                ->where('category_status', 1)
                ->with('children')
                ->first();
                
            $phone_category = Category::where('category_name', 'Android')
                ->where('parent_id', null)
                ->where('category_status', 1)
                ->with('children')
                ->first();
                
            $laptop_category = Category::where('category_name', 'Laptop')
                ->where('parent_id', null)
                ->where('category_status', 1)
                ->with('children')
                ->first();
                
            $tablet_category = Category::where('category_name', 'Máy tính bảng')
                ->where('parent_id', null)
                ->where('category_status', 1)
                ->with('children')
                ->first();
            
            $view->with('parent_categories', $parent_categories);
            $view->with('categories', $all_categories);
            $view->with('iphone_category', $iphone_category);
            $view->with('phone_category', $phone_category);
            $view->with('laptop_category', $laptop_category);
            $view->with('tablet_category', $tablet_category);
        });
    }
}
