@extends('frontend/layouts/master')
@section('title_url')
    <title> Đơn hàng </title>
@endsection
@section('main')
    <div class="page-content-wraper">
        <!-- Bread Crumb -->
        <section class="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="breadcrumb-link">
                            <a href="{{ route('home') }}">Trang chủ</a>
                            <span>Đơn hàng của bạn</span>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bread Crumb -->
        <section class="content-page">
            <div class="container">
                <div class="row">
                    @if ($invoices->count() > 0)
                        <div class="col-md-3">
                            <form class="invoice-status" action="" role="form">
                                <label for="product-show">Trạng thái đơn hàng</label>
                                <select name="status" id="status" class="nice-select-box">
                                    <option value="all" {{ request()->status == 'all' ? 'selected' : '' }}>Hiển thị tất
                                        cả</option>
                                    <option value="{{ config('common.invoice.status.cho_xac_nhan') }}"
                                        {{ request()->status == config('common.invoice.status.cho_xac_nhan') ? 'selected' : '' }}>
                                        Chờ xác nhận</option>
                                    <option value="{{ config('common.invoice.status.cho_lay_hang') }}"
                                        {{ request()->status == config('common.invoice.status.cho_lay_hang') ? 'selected' : '' }}>
                                        Chờ lấy hàng</option>
                                    <option value="{{ config('common.invoice.status.dang_giao') }}"
                                        {{ request()->status == config('common.invoice.status.dang_giao') ? 'selected' : '' }}>
                                        Đang giao</option>
                                    <option value="{{ config('common.invoice.status.da_giao') }}"
                                        {{ request()->status == config('common.invoice.status.da_giao') ? 'selected' : '' }}>
                                        Đã giao</option>
                                    <option value="{{ config('common.invoice.status.da_huy') }}"
                                        {{ request()->status == config('common.invoice.status.da_huy') ? 'selected' : '' }}>
                                        Đã hủy</option>

                                </select>
                            </form>
                        </div>
                        <div class="col-md-9">
                            @foreach ($invoices as $itemInvoice)
                                <div class="row" style="background-color: rgb(247 247 247); margin-bottom: 50px">
                                    <div class="col-md-8">
                                        <p>Mã đơn hàng: <span
                                                style="font-weight: bold;">{{ $itemInvoice->invoice_nr }}</span></p>
                                        <p>Địa chỉ nhận hàng: <span
                                                style="font-weight: bold;">{{ $itemInvoice->address }}</span></p>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <p style="color: red; font-size: 16px;">

                                            @if ($itemInvoice->status == config('common.invoice.status.cho_xac_nhan'))
                                                Chờ xác nhận
                                            @elseif($itemInvoice->status ==
                                                config('common.invoice.status.cho_lay_hang'))
                                                Chờ lấy hàng
                                            @elseif($itemInvoice->status ==
                                                config('common.invoice.status.dang_giao'))
                                                Đang giao
                                            @elseif($itemInvoice->status == config('common.invoice.status.da_giao'))
                                                Đã giao
                                            @elseif($itemInvoice->status == config('common.invoice.status.da_huy'))
                                                Đã hủy
                                            @endif
                                        </p>
                                    </div>
                                    @foreach ($itemInvoice->getInvoices as $itemInvoiceDetail)
                                        <div class="col-md-2"
                                            style="border-top: 1px solid #fff;padding-top: 5px; padding-bottom: 5px">
                                            <img src="{{ $itemInvoiceDetail->getProductVariant->image }}" alt="">
                                        </div>
                                        <div class="col-md-6"
                                            style="border-top: 1px solid #fff;padding-top: 5px; padding-bottom: 5px">
                                            <p>{{ $itemInvoiceDetail->getProductVariant->getProduct->name }}</p>
                                            <p>Màu sắc: <span>{{ $itemInvoiceDetail->color }}</span></p>
                                            <p>x <span
                                                    style="font-weight: bold;">{{ $itemInvoiceDetail->quantity }}</span>
                                            </p>
                                        </div>
                                        <div class="col-md-4 text-right"
                                            style="border-top: 1px solid #fff;padding-top: 5px; padding-bottom: 5px">
                                            <p style="font-size: 18px">
                                                {{ number_format($itemInvoiceDetail->unit_price) }} Đ
                                            </p>
                                        </div>

                                    @endforeach
                                    <div class="col-md-6">
                                        @if ($itemInvoice->status == config('common.invoice.status.cho_xac_nhan'))
                                            <br>
                                            <a href="{{ route('cancelOrder', $itemInvoice->id) }}" style="color: red"
                                                onclick="return confirm('Bạn chắc chắn muốn hủy đơn hàng này ?')">Hủy đơn
                                                hàng</a>
                                        @endif
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <p>Tổng tiền hóa đơn:
                                            <span style="font-size: 22px">{{ number_format($itemInvoice->total_price) }}
                                                Đ</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="col-md-3">
                            <form class="invoice-status" action="" role="form">
                                <label for="product-show">Trạng thái đơn hàng</label>
                                <select name="status" id="status" class="nice-select-box">
                                    <option value="all" {{ request()->status == 'all' ? 'selected' : '' }}>Hiển thị tất
                                        cả</option>
                                    <option value="{{ config('common.invoice.status.cho_xac_nhan') }}"
                                        {{ request()->status == config('common.invoice.status.cho_xac_nhan') ? 'selected' : '' }}>
                                        Chờ xác nhận</option>
                                    <option value="{{ config('common.invoice.status.cho_lay_hang') }}"
                                        {{ request()->status == config('common.invoice.status.cho_lay_hang') ? 'selected' : '' }}>
                                        Chờ lấy hàng</option>
                                    <option value="{{ config('common.invoice.status.dang_giao') }}"
                                        {{ request()->status == config('common.invoice.status.dang_giao') ? 'selected' : '' }}>
                                        Đang giao</option>
                                    <option value="{{ config('common.invoice.status.da_giao') }}"
                                        {{ request()->status == config('common.invoice.status.da_giao') ? 'selected' : '' }}>
                                        Đã giao</option>
                                    <option value="{{ config('common.invoice.status.da_huy') }}"
                                        {{ request()->status == config('common.invoice.status.da_huy') ? 'selected' : '' }}>
                                        Đã hủy</option>

                                </select>
                            </form>
                        </div>
                        <div class="col-md-9 text-center">
                            <p>Bạn chưa có đơn hàng nào !</p>
                            <img src="{{ asset('frontend_assets/img/no_order.png') }}" alt="" style="width:400px">

                        </div>
                    @endif
                </div>
            </div>
        </section>

    </div>
@endsection
@section('js')
    <script>
        $('#status').change(function() {
            $('form.invoice-status').submit();
        });
    </script>
@endsection
