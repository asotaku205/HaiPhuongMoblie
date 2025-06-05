<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index()
    {  
        $category = DB::table('category_product')->where('category_status', 1)->orderBy('category_id', 'desc')->get();
        $product = DB::table('product')->where('product_status', 1)->orderBy('product_id', 'desc')->get();
        // $all_product = DB::table('product')
        // ->join('category_product', 'product.category_id', '=', 'category_product.category_id')
        // ->select('product.*', 'category_product.category_name')
        // ->orderBy('product_id', 'desc')
        // ->limit(10)
        // ->get();
        $all_product = DB::table('product')->where('product_status', 1)->orderBy('product_id', 'desc')->limit(10)->get();
        return view('layouts.main', compact('category', 'product', 'all_product'));
    }

}
