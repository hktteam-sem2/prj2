@extends('layouts.admin_layouts')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Add New CategoryProducts
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
                <form role="form" action="/postadd_categoryproducts" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Tên Danh Mục</label>
                        <input type="text" class="form-control" name="category_name" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Mô Tả Danh Mục</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="category_desc" placeholder="Mô Tả Danh Mục"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Trạng Thái</label>
                        <select name="category_status" class="form-control input-sm m-bot15">
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
