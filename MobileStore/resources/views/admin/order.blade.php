@extends('layouts.admin_layouts')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Đơn Hàng
      </div>
      <div class="row w3-res-tb">

      </div>
      <div class="table-responsive">
        <?php
            $message = session()->get('message');
            if($message){
                echo '<span style="color: red">'.$message.'</span>';
                session()->put('message', null);
            }
        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>STT</th>
              <th>Mã đơn hàng</th>
              <th>Ngày đặt hàng</th>
              <th>Tình trạng đơn hàng</th>
              <th>Action</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
              @php
                  $i = 0;
              @endphp
            @foreach($order as $ord)
                @php
                    $i++;
                @endphp
                <tr>
                <td>{{ $i }}</td>
                <td>{{ $ord->order_code }}</td>
                <td>{{ $ord->created_at }}</td>
                <td>
                    @if($ord->order_status == 1)
                        Đơn hàng mới
                    @else
                        Đã xử lý
                    @endif
                </td>
                <td>
                    <a href="/order_details/{{ $ord->order_code }}" class="btn btn-default" ui-toggle-class=""><i style="font-size: 25px" class="fa fa-eye text-success text-active"></i></a>
                    <a onclick="return confirm('Are you sure to delete ?')" href="/delete_order/{{ $ord->order_code }}" class="btn btn-default" ui-toggle-class=""><i style="font-size: 25px"  class="fa fa-times text-danger text"></i></a>
                </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection
