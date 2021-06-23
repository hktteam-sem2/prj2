@extends('layouts.welcome')
@section('content')
    <section style="margin-top: 10px" id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Đăng Nhập</h2>
                        <form action="/login_customer" method="POST">
                            @csrf
                            <input type="text" name="customer_email" placeholder="Email" />
                            <input type="password" name="customer_password" placeholder="Password" />
                            <span>
                                <input type="checkbox" class="checkbox">
                                Nhớ đăng nhập
                            </span>
                            <button type="submit" class="btn btn-default">Đăng nhập</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">Hoặc</h2>
                </div>
                <div class="col-sm-4">
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                    <div class="signup-form"><!--sign up form-->
                        <h2>Đăng ký</h2>
                        <form action="/add_customer" method="POST">
                            @csrf
                            <input type="text" name="customer_email" placeholder="Nhập Email"/>
                            <input type="text" name="customer_name" placeholder="Nhập Họ và Tên"/>
                            <input type="password" name="customer_password" placeholder="Nhập Mật khẩu"/>
                            <input type="text" name="customer_address" placeholder="Nhập địa chỉ"/>
                            <input type="text" name="customer_phone" placeholder="Nhập Số điện thoại"/>
                            <button type="submit" class="btn btn-default">Đăng ký</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection
