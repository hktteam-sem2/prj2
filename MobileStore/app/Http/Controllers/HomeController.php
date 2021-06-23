<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends Controller
{

    public function index(){
         //banner
         $slider = DB::table('slider')->orderByDesc('slider_id')->where('slider_status','1')->take(4)->get();
         //danh muc
        $category = DB::table('categoryproducts')->where('category_status','1')->orderBy('category_id')->get();
        //thuong hieu
        $brand = DB::table('brandproducts')->where('brand_status','1')->orderBy('brand_id')->get();

        $all_product = DB::table('products')->where('product_status','1')->orderBy('product_id')->get();
        return view('pages.home')->with('category',$category)->with('brand',$brand)->with('all_product',$all_product)->with('slider',$slider);
    }
}
