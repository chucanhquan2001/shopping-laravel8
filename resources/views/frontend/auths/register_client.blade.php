@extends('frontend/layouts/master')
@section('title_url')
    <title> Đăng kí tài khoản </title>
@endsection
@section('main')
    <!-- Page Content Wraper -->
    <div class="page-content-wraper">
        <!-- Bread Crumb -->
        <section class="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="breadcrumb-link">
                            <a href="#">Trang chủ</a>
                            <span>Đăng kí</span>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bread Crumb -->

        <!-- Page Content -->
        <section class="content-page">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-border-box">
                            <form method="POST">
                                @csrf
                                <h2 class="normal"><span>ĐĂNG KÍ</span></h2>
                                @if (Session::has('error'))
                                    <div class="alert alert-danger" role="alert"
                                        style="border-radius:50px;margin-bottom: 40px;">
                                        {{ Session::get('error') }}
                                    </div>
                                @else
                                    <p>Đăng kí tài khoản mới để kiểm
                                        tra
                                        đơn hàng và được hỗ trợ tốt nhất từ AnhQuanStore !</p>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-field-wrapper">
                                            <label>Họ và tên <span class="required">*</span></label>
                                            <input id="author-pass"
                                                class="input-md form-full-width @error('name') is-invalid @enderror"
                                                name="name" size="30" aria-required="true" type="text"
                                                value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <p style="color:red; font-size: 13px">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-field-wrapper">
                                            <label>Nhập email của bạn <span class="required">*</span></label>
                                            <input id="author-email"
                                                class="input-md form-full-width @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" size="30" aria-required="true"
                                                type="text">
                                            @if ($errors->has('email'))
                                                <p style="color:red;font-size: 13px">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-field-wrapper">
                                            <label>Nhập mật khẩu của bạn <span class="required">*</span></label>
                                            <input id="author-pass"
                                                class="input-md form-full-width @error('password') is-invalid @enderror"
                                                name="password" size="30" aria-required="true" type="password">
                                            @if ($errors->has('password'))
                                                <p style="color:red; font-size: 13px">{{ $errors->first('password') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-field-wrapper">
                                            <label>Xác nhận mật khẩu của bạn <span class="required">*</span></label>
                                            <input id="author-pass"
                                                class="input-md form-full-width @error('password_confirmation') is-invalid @enderror"
                                                name="password_confirmation" size="30" aria-required="true" type="password">
                                            @if ($errors->has('password_confirmation'))
                                                <p style="color:red; font-size: 13px">
                                                    {{ $errors->first('password_confirmation') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-field-wrapper">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input name="submit" id="submit" class="submit btn btn-md btn-black"
                                                value="Register" type="submit">
                                        </div>
                                        <div class="col-md-6 text-right" style="padding-top:10px">
                                            <a href="{{ route('login.client') }}" id="kt_login_forgot">Đã có tài khoản
                                                ?</a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Page Content -->

    </div>
    <!-- End Page Content Wraper -->
@endsection
