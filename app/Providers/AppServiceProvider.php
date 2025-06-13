<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

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
            $categories = DB::table('category_product')
                ->where('category_status', 1)
                ->orderBy('category_id', 'desc')
                ->get();
            
            $view->with('categories', $categories);
        });
    }
}
