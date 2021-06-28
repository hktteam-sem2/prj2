@extends('layouts.admin_layouts')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thông tin website
            </header>
            <?php
            $message = session()->get('message');
            if($message){
                echo '<span style="color: red">'.$message.'</span>';
                session()->put('message', null);
            }
            ?>
            <div class="panel-body">

                <div class="position-center">
                @foreach($contact as $cont)
                    <form role="form" action="/update-info/{{$cont->info_id}}" method="post"  enctype="multipart/form-data">
                        @csrf

                    <div class="form-group">
                        <label for="exampleInputPassword1">Thông tin liên hệ</label>
                        <textarea style="resize: none" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự"  rows="8" class="form-control" name="info_contact" id="addcontact" >{{$cont->info_contact}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Bản đồ</label>
                        <textarea style="resize: none"  rows="8" class="form-control" name="info_map" id="exampleInputPassword1">{{$cont->info_map}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh logo</label>
                        <input type="file" name="info_image" class="form-control" id="exampleInputEmail1">
                        <img src="{{url('/public/upload/contact/'.$cont->info_logo)}}" height="100" width="100">
                    </div>
                    <button type="submit" name="add_info" class="btn btn-info">Cập nhật thông tin</button>
                    </form>
                @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
