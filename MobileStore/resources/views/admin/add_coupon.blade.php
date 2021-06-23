@extends('layouts.admin_layouts')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm Mã giảm giá
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
                <form role="form" action="/postadd_coupon" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Tên mã giảm giá</label>
                        <input type="text" class="form-control" name="coupon_name" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Mã giảm giá</label>
                        <input type="text" class="form-control" name="coupon_code" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input type="text" class="form-control" name="coupon_time" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Tính năng</label>
                        <select name="coupon_condition" class="form-control input-sm m-bot15">
                            <option value="0">----Chọn tính năng----</option>
                            <option value="1">Giảm theo %</option>
                            <option value="2">Giảm theo tiền</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Giảm theo % hoặc giảm theo tiền</label>
                        <input type="text" class="form-control" name="coupon_number" placeholder="Enter email">
                    </div>
                    <button type="submit" class="btn btn-info">Thêm</button>
                </form>
            </div>
        </div>
        </section>
    </div>
</div>
@endsection
