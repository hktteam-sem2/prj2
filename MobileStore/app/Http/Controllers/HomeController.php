<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Product;
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
    public function search(Request $request){
         //slide
        $slider = DB::table('slider')->orderByDesc('slider_id')->where('slider_status','1')->take(4)->get();
        $keywords = $request->keywords_submit;

        $category = DB::table('categoryproducts')->where('category_status','1')->orderBy('category_id')->get();
        //thuong hieu
        $brand = DB::table('brandproducts')->where('brand_status','1')->orderBy('brand_id')->get();
        $search_product = DB::table('products')->where('product_name','like','%'.$keywords.'%')->get();


        return view('pages.detailhome.search')->with('category',$category)->with('brand',$brand)->with('slider',$slider)->with('search_product',$search_product);

    }
    public function autocomplete_ajax(Request $request){
        $data = $request->all();

        if($data['query']){
            $product = Product::where('product_status',1)->where('product_name','LIKE','%'.$data['query'].'%')->get();
            $output = '
            <ul class="dropdown-menu" style="display:block; position:relative">'
            ;
            foreach($product as $val){
               $output .= '
               <li class="li_search_ajax"><a href="#">'.$val->product_name.'</a></li>
               ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
