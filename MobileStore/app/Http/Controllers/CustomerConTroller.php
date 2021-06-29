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
use Illuminate\Support\Facades\Auth;

session_start();

class CustomerConTroller extends Controller
{
    //check xem admin co dang nhap hay ko
    public function CheckAdminLogin(){
        $admin_id = Auth::id();
        if($admin_id==true){
            return redirect('/dashboard');
        }else{
            return redirect('/admin')->send();
        }
    }

    //hiển thị tất cả user
    public function all_customers(){
        $this->CheckAdminLogin();
        $alluser = DB::table('customer')
        ->orderBy('customer.customer_id')->get();
        return view('customer.all_customer')->with([
            'alluser' => $alluser
        ]);
    }
    //edit user
    public function edit_customers($customer_id){
        $this->CheckAdminLogin();
        $edit = DB::table('customer')->where('customer_id', $customer_id)->first();
        return view('customer.edit_customer',['edit' => $edit])->with('customer_id', $customer_id);
    }

    //update user
    public function update_customers($customer_id , Request $request){
        $data = array();
        $data['customer_email'] = $request->customer_email;
        $data['customer_name'] = $request->customer_name;
        $data['customer_password'] = ($request->customer_password);
        $data['customer_address'] = $request->customer_address;
        $data['customer_phone'] = $request->customer_phone;
        DB::table('customer')->where('customer_id',$customer_id)->update($data);
        session()->put('message', 'update thành công!!!');
        return redirect('all_customer');
    }

    //xoa user
    public function delete_customers($customer_id){
        DB::table('customer')->where('customer_id', $customer_id)->delete();
        session()->put('message', 'delete Successfull !!!');
        return redirect('all_customer');
    }

}
