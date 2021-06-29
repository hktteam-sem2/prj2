@extends('layouts.welcome')
@section('content')

@foreach($detail_product as $detail)
    <div class="product-details"><!--product-details-->
        <style type="text/css">
            .lSSlideOuter .lSPager.lSGallery img {
                display: block;
                height: 140px;
                max-width: 100%;
            }

        }
        </style>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background: none;">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/danh-muc-san-pham/{{ $category_id }}">{{$category_name}}</a></li>
                <li class="breadcrumb-item"><a href="/thuong-hieu-san-pham/{{ $brand_id }}">{{$brand_name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$product_name}}</li>
            </ol>
          </nav>
        <div class="col-sm-5">
            <ul id="imageGallery">
                @foreach($gallery as $gal)
                  <li data-thumb="{{asset('upload/gallery/'.$gal->gallery_image)}}" data-src="{{asset('upload/gallery/'.$gal->gallery_image)}}">
                    <img width="100%" alt="{{$gal->gallery_name}}" src="{{asset('upload/gallery/'.$gal->gallery_image)}}" />
                  </li>
                 @endforeach
            </ul>

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
            @foreach ($specifi as $spec)

            <div class="col-md-6 col-lg-6 col-sm-12">
                <table class="table table-bordered">
                    <tr>
                        <th>Màn hình:</th><td>{{$spec->speci_screen}}</td>
                    </tr>
                    <tr>
                        <th>Hệ điều hành:</th><td>{{$spec->speci_os}}</td>
                    </tr>
                    <tr>
                        <th>Camera trước:</th><td>{{$spec->speci_frontcam}}</td>
                    </tr>
                    <tr>
                        <th>Camera sau:</th><td>{{$spec->speci_backcam}}</td>
                    </tr>
                    <tr>
                        <th>Chipset:</th><td>{{$spec->speci_chip}}</td>
                    </tr>
                    <tr>
                        <th>Ram</th><td>{{$spec->speci_ram}}</td>
                    </tr>
                    <tr>
                        <th>Bộ nhớ trong</th><td>{{$spec->speci_memory}}</td>
                    </tr>
                    <tr>
                        <th>Sim</th><td>{{$spec->speci_sim}}</td>
                    </tr>
                    <tr>
                        <th>Pin , Sạc</th><td>{{$spec->speci_battery}}</td>
                    </tr>
                </table>
            </div>
            @endforeach
        </div>

        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>Admin</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>28.06.2021</a></li>
                </ul>
                <style type="text/css">
                    .style_comment {
                        border: 1px solid #ddd;
                        border-radius: 10px;
                        background: #F0F0E9;
                    }
                </style>
                <form>
                     @csrf
                    <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$detail->product_id}}">
                     <div id="comment_show"></div>

                </form>

                <p><b>Viết đánh giá của bạn</b></p>

                 <!------Rating here---------->
                            <ul class="list-inline rating"  title="Average Rating">
                                @for($count=1; $count<=5; $count++)
                                    @php
                                        if($count<=$rating){
                                            $color = 'color:#ffcc00;';
                                        }
                                        else {
                                            $color = 'color:#ccc;';
                                        }

                                    @endphp

                                <li title="star_rating" id="{{$detail->product_id}}-{{$count}}" data-index="{{$count}}"  data-product_id="{{$detail->product_id}}" data-rating="{{$rating}}" class="rating" style="cursor:pointer; {{$color}} font-size:30px;">&#9733;</li>
                                @endfor

                            </ul>
                <form action="#">
                    @if(Session::get('customer_id')!=null)
                    @php
                        $tendangnhap = Session::get('customer_name');

                    @endphp
                    <input type="hidden" value="1" class="check_dangnhap">
                    @else
                    @php
                    $tendangnhap = '';

                    @endphp
                    <input type="hidden" value="0" class="check_dangnhap">
                    @endif
                    <span>
                        <input style="width:100%;margin-left: 0" type="text" class="comment_name" readonly value="{{ $tendangnhap }}" placeholder="Tên bình luận"/>

                    </span>
                    <textarea name="comment" class="comment_content" placeholder="Nội dung bình luận"></textarea>
                    <div id="notify_comment"></div>

                    <button type="button" class="btn btn-default pull-right send-comment">
                        Gửi bình luận
                    </button>

                </form>
            </div>
        </div>
    </div>
</div><!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <br>
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
