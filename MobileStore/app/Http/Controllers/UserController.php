<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Roles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('user.all_users')->with(compact('admin'));
    }
    public function add_users(){
        return view('user.add_users');
    }
    public function assign_roles(Request $request){
        if (Auth::id() ==$request->admin_id) {
            return redirect()->back()->with('message','Bạn không được phân quyền chính mình');
        }
        $user = Admin::where('admin_email',$request->admin_email)->first();
        $user->roles()->detach();
        if($request['author_role']){
           $user->roles()->attach(Roles::where('name','author')->first());
        }
        if($request['admin_role']){
           $user->roles()->attach(Roles::where('name','admin')->first());
        }
        return redirect()->back()->with('message','Cấp quyền thành công');
    }
    public function delete_user_roles($admin_id){
        if (Auth::id() ==$admin_id) {
            return redirect()->back()->with('message','Bạn không được xoá chính mình');
        }
        $admin = Admin::find($admin_id);
        if ($admin) {
           $admin->roles()->detach();
           $admin->delete();
        }
        return redirect()->back()->with('message','Xoá thành công');
    }
    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = ($data['admin_password']);
        $admin->save();
        $admin->roles()->attach(Roles::where('name','author')->first());
        Session::put('message','Thêm users thành công');
        return Redirect::to('users');
    }

}
