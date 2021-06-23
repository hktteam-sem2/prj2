@extends('layouts.welcome')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Sản phẩm mới nhất</h2>
    @foreach($all_product as $allpro)

            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{ $allpro->product_id }}" class="cart_product_id_{{ $allpro->product_id }}">
                                    <input type="hidden" value="{{ $allpro->product_name }}" class="cart_product_name_{{ $allpro->product_id }}">
                                    <input type="hidden" value="{{ $allpro->product_image }}" class="cart_product_image_{{ $allpro->product_id }}">
                                    <input type="hidden" value="{{ $allpro->product_price }}" class="cart_product_price_{{ $allpro->product_id }}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{ $allpro->product_id }}">
                                    <a href="/chi-tiet-san-pham/{{ $allpro->product_id }}">
                                        <img src="/upload/product/{{ $allpro->product_image }}" alt="" />
                                        <h2>{{ number_format($allpro->product_price,0,',','.') }} VND</h2>
                                        <p>{{ $allpro->product_name }}</p>
                                    </a>
                                    <button type="button" class="btn btn-default add-to-cart" data-id_product="{{ $allpro->product_id }}" name="add-to-cart">Thêm vào giỏ hàng</button>
                                </form>
                            </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-star"></i>Yêu Thích</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                        </ul>
                    </div>
                </div>
            </div>
    @endforeach

</div><!--features_items-->
@endsection
