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
                <th>Số lượng tồn kho</th>
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
                    <tr class="color_qty_{{$details->product_id}}">
                        <td>{{ $i }}</td>
                        <td>{{ $details->order_code }}</td>
                        <td>{{ $details->product_id }}</td>
                        <td>{{ $details->product_name }}</td>
                        <td>{{ number_format($details->product_price,0,',','.') }} vnđ</td>
                        <td>{{ $details->product->product_quantity }}</td>
                        <td>
                            <input type="number" min="1" {{$order_status==2 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">

                            <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">{{--So luong kho co--}}

                            <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">

                            <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
                            @if($order_status!=2)
                            <button class="btn btn-default update_quantity_order" data-product_id="{{$details->product_id}}"name="update_quantity_order">Cập nhật</button>
                            @endif
                        </td>

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
                <tr>
                    <td colspan="2">
                        @foreach($order as $key => $or)
                            @if($or->order_status==1)
                                <form action="">
                                    @csrf
                                    <select class="form-control order_details">
                                        <option value="">----Chọn hình thức đơn hàng-----</option>
                                        <option id="{{$or->order_id}}" selected value="1">Chưa xử lý</option>
                                        <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                                        <option id="{{$or->order_id}}" value="3">Hủy đơn hàng-Tạm giữ</option>
                                    </select>
                                </form>
                            @elseif ($or->order_status==2)
                                <form action="">
                                    @csrf
                                    <select class="form-control order_details">
                                        <option value="">----Chọn hình thức đơn hàng-----</option>
                                        <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                                        <option id="{{$or->order_id}}" selected value="2">Đã xử lý-Đã giao hàng</option>
                                        <option id="{{$or->order_id}}" value="3">Hủy đơn hàng-Tạm giữ</option>
                                    </select>
                                </form>
                            @else
                            <form action="">
                                @csrf
                                <select class="form-control order_details">
                                    <option value="">----Chọn hình thức đơn hàng-----</option>
                                    <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
                                    <option id="{{$or->order_id}}" value="2">Đã xử lý-Đã giao hàng</option>
                                    <option id="{{$or->order_id}}" selected value="3">Hủy đơn hàng-Tạm giữ</option>
                                </select>
                            </form>
                            @endif
                        @endforeach

                    </td>
                </tr>
            </tbody>
            </table>
            <a target="_blank" href="/print_order/{{ $details->order_code }}">In đơn hàng</a>
        </div>
    </div>
</div>
@endsection
