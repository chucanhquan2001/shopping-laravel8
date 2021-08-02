@extends('frontend/layouts/master')
@section('title_url')
    <title> {{ $category->name }} </title>
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
                            <a href="#">Danh mục</a>
                            <span>{{ $category->name }}</span>
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
                    <!-- Product Content -->
                    <div class="col-md-9 push-md-3">
                        <!-- Title -->
                        <div class="list-page-title">
                            <h2 class="">{{ $category->name }} <small>{{ $category->getProduct->count() }} sản
                                    phẩm</small></h2>
                        </div>
                        <!-- End Title -->

                        <!-- Product Filter -->
                        @include('frontend.layouts.filter')
                        <!-- End Product filters Toggle-->

                        <!-- Product Grid -->
                        <div class="row product-list-item">
                            <!-- item.1 -->
                            @foreach ($products as $product)
                                <div class="product-item-element col-sm-6 col-md-6 col-lg-4">
                                    <!--Product Item-->
                                    <div class="product-item">
                                        <div class="product-item-inner">
                                            <div class="product-img-wrap">
                                                <img src="{{ $product->getProductVariant()->where('status', 0)->first()->image }}"
                                                    alt="">
                                            </div>
                                            <div class="product-button">
                                                <a href="#" class="js_tooltip" data-mode="top" data-tip="Compare"><i
                                                        class="fa fa-exchange"></i></a>
                                                <a href="#" class="js_tooltip" data-mode="top"
                                                    data-tip="Add To Whishlist"><i class="fa fa-heart"></i></a>
                                                <a href="#" class="js_tooltip" data-mode="top" data-tip="Quick&nbsp;View"><i
                                                        class="fa fa-eye"></i></a>
                                            </div>
                                        </div>
                                        <div class="product-detail">
                                            @foreach ($product->getTag as $tag)
                                                <a class="tag" href="#">{{ $tag->name }}</a>
                                            @endforeach
                                            <p class="product-title"><a
                                                    href="{{ route('client.product.detail', $product->slug) }}">{{ $product->name }}</a>
                                            </p>
                                            <div class="product-rating">
                                                <div class="star-rating" itemprop="reviewRating" itemscope=""
                                                    itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
                                                    <span style="width: 60%"></span>
                                                </div>
                                                <a href="#" class="product-rating-count"><span class="count">3</span>
                                                    Reviews</a>
                                            </div>

                                            <h5 class="item-price">
                                                <del>{{ number_format(
    $product->getProductVariant()->where('status', 0)->first()->price,
) }}
                                                    Đ</del>
                                                {{ number_format(
    $product->getProductVariant()->where('status', 0)->first()->price -
        ($product->getProductVariant()->where('status', 0)->first()->price *
            $product->getProductVariant()->where('status', 0)->first()->discount) /
            100,
) }}
                                                Đ
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- End Product Item-->
                                </div>
                            @endforeach
                        </div>
                        <!-- End Product Grid -->

                        <div class="pagination-wraper">
                            <div class="pagination">
                                @if (request()->product_show && request()->product_show != 'all')
                                    {{ $products->appends(request()->all())->links() }}
                                @endif
                            </div>
                        </div>

                    </div>
                    <!-- End Product Content -->

                    <!-- Sidebar -->
                    @include('frontend.layouts.sidebar')
                    <!-- End Sidebar -->

                </div>
            </div>
        </section>
        <!-- End Page Content -->
    </div>
@endsection
@section('js')
    <script>
        $('#product-show').change(function() {
            $('form.product-show').submit();
        });
    </script>
@endsection
