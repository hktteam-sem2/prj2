@extends('layouts.welcome')
@section('content')
<div class="features_items"><!--features_items-->
    @foreach($category_by_name as  $name)
        <h2 class="title text-center">{{ $name->category_name }}</h2>
    @endforeach

    @foreach($category_by_id as $cateid)

            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{ $cateid->product_id }}" class="cart_product_id_{{ $cateid->product_id }}">
                                    <input type="hidden" value="{{ $cateid->product_name }}" class="cart_product_name_{{ $cateid->product_id }}">
                                    <input type="hidden" value="{{ $cateid->product_image }}" class="cart_product_image_{{ $cateid->product_id }}">
                                    <input type="hidden" value="{{ $cateid->product_price }}" class="cart_product_price_{{ $cateid->product_id }}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{ $cateid->product_id }}">
                                    <a href="/chi-tiet-san-pham/{{ $cateid->product_id }}">
                                        <img src="/upload/product/{{ $cateid->product_image }}" alt="" />
                                        <h2>{{ number_format($cateid->product_price,0,',','.') }} VND</h2>
                                        <p>{{ $cateid->product_name }}</p>
                                    </a>
                                <button type="button" class="btn btn-default add-to-cart" data-id_product="{{ $cateid->product_id }}" >Thêm vào giỏ hàng</button>
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
