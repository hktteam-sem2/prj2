@extends('layouts.admin_layouts')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Điều Chỉnh Thương Hiệu Sản Phẩm
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
                <form role="form" action="/update_brandproducts/{{ $edit->brand_id }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Mã Thương Hiệu</label>
                        <input type="text" class="form-control" name="brand_id" value="{{ $edit->brand_id }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Tên Thương Hiệu</label>
                        <input type="text" class="form-control" name="brand_name" value="{{ $edit->brand_name }}">
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="brand_desc" >{{ $edit->brand_desc }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-info">Cập nhật</button>
                </form>
            </div>
        </div>
        </section>
    </div>
</div>
@endsection
