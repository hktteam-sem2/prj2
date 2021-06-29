<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;
use App\CategoryModel;

class CategoryProductsController extends Controller
{

    //check xem admin co dang nhap hay ko
    public function CheckAdminLogin(){
        $admin_id = Auth::id();
        if($admin_id==true){
            return redirect('/dashboard');
        }else{
            return redirect('/login-auth')->send();
        }
    }

    //thêm danh mục sản phẩm
    public function add_categoryproducts(){
        $this->CheckAdminLogin();
        return view('admin.add_categoryproducts');
    }
    public function arrange_category(Request $request){

        $this->AuthLogin();

        $data = $request->all();
        $cate_id = $data["page_id_array"];

        foreach($cate_id as $key => $value){
            $category = CategoryModel::find($value);
            $category->category_order = $key;
            $category->save();
        }
        echo 'Updated';
    }
    public function postadd_categoryproducts(Request $request){
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        $data['category_status'] = $request->category_status;
        DB::table('categoryproducts')->insert($data);
        session()->put('message', 'Thêm danh mục sản phẩm thành công!!!');
        return redirect('add_categoryproducts');

    }

    //hiển thị tất cả danh mục sản phẩm
    public function all_categoryproducts(){
        $this->CheckAdminLogin();
        $allcategory = DB::table('categoryproducts')->orderBy('category_order','ASC')->get();
        return view('admin.all_categoryproducts')->with([
            'allcategory' => $allcategory
        ]);
    }

    //off danh muc
    public function unactive_categoryproducts($category_id){
        DB::table('categoryproducts')->where('category_id',$category_id)->update(['category_status'=>1]);
        session()->put('message', 'on Successfull !!!');
        return redirect('all_categoryproducts');
    }
    //on danh muc
    public function active_categoryproducts($category_id){
        DB::table('categoryproducts')->where('category_id',$category_id)->update(['category_status'=>0]);
        session()->put('message', 'off Successfull !!!');
        return redirect('all_categoryproducts');
    }

    //edit danh muc san pham
    public function edit_categoryproducts($category_id){
        $this->CheckAdminLogin();
        $edit = DB::table('categoryproducts')->where('category_id', $category_id)->first();
        return view('admin.edit_categoryproducts',['edit' => $edit]);
    }

    //update danh muc san pham
    public function update_categoryproducts($category_id , Request $request){
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        DB::table('categoryproducts')->where('category_id',$category_id)->update($data);
        session()->put('message', 'Update Successfull !!!');
        return redirect('all_categoryproducts');
    }

    //xoa danh muc san pham
    public function delete_categoryproducts($category_id){
        DB::table('categoryproducts')->where('category_id', $category_id)->delete();
        session()->put('message', 'delete Successfull !!!');
        return redirect('all_categoryproducts');
    }
    //***Ket thuc function folder admin



    //hiển thị danh mục sản phẩm trang home
    public function show_category_home($category_id){
        $slider = DB::table('slider')->orderByDesc('slider_id')->where('slider_status', '1')->take(4)->get();
        $category = DB::table('categoryproducts')->where('category_status','1')->orderBy('category_id')->get();
        $brand = DB::table('brandproducts')->where('brand_status','1')->orderBy('brand_id')->get();
        $category_by_id = DB::table('products')
        ->join('categoryproducts','products.category_id','=','categoryproducts.category_id')
        ->where('products.category_id',$category_id)->get();

        $category_by_name = DB::table('categoryproducts')->where('categoryproducts.category_id',$category_id)->get();

        return view('pages.categoryhome.show_category_home')
        ->with('category',$category)
        ->with('brand',$brand)
        ->with('category_by_id',$category_by_id)
        ->with('category_by_name' , $category_by_name)
        ->with('slider',$slider);
    }
}
