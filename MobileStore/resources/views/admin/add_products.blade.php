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
                        <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Làm ơn điền ít nhất 3 ký tự" class="form-control" name="product_name">
                    </div>
                    <div class="form-group">
                        <label>Giá Sản Phẩm</label>
                        <input type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền số tiền" class="form-control" name="product_price">
                    </div>
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input type="text" data-validation="number" data-validation-error-msg="Làm ơn điền số lượng" class="form-control" name="product_quantity">
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh Sản Phẩm</label>
                        <input type="file" class="form-control" name="product_image">
                    </div>
                    <div class="form-group">
                        <label>Mô Tả</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="product_desc" id="product_desc" placeholder="Desc Product"></textarea>
                    </div>
                    <label>Thông số kỹ thuật</label><br>
                    <div class="form-group">
                        <label>Màn hình: </label>
                        <input type="text" class="form-control" name="screen">
                    </div>
                    <div class="form-group">
                        <label>Hệ điều hành: </label>
                        <input type="text" class="form-control" name="os">
                    <div class="form-group">
                        <label>Camera trước: </label>
                        <input type="text" class="form-control" name="front_camera">
                    <div class="form-group">
                        <label>Camera sau: </label>
                        <input type="text" class="form-control" name="back_camera">
                    <div class="form-group">
                        <label>Chipset: </label>
                        <input type="text" class="form-control" name="chip">
                    <div class="form-group">
                        <label>Ram: </label>
                        <input type="text" class="form-control" name="ram">
                    </div>
                    <div class="form-group">
                        <label>Bộ nhớ: </label>
                        <input type="text" class="form-control" name="memory">
                    </div>
                    <div class="form-group">
                        <label>Sim: </label>
                        <input type="text" class="form-control" name="sim">
                    </div>
                    <div class="form-group">
                        <label>Pin: </label>
                        <input type="text" class="form-control" name="battery_charge">
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
                    <div class="form-group">
                        <input type="hidden" name="created_at">
                    </div>

                    <button type="submit" class="btn btn-info">Thêm</button>
                </form>
            </div>
        </div>
        </section>
    </div>
</div>
@endsection
