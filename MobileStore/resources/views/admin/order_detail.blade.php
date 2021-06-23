@extends('layouts.admin_layouts')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Tài Khoản Khách Hàng
      </div>
      <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Email Khách Hàng</th>
                    <th>Tên Khách Hàng</th>
                    <th>Số điện thoại Khách Hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $customer->customer_id }}</td>
                        <td>{{ $customer->customer_email }}</td>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->customer_phone }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin vận chuyển
      </div>
      <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Họ và tên người nhận hàng</th>
                    <th>Số điện thoại liên lạc</th>
                    <th>Địa chỉ người nhận hàng</th>
                    <th>Ghi chú</th>
                    <th>Hình thức thanh toán</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $shipping->shipping_id }}</td>
                        <td>{{ $shipping->shipping_name }}</td>
                        <td>{{ $shipping->shipping_phone }}</td>
                        <td>{{ $shipping->shipping_address }}</td>
                        <td>{{ $shipping->shipping_notes }}</td>
                        <td>
                            @if($shipping->shipping_method==0)
                                Chuyển khoản
                            @else
                                Tiền mặt
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Chi tiết đơn hàng
      </div>
      <div class="table-responsive">

            <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Số lượng sản phẩm</th>
                <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    $total = 0;
                @endphp
                @foreach ($order_details as $key => $details)
                    @php
                        $i++;
                        $subtotal = $details->product_price*$details->product_sales_quantity;
                        $total+=$subtotal;
                    @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $details->order_code }}</td>
                        <td>{{ $details->product_id }}</td>
                        <td>{{ $details->product_name }}</td>
                        <td>{{ number_format($details->product_price,0,',','.') }} vnđ</td>
                        <td>{{ $details->product_sales_quantity }}</td>
                        <td>{{ number_format($subtotal,0,',','.')}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td>
                        @if($details->product_coupon!='No')
                           Mã giảm giá : {{ $details->product_coupon }}
                        @else
                           Mã giảm giá : Không có !
                        @endif
                    </td>
                    <td>
                        @php
                            $total_coupon = 0;
                        @endphp
                        @if($coupon_condition==1)
                            @php
                                $total_after_coupon = ($total*$coupon_number)/100;
                                echo 'Tổng giảm được: ' . number_format($total_after_coupon,0,',','.') . 'vnđ';
                                $total_coupon = $total - $total_after_coupon;
                            @endphp
                        @elseif($coupon_condition==2)
                            @php
                                echo 'Tổng giảm được: ' . number_format($coupon_number,0,',','.') .' '. 'vnđ';
                                $total_coupon = $total - $coupon_number;
                            @endphp
                        @endif
                    </td>
                    <td colspan="2"> Tổng tiền cần thanh toán :
                        {{ number_format($total_coupon,0,',','.')}} vnđ
                    </td>
                </tr>
            </tbody>
            </table>
            <a target="_blank" href="/print_order/{{ $details->order_code }}">In đơn hàng</a>
        </div>
    </div>
</div>
@endsection
