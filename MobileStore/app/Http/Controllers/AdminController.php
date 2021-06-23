<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
class AdminController extends Controller
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

    //đăng nhập admin
    public function login(){
        return view('admin_login');
    }

    //kiểm tra đăng nhập đúng hay ko
    public function postlogin(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;
        $data = DB::table('admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($data==true){
            session()->put('admin_name', $data->admin_name);
            session()->put('admin_id', $data->admin_id);
            return redirect('/dashboard');
        }else{
            session()->put('message', 'Tài khoản hoặc Mật khẩu không đúng !!!');
            return redirect('/admin');
        }
    }

    //sau khi đăng nhập admin thành công
    public function showDasboard(){
        $this->CheckAdminLogin();
        return view('admin.dashboard');
    }

    //đăng xuất
    public function logout(){
        session()->put('admin_name',null);
        session()->put('admin_id',null);
        return redirect('/admin');
    }
}
