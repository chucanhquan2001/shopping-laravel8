@extends('frontend/layouts/master')
@section('title_url')
    <title> Đăng nhập </title>
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
                            <span>Đăng nhập</span>
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
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="form-border-box">
                            <form method="POST">
                                @csrf
                                <h2 class="normal"><span>ĐĂNG NHẬP</span></h2>
                                @if (Session::has('error'))
                                    <div class="alert alert-danger" role="alert"
                                        style="border-radius:50px;margin-bottom: 40px;">
                                        {{ Session::get('error') }}
                                    </div>
                                @else
                                    <p>Nếu bạn đã đăng kí tài khoản thì hãy đăng nhập thông tin tài khoản của mình để kiểm
                                        tra
                                        đơn hàng và được hỗ trợ tốt nhất từ AnhQuanStore !</p>
                                @endif
                                <div class="form-field-wrapper">
                                    <label>Nhập email của bạn <span class="required">*</span></label>
                                    <input id="author-email" class="input-md form-full-width" name="email"
                                        value="{{ old('email') }}" size="30" aria-required="true" type="text">
                                    @if ($errors->has('email'))
                                        <p style="color:red;font-size: 13px">{{ $errors->first('email') }}</p>
                                    @endif
                                </div>
                                <div class="form-field-wrapper">
                                    <label>Nhập mật khẩu của bạn <span class="required">*</span></label>
                                    <input id="author-pass" class="input-md form-full-width" name="password" size="30"
                                        aria-required="true" type="password">
                                    @if ($errors->has('password'))
                                        <p style="color:red; font-size: 13px">{{ $errors->first('password') }}</p>
                                    @endif
                                </div>
                                <div class="form-field-wrapper">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input name="submit" id="submit" class="submit btn btn-md btn-black"
                                                value="Sign In" type="submit">
                                        </div>
                                        <div class="col-md-6 text-right" style="padding-top:10px">
                                            <a href="#" id="kt_login_forgot">Quên mật khẩu</a> |
                                            <a href="{{ route('register.client') }}" id="kt_login_forgot">Đăng kí</a>
                                        </div>
                                    </div>
                                </div>
                                <label class="custom_checkbox">Remember me
                                    <input type="checkbox" name="remember">
                                    <span class="checkmark"></span>
                                </label>

                            </form>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </section>
        <!-- End Page Content -->

    </div>
    <!-- End Page Content Wraper -->
@endsection
