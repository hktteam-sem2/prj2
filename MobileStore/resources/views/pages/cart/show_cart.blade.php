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
        <div class="table-responsive cart_info col-sm-12">
            <?php
                $content = Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh sản phẩm</td>
                        <td class="description">Mô tả</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                     @foreach($content as $contentvalue)


                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="/upload/product/{{ $contentvalue->options->image }}" alt="" width="150px"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{ $contentvalue->name }}</a></h4>
                            <br>
                            <p>Mã sản phẩm: {{ $contentvalue->id }}</p>
                        </td>
                        <td class="cart_price">
                            <p>{{ number_format($contentvalue->price) }} Vnđ</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="/update_cart_quantity" method="POST">
                                    @csrf
                                    <input style="width: 50px" class="cart_quantity_input" type="number" min="1" name="cart_quantity" value="{{ $contentvalue->qty }}" autocomplete="off">
                                    <input type="hidden" value="{{ $contentvalue->rowId }}"  name="rowId_cart" class="from-control">
                                    <input type="submit" class="btn btn-warning btn-sm" value="cập nhật" name="update_qty">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                <?php
                                    $subtotal = $contentvalue->price * $contentvalue->qty;
                                    echo number_format($subtotal).' '.'VND';
                                ?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="/delete_to_cart/{{ $contentvalue->rowId }} "><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                     @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
<section id="do_action">
    <div class="container" >
            <div class="col-sm-6">
                <div class="total_area">
                    <?php
                        $message = session()->get('message');
                        if($message){
                            echo '<span style="color: red">'.$message.'</span>';
                            session()->put('message', null);
                        }
                    ?>
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
                    <ul>
                        <li>Tổng <span>{{ Cart::subtotal(0) }} Vnd</span></li>
                        <li>Thuế <span>0 vnd</span></li>
                        <li>Phí Vận Chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{ Cart::subtotal(0) }} Vnd</span></li>
                        <li>Thành tiền(có mã giảm giá) <span>{{ Cart::subtotal(0) }} Vnd</span></li>
                    </ul>
                        {{-- <a class="btn btn-default update" href="">Update</a> --}}
                    <?php
                        $customer_id = session()->get('customer_id');
                        if($customer_id == null){
                    ?>
                        <a class="btn btn-default check_out" href="/login_checkout">Thanh Toán</a>

                    <?php
                        }else {
                    ?>
                        <a class="btn btn-default check_out" href="/show_checkout">Thanh Toán</a>
                    <?php
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

@endsection
