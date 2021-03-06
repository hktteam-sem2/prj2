@extends('layouts.admin_layouts')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Danh sách Sản Phẩm
      </div>
      <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
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
                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Thư viện ảnh</th>
                        <th>Giá sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Hình ảnh sản phẩm</th>
                        <th>Thông số kỹ thuật</th>
                        <th>Danh mục sản phẩm</th>
                        <th>Thương hiệu sản phẩm</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                        <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allproduct as $all)
                        <tr>
                        <td>{{ $all->product_id }}</td>
                        <td>{{ $all->product_name }}</td>
                        <td><a href="/add-gallery/{{$all->product_id}}">Hiển thị</a></td>
                        <td>{{ $all->product_price }}</td>
                        <td>{{ $all->product_quantity }}</td>
                        <td><img src="upload/product/{{ $all->product_image }}" height="100px" width="100px"></td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#myModal{{$all->product_id}}">Hiển thị</a>
                            <!-- Modal -->
                            <div id="myModal{{$all->product_id}}" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Thông số kỹ thuật</h4>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>Màn hình:</th><td>{{$all->speci_screen}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Hệ điều hành:</th><td>{{$all->speci_os}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Camera trước:</th><td>{{$all->speci_frontcam}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Camera sau:</th><td>{{$all->speci_backcam}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Chipset:</th><td>{{$all->speci_chip}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Ram</th><td>{{$all->speci_ram}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Bộ nhớ trong</th><td>{{$all->speci_memory}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Sim</th><td>{{$all->speci_sim}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Pin , Sạc</th><td>{{$all->speci_battery}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $all->category_name }}</td>
                        <td>{{ $all->brand_name }}</td>
                        <td><span class="text-ellipsis">
                            @if($all->product_status==0)
                                <a href="/unactive_products/{{ $all->product_id }}"><span style="font-size: 18px; color: red"  class="fa fa-thumbs-down"></span></a>
                            @else
                                <a href="/active_products/{{ $all->product_id }}"><span style="font-size: 18px; color:green"  class="fa fa-thumbs-up"></span></a>
                            @endif
                        </span></td>
                        <td>
                            <a href="/edit_products/{{ $all->product_id }}" class="btn btn-default" ui-toggle-class=""><i style="font-size: 25px" class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a onclick="return confirm('Are you sure to delete ?')" href="/delete_products/{{ $all->product_id }}" class="btn btn-default" ui-toggle-class=""><i style="font-size: 25px"  class="fa fa-times text-danger text"></i></a>
                        </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                <form action="/export-product" method="POST">
                    @csrf
                    <input type="submit" value="Report" name="export_csv" class="btn btn-success">
                </form>
          </div>
      </div>
    </div>
</div>




@endsection
