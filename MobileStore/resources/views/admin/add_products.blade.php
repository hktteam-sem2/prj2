@extends('layouts.admin_layouts')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Thêm Mới Sản Phẩm
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
                <form role="form" action="/postadd_products" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Tên Sản Phẩm</label>
                        <input type="text" class="form-control" name="product_name">
                    </div>
                    <div class="form-group">
                        <label>Giá Sản Phẩm</label>
                        <input type="text" class="form-control" name="product_price">
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh Sản Phẩm</label>
                        <input type="file" class="form-control" name="product_image">
                    </div>
                    <div class="form-group">
                        <label>Mô Tả</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="product_desc" placeholder="Desc Product"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="product_content" placeholder="Content Product"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Danh Mục Sản Phẩm</label>
                        <select name="category" class="form-control input-sm m-bot15">
                            @foreach($category as $cate)
                                <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Thương Hiệu Sản Phẩm</label>
                        <select name="brand" class="form-control input-sm m-bot15">
                            @foreach($brand as $bra)
                                <option value="{{ $bra->brand_id }}">{{ $bra->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trạng Thái</label>
                        <select name="product_status" class="form-control input-sm m-bot15">
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
