<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Exports\ExcelExportProduct;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends Controller
{
    //check xem admin co dang nhap hay ko
    public function CheckAdminLogin(){
        $admin_id = session()->get('admin_id');
        if($admin_id==true){
            return redirect('/dashboard');
        }else{
            return redirect('/admin')->send();
        }
    }
      //thêm danh mục sản phẩm
      public function add_products(){
        $this->CheckAdminLogin();
          $category = DB::table('categoryproducts')->orderBy('category_id')->get();
          $brand = DB::table('brandproducts')->orderBy('brand_id')->get();
        return view('admin.add_products')->with('category',$category)->with('brand',$brand);
    }
    public function postadd_products(Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_image'] = $request->product_image;
        $data['product_desc'] = $request->product_desc;
        $data['product_status'] = $request->product_status;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->category;
        $data['brand_id'] = $request->brand;
        $image = $request->file('product_image');
        if($image==true){
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image . rand(0,99).'.'.$image->getClientOriginalExtension(); //lay duoi mo rong , vd: .jpg , .png , ....
            $image->move('upload/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('products')->insert($data);
            session()->put('message', 'Thêm danh mục sản phẩm thành công!!!');
            return redirect('add_products');
        }
        $data['product_image'] = '';
        DB::table('products')->insert($data);
        session()->put('message', 'Thêm danh mục sản phẩm thành công!!!');
        return redirect('add_products');

    }

     //hiển thị tất cả danh mục sản phẩm
     public function all_products(){
        $this->CheckAdminLogin();
        $allproduct = DB::table('products')
        ->join('categoryproducts','categoryproducts.category_id','=','products.category_id')
        ->join('brandproducts','brandproducts.brand_id','=','products.brand_id')
        ->orderBy('products.product_id')->get();
        return view('admin.all_products')->with([
            'allproduct' => $allproduct
        ]);
    }

    //off danh muc
    public function unactive_products($product_id){
        DB::table('products')->where('product_id',$product_id)->update(['product_status'=>1]);
        session()->put('message', 'on Successfull !!!');
        return redirect('all_products');
    }
    //on danh muc
    public function active_products($product_id){
        DB::table('products')->where('product_id',$product_id)->update(['product_status'=>0]);
        session()->put('message', 'off Successfull !!!');
        return redirect('all_products');
    }

    //edit danh muc san pham
    public function edit_products($product_id){
        $this->CheckAdminLogin();
        $category = DB::table('categoryproducts')->orderBy('category_id')->get();
        $brand = DB::table('brandproducts')->orderBy('brand_id')->get();
        $edit = DB::table('products')->where('product_id', $product_id)->first();
        return view('admin.edit_products',['edit' => $edit])->with('category', $category)->with('brand',$brand);
    }

    //update danh muc san pham
    public function update_products($product_id , Request $request){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category;
        $data['brand_id'] = $request->brand;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $image = $request->file('product_image');
        if($image==true){
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image . rand(0,99).'.'.$image->getClientOriginalExtension(); //lay duoi mo rong , vd: .jpg , .png , ....
            $image->move('upload/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('products')->where('product_id',$product_id)->update($data);
            session()->put('message', 'update danh mục sản phẩm thành công!!!');
            return redirect('all_products');
        }
        DB::table('products')->where('product_id',$product_id)->update($data);
        session()->put('message', 'update danh mục sản phẩm thành công!!!');
        return redirect('all_products');
    }

    //xoa danh muc san pham
    public function delete_products($product_id){
        DB::table('products')->where('product_id', $product_id)->delete();
        session()->put('message', 'delete Successfull !!!');
        return redirect('all_products');
    }

    //report
    public function export_product(){
        return Excel::download(new ExcelExportProduct , 'Product.xlsx');
    }


    //***kết thúc function trang admin***

    //show chi tiet san pham trang chu
    public function detail_product($product_id){
        $category = DB::table('categoryproducts')->where('category_status','1')->orderBy('category_id')->get();
        $brand = DB::table('brandproducts')->where('brand_status','1')->orderBy('brand_id')->get();
        $slider = DB::table('slider')->orderByDesc('slider_id')->where('slider_status', '1')->take(4)->get();

        $detail_product = DB::table('products')
        ->join('categoryproducts','categoryproducts.category_id','=','products.category_id')
        ->join('brandproducts','brandproducts.brand_id','=','products.brand_id')
        ->where('products.product_id', $product_id)->get();

        foreach($detail_product as $detail){
            $category_id = $detail->category_id;
            $brand_id = $detail->brand_id;
        }

        $related_product = DB::table('products')
        ->join('categoryproducts','categoryproducts.category_id','=','products.category_id')
        ->join('brandproducts','brandproducts.brand_id','=','products.brand_id')
        ->where('categoryproducts.category_id', $category_id)
        ->where('brandproducts.brand_id', $brand_id)
        ->whereNotIn('products.product_id', [$product_id])->get();


        return view('pages.detailhome.detail_product_home')
        ->with('category',$category)
        ->with('brand',$brand)
        ->with('detail_product',$detail_product)
        ->with('related_product', $related_product)
        ->with('slider', $slider);
    }
}
