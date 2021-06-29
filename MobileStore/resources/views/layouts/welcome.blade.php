<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/lightslider.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/prettify.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('frontend/images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('frontend/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('frontend/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('frontend/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/images/ico/apple-touch-icon-57-precomposed.png') }}">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->

		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="frontend/images/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-star"></i>Yêu Thích</a></li>
                                <?php
                                    $customer_id = session()->get('customer_id');
                                    $shipping_id = session()->get('shipping_id');

                                    if($customer_id!=Null && $shipping_id==Null){
                                ?>
                                    <li><a href="/show_checkout"><i class="fa fa-crosshairs"></i>Thanh Toán</a></li>
                                <?php
                                    }elseif($customer_id!=Null && $shipping_id!=Null) {
                                ?>
                                    <li><a href="/payment"><i class="fa fa-crosshairs"></i>Thanh Toán</a></li>
                                <?php
                                    }else {
                                ?>
                                    <li><a href="/login_checkout"><i class="fa fa-crosshairs"></i>Thanh Toán</a></li>
                                <?php
                                    }
                                ?>

								<li><a href="/gio-hang"><i class="fa fa-shopping-cart"></i>Giỏ Hàng</a></li>
                                <li><a href="/login_checkout"><i class="fa fa-lock"></i>Đăng Ký</a></li>
                                <?php
                                    $customer_id = session()->get('customer_id');

                                    if($customer_id==Null){
                                ?>
                                    <li><a href="/login_checkout"><i class="fa fa-lock"></i>Đăng Nhập</a></li>

                                <?php
                                    }else {
                                ?>
                                    <li><a href="/logout_checkout"><i class="fa fa-lock"></i>Đăng Xuất</a></li>
                                <?php
                                    }
                                ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-7">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="/trang-chu" class="active">Trang Chủ</a></li>
                                <li class="dropdown"><a href="#">Danh Mục<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($category as $cate)
                                        <li><a href="/danh-muc-san-pham/{{ $cate->category_id }}">{{ $cate->category_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#">Thương Hiệu<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach($brand as $br)
                                        <li><a href="/thuong-hieu-san-pham/{{ $br->brand_id }}">{{ $br->brand_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>

                                </li>
								<li><a href="/lien-he">Liên Hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-5">
						<form action="/tim-kiem" autocomplete="off" method="POST">
                            @csrf
                            <div class="search_box">
                                <input type="text" style="width: 100%" name="keywords_submit" id="keywords" placeholder="Tìm kiếm sản phẩm"/>
                                <div id="search_ajax"></div>
                                <input type="submit" style="margin-top:0;color:#666" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm">
                            </div>
                        </form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->

	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>

						<div class="carousel-inner">
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($slider as $ban)
                            @php
                                $i++;
                            @endphp
                            <div class="item {{$i == 1 ? 'active' : '' }}">

                            <div class="col-sm-12">
                                <img alt="{{$ban->slider_desc}}" src="{{asset('/upload/banner/'.$ban->slider_image)}}" width="100%" class="img img-responsive">
                            </div>
                        </div>
                        @endforeach

						</div>

						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>

				</div>
			</div>
		</div>
	</section><!--/slider-->

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh Mục Sản Phẩm</h2>
						<div class="panel-group category-products" id="accordian">
                            @foreach($category as $cate)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="/danh-muc-san-pham/{{ $cate->category_id }}">{{ $cate->category_name }}</a></h4>
                                    </div>
                                </div>
                            @endforeach

						</div><!--/category-products-->

						<div class="brands_products"><!--brands_products-->
							<h2>Thương Hiệu Sản Phẩm</h2>
                            @foreach($brand as $br)
                                <div class="brands-name">
                                    <ul class="nav nav-pills nav-stacked">
                                        <li><a href="/thuong-hieu-san-pham/{{ $br->brand_id }}"> <span class="pull-right"></span>{{ $br->brand_name }}</a></li>
                                    </ul>
                                </div>
                            @endforeach

						</div><!--/brands_products-->

					</div>
				</div>

				<div class="col-sm-9 padding-right">
                    @yield('content')
				</div>
			</div>
		</div>
	</section>

	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ asset('frontend/images/iframe1.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ asset('frontend/images/iframe2.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ asset('frontend/images/iframe3.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="{{ asset('frontend/images/iframe4.png') }}" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="{{ asset('frontend/images/map.png') }}" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Online Help</a></li>
								<li><a href="#">Contact Us</a></li>
								<li><a href="#">Order Status</a></li>
								<li><a href="#">Change Location</a></li>
								<li><a href="#">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privecy Policy</a></li>
								<li><a href="#">Refund Policy</a></li>
								<li><a href="#">Billing System</a></li>
								<li><a href="#">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->



    <script src="{{ asset('frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ asset('frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('frontend/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('frontend/js/lightslider.js') }}"></script>
    <script src="{{ asset('frontend/js/prettify.js') }}"></script>
<!--Danh gia sao-->
<script type="text/javascript">
    function remove_background(product_id)
     {
      for(var count = 1; count <= 5; count++)
      {
       $('#'+product_id+'-'+count).css('color', '#ccc');
      }
    }
    //hover chuột đánh giá sao
   $(document).on('mouseenter', '.rating', function(){
      var index = $(this).data("index");
      var product_id = $(this).data('product_id');
    // alert(index);
    // alert(product_id);
      remove_background(product_id);
      for(var count = 1; count<=index; count++)
      {
       $('#'+product_id+'-'+count).css('color', '#ffcc00');
      }
    });
   //nhả chuột ko đánh giá
   $(document).on('mouseleave', '.rating', function(){
      var index = $(this).data("index");
      var product_id = $(this).data('product_id');
      var rating = $(this).data("rating");
      remove_background(product_id);
      //alert(rating);
      for(var count = 1; count<=rating; count++)
      {
       $('#'+product_id+'-'+count).css('color', '#ffcc00');
      }
     });

    //click đánh giá sao
    $(document).on('click', '.rating', function(){
          var index = $(this).data("index");
          var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();
          $.ajax({
           url:"{{url('insert-rating')}}",
           method:"POST",
           data:{index:index, product_id:product_id,_token:_token},
           success:function(data)
           {
            if(data == 'done')
            {
             alert("Bạn đã đánh giá "+index +" trên 5");
            }
            else
            {
             alert("Lỗi đánh giá");
            }
           }
    });

    });
</script>
<!--End danh gia sao-->
<!--Comment-->
<script type="text/javascript">
    $(document).ready(function(){

        load_comment();

        function load_comment(){
            var product_id = $('.comment_product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{url('/load-comment')}}",
              method:"POST",
              data:{product_id:product_id, _token:_token},
              success:function(data){

                $('#comment_show').html(data);
              }
            });
        }
        $('.send-comment').click(function(){
            var product_id = $('.comment_product_id').val();
            var comment_name = $('.comment_name').val();
            var comment_content = $('.comment_content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
              url:"{{url('/send-comment')}}",
              method:"POST",
              data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content, _token:_token},
              success:function(data){

                $('#notify_comment').html('<span class="text text-success">Thêm bình luận thành công, bình luận đang chờ duyệt</span>');
                load_comment();
                $('#notify_comment').fadeOut(9000);
                $('.comment_name').val('');
                $('.comment_content').val('');
              }
            });
        });
    });
</script>
<!-- End comment-->
 <!--add to  cart quickview-->
 <script type="text/javascript">

    $(document).on('click','.add-to-cart-quickview',function(){

        var id = $(this).data('id_product');
        var cart_product_id = $('.cart_product_id_' + id).val();
        var cart_product_name = $('.cart_product_name_' + id).val();
        var cart_product_image = $('.cart_product_image_' + id).val();
        var cart_product_quantity = $('.cart_product_quantity_' + id).val();
        var cart_product_price = $('.cart_product_price_' + id).val();
        var cart_product_qty = $('.cart_product_qty_' + id).val();
        var _token = $('input[name="_token"]').val();

        if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
            alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
        }else{

            $.ajax({
                url: '{{url('/add-cart-ajax')}}',
                method: 'POST',
                data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                beforeSend: function(){
                    $("#beforesend_quickview").html("<p class='text text-primary'>Đang thêm sản phẩm vào giỏ hàng</p>");
                },
                success:function(){
                    $("#beforesend_quickview").html("<p class='text text-success'>Sản phẩm đã thêm vào giỏ hàng</p>");


                }

            });
        }


    });
    $(document).on('click','.redirect-cart',function(){
        window.location.href = "{{url('/gio-hang')}}";
    });

</script>
<!-- End add to  cart quickview-->
<!--QuickView-->
<script type="text/javascript">

    $('.xemnhanh').click(function(){
        var product_id = $(this).data('id_product');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{url('/quickview')}}",
            method:"POST",
            dataType:"JSON",
            data:{product_id:product_id, _token:_token},
            success:function(data){
                $('#product_quickview_title').html(data.product_name);
                $('#product_quickview_id').html(data.product_id);
                $('#product_quickview_price').html(data.product_price);
                $('#product_quickview_image').html(data.product_image);
                $('#product_quickview_gallery').html(data.product_gallery);
                $('#product_quickview_desc').html(data.product_desc);
                $('#product_quickview_value').html(data.product_quickview_value);
                $('#product_quickview_button').html(data.product_button);
            }
        });
    });

</script>
<!--End QuickView-->
<!--AutoComplete-->
<script type="text/javascript">
    $('#keywords').keyup(function(){
        var query = $(this).val();

          if(query != '')
            {
             var _token = $('input[name="_token"]').val();

             $.ajax({
              url:"{{url('/autocomplete-ajax')}}",
              method:"POST",
              data:{query:query, _token:_token},
              success:function(data){
               $('#search_ajax').fadeIn();
                $('#search_ajax').html(data);
              }
             });

            }else{

                $('#search_ajax').fadeOut();
            }
    });

    $(document).on('click', '.li_search_ajax', function(){
        $('#keywords').val($(this).text());
        $('#search_ajax').fadeOut();
    });
</script>
<!--End Autocomplete-->
    <!--/Xu ly gallery -->
    <script type="text/javascript">
        $(document).ready(function() {
           $('#imageGallery').lightSlider({

               gallery:true,
               item:1,
               loop:true,
               thumbItem:3,
               slideMargin:0,
               enableDrag: false,
               currentPagerPosition:'left',
               onSliderLoad: function(el) {
                   el.lightGallery({
                       selector: '#imageGallery .lslide'
                   });
               }

           });
         });
   </script>
   <!--End /Xu ly gallery -->

    <!--/Script phần xác nhận đặt hàng trong trang show_checkout -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                    title: "Xác Nhận Đơn Hàng",
                    text: "Bạn có muốn mua đơn hàng này không?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Xác Nhận",
                    cancelButtonText: "Hủy",
                    closeOnConfirm: false,
                    closeOnCancel: false
                    },
                    function(isConfirm){
                        if(isConfirm){
                            var shipping_name = $('.shipping_name').val();
                            var shipping_phone =$('.shipping_phone').val();
                            var shipping_address =$('.shipping_address').val();
                            var shipping_notes =$('.shipping_notes').val();
                            var shipping_method =$('.payment_select').val();
                            var order_coupon =$('.order_coupon').val();
                            var _token = $('input[name="_token"]').val();

                            $.ajax({
                                url: '{{url('/confirm-order')}}',
                                method: 'POST',
                                data:
                                {
                                    shipping_name:shipping_name,
                                    shipping_phone:shipping_phone,
                                    shipping_address:shipping_address,
                                    shipping_notes:shipping_notes,
                                    shipping_method:shipping_method,
                                    order_coupon:order_coupon,
                                    _token:_token
                                },
                                success:function(data){
                                    swal("Xác Nhận Đơn Hàng Thành Công!", "Cảm ơn bạn đã mua hàng.Chúng tôi sẽ liên lạc với bạn để nhanh chóng giao hàng.", "success");
                                }
                            });
                            window.setTimeout(function(){
                                location.reload();
                            }, 3000);
                        }else{
                            swal("Xác Nhận Đơn Hàng Thất bại!", "Mong lần sau bạn sẽ mua hàng :( ", "error");
                        }

                });
            });
        });


</script>

    <!--/Script phần giỏ hàng -->
    <script type="text/javascript">

            $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_'+ id).val();
                var cart_product_name =$('.cart_product_name_'+ id).val();
                var cart_product_image =$('.cart_product_image_'+ id).val();
                var cart_product_price =$('.cart_product_price_'+ id).val();
                var cart_product_qty =$('.cart_product_qty_'+ id).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:
                    {
                        cart_product_id:cart_product_id,
                        cart_product_name:cart_product_name,
                        cart_product_image:cart_product_image,
                        cart_product_price:cart_product_price,
                        cart_product_qty:cart_product_qty,
                        _token:_token
                    },
                    success:function(data){
                        swal({
                            title: "Đã thêm sản phẩm vào giỏ hàng",
                            text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để thanh toán",
                            showCancelButton: true,
                            cancelButtonText: "Xem Tiếp",
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Đi đến giỏ hàng",
                            closeOnConfirm: false
                        },
                        function(){
                            window.location.href = "/gio-hang";
                        });
                    }
                });
            });

    </script>
</body>
</html>
