@extends('layouts.admin_layouts')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Điều Chỉnh Người Sử Dụng
        </header>
        <div class="panel-body">
            <?php
                $message = session()->get('message');
                if($message){
                    echo '<span style="color: red">'.$message.'</span>';
                    session()->put('message', null);
                }
            ?>
            <div class="position-center">
                <form role="form" action="/update_customers/{{ $edit->customer_id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" class="form-control" name="product_id" value="{{ $edit->customer_id }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Email Người Dùng</label>
                        <input type="text" class="form-control" name="customer_email" value="{{ $edit->customer_email }}">
                    </div>
                    <div class="form-group">
                        <label>Tên Người Dùng</label>
                        <input type="text" class="form-control" name="customer_name" value="{{ $edit->customer_name }}">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" name="customer_password" value="{{ $edit->customer_password }}">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="text" class="form-control" name="customer_address" value="{{ $edit->customer_address }}">
                    </div>
                    <div class="form-group">
                        <label>Số Điện Thoại</label>
                        <input type="text" class="form-control" name="customer_phone" value="{{ $edit->customer_phone }}">
                    </div>
                    <button type="submit" class="btn btn-info">Cập Nhật</button>
                </form>
            </div>
        </div>
        </section>
    </div>
</div>
@endsection
