@extends('layouts.admin_layouts')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Điều Chỉnh Danh Mục Sản Phẩm
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
                <form role="form" action="/update_categoryproducts/{{ $edit->category_id }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Mã Danh Mục</label>
                        <input type="text" class="form-control" name="category_id" value="{{ $edit->category_id }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Tên Danh Mục</label>
                        <input type="text" class="form-control" name="category_name" value="{{ $edit->category_name }}">
                    </div>
                    <div class="form-group">
                        <label>Mô Tả</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="category_desc" >{{ $edit->category_desc }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-info">Cập Nhật</button>
                </form>
            </div>
        </div>
        </section>
    </div>
</div>
@endsection
