@extends('layouts.admin_layouts')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách Người dùng
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
              <th>ID</th>
              <th>Email</th>
              <th>Tên Người Dùng</th>
              <th>Password</th>
              <th>Địa chỉ</th>
              <th>Số điện thoại</th>
              <th>Action</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($alluser as $all)
                <tr>
                <td>{{ $all->customer_id }}</td>
                <td>{{ $all->customer_email }}</td>
                <td>{{ $all->customer_name }}</td>
                <td>{{ $all->customer_password }}</td>
                <td>{{ $all->customer_address }}</td>
                <td>{{ $all->customer_phone }}</td>
                <td>
                    <a href="/edit_customers/{{ $all->customer_id }}" class="btn btn-default" ui-toggle-class=""><i style="font-size: 25px" class="fa fa-pencil-square-o text-success text-active"></i></a>
                    <a onclick="return confirm('Are you sure to delete ?')" href="/delete_customers/{{ $all->customer_id }}" class="btn btn-default" ui-toggle-class=""><i style="font-size: 25px"  class="fa fa-times text-danger text"></i></a>
                </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection
