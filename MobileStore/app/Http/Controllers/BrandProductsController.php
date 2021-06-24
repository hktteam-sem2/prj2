<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;

class BrandProductsController extends Controller
{

    //check xem admin co dang nhap hay ko
    public function CheckAdminLogin(){
        $admin_id = session()->get('admin_id');
        if($admin_id==true){
            return redirect('/dashboard');
        }else{
            return redirect('/login-auth')->send();
        }
    }

    //thêm danh mục sản phẩm
    public function add_brandproducts(){
        $this->CheckAdminLogin();
        return view('admin.add_brandproducts');
    }
    public function postadd_brandproducts(Request $request){
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        $data['brand_status'] = $request->brand_status;
        DB::table('brandproducts')->insert($data);
        session()->put('message', 'Thêm danh mục sản phẩm thành công!!!');
        return redirect('add_brandproducts');

    }

     //hiển thị tất cả danh mục sản phẩm
     public function all_brandproducts(){
        $this->CheckAdminLogin();
        $allbrand = DB::table('brandproducts')->get();
        return view('admin.all_brandproducts')->with([
            'allbrand' => $allbrand
        ]);
    }

    //off danh muc
    public function unactive_brandproducts($brand_id){
        DB::table('brandproducts')->where('brand_id',$brand_id)->update(['brand_status'=>1]);
        session()->put('message', 'on Successfull !!!');
        return redirect('all_brandproducts');
    }
    //on danh muc
    public function active_brandproducts($brand_id){
        DB::table('brandproducts')->where('brand_id',$brand_id)->update(['brand_status'=>0]);
        session()->put('message', 'off Successfull !!!');
        return redirect('all_brandproducts');
    }

    //edit danh muc san pham
    public function edit_brandproducts($brand_id){
        $this->CheckAdminLogin();
        $edit = DB::table('brandproducts')->where('brand_id', $brand_id)->first();
        return view('admin.edit_brandproducts',['edit' => $edit]);
    }

    //update danh muc san pham
    public function update_brandproducts($brand_id , Request $request){
        $data = array();
        $data['brand_name'] = $request->brand_name;
        $data['brand_desc'] = $request->brand_desc;
        DB::table('brandproducts')->where('brand_id',$brand_id)->update($data);
        session()->put('message', 'Update Successfull !!!');
        return redirect('all_brandproducts');
    }

    //xoa thương hiệu san pham
    public function delete_brandproducts($brand_id){
        DB::table('brandproducts')->where('brand_id', $brand_id)->delete();
        session()->put('message', 'delete Successfull !!!');
        return redirect('all_brandproducts');
    }

    //***ket thuc function folder admin


    //hiển thị thương hiệu sản phẩm trang home
    public function show_brand_home($brand_id){
        $slider = DB::table('slider')->orderByDesc('slider_id')->where('slider_status','1')->take(4)->get();
        $category = DB::table('categoryproducts')->where('category_status','1')->orderBy('category_id')->get();
        $brand = DB::table('brandproducts')->where('brand_status','1')->orderBy('brand_id')->get();
        $brand_by_id = DB::table('products')
        ->join('brandproducts','products.brand_id','=','brandproducts.brand_id')
        ->where('products.brand_id',$brand_id)->get();
        $brand_by_name = DB::table('brandproducts')->where('brandproducts.brand_id',$brand_id)->get();
        return view('pages.brandhome.show_brand_home')
        ->with('category',$category)
        ->with('brand',$brand)
        ->with('brand_by_id',$brand_by_id)
        ->with('brand_by_name', $brand_by_name)
        ->with('slider',$slider);
    }
}
