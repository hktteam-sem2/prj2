
<!DOCTYPE html>
<head>
<title>Admin Dasboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<meta name="csrf-token" content="{{csrf_token()}}">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{ asset('backend/css/style.css') }}" rel='stylesheet' type='text/css' />
<link href="{{ asset('backend/css/style-responsive.css') }}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{ asset('backend/css/font.css') }}" type="text/css"/>
<link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('backend/css/morris.css') }}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{ asset('backend/css/monthly.css') }}">
<!-- //calendar -->
<!-- datatable -->
<link rel="stylesheet" href="{{ asset('backend/css/jquery.dataTables.min.css') }}" type="text/css"/>
<!-- //datatable -->
<link rel="stylesheet" href="{{ asset('backend/css/jquery-ui.css') }}">
{{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
<link rel="stylesheet" href="{{ asset('backend/css/morris.css') }}">
{{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> --}}
<!-- //font-awesome icons -->
<script src="{{ asset('backend/js/jquery2.0.3.min.js') }}"></script>
<script src="{{ asset('backend/js/raphael-min.js') }}"></script>
<script src="{{ asset('backend/js/morris.js') }}"></script>
<script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>

</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        HKT-Admin
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{ asset('backend/images/2.png') }}">
                <span class="username">
                    <?php
                    if(Session::get('login_normal')){

                        $name = Session::get('admin_name');
                    }else{
                        $name = Auth::user()->admin_name;
                    }

                    if($name){
                        echo $name;
                    }
                    ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Prolife</a></li>
                <li><a href="#"><i class="fa fa-cog"></i>C??i ?????t</a></li>
                <li><a href="/logout-auth"><i class="fa fa-key"></i>????ng xu???t</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->

    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="/dashboard">
                        <i class="fa fa-dashboard"></i>
                        <span>T???ng Quan</span>
                    </a>
                </li>
                @hasrole(['admin','author'])
                <li>
                    <a href="/information">
                        <i class="fa fa-dashboard"></i>
                        <span>Th??ng tin website</span>
                    </a>
                </li>
                <li>
                    <a class="active" href="/all_customer">
                        <i class="fa fa-user"></i>
                        <span>Qu???n l?? Kh??ch h??ng</span>
                    </a>
                </li>
                @endhasrole
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>????n h??ng</span>
                    </a>
                    <ul class="sub">
						<li><a href="/order">Qu???n l?? ????n h??ng</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>M?? gi???m gi??</span>
                    </a>
                    <ul class="sub">
						<li><a href="/add_coupon">Th??m m?? gi???m gi??</a></li>
						<li><a href="/all_coupon">Li???t k?? m?? gi???m gi??</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh m???c s???n ph???m</span>
                    </a>
                    <ul class="sub">
						<li><a href="/add_categoryproducts">Th??m m???i danh m???c</a></li>
						<li><a href="/all_categoryproducts">Li???t k?? danh m???c</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Th????ng hi???u s???n ph???m</span>
                    </a>
                    <ul class="sub">
						<li><a href="/add_brandproducts">Th??m m???i th????ng hi???u</a></li>
						<li><a href="/all_brandproducts">Danh s??ch th????ng hi???u</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>S???n ph???m</span>
                    </a>
                    <ul class="sub">
						<li><a href="/add_products">Th??m m???i s???n ph???m</a></li>
						<li><a href="/all_products">Li???t k?? s???n ph???m</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Banner</span>
                    </a>
                    <ul class="sub">
						<li><a href="/add_banner">Th??m m???i banner</a></li>
						<li><a href="/all_banner">Li???t k?? banner</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>B??nh lu???n</span>
                    </a>
                    <ul class="sub">
                        <li><a href="/comment">Li???t k?? b??nh lu???n</a></li>
                    </ul>
                </li>
                @hasrole(['admin'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-users')}}">Th??m user</a></li>
                        <li><a href="{{URL::to('/users')}}">Li???t k?? user</a></li>
                    </ul>
                </li>
                @endhasrole
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
        @yield('admin_content')
    </section>
 <!-- footer -->
		  {{-- <div class="footer">
			<div class="wthree-copyright">
			  <p>?? 2021 HKT-Admin</p>
			</div>
		  </div> --}}
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{ asset('backend/js/bootstrap.js') }}"></script>
<script src="{{ asset('backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
<script src="{{ asset('backend/js/scripts.js') }}"></script>
<script src="{{ asset('backend/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('backend/js/jquery.nicescroll.js') }}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{ asset('backend/js/jquery.scrollTo.js') }}"></script>
<!-- morris JavaScript -->

{{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
<script src="{{ asset('backend/js/jquery-ui.js') }}"></script>
<script src="{{ asset('backend/js/morris.js') }}"></script>
<script src="{{ asset('backend/js/raphael-min.js') }}"></script>
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> --}}
<script src="{{asset('backend/ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace('addcontact');
    CKEDITOR.replace('product_desc');
    CKEDITOR.replace('editdesc');
</script>

<!--Xu ly duyet binh luan-->
<script type="text/javascript">
    $('.comment_duyet_btn').click(function(){
        var comment_status = $(this).data('comment_status');

        var comment_id = $(this).data('comment_id');
        var comment_product_id = $(this).attr('id');
        if(comment_status==0){
            var alert = 'Thay ?????i th??nh duy???t th??nh c??ng';
        }else{
            var alert = 'Thay ?????i th??nh kh??ng duy???t th??nh c??ng';
        }
          $.ajax({
                url:"{{url('/allow-comment')}}",
                method:"POST",

                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{comment_status:comment_status,comment_id:comment_id,comment_product_id:comment_product_id},
                success:function(data){
                    location.reload();
                   $('#notify_comment').html('<span class="text text-alert">'+alert+'</span>');

                }
            });


    });
    $('.btn-reply-comment').click(function(){
        var comment_id = $(this).data('comment_id');

        var comment = $('.reply_comment_'+comment_id).val();



        var comment_product_id = $(this).data('product_id');


        // alert(comment);
        // alert(comment_id);
        // alert(comment_product_id);

          $.ajax({
                url:"{{url('/reply-comment')}}",
                method:"POST",

                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{comment:comment,comment_id:comment_id,comment_product_id:comment_product_id},
                success:function(data){
                    $('.reply_comment_'+comment_id).val('');

                   $('#notify_comment').html('<span class="text text-alert">Tr??? l???i b??nh lu???n th??nh c??ng</span>');
                   location.reload();

                }
            });


    });
</script>
<!--End xu ly duyet binh luan-->
<!-- datepicker ma giam gia -->
<script>
    $( function() {
      $( "#start_coupon" ).datepicker({
        prevText: "Th??ng tr?????c",
        nextText: "Th??ng sau",
        dateFormat: "dd/mm/yy",
        dayNamesMin: ["Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7" , "Ch??? nh???t"],
        duration: "slow"
      });
      $( "#end_coupon" ).datepicker({
        prevText: "Th??ng tr?????c",
        nextText: "Th??ng sau",
        dateFormat: "dd/mm/yy",
        dayNamesMin: ["Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7" , "Ch??? nh???t"],
        duration: "slow"
      });
    } );
</script>
<!--  end datepicker ma giam gia -->

<!-- xu ly Gallery -->
<script type="text/javascript">
    $(document).ready(function(){
        load_gallery();

        function load_gallery(){
            var pro_id = $('.pro_id').val();
            var _token = $('input[name="_token"]').val();
            // alert(pro_id);
            $.ajax({
                url:"{{url('/select-gallery')}}",
                method:"POST",
                data:{pro_id:pro_id,_token:_token},
                success:function(data){
                    $('#gallery_load').html(data);
                }
            });
        }
        //thong bao loi cho the span error
        $('#file').change(function(){
            var error = '';
            var files = $('#file')[0].files;//[0] la file anh dau tien

            if(files.length>5){
                error+='<p>B???n ch???n t???i ??a ch??? ???????c 5 ???nh</p>';
            }else if(files.length==''){
                error+='<p>B???n kh??ng ???????c b??? tr???ng ???nh</p>';
            }else if(files.size > 2000000){
                error+='<p>File ???nh kh??ng ???????c l???n h??n 2MB</p>';
            }

            if(error==''){

            }else{
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                return false;
            }

        });
        // Thay doi ten cua hinh anh
        $(document).on('blur','.edit_gal_name',function(){
            var gal_id = $(this).data('gal_id');
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/update-gallery-name')}}",
                method:"POST",
                data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
                success:function(data){
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">C???p nh???t t??n h??nh ???nh th??nh c??ng</span>');
                }
            });
        });
        // X??a h??nh ???nh
        $(document).on('click','.delete-gallery',function(){
            var gal_id = $(this).data('gal_id');

            var _token = $('input[name="_token"]').val();
            if(confirm('B???n mu???n x??a h??nh ???nh n??y kh??ng?')){
                $.ajax({
                    url:"{{url('/delete-gallery')}}",
                    method:"POST",
                    data:{gal_id:gal_id,_token:_token},
                    success:function(data){
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">X??a h??nh ???nh th??nh c??ng</span>');
                    }
                });
            }
        });
        //Thay doi hinh anh
        $(document).on('change','.file_image',function(){

            var gal_id = $(this).data('gal_id');
            var image = document.getElementById("file-"+gal_id).files[0];

            var form_data = new FormData();

            form_data.append("file", document.getElementById("file-"+gal_id).files[0]);
            form_data.append("gal_id",gal_id);
            $.ajax({
                url:"{{url('/update-gallery')}}",
                method:"POST",
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:form_data,
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">C???p nh???t h??nh ???nh th??nh c??ng</span>');
                }
            });
        });
    });
</script>
<!-- End xu ly Gallery -->

<!-- Morris Bar -->
<script>
    $(document).ready(function(){
        chart30daysorder();

        var chart = new Morris.Bar({
            element: 'myfirstchart',
            lineColors: ['#819C79' , '#fc8710' , '#FF6541' , '#A4ADD3' , '#766856'],
            pointFillColors: ['#ffffff'],
            pointStrokeColors: ['black'],
            fillOpacity: 0.6,
            hideHover: 'auto',
            parseTime: false,
            xkey: 'period',
            ykeys: ['order' , 'sales' , 'profit' , 'quantity'],
            behaveLikeLine: true,
            labels: ['????n h??ng' , 'doanh s???' , 'l???i nhu???n' ,'s??? l?????ng']
        });


        function chart30daysorder(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ url('/days-order') }}",
                method: "POST",
                dataType: "JSON",
                data:{
                    _token:_token
                },

                success:function(data){
                    chart.setData(data);
                }
            });
        }

        $('#btn-dashboard-filter').click(function(){
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();
            $.ajax({
                url: "{{url('/filter-by-date')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    from_date:from_date,
                    to_date:to_date,
                    _token:_token
                },
                success:function(data){
                    chart.setData(data);
                }
            });
        });

        $('.dashboard-filter').change(function(){
            var dashboard_value = $(this).val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/dashboard-filter')}}",
                method: "POST",
                dataType: "JSON",
                data: {
                    dashboard_value:dashboard_value,
                    _token:_token
                },
                success:function(data){
                    chart.setData(data);
                }
            });
        });
    });
</script>
<!-- End Morris Bar -->

<!-- Morris donut -->
<script>
    $(document).ready(function(){
       var donut =  Morris.Donut({
        element: 'donut',
        resize: true,
        colors: [
            '#a8328e',
            // '#33CC00',
            '#61a1ce',
            '#ce8f61'
        ],
        //labelColor:"#cccccc", // text color
        //backgroundColor: '#333333', // border color
        data: [
            {label:"S???n Ph???m", value:{{ $products }}},
            // {label:"S???n Ph???m xem nhi???u", value:{{ $product_views }}},
            {label:"????n H??ng", value:{{ $orders}}},
            {label:"Kh??ch H??ng", value:{{ $customers }}},
        ]
        });
    });
</script>
<!-- End Morris donut -->

<!-- datepicker -->
<script>
    $( function() {
      $( "#datepicker" ).datepicker({
        prevText: "Th??ng tr?????c",
        nextText: "Th??ng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7" , "Ch??? nh???t"],
        duration: "slow"
      });
      $( "#datepicker2" ).datepicker({
        prevText: "Th??ng tr?????c",
        nextText: "Th??ng sau",
        dateFormat: "yy-mm-dd",
        dayNamesMin: ["Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7" , "Ch??? nh???t"],
        duration: "slow"
      });
    } );
</script>
<!--  end datepicker -->


<!-- datatable -->
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
<!--  End datatable -->

<!-- quan ly so luong ban ton -->

    <!-- xu ly nut cap nhat  -->
    <script>
        $('.update_quantity_order').click(function(){
            var order_product_id = $(this).data('product_id');
            var order_qty = $('.order_qty_'+order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();
            // alert(order_product_id);
            // alert(order_qty);
            // alert(order_code);
            $.ajax({
                url : '{{url('/update-qty')}}',
                method: 'POST',
                data:{_token:_token, order_product_id:order_product_id ,order_qty:order_qty ,order_code:order_code},
                // dataType:"JSON",
                success:function(data){
                    alert('C???p nh???t s??? l?????ng th??nh c??ng');
                    location.reload();
                }
            });
        });
    </script>
    <!--End xu ly nut cap nhat  -->
<script>
    $('.order_details').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();
        //lay ra so luong
        quantity = [];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j =0;
        for(i=0;i<order_product_id.length;i++){
            //so luong khach dat
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            //so luong ton kho
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j + 1;
                if(j==1){
                    alert('S??? l?????ng b??n trong kho kh??ng ?????');
                }
                $('.color_qty_'+order_product_id[i]).css('background','#6e6975');
            }
        }
        if(j==0){
            $.ajax({
                url : '{{url('/update-order-qty')}}',
                    method: 'POST',
                    data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                    success:function(data){
                        alert('Thay ?????i t??nh tr???ng ????n h??ng th??nh c??ng');
                        location.reload();
                    }
            });
        }
    });
</script>
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });

	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}

		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},

			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});


	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{ asset('backend/js/monthly.js') }}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',

			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
