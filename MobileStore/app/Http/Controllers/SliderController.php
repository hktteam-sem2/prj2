<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Exports\ExcelExportSlider;
use App\Imports\ExcelImportSlider;
use Maatwebsite\Excel\Facades\Excel;
use App\SliderModel;


class SliderController extends Controller
{
    //check xem admin co dang nhap hay ko
    public function CheckAdminLogin(){
        $admin_id = session()->get('admin_id');
        if($admin_id==true){
            return redirect('/dashboard');
        }else{
            return redirect('/login-auth')->send();
        }
    }

    //thêm banner
    public function add_banner(){
        $this->CheckAdminLogin();
        return view('admin.add_slider');
    }

    public function postadd_banner(Request $request){
        $data = new SliderModel;
        $data->slider_name= $request->input(['slider_name']);
        $data->slider_image= $request->input(['slider_image']);
        $data->slider_desc= $request->input(['slider_desc']);
        $data->slider_status= $request->input(['slider_status']);
        $image = $request->file('slider_image');
        if($image==true){
            $get_name_image = $image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image . rand(0,99).'.'.$image->getClientOriginalExtension(); //lay duoi mo rong , vd: .jpg , .png , ....
            $image->move('upload/banner',$new_image);
            $data->slider_image = $new_image;
            $data->save();
            session()->put('message', 'Thêm banner thành công!!!');
            return redirect('add_banner');
        }else{
            session()->put('message', 'Vui lòng thêm banner!!!');
            return redirect('add_banner');
        }

    }
    //liet ke banner
    public function manage_banner(){
        $this->CheckAdminLogin();
        $allslide = DB::table('slider')->orderByDesc('slider_id')->get();
        return view('admin.list_slide')->with(['allslide'=>$allslide]);
    }

    //off banner
    public function unactive_banner($slider_id){
        DB::table('slider')->where('slider_id',$slider_id)->update(['slider_status'=>1]);
        Session::put('message', 'ON Successfull !!!');
        return redirect('all_banner');
    }
    //on banner
    public function active_banner($slider_id){
        DB::table('slider')->where('slider_id',$slider_id)->update(['slider_status'=>0]);
        Session::put('message', 'OFF Successfull !!!');
        return redirect('all_banner');
    }

    //xoa banner
    public function delete_banner($slider_id){
        DB::table('slider')->where('slider_id', $slider_id)->delete();
        session()->put('message', 'Delete Successfull !!!');
        return redirect('all_banner');
    }
    // public function export_banner(){
    //     return Excel::download(new ExcelExportSlider , 'SliderProduct.xlsx');
    // }
    // public function import_banner(Request $request){
    //     $path = $request->file('file')->getRealPath();
    //     Excel::import(new ExcelImportSlider, $path);
    //     return back();

    // }

}
