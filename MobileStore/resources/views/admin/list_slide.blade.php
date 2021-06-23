@extends('layouts.admin_layouts')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh Sách Banner
      </div>
      <div class="row w3-res-tb">
        <div class="col-sm-5 m-b-xs">
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
                echo '<span style="color: red; margin-left:5px">'.$message.'</span>';
                session()->put('message', null);
            }
        ?>
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>#</th>
              <th>Tên Banner</th>
              <th>Hình Ảnh</th>
              <th>Mô Tả</th>
              <th>Tình Trạng</th>

              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($allslide as $all)
                <tr>
                    <td>{{ $all->slider_id }}</td>
                    <td>{{ $all->slider_name }}</td>
                    <td><img src="upload/banner/{{ $all->slider_image }}" height="100px" width="100px"></td>
                    <td>{{ $all->slider_desc }}</td>
                    <td><span class="text-ellipsis">
                        @if($all->slider_status==0)
                            <a href="/unactive_banner/{{ $all->slider_id }}"><span style="font-size: 24px; color: red"  class="fa fa-thumbs-down"></span></a>
                        @else
                            <a href="/active_banner/{{ $all->slider_id }}"><span style="font-size: 24px; color:green"  class="fa fa-thumbs-up"></span></a>
                        @endif
                    </span></td>
                    <td>
                        <a onclick="return confirm('Are you sure to delete ?')" href="/delete_banner/{{ $all->slider_id }}" class="btn btn-default" ui-toggle-class=""><i style="font-size: 25px"  class="fa fa-times text-danger text"></i></a>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        {{-- <form action="/import-banner" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".xlsx"><br>
            <input type="submit" value="Import file Excel" name="import_csv" class="btn btn-warning">
        </form>
        <form action="/export-banner" method="POST">
            @csrf
            <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
        </form> --}}
    </div>
@endsection
