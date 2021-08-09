@extends('frontend/layouts/master')
@section('title_url')
    <title> Thanh toán thành công </title>
@endsection
@section('main')
    <div class="page-content-wraper">
        <!-- Bread Crumb -->
        <section class="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="breadcrumb-link">
                            <a href="#">Trang chủ</a>
                            <span>Đặt hàng thành công</span>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 40px">
                    <p style="font-size:26px;font-weight:bold;">Cảm ơn bạn đã mua hàng !</p>
                    <p>Bạn sẽ nhận được email xác nhận đơn hàng ! Mọi thắc mắc vui lòng liên hệ 0853009301 để được hỗ trợ !
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-lg btn-color">Tiếp tục mua sắm</a>
                </div>
            </div>
        </div>
    </div>
@endsection
