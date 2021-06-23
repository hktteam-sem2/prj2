<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;
use App\CouponModel;

class CouponController extends Controller
{
    //***Coupon backend***
      //check xem admin co dang nhap hay ko
      public function CheckAdminLogin(){
        $admin_id = session()->get('admin_id');
        if($admin_id==true){
            return redirect('/dashboard');
        }else{
            return redirect('/admin')->send();
        }
    }
    //thêm mã giảm giá
    public function add_coupon(){
        $this->CheckAdminLogin();
        return view('admin.add_coupon');
    }
    public function postadd_coupon(Request $request){
        $this->CheckAdminLogin();
       $data = $request->all();
       $coupon = new CouponModel();
       $coupon->coupon_name = $data['coupon_name'];
       $coupon->coupon_code = $data['coupon_code'];
       $coupon->coupon_time = $data['coupon_time'];
       $coupon->coupon_condition = $data['coupon_condition'];
       $coupon->coupon_number = $data['coupon_number'];
       $coupon->save();
        session()->put('message', 'Thêm mã giảm giá thành công!!!');
        return redirect('add_coupon');

    }

    //hiển thị tất cả ma giam gia
    public function all_coupon(){
        $this->CheckAdminLogin();
        $allcoupon = CouponModel::orderby('coupon_id' , 'DESC')->get();
        return view('admin.all_coupon')->with(compact('allcoupon'));
    }

    //xoa mã giảm giá san pham
    public function delete_coupon($coupon_id){
        DB::table('coupon')->where('coupon_id', $coupon_id)->delete();
        session()->put('message', 'delete Successfull !!!');
        return redirect('all_coupon');
    }
    //***Két thúc coupon backend

}
