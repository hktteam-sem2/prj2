@extends('layouts.admin_layouts')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm mới Thương Hiệu Sản Phẩm
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
                <form role="form" action="/postadd_brandproducts" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Tên Thương Hiệu</label>
                        <input type="text" class="form-control" name="brand_name" >
                    </div>
                    <div class="form-group">
                        <label>Mô Tả</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="brand_desc" placeholder="Desc Brand"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Active</label>
                        <select name="brand_status" class="form-control input-sm m-bot15">
                            <option value="0">Off</option>
                            <option value="1">On</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Thêm</button>
                </form>
            </div>
        </div>
        </section>
    </div>
</div>
@endsection
