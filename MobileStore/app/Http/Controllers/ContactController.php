<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
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
    public function lien_he(){
        $this->CheckAdminLogin();
        $slider = DB::table('slider')->orderByDesc('slider_id')->where('slider_status','1')->take(4)->get();
         //danh muc
        $category = DB::table('categoryproducts')->where('category_status','1')->orderBy('category_id')->get();
        //thuong hieu
        $brand = DB::table('brandproducts')->where('brand_status','1')->orderBy('brand_id')->get();
        $contact = Contact::where('info_id',1)->get();
        return view('pages.lienhe.contact')->with('category',$category)->with('brand',$brand)->with('slider',$slider)->with('contact',$contact);
    }
    public function information(){
        $this->CheckAdminLogin();
        $contact = Contact::where('info_id',1)->get();
        return view('admin.add_information')->with(compact('contact'));
    }
    public function save_info(Request $request){
    	$data = $request->all();
    	$contact = new Contact();
    	$contact->info_contact = $data['info_contact'];
    	$contact->info_map = $data['info_map'];
    	$get_image = $request->file('info_image');
    	$path = 'public/upload/contact/';
    	if($get_image){
    		$get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo = $new_image;
    	}

    	$contact->save();
    	return redirect()->back()->with('message','Cập nhật thông tin website thành công');

    }

    public function update_info(Request $request,$info_id){
        $this->CheckAdminLogin();
    	$data = $request->all();
    	$contact = Contact::find($info_id);
    	$contact->info_contact = $data['info_contact'];
    	$contact->info_map = $data['info_map'];
    	$get_image = $request->file('info_image');
    	$path = 'public/upload/contact/';
    	if($get_image){
    		unlink($path.$contact->info_logo);
    		$get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            $contact->info_logo = $new_image;
    	}

    	$contact->save();
    	return redirect()->back()->with('message','Thêm thông tin website thành công');
    }
}
