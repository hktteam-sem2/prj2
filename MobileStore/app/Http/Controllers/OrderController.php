<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use App\Shipping;
use App\Order;
use App\Orderdetails;
use App\CouponModel;
use App\Product;

use Barryvdh\DomPDF\PDF;
session_start();

class OrderController extends Controller
{
//quan ly so luong ban ton
    // xu ly nut cap nhat
    public function update_qty(Request $request){
		$data = $request->all();
		$order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
		$order_details->product_sales_quantity = $data['order_qty'];
		$order_details->save();
	}
    //End xu ly nut cap nhat
    public function update_order_qty(Request $request){
        //update order
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        if ($order->order_status==2) {
            //them
            // $total_order = 0;
            // $sales = 0;
            // $profit = 0;
            // $quantity = 0;

            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                //them
                // $product_price = $product->product_price;
                // $product_cost = $product->price_cost;
                // $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key==$key2) {
                        $pro_remain = $product_quantity - $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();
                        //update doanh thu
                        // $quantity+=$qty;
                        // $total_order+=1;
                        // $sales+=$product_price*$qty;
                        // $profit = $sales - ($product_cost*$qty);
                    }
                }
            }
        }elseif($order->order_status!=2 && $order->order_status!=3){
			foreach($data['order_product_id'] as $key => $product_id){

				$product = Product::find($product_id);
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				foreach($data['quantity'] as $key2 => $qty){
						if($key==$key2){
								$pro_remain = $product_quantity + $qty;
								$product->product_quantity = $pro_remain;
								$product->product_sold = $product_sold - $qty;
								$product->save();
						}
				}
			}
		}
    }
//End quan ly so luong ban ton
    //xem don hang
    public function order(){
        $order = Order::orderby('created_at', 'DESC')->get();
        return view('admin.order')->with(compact('order'));
    }

    //xem chi tiet don hang
    public function order_details($order_code){
        $order_detail = Orderdetails::with('product')->where('order_code', $order_code)->get();
        $order = Order::where('order_code', $order_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $order_details = Orderdetails::with('product')->where('order_code' , $order_code)->get();

        foreach($order_details as $key => $order_d){
            $product_coupon = $order_d->product_coupon;
        }
        if($product_coupon != 'No'){
            $coupon = CouponModel::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }

        return view('admin.order_detail')->with(compact('order_detail','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status'));
    }

    //in don hang pdf
    public function print_order($check_code){
        $pdf = \App()->make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($check_code));
        return $pdf->stream();
    }
    public function print_order_convert($check_code){
        $order_detail = Orderdetails::where('order_code', $check_code)->get();
        $order = Order::where('order_code', $check_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $order_details = Orderdetails::with('product')->where('order_code' , $check_code)->get();

        foreach($order_details as $key => $order_d){
            $product_coupon = $order_d->product_coupon;
        }
        if($product_coupon != 'No'){
            $coupon = CouponModel::where('coupon_code', $product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
            if($coupon_condition==1){
                $coupon_echo = $coupon_number . '%';
            }else{
                $coupon_echo = number_format($coupon_number,0,',','.').'vnđ';
            }
        }else{
            $coupon_condition = 2;
            $coupon_echo = $coupon_number = 0;
        }

        $ouput = '';
        $ouput.= '<style>body{
            font-family:DejaVu Sans;
        }
        .table-styling{
            border:1px solid #000;
        }
        .table-styling tbody tr td{
            border:1px solid #000;
        }
        </style>
            <h1><center>HKT-Mobile Shop</center></h1>
            <h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
            <p>---Tài khoản đặt hàng---</p>
            <table class="table-styling">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                    </tr>
                </thead>
                <tbody>';
            $ouput.='
                    <tr>
                        <td>'.$customer->customer_email.'</td>
                        <td>'.$customer->customer_name.'</td>
                        <td>'.$customer->customer_phone.'</td>
                    </tr>';
            $ouput.='
                </tbody>
            </table>

            <p>---Thông tin vận chuyển---</p>
            <table class="table-styling">
                <thead>
                    <tr>
                        <th>Tên người nhận</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Ghi chú</th>
                        <th>Hình thức thanh toán</th>
                    </tr>
                </thead>
                <tbody>';
                if($shipping->shipping_method==0){
                    $shipping->shipping_method = 'chuyển khoản';
                }else{
                    $shipping->shipping_method = 'Tiền mặt';
                }
            $ouput.='
                    <tr>
                        <td>'.$shipping->shipping_name.'</td>
                        <td>'.$shipping->shipping_phone.'</td>
                        <td>'.$shipping->shipping_address.'</td>
                        <td>'.$shipping->shipping_notes.'</td>
                        <td>'.$shipping->shipping_method.'</td>
                    </tr>';
            $ouput.='
                </tbody>
            </table>

            <p>---Thông tin đơn hàng đã đặt---</p>
            <table class="table-styling">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>';
                $total = 0;
                foreach ($order_details as $key => $ord) {
                    $subtotal = $ord->product_price*$ord->product_sales_quantity;
                    $total+=$subtotal;
                    if($ord->product_coupon!='No'){
                        $product_coupon = $ord->product_coupon;
                    }else{
                        $product_coupon = 'Không có';
                    }
                    $ouput.='
                    <tr>
                        <td>'.$ord->product_name.'</td>
                        <td>'.number_format($ord->product_price,0,',','.').' vnđ'.'</td>
                        <td>'.$ord->product_sales_quantity.'</td>
                        <td>'.number_format($subtotal,0,',','.').' vnđ'.'</td>
                    </tr>';
                }
                if($coupon_condition==1){
                    $total_after_coupon = ($total*$coupon_number)/100;
                    $total_coupon = $total - $total_after_coupon;
                }else{

                    $total_coupon = $total - $coupon_number;
                }
            $ouput.='
                    <tr>
                        <td>'
                            .'<p>Mã giảm giá:'.$product_coupon .'</p>'.
                        '</td>
                        <td>'
                            .'<p>Tổng giảm:'.$coupon_echo .'</p>'.
                        '</td>
                        <td colspan="2">'
                            .'<p>Tổng cần thanh toán:'.number_format($total_coupon,0,',','.').'vnđ' .'</p>'.
                        '</td>
                    </tr>';

            $ouput.='
                </tbody>
            </table>

            <p>Ký Tên</p>
            <table>
                <thead>
                    <tr>
                        <th width="200px">Người lập phiếu</th>
                        <th width="800px">Người Nhận Hàng</th>
                    </tr>
                </thead>
                <tbody>';
            $ouput.='
                </tbody>
            </table>
            ';
        return $ouput;
    }
}
