@extends('layouts.admin_layouts')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Thương Hiệu Sản Phẩm
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
              <th>Tên Thương Hiệu</th>
              <th>Trạng Thái</th>
              <th>Action</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($allbrand as $all)
                <tr>
                <td>{{ $all->brand_id }}</td>
                <td>{{ $all->brand_name }}</td>
                <td><span class="text-ellipsis">
                    @if($all->brand_status==0)
                        <a href="/unactive_brandproducts/{{ $all->brand_id }}"><span style="font-size: 24px; color: red"  class="fa fa-thumbs-down"></span></a>
                    @else
                        <a href="/active_brandproducts/{{ $all->brand_id }}"><span style="font-size: 24px; color:green"  class="fa fa-thumbs-up"></span></a>
                    @endif
                </span></td>
                <td>
                    <a href="/edit_brandproducts/{{ $all->brand_id }}" class="btn btn-default" ui-toggle-class=""><i style="font-size: 25px" class="fa fa-pencil-square-o text-success text-active"></i></a>
                    <a onclick="return confirm('Are you sure to delete ?')" href="/delete_brandproducts/{{ $all->brand_id }}" class="btn btn-default" ui-toggle-class=""><i style="font-size: 25px"  class="fa fa-times text-danger text"></i></a>
                </td>
                </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection
