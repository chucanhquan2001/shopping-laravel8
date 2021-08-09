@extends('frontend.layouts.master')
@section('title_url')
    <title> Thanh toán </title>
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
                            <span>Thanh toán</span>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bread Crumb -->

        <!-- Page Content -->
        <section class="content-page">
            <div class="container mb-80">
                <div class="row">
                    <div class="col-sm-12">
                        <article class="post-8">
                            <p class="checkout-info">
                                Have a coupon? <strong><a href="#">Click here to enter your code</a></strong>
                            </p>
                            <form class="product-checkout mt-45" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Chi tiết hóa đơn</h3>
                                        <div class="row">
                                            <div class="form-field-wrapper form-center col-sm-6">
                                                <label for="billing_first_name" class="left">
                                                    Họ và tên
                                                    <abbr class="form-required" title="required">*</abbr></label>
                                                <input class="input-md form-full-width" name="name" type="text"
                                                    aria-required="true" value="{{ old('name') }}">
                                                @if ($errors->has('name'))
                                                    <p style="color:red">{{ $errors->first('name') }}</p>
                                                @endif
                                            </div>
                                            <div class="form-field-wrapper form-center col-sm-6">
                                                <label for="billing_last_name" class="left">
                                                    Điện thoại liên hệ
                                                    <abbr class="form-required" title="required">*</abbr></label>
                                                <input class="input-md form-full-width" name="phone" type="text"
                                                    aria-required="true" value="{{ old('phone') }}">
                                                @if ($errors->has('phone'))
                                                    <p style="color:red">{{ $errors->first('phone') }}</p>
                                                @endif
                                            </div>
                                            <div class="form-field-wrapper form-center col-sm-12">
                                                <label for="billing_company" class="left">Email *</label>
                                                <input class="input-md form-full-width" name="email" type="text"
                                                    value="{{ old('email') }}">
                                                @if ($errors->has('email'))
                                                    <p style="color:red">{{ $errors->first('email') }}</p>
                                                @endif
                                            </div>
                                            <div class="form-field-wrapper form-center col-sm-12">
                                                <label for="billing_company" class="left">Địa chỉ *</label>
                                                <input class="input-md form-full-width" name="address" type="text"
                                                    value="{{ old('address') }}">
                                                @if ($errors->has('address'))
                                                    <p style="color:red">{{ $errors->first('address') }}</p>
                                                @endif
                                            </div>
                                            <div class="form-field-wrapper col-sm-12">
                                                <label>Ghi chú đơn hàng<span class="required">*</span></label>
                                                <textarea id="note" class="form-full-width" name="note" cols="45" rows="8"
                                                    aria-required="true"></textarea>
                                            </div>
                                            @if (!auth()->check())
                                                <div class="form-field-wrapper form-center col-sm-6">
                                                    <label class="custom_checkbox">Thêm tài khoản cho bạn ?
                                                        <input type="checkbox"
                                                            value="{{ config('common.create_account.agree') }}"
                                                            name="create_account">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-order-review">
                                            <h3>Đơn hàng của bạn</h3>
                                            <div class="product-checkout-review-order">
                                                <div class="responsive-table">
                                                    <table class="">
                                                        <thead>
                                                            <tr>
                                                                <th class="product-name">Sản phẩm</th>
                                                                <th class="product-total">Tổng tiền</th>
                                                            </tr>
                                                        </thead>
                                                        @php
                                                            $totalPrice = 0;
                                                        @endphp
                                                        <tbody>
                                                            @foreach (Session::get('cart') as $itemCart)
                                                                @php
                                                                    $totalPrice += ($itemCart['price'] - ($itemCart['price'] * $itemCart['discount']) / 100) * $itemCart['quantity'];
                                                                @endphp
                                                                <tr class="cart_item">
                                                                    <td class="product-name">
                                                                        {{ $itemCart['name'] }}<strong> x
                                                                            {{ $itemCart['quantity'] }}</strong></td>
                                                                    <td class="product-total">
                                                                        <span
                                                                            class="product-price-amount amount">{{ number_format(($itemCart['price'] - ($itemCart['price'] * $itemCart['discount']) / 100) * $itemCart['quantity']) }}
                                                                            Đ</span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="cart-subtotal">
                                                                <th>Dự kiến</th>
                                                                <td>
                                                                    <strong><span
                                                                            class="product-price-amount amount">{{ number_format($totalPrice) }}
                                                                            Đ</span></strong>
                                                                </td>
                                                            </tr>
                                                            <tr class="shipping">
                                                                <th>Phí vận chuyển</th>
                                                                <td>
                                                                    Miễn phí vận chuyển toàn quốc !
                                                                </td>
                                                            </tr>
                                                            <tr class="order-total">
                                                                <th>TỔNG TIỀN</th>
                                                                <td>
                                                                    <span
                                                                        class="product-price-amount amount">{{ number_format($totalPrice) }}
                                                                        Đ</span>
                                                                </td>
                                                            </tr>
                                                            <input type="text" name="total_price"
                                                                value="{{ $totalPrice }}" hidden>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                                <div class="product-checkout-payment">
                                                    <ul>
                                                        <li>

                                                        </li>
                                                    </ul>
                                                    <div class="place-order">

                                                        <input name="submit" id="submit"
                                                            class="submit btn btn-lg btn-color form-full-width"
                                                            value="ĐẶT HÀNG" type="submit">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Page Content -->

    </div>
@endsection
