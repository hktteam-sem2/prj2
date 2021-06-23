<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
// use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Session;
use App\Shipping;
use App\Order;
use App\Orderdetails;
session_start();
class CheckOutController extends Controller
{

    public function checkout_login(){
        $slider = DB::table('slider')->orderByDesc('slider_id')->where('slider_status', '1')->take(4)->get();
        $category = DB::table('categoryproducts')->where('category_status','1')->orderBy('category_id')->get();
        $brand = DB::table('brandproducts')->where('brand_status','1')->orderBy('brand_id')->get();
        return view('pages.checkout.login_checkout')->with('category', $category)->with('brand', $brand)->with('slider',$slider);
    }


    // dang ky account customer
    public function add_customer(Request $request){
        $data = array();
        $data['customer_email'] = $request->customer_email;
        $data['customer_name'] = $request->customer_name;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_address'] = $request->customer_address;
        $data['customer_phone'] = $request->customer_phone;

        $customer_id = DB::table('customer')->insertGetId($data);

        session()->put('customer_id', $customer_id);
        session()->put('customer_name', $request->customer_name);

        return redirect()->back()->with('message', 'Đăng ký tài khoản thành công!');
    }

    public function checkout(){
        $slider = DB::table('slider')->orderByDesc('slider_id')->where('slider_status', '1')->take(4)->get();
        $category = DB::table('categoryproducts')->where('category_status','1')->orderBy('category_id')->get();
        $brand = DB::table('brandproducts')->where('brand_status','1')->orderBy('brand_id')->get();
        return view('pages.checkout.show_checkout')->with('category', $category)->with('brand', $brand)->with('slider',$slider);
    }

    // public function save_checkout(Request $request){
    //     $data = array();
    //     $data['shipping_name'] = $request->shipping_name;
    //     $data['shipping_phone'] = $request->shipping_phone;
    //     $data['shipping_address'] = $request->shipping_address;
    //     $data['shipping_notes'] = $request->shipping_notes;

    //     $shipping_id = DB::table('shipping')->insertGetId($data);

    //     session()->put('shipping_id', $shipping_id);

    //     return redirect('/payment');
    // }

    //xác nhận đặt hàng
    public function confirm_order(Request $request){
        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;


        $order = new Order();
        $check_code = substr(md5(microtime()),rand(0,26),5);
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $check_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();



        if(Session::get('cart')){
            foreach(Session::get('cart') as $key => $cart){
                $order_details = new Orderdetails();
                $order_details->order_code = $check_code;
                $order_details->product_id = $cart['product_id'];
                $order_details->product_name = $cart['product_name'];
                $order_details->product_price = $cart['product_price'];
                $order_details->product_sales_quantity = $cart['product_qty'];
                $order_details->product_coupon = $data['order_coupon'];
                $order_details->save();
            }
        }
        Session::forget('coupon');
        Session::forget('cart');

    }


    //xác nhận thông tin thanh toán
    // public function payment(){
    //     $category = DB::table('categoryproducts')->where('category_status','1')->orderBy('category_id')->get();
    //     $brand = DB::table('brandproducts')->where('brand_status','1')->orderBy('brand_id')->get();
    //     return view('pages.checkout.payment')->with('category', $category)->with('brand', $brand);
    // }

    //xac nhan đặt hàng
    // public function order_place(Request $request){
    //     //insert payment_method
    //     $payment_data = array();
    //     $payment_data['payment_method'] = $request->payment_option;
    //     $payment_data['payment_status'] = 'Đang chờ xử lý';
    //     $payment_id = DB::table('payment')->insertGetId($payment_data);

    //     //insert order
    //     $order_data = array();
    //     $order_data['customer_id'] = session()->get('customer_id');
    //     $order_data['shipping_id'] = session()->get('shipping_id');
    //     $order_data['payment_id'] = $payment_id;
    //     $order_data['order_total'] = Cart::subtotal(0);
    //     $order_data['order_status'] = 'Đang chờ xử lý';
    //     $order_id = DB::table('orders')->insertGetId($order_data);

    //     //insert order_details
    //     $content = Cart::content();
    //     foreach($content as $contentvalue){
    //         $order_detail_data['order_id'] = $order_id;
    //         $order_detail_data['product_id'] = $contentvalue->id;
    //         $order_detail_data['product_name'] = $contentvalue->name;
    //         $order_detail_data['product_price'] = $contentvalue->price;
    //         $order_detail_data['product_sales_quantity'] = $contentvalue->qty;
    //         DB::table('orderdetails')->insert($order_detail_data);
    //     }
    //     if($payment_data['payment_method']==1){
    //         echo 'ATM đang được cập nhật !!!';
    //     }elseif($payment_data['payment_method']==2){
    //         $category = DB::table('categoryproducts')->where('category_status','1')->orderBy('category_id')->get();
    //         $brand = DB::table('brandproducts')->where('brand_status','1')->orderBy('brand_id')->get();
    //         Cart::destroy();
    //         return view('pages.checkout.handcash2')->with('category', $category)->with('brand', $brand);
    //     }

        //return redirect('/payment');
    // }

    //dang xuat account customer
    public function checkout_logout(){
        session()->flush();
        return redirect('/login_checkout');
    }

    //dang nhap account customer
    public function login_customer(Request $request){
        $customer_email = $request->customer_email;
        $customer_password = md5($request->customer_password);
        $result = DB::table('customer')
        ->where('customer_email' , $customer_email)
        ->where('customer_password' , $customer_password)->first();

        if($result==true){
            session()->put('customer_id', $result->customer_id);
            return redirect('/trang-chu');
        }else{
            return redirect('login_checkout');
        }

    }

    // quay lai phan backend

    //check xem admin co dang nhap hay ko
    public function CheckAdminLogin(){
        $admin_id = session()->get('admin_id');
        if($admin_id==true){
            return redirect('/dashboard');
        }else{
            return redirect('/admin')->send();
        }
    }

    public function order(){
        $this->CheckAdminLogin();

        $allorder = DB::table('orders')
        ->join('customer','orders.customer_id','=','customer.customer_id')
        ->select('orders.*', 'customer.customer_name')
        ->orderBy('orders.order_id', 'desc')->get();
        return view('admin.order')->with([
            'allorder' => $allorder
        ]);
    }

    public function detail_order($order_id){
        $this->CheckAdminLogin();
        $order_by_id = DB::table('orders')
        ->join('customer','orders.customer_id','=','customer.customer_id')
        ->join('shipping','orders.shipping_id','=','shipping.shipping_id')
        ->join('orderdetails','orders.order_id','=','orderdetails.order_id')
        ->select('orders.*', 'customer.*','shipping.*','orderdetails.*')->where('orders.order_id', $order_id)->get();
        return view('admin.detail_order')->with([
            'order_by_id' => $order_by_id
        ]);
    }

}
