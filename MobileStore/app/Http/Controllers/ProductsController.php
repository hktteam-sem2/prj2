<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Exports\ExcelExportProduct;
Use Illuminate\Support\Facades\Session;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Gallery;
use App\Pro_details;
use App\Product;
use App\Comment;
use App\Rating;
class ProductsController extends Controller
{
    //check xem admin co dang nhap hay ko
    // public function AuthLogin(){
    //     $admin_id =Auth::id();
    //     if($admin_id){
    //         return Redirect::to('dashboard');
    //     }else{
    //         return Redirect::to('/login-auth')->send();
    //     }
    // }

    //dang nhap account customer
    public function login_customer(Request $request){
        $customer_email = $request->customer_email;
        $customer_password = md5($request->customer_password);
        $result = DB::table('customer')
        ->where('customer_email' , $customer_email)
        ->where('customer_password' , $customer_password)->first();
        if(Session::get('coupon')==true){
            Session::forget('coupon');
        }
        if($result==true){
            session()->put('customer_id', $result->customer_id);
            return redirect('/show_checkout');
        }else{
            return redirect('login_checkout');
        }
    }

      //thêm danh mục sản phẩm
      public function add_products(){
            // $this->AuthLogin();
          $category = DB::table('categoryproducts')->orderBy('category_id')->get();
          $brand = DB::table('brandproducts')->orderBy('brand_id')->get();
        return view('admin.add_products')->with('category',$category)->with('brand',$brand);
    }

    public function postadd_products(Request $request){
        $pro = new Product();
        $pro->product_name = $request->product_name;
        $pro->product_price = $request->product_price;
        $pro->product_quantity = $request->product_quantity;
        $pro->product_image = $request->product_image;
        $pro->product_desc= $request->product_desc;
        $pro->product_status = $request->product_status;
        $pro->category_id = $request->category;
        $pro->brand_id = $request->brand;
        $image = $request->file('product_image');
        if($image==true){
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image . rand(0,99).'.'.$image->getClientOriginalExtension(); //lay duoi mo rong , vd: .jpg , .png , ....
            $pro->product_image = $new_image;
            $image->move('upload/product/',$new_image);
            File::copy('upload/product/'.$new_image,'upload/gallery/'.$new_image);


        }
        $pro->save();
        $pro_id = $pro->product_id;

        $spec = new Pro_details();
        // $spec->speci_screen = $request->screen;
        $spec->speci_screen =$request->screen;
        $spec->speci_os =$request->os;
        $spec->speci_frontcam = $request->front_camera;
        $spec->speci_backcam = $request->back_camera;
        $spec->speci_chip = $request->chip;
        $spec->speci_ram = $request->ram;
        $spec->speci_memory = $request->memory;
        $spec->speci_sim = $request->sim;
        $spec->speci_battery = $request->battery_charge;
        $spec->product_id = $pro_id;
        $spec->save();

        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();

        session()->put('message', 'Thêm danh mục sản phẩm thành công!!!');
        return redirect('add_products');


    }

     //hiển thị tất cả danh mục sản phẩm
     public function all_products(){
        // $this->AuthLogin();
        $allproduct = DB::table('products')
        ->join('pro_details','pro_details.product_id','=','products.product_id')
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
        // $this->AuthLogin();
        $category = DB::table('categoryproducts')->orderBy('category_id')->get();
        $brand = DB::table('brandproducts')->orderBy('brand_id')->get();
        // $edit = DB::table('products')->where('product_id', $product_id)->first();
        $edit = Product::with('pro_details')->where('product_id' , $product_id)->first();
        return view('admin.edit_products',['edit' => $edit])->with('category', $category)->with('brand',$brand);
    }

    //update danh muc san pham
    public function update_products($product_id , Request $request){
        // $data = array();
        // $data['product_name'] = $request->product_name;
        // $data['category_id'] = $request->category;
        // $data['brand_id'] = $request->brand;
        // $data['product_price'] = $request->product_price;
        // $data['product_quantity'] = $request->product_quantity;
        // $data['product_desc'] = $request->product_desc;
        // $data['product_speci'] = $request->product_speci;
        // $image = $request->file('product_image');
        // if($image==true){
        //     $get_name_image = $image->getClientOriginalName();
        //     $name_image = current(explode('.',$get_name_image));
        //     $new_image = $name_image . rand(0,99).'.'.$image->getClientOriginalExtension(); //lay duoi mo rong , vd: .jpg , .png , ....
        //     $image->move('upload/product',$new_image);
        //     $data['product_image'] = $new_image;
        //     DB::table('products')->where('product_id',$product_id)->update($data);
        //     session()->put('message', 'update danh mục sản phẩm thành công!!!');
        //     return redirect('all_products');
        // }
        // DB::table('products')->where('product_id',$product_id)->update($data);
        // session()->put('message', 'update danh mục sản phẩm thành công!!!');
        // return redirect('all_products');
        // $data = Product::with('Pro_details')->find($product_id);
        $data = Product::find($product_id);
        $data->product_name = $request->product_name;
        $data->category_id = $request->category;
        $data->brand_id = $request->brand;
        $data->product_price = $request->product_price;
        $data->product_quantity = $request->product_quantity;
        $data->product_desc = $request->product_desc;
        $image = $request->file('product_image');

        if($image==true){
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image . rand(0,99).'.'.$image->getClientOriginalExtension(); //lay duoi mo rong , vd: .jpg , .png , ..
            $image->move('upload/product/',$new_image);
            $data->product_image = $new_image;

        }
        $data->save();
        $data_id = $data->product_id;

        $data->pro_details->speci_screen = $request->screen;
        $data->pro_details->speci_os = $request->os;
        $data->pro_details->speci_frontcam = $request->front_camera;
        $data->pro_details->speci_backcam = $request->back_camera;
        $data->pro_details->speci_chip = $request->chip;
        $data->pro_details->speci_ram = $request->ram;
        $data->pro_details->speci_memory = $request->memory;
        $data->pro_details->speci_sim = $request->sim;
        $data->pro_details->speci_battery = $request->battery_charge;
        $data->pro_details->product_id = $data_id;
        $data->pro_details->save();

        session()->put('message', 'Cập nhật sản phẩm thành công!!!');
        return redirect('all_products');
    }

    //xoa danh muc san pham
    public function delete_products($product_id){
        // $this->AuthLogin();
        DB::table('products')->where('product_id', $product_id)->delete();
        session()->put('message', 'delete Successfull !!!');
        return redirect('all_products');
    }

    //report
    public function export_product(){
        $this->AuthLogin();
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
        ->where('products.product_id', $product_id)
        ->get();

        foreach($detail_product as $detail){
            $category_id = $detail->category_id;
            $brand_id = $detail->brand_id;
            $product_id = $detail->product_id;
            $category_name = $detail->category_name;
            $brand_name = $detail->brand_name;
            $product_name= $detail->product_name;
        }
        //gallery
        $gallery = Gallery::where('product_id',$product_id)->get();
        // thong so kỹ thuat
        $specifi = Pro_details::where('product_id',$product_id)->get();
        //rating
        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $rating = round($rating);

        $related_product = DB::table('products')

        ->join('categoryproducts','categoryproducts.category_id','=','products.category_id')
        ->join('brandproducts','brandproducts.brand_id','=','products.brand_id')
        ->where('categoryproducts.category_id', $category_id)
        ->where('brandproducts.brand_id', $brand_id)
        ->whereNotIn('products.product_id', [$product_id])->get();

        //update view product
        $product = Product::where('product_id' , $product_id)->first();
        $product->product_views = $product->product_views + 1;
        $product->save();


        return view('pages.detailhome.detail_product_home')
        ->with('category',$category)
        ->with('brand',$brand)
        ->with('category_id',$category_id)
        ->with('brand_id',$brand_id)
        ->with('detail_product',$detail_product)
        ->with('related_product', $related_product)
        ->with('slider', $slider)
        ->with('gallery',$gallery)
        ->with('category_name',$category_name)
        ->with('brand_name',$brand_name)
        ->with('product_name',$product_name)
        ->with('specifi',$specifi)
        ->with('rating',$rating);

    }
    //quickview
    public function quickview(Request $request){

        $product_id = $request->product_id;
        $product = Product::find($product_id);

        $gallery = Gallery::where('product_id',$product_id)->get();

        $output['product_gallery'] = '';

        foreach($gallery as $gal){
            $output['product_gallery'].= '<p><img width="100%" src="upload/gallery/'.$gal->gallery_image.'"></p>';
        }

        $output['product_name'] = $product->product_name;
        $output['product_id'] = $product->product_id;
        $output['product_desc'] = $product->product_desc;
        $output['product_price'] = number_format($product->product_price,0,',','.').' VNĐ';
        $output['product_image'] = '<p><img width="100%" src="upload/product/'.$product->product_image.'"></p>';

        $output['product_button'] = '<input type="button" value="Mua ngay" class="btn btn-primary btn-sm add-to-cart-quickview" id="buy_quickview" data-id_product="'.$product->product_id.'"  name="add-to-cart">';

        $output['product_quickview_value'] = '
        <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_name.'" class="cart_product_name_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_quantity.'" class="cart_product_quantity_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_image.'" class="cart_product_image_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">
        <input type="hidden" value="1" class="cart_product_qty_'.$product->product_id.'">';
        echo json_encode($output);
    }

    //Comment
    public function delete_comment($comment_id){

        DB::table('comment')->where('comment_id', $comment_id)->delete();
        session()->put('message', 'Đã xóa bình luận !!!');
        return redirect('comment');
    }
    public function reply_comment(Request $request){

        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 0;
        $comment->comment_name = 'HKT Mobile Store';
        $comment->save();

    }
    public function allow_comment(Request $request){

        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }
    public function list_comment(){

        $comment = Comment::with('product')->where('comment_parent_comment','=',0)->orderBy('comment_id','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        return view('admin.list_comment')->with(compact('comment','comment_rep'));
    }
    public function send_comment(Request $request){
            $product_id = $request->product_id;
            $comment_name = $request->comment_name;
            $comment_content = $request->comment_content;
            $comment = new Comment();
            $comment->comment = $comment_content;
            $comment->comment_name = $comment_name;
            $comment->comment_product_id = $product_id;
            $comment->comment_status = 1;
            $comment->comment_parent_comment = 0;
            $comment->save();

    }
    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->where('comment_parent_comment','=',0)->where('comment_status',0)->get();//comment_status =0 : show, =1 : hide
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        $output = '';
        foreach($comment as $comm){
            $output.= '
            <div class="row style_comment">

                                        <div class="col-md-2">
                                            <img width="100%" src="'.url('/frontend/images/batman.jpg').'" class="img img-responsive img-thumbnail">
                                        </div>
                                        <div class="col-md-10">
                                            <p style="color:green;">@'.$comm->comment_name.'</p>
                                            <p style="color:#000;">'.$comm->comment_date.'</p>
                                            <p>'.$comm->comment.'</p>
                                        </div>
                                    </div><p></p>
                                    ';

                                    foreach($comment_rep as $rep_comment)  {
                                        if($rep_comment->comment_parent_comment==$comm->comment_id)  {
                                     $output.= ' <div class="row style_comment" style="margin:5px 40px;background: aquamarine;">

                                        <div class="col-md-2">
                                            <img width="80%" src="'.url('/frontend/images/businessman.jpg').'" class="img img-responsive img-thumbnail">
                                        </div>
                                        <div class="col-md-10">
                                            <p style="color:blue;">@HKT-MobileStore</p>
                                            <p style="color:#000;">'.$rep_comment->comment.'</p>
                                            <p></p>
                                        </div>
                                    </div><p></p>';
                                        }
                                    }
        }
        echo $output;

    }
    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }
}
