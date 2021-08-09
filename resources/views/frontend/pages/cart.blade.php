@extends('frontend.layouts.master')
@section('title_url')
    <title> Giỏ hàng </title>
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
                            <span>Giỏ hàng</span>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bread Crumb -->

        <!-- Page Content -->
        @if (Session::has('cart'))
            <section class="content-page change-table-cart">
                @include('frontend.layouts.cart_table');
            </section>
        @else
            <div class="row">
                <div class="col-md-12 text-center" style="padding: 30px 0">
                    <img src="{{ asset('frontend_assets/img/empty_cart.png') }}" alt="" style="width:300px">
                    <p style="color:red; font-size: 24px">Chưa có sản phẩm nào trong giỏ hàng !</p>
                    <a href="{{ route('home') }}" class="view-cart btn btn-md btn-gray">Mua Sắm</a>
                </div>
            </div>
        @endif

    </div>
@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(".update-quantity").click(function(e) {
            e.preventDefault();
            let id = $(this).data("id");
            let quantity = $(this).parents('tr').find('input').val();

            let urlRequest = "{{ route('update.cart') }}";
            $.ajax({
                type: "GET",
                url: urlRequest,
                data: {
                    id: id,
                    quantity: quantity
                },
                success: function(data) {
                    if (data.code === 200) {
                        $(".change-table-cart").html(data.cart_table_html);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                        swal("Cập nhập thành công !", {
                            icon: "warning",
                        });
                    }
                },
                error: function() {

                }

            });
        });

        $(".product-remove-item").click(function(e) {
            e.preventDefault();
            let id = $(this).data("id");
            let urlRequest = "{{ route('delete.item.cart') }}";
            $.ajax({
                type: "GET",
                url: urlRequest,
                data: {
                    id: id,
                },
                success: function(data) {
                    if (data.code === 200) {
                        $(".change-table-cart").html(data.cart_table_html);
                        swal("Xóa thành công !", {
                            icon: "warning",
                        });
                    }
                },
                error: function() {

                }

            });
        });
    </script>
@endsection
