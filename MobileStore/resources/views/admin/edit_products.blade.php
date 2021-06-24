@extends('layouts.admin_layouts')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            Điều Chỉnh Sản Phẩm
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
                <form role="form" action="/update_products/{{ $edit->product_id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Mã Sản Phẩm</label>
                        <input type="text" class="form-control" name="product_id" value="{{ $edit->product_id }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Tên Sản Phẩm</label>
                        <input type="text" class="form-control" name="product_name" value="{{ $edit->product_name }}">
                    </div>
                    <div class="form-group">
                        <label>Giá Sản Phẩm</label>
                        <input type="text" class="form-control" name="product_price" value="{{ $edit->product_price }}">
                    </div>
                    <div class="form-group">
                        <label>Số lượng</label>
                        <input type="text" class="form-control" name="product_quantity" value="{{ $edit->product_quantity }}">
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh Sản Phẩm</label>
                        <input type="file" class="form-control" name="product_image">
                        <img src="/upload/product/{{ $edit->product_image }}" height="100px" width="100px">
                    </div>
                    <div class="form-group">
                        <label>Mô Tả</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="product_desc">{{ $edit->product_desc }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Thông số kỹ thuật</label>
                        <textarea style="resize: none" rows="5" class="form-control" name="product_speci">{{ $edit->product_speci }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Danh Mục Sản Phẩm</label>
                        <select name="category" class="form-control input-sm m-bot15">
                            @foreach($category as $cate)
                                @if($cate->category_id == $edit->category_id)
                                <option selected value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                @else
                                <option value="{{ $cate->category_id }}">{{ $cate->category_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Thương Hiệu Sản Phẩm</label>
                        <select name="brand" class="form-control input-sm m-bot15">
                            @foreach($brand as $bra)
                                @if($bra->brand_id == $edit->brand_id)
                                <option selected value="{{ $bra->brand_id }}">{{ $bra->brand_name }}</option>
                                @else
                                <option value="{{ $bra->brand_id }}">{{ $bra->brand_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info">Cập Nhật</button>
                </form>
            </div>
        </div>
        </section>
    </div>
</div>
@endsection
