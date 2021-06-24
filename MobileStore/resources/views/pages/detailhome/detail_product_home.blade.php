@extends('layouts.welcome')
@section('content')

@foreach($detail_product as $detail)
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img src="/upload/product/{{ $detail->product_image }}" alt="" />
                <h3>ZOOM</h3>
            </div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">

                <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                        <a href=""><img src="{{ asset('/frontend/images/similar1.jpg') }}" alt=""></a>
                        <a href=""><img src="{{ asset('/frontend/images/similar1.jpg') }}" alt=""></a>
                        <a href=""><img src="{{ asset('/frontend/images/similar1.jpg') }}" alt=""></a>
                        </div>
                        <div class="item">
                        <a href=""><img src="{{ asset('/frontend/images/similar1.jpg') }}" alt=""></a>
                        <a href=""><img src="{{ asset('/frontend/images/similar1.jpg') }}" alt=""></a>
                        <a href=""><img src="{{ asset('/frontend/images/similar1.jpg') }}" alt=""></a>
                        </div>
                        <div class="item">
                        <a href=""><img src="{{ asset('/frontend/images/similar1.jpg') }}" alt=""></a>
                        <a href=""><img src="{{ asset('/frontend/images/similar1.jpg') }}" alt=""></a>
                        <a href=""><img src="{{ asset('/frontend/images/similar1.jpg') }}" alt=""></a>
                        </div>

                    </div>

                <!-- Controls -->
                <a class="left item-control" href="#similar-product" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right item-control" href="#similar-product" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>

        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="{{ asset('frontend/images/new.jpg') }}" class="newarrival" alt="" />
                <form>
                    @csrf
                    <input type="hidden" value="{{ $detail->product_id }}" class="cart_product_id_{{ $detail->product_id }}">
                    <input type="hidden" value="{{ $detail->product_name }}" class="cart_product_name_{{ $detail->product_id }}">
                    <input type="hidden" value="{{ $detail->product_image }}" class="cart_product_image_{{ $detail->product_id }}">
                    <input type="hidden" value="{{ $detail->product_price }}" class="cart_product_price_{{ $detail->product_id }}">
                    <input type="hidden" value="1" class="cart_product_qty_{{ $detail->product_id }}">
                    <h2>{{ $detail->product_name }}</h2>
                    <p>Mã Sản Phẩm: {{ $detail->product_id }}</p>
                    <img src="images/product-details/rating.png" alt="" />
                    <span>
                        <span>{{ number_format($detail->product_price,0,',','.') }} VND</span>
                        <label>Số lượng:</label>
                        <input name="qty" type="number" min="1" value="1"/>
                        <input name="productid_hidden" type="hidden" value="{{ $detail->product_id }}"/>
                        <button type="button" class="btn btn-default add-to-cart" data-id_product="{{ $detail->product_id }}" >Thêm vào giỏ hàng</button>
                    </span>
                </form>
                <p><b>Tình trạng:</b> còn hàng</p>
                <p><b>Loại sản phẩm: </b>{{ $detail->category_name }}</p>
                <p><b>Thương hiệu: </b>{{ $detail->brand_name }}</p>
                <a href=""><img src="{{ asset('frontend/images/share.png') }}" class="share img-responsive"  alt="" /></a>
            </div><!--/product-information-->
        </div>
    </div><!--/product-details-->
<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li><a href="#details" data-toggle="tab">Mô tả</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Thông số kỹ thuật</a></li>
            <li class="active"><a href="#reviews" data-toggle="tab">Đánh giá </a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade" id="details" >
            <p>{!! $detail->product_desc !!}</p>

        </div>

        <div class="tab-pane fade" id="companyprofile" >
            <p>{!! $detail->product_speci !!}</p>
        </div>

        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <p><b>Write Your Review</b></p>

                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name"/>
                        <input type="email" placeholder="Email Address"/>
                    </span>
                    <textarea name="" ></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div><!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($related_product as $related)
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <form>
                                        @csrf
                                        <input type="hidden" value="{{ $related->product_id }}" class="cart_product_id_{{ $related->product_id }}">
                                        <input type="hidden" value="{{ $related->product_name }}" class="cart_product_name_{{ $related->product_id }}">
                                        <input type="hidden" value="{{ $related->product_image }}" class="cart_product_image_{{ $related->product_id }}">
                                        <input type="hidden" value="{{ $related->product_price }}" class="cart_product_price_{{ $related->product_id }}">
                                        <input type="hidden" value="1" class="cart_product_qty_{{ $related->product_id }}">
                                        <a href="/chi-tiet-san-pham/{{ $related->product_id }}">
                                            <img src="/upload/product/{{ $related->product_image }}" alt="" />
                                            <h2>{{ number_format($related->product_price,0,',','.') }} VND</h2>
                                            <p>{{ $related->product_name }}</p>
                                        </a>
                                        <button type="button" class="btn btn-default add-to-cart" data-id_product="{{ $related->product_id }}" >Thêm vào giỏ hàng</button>
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
            </div>
        </div>
    </div>
</div><!--/recommended_items-->
@endsection
