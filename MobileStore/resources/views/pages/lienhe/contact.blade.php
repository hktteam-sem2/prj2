@extends('layouts.welcome')
@section('content')

<div class="features_items"><!--features_items-->
    <br>
    <h2 class="title text-center">Liên hệ với chúng tôi</h2>
    <div class="row">
        @foreach($contact as $cont)
        <div class="col-md-12">
            {!!$cont->info_contact!!}
            {{-- <p>
                <i class="fa fa-windows"></i>BÁN &amp; SỬA CHỮA ĐIỆN THOẠI HKT MOBILE STORE<br>
                <i class="fa fa-home"></i>Địa chỉ : 590 Cách Mạng Tháng 8, Phường 11 - Quận 3 - Tp.Hồ Chí Minh<br>
                <i class="fa fa-mobile"></i>Hotiline: 0909797979<br>
                <i class="fa fa-envelope"></i>Email : hkt.store@gmail.com<br>
                <i class="fa fa-wifi"></i>Website:  hktmobilestore.com.vn<br><span style="color: #C3191F;">
            </p> --}}
        </div>
        <div class="col-md-12">
            <h4>Bản đồ</h4>
            {!!$cont->info_map!!}
            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d322.29125712149516!2d106.66608790428816!3d10.786752443972862!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ed2392c44df%3A0xd2ecb62e0d050fe9!2sFPT-Aptech%20Computer%20Education%20HCM!5e0!3m2!1svi!2s!4v1624518494319!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe> --}}
        </div>
    </div>
    @endforeach


</div><!--features_items-->
@endsection
