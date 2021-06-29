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
                                {{-- <button type="button" class="btn btn-default add-to-cart" data-id_product="{{ $cateid->product_id }}" >Thêm vào giỏ hàng</button> --}}
                                <style type="text/css">
                                    .xemnhanh {
                                       background: #F5F5ED;
                                       border: 0 none;
                                       border-radius: 0;
                                       color: #696763;
                                       font-family: 'Roboto', sans-serif;
                                       font-size: 15px;
                                       margin-bottom: 25px;
                                   }
                                </style>
                               <input type="button" value="Thêm giỏ hàng" class="btn btn-default add-to-cart" data-id_product="{{$cateid->product_id}}" name="add-to-cart">


                               <input type="button" data-toggle="modal" data-target="#xemnhanh"  value="Xem nhanh" class="btn btn-default xemnhanh" data-id_product="{{$cateid->product_id}}" name="add-to-cart">
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
           <!-- Modal xem nhanh-->
           <div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"  role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title product_quickview_title" id="">

                            <span id="product_quickview_title"></span>

                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <style type="text/css">
                            span#product_quickview_content img {
                                width: 100%;
                            }

                            @media screen and (min-width: 768px) {
                                .modal-dialog {
                                width: 700px; /* New width for default modal */
                                }
                                .modal-sm {
                                width: 350px; /* New width for small modal */
                                }
                            }

                            @media screen and (min-width: 992px) {
                                .modal-lg {
                                width: 1200px; /* New width for large modal */
                                }
                            }
                        </style>
                        <div class="row">
                            <div class="col-md-5">
                                <span id="product_quickview_image"></span>
                                <span id="product_quickview_gallery"></span>
                            </div>
                            <form>
                                @csrf
                                <div id="product_quickview_value"></div>
                                <div class="col-md-7">
                                    <h2><span id="product_quickview_title"></span></h2>
                                    <p>Mã ID: <span id="product_quickview_id"></span></p>
                                    <p style="font-size: 20px; color: brown;font-weight: bold;">Giá sản phẩm : <span id="product_quickview_price"></span></p>

                                        <label>Số lượng:</label>

                                        <input name="qty" type="number" min="1" class="cart_product_qty_"  value="1" />

                                    </span>
                                    <h4 style="font-size: 20px; color: brown;font-weight: bold;">Mô tả sản phẩm</h4>
                                    <hr>
                                    <p><span id="product_quickview_desc"></span></p>
                                    <div id="product_quickview_button"></div>
                                    <div id="beforesend_quickview"></div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-default redirect-cart">Đi tới giỏ hàng</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
