@extends('layouts.admin_layouts')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Mã giảm giá Sản Phẩm
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
          <select class="input-sm form-control w-sm inline v-middle">
            <option value="0">Bulk action</option>
            <option value="1">Delete selected</option>
            <option value="2">Bulk edit</option>
            <option value="3">Export</option>
          </select>
          <button class="btn btn-sm btn-default">Apply</button>
        </div>
        <div class="col-sm-4">
        </div>
        <div class="col-sm-3">
          <div class="input-group">
            <input type="text" class="input-sm form-control" placeholder="Search">
            <span class="input-group-btn">
              <button class="btn btn-sm btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
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
              <th>#</th>
              <th>Tên mã giảm giá</th>
              <th>Mã giảm giá</th>
              <th>Số lượng</th>
              <th>Điều kiện giảm giá</th>
              <th>Số giảm</th>
              <th>Ngày bắt đầu</th>
              <th>Ngày kết thúc</th>
          </thead>
          <tbody>
            @foreach($allcoupon as $all)
                <tr>
                <td>{{ $all->coupon_id }}</td>
                <td>{{ $all->coupon_name }}</td>
                <td>{{ $all->coupon_code }}</td>
                <td>{{ $all->coupon_time }}</td>
                <td><span class="text-ellipsis">
                    @if($all->coupon_condition==1)
                        Giảm theo %
                    @else
                        Giảm theo tiền
                    @endif
                </span></td>
                <td><span class="text-ellipsis">
                    @if($all->coupon_condition==1)
                        Giảm {{ $all->coupon_number }} %
                    @else
                    Giảm {{ $all->coupon_number }} tiền
                    @endif
                </span></td>
                <td>{{ $all->coupon_date_start }}</td>
                <td>{{ $all->coupon_date_end }}</td>
                <td>
                    <a onclick="return confirm('Are you sure to delete ?')" href="/delete_coupon/{{ $all->coupon_id }}" class="btn btn-default" ui-toggle-class=""><i style="font-size: 25px"  class="fa fa-times text-danger text"></i></a>
                </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection
