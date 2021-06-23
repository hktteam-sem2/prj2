@extends('layouts.welcome')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="/trang-chu">Home</a></li>
              <li class="active">Giỏ Hàng</li>
            </ol>
        </div>
        @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
        @elseif(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="table-responsive cart_info ">
            <form action="/update-cart-product-qty" method="POST">
            @csrf
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh sản phẩm</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Thành tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                @if(session()->get('cart')==true)
                        @php
                            $total = 0;
                        @endphp
                    @foreach (session()->get('cart') as $key =>$cart )
                         @php
                            $subtotal = $cart['product_price']*$cart['product_qty'];
                            $total+=$subtotal;
                        @endphp
                        <tr>
                            <td class="cart_product">
                                <a href=""><img src="/upload/product/{{ $cart['product_image'] }}" alt="" width="150px"></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href=""></a></h4>
                                <p>{{ $cart['product_name'] }}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{ number_format($cart['product_price'],0,',','.')}} vnđ</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <input style="width: 35px" class="cart_quantity_" type="number" min="1" name="cart_quantity[{{ $cart['session_id'] }}]" value="{{ $cart['product_qty'] }}" autocomplete="off">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    {{ number_format($subtotal,0,',','.') }} vnđ
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="/delete-cart-product/{{ $cart['session_id'] }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td><input type="submit" class="btn btn-warning check_out" value="cập nhật giỏ hàng" name="update_qty"></td>
                        <td><a class="btn btn-default check_out" href="/delete-all-cart">Xóa tất cả sản phẩm</a></td>
                        <td>
                            @if(Session::get('coupon'))
                              <a class="btn btn-default check_out" href="/unset-coupon">Xóa mã khuyến mãi</a>
                            @endif
                        </td>
                        <td >
                            <li>Thành tiền:  <span>{{ number_format($total,0,',','.') }} vnđ</span></li>
                                @if(session()->get('coupon')==true)
                                    <td>
                                        @foreach (session()->get('coupon') as $key => $cou )
                                            @if($cou['coupon_condition']==1)
                                               <li> Mã <span style="color: red">{{ $cou['coupon_code'] }}</span> giảm được: {{ $cou['coupon_number'] }} % </li>
                                                <p>
                                                    @php
                                                        $total_coupon = ($total*$cou['coupon_number'])/100;
                                                        echo '<p><li>Tổng giảm: '.number_format($total_coupon,0,',','.').'vnđ</li></p>';
                                                    @endphp
                                                </p>
                                                <p><li>Thành tiền(Có mã giảm giá): {{ number_format($total-$total_coupon,0,',','.') }}vnđ</li></p>
                                            @elseif($cou['coupon_condition']==2)
                                               <li> Mã <span style="color: red">{{ $cou['coupon_code'] }}</span> giảm được: {{ number_format($cou['coupon_number'],0,',','.')}} vnđ </li>
                                                <p>
                                                    @php
                                                        $total_coupon = $total-$cou['coupon_number'];
                                                        echo '<p><li>Tổng giảm: '.number_format($total_coupon,0,',','.').' vnđ</li></p>';
                                                    @endphp
                                                </p>
                                                <p><li>Thành tiền(Có mã giảm giá): {{ number_format($total_coupon,0,',','.') }} vnđ</li></p>
                                            @endif
                                        @endforeach
                                        {{-- <a class="btn btn-default check_out" href="show_checkout">Đi đến Thanh Toán</a> --}}
                                    </td>
                                @endif
                            </li>
                            <td>
                                <?php
                                    $customer_id = session()->get('customer_id');
                                    $shipping_id = session()->get('shipping_id');

                                        if($customer_id!=Null && $shipping_id==Null){
                                    ?>
                                        <a class="btn btn-default check_out" href="/show_checkout">Đi đến Thanh Toán</a>
                                    <?php
                                        }elseif($customer_id!=Null && $shipping_id!=Null) {
                                    ?>
                                        <a class="btn btn-default check_out" href="/payment">Đi đến Thanh Toán</a>
                                    <?php
                                        }else {
                                    ?>
                                        <a class="btn btn-default check_out" href="/login_checkout">Đi đến Thanh Toán</a>
                                    <?php
                                        }
                                    ?>
                            </td>
                            {{-- <li>Thuế <span>0 vnd</span></li>
                            <li>Phí Vận Chuyển <span>Free</span></li> --}}
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="5">
                        <center>
                        @php
                            echo 'Giỏ hàng của bạn đang trống!!!';
                        @endphp
                        </center>
                        </td>
                    </tr>
                @endif
                </tbody>
            </form>
                @if(session()->get('cart'))
                {{-- @php
                print_r(Session::get('coupon'));
                @endphp --}}
                    <tr>
                        <td>
                            <form method="POST" action="/check-coupon">
                                @csrf
                                <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá (nếu có)">
                                <br>
                                <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Xác nhận">
                            </form>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection
