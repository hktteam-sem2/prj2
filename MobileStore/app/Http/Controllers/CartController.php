<?php

namespace App\Http\Controllers;

use App\CouponModel;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\Constraint\Count;
// use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

use function PHPUnit\Framework\returnSelf;
session_start();
class CartController extends Controller
{

    // -----cart ajax------
    //them san pham vao gio hang ajax
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = session()->get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id'] == $data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if( $is_avaiable == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['cart_product_id'],
                    'product_name' => $data['cart_product_name'],
                    'product_image' => $data['cart_product_image'],
                    'product_price' => $data['cart_product_price'],
                    'product_qty' => $data['cart_product_qty'],
                );
                session()->put('cart', $cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_image' => $data['cart_product_image'],
                'product_price' => $data['cart_product_price'],
                'product_qty' => $data['cart_product_qty'],
            );
            session()->put('cart', $cart);
        }

        session()->save();

    }

    //hien thi gio hang jax
    public function show_cart_ajax(){
        $slider = DB::table('slider')->orderByDesc('slider_id')->where('slider_status', '1')->take(4)->get();
        $category = DB::table('categoryproducts')->where('category_status','1')->orderBy('category_id')->get();
        $brand = DB::table('brandproducts')->where('brand_status','1')->orderBy('brand_id')->get();
        return view('pages.cart.cart_ajax')->with('category', $category)->with('brand', $brand) ->with('slider', $slider);
    }

    //xóa từng sản phẩm khỏi giỏ hàng ajax
    public function delete_cart_ajax($session_id){
        $cart = session()->get('cart');
        if($cart==true){
            foreach($cart as $key => $val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            session()->put('cart',$cart);
            return redirect()->back()->with('message', 'Xóa sản phẩm khỏi giỏ hàng thành công!!!');
        }else{
            return redirect()->back()->with('message', 'Xóa sản phẩm khỏi giỏ hàng thất bại!!!');
        }
    }

    //xóa tất cả sản phẩm khỏi giỏ hàng
    public function delete_all_cart_ajax(){
        $cart = session()->get('cart');
        if($cart==true){
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message', 'Xóa tất cả sản phẩm khỏi giỏ hàng thành công!!!');
        }
    }

    //cập nhật số lượng sản phẩm giỏ hàng ajax
    public function update_cart_ajax(Request $request){
        $data = $request->all();
        $cart = session()->get('cart');
        if($cart==true){
            foreach($data['cart_quantity'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['session_id']==$key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('message', 'Cập nhật số lượng sản phẩm trong giỏ hàng thành công!!!');
        }else{
            return redirect()->back()->with('message', 'Cập nhật số lượng sản phẩm trong giỏ hàng thất bại!!!');
        }
    }

     //nhập và tính mã giảm giá
    public function check_coupon(Request $request){

        // Session::forget('coupon');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $data = $request->all();
        //neu co dang nhap roi
        if(Session::get('customer_id')){
            $coupon = CouponModel::where('coupon_code', $data['coupon'])->where('coupon_status', 1)
            ->where('coupon_date_end', '>=', $today)
            ->where('coupon_used','LIKE', '%'.Session::get('customer_id').'%' )
            ->first();
            if($coupon){
                return redirect()->back()->with('error','Mã giảm giá này đã được sử dụng, vui lòng nhập mã khác!');
            }else{
                $coupon_login = CouponModel::where('coupon_code', $data['coupon'])->where('coupon_status', 1)->where('coupon_date_end', '>=', $today)->first();
                if($coupon_login){
                    $count_coupon = $coupon_login->count();
                    if ($count_coupon>0) {
                        $coupon_session = Session::get('coupon');
                        if ($coupon_session==true) {
                            $is_avaiable = 0;
                                if ($is_avaiable==0) {
                                    $cou[] = array(
                                        'coupon_code' => $coupon_login->coupon_code,
                                        'coupon_condition' => $coupon_login->coupon_condition,
                                        'coupon_number' => $coupon_login->coupon_number
                                    );
                                    Session::put('coupon', $cou);
                                }else{
                                    $cou[] = array(
                                        'coupon_code' => $coupon_login->coupon_code,
                                        'coupon_condition' => $coupon_login->coupon_condition,
                                        'coupon_number' => $coupon_login->coupon_number
                                    );
                                    Session::put('coupon', $cou);
                                }
                            // Session::save();
                        }else{
                            $cou[] = array(
                                'coupon_code' => $coupon_login->coupon_code,
                                'coupon_condition' => $coupon_login->coupon_condition,
                                'coupon_number' => $coupon_login->coupon_number
                            );
                            Session::put('coupon', $cou);
                        }
                        return redirect()->back()->with('message', 'Nhập mã giảm giá thành công!');
                    }
                }else{
                    return redirect()->back()->with('error','Mã giảm giá không đúng - hoặc đã hết hạn!');
                }
            }
        //nếu chua dang nhập
        }else{
            $coupon = CouponModel::where('coupon_code', $data['coupon'])->where('coupon_status', 1)->where('coupon_date_end', '>=', $today)->first();
        // dd($coupon);
            if($coupon){
                $count_coupon = $coupon->count();
                if ($count_coupon>0) {
                    $coupon_session = Session::get('coupon');
                    if ($coupon_session==true) {
                        $is_avaiable = 0;
                            if ($is_avaiable==0) {
                                $cou[] = array(
                                    'coupon_code' => $coupon->coupon_code,
                                    'coupon_condition' => $coupon->coupon_condition,
                                    'coupon_number' => $coupon->coupon_number
                                );
                                Session::put('coupon', $cou);
                            }else{
                                $cou[] = array(
                                    'coupon_code' => $coupon->coupon_code,
                                    'coupon_condition' => $coupon->coupon_condition,
                                    'coupon_number' => $coupon->coupon_number
                                );
                                Session::put('coupon', $cou);
                            }
                        // Session::save();
                    }else{
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number
                        );
                        Session::put('coupon', $cou);
                    }
                    return redirect()->back()->with('message', 'Nhập mã giảm giá thành công!');
                }
            }else{
                return redirect()->back()->with('error','Mã giảm giá không đúng - hoặc đã hết hạn!');
            }
        }
    }

    //xóa mã giảm giá frontend
    public function unset_coupon(){
        $coupon = Session::get('coupon');
        if($coupon == true){
            Session::forget('coupon');
            return redirect()->back()->with('message', 'Xóa mã giảm giá thành công!!!');
        }
    }




    //-----cart bummen99-------
    // public function add_cart(Request $request){


    //     $productid = $request->productid_hidden;
    //     $quantity = $request->qty;
    //     $product_info = DB::table('products')->where('product_id' , $productid)->first();

    //     $data['id'] = $product_info->product_id;
    //     $data['qty'] = $quantity;
    //     $data['name'] = $product_info->product_name;
    //     $data['price'] = $product_info->product_price;
    //     $data['weight'] = '123';
    //     $data['options']['image'] = $product_info->product_image;
    //     Cart::add($data);
    //     return redirect('/show_cart');
    //     // Cart::destroy();

    // }

    // public function show_cart(){
    //     $category = DB::table('categoryproducts')->where('category_status','1')->orderBy('category_id')->get();
    //     $brand = DB::table('brandproducts')->where('brand_status','1')->orderBy('brand_id')->get();
    //     return view('pages.cart.show_cart')->with('category', $category)->with('brand', $brand);
    // }

    // public function delete_cart($rowId){
    //     Cart::update($rowId,0);
    //     return redirect('/show_cart');
    // }

    // public function update_cart_quantity(Request $request){
    //     $rowId = $request->rowId_cart;
    //     $qty = $request->cart_quantity;
    //     Cart::update($rowId,$qty);
    //     return redirect('/show_cart');
    // }


}
