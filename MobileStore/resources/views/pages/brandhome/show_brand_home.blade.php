@extends('layouts.welcome')
@section('content')
<div class="features_items"><!--features_items-->
    @foreach($brand_by_name as $name)
        <h2 class="title text-center">{{ $name->brand_name }}</h2>
    @endforeach

    @foreach($brand_by_id as $brandid)

            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{ $brandid->product_id }}" class="cart_product_id_{{ $brandid->product_id }}">
                                    <input type="hidden" value="{{ $brandid->product_name }}" class="cart_product_name_{{ $brandid->product_id }}">
                                    <input type="hidden" value="{{ $brandid->product_image }}" class="cart_product_image_{{ $brandid->product_id }}">
                                    <input type="hidden" value="{{ $brandid->product_price }}" class="cart_product_price_{{ $brandid->product_id }}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{ $brandid->product_id }}">
                                    <a href="/chi-tiet-san-pham/{{ $brandid->product_id }}">
                                        <img src="/upload/product/{{ $brandid->product_image }}" alt="" />
                                        <h2>{{ number_format($brandid->product_price,0,',','.') }} VND</h2>
                                        <p>{{ $brandid->product_name }}</p>
                                    </a>
                                    <button type="button" class="btn btn-default add-to-cart" data-id_product="{{ $brandid->product_id }}" >Thêm vào giỏ hàng</button>
                                </form>
                            </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Yêu Thích</a></li>
                        </ul>
                    </div>
                </div>
            </div>

    @endforeach

</div><!--features_items-->
@endsection
