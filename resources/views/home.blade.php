@extends('frontend/layouts/master')
@section('title_url')
    <title> AnhQuanStore - Đẳng cấp thời trang </title>
@endsection
@section('main')

    <div class="page-content-wraper">
        <!-- Intro -->
        @include('frontend.layouts.slider')
        <!-- End Intro -->

        <!-- Promo Box -->
        <section id="promo" class="section-padding-sm promo ">
            <div class="container">
                <div class="promo-box row">
                    <div class="col-md-4 mtb-sm-30 promo-item">
                        <div class="icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                        <div class="info">
                            <a href="#">
                                <h6 class="normal">Giao hàng miễn phí</h6>
                            </a>
                            <p>Áp dụng cho đơn hàng từ 500.000 đ</p>
                        </div>
                    </div>
                    <div class="col-md-4 mtb-sm-30 promo-item">
                        <div class="icon"><i class="fa fa-repeat" aria-hidden="true"></i></div>
                        <div class="info">
                            <a href="#">
                                <h6 class="normal">TRAO ĐỔI HOẶC TRẢ LẠI</h6>
                            </a>
                            <p>Đảm bảo hoàn tiền trong 30 ngày</p>
                        </div>
                    </div>
                    <div class="col-md-4 mtb-sm-30 promo-item">
                        <div class="icon"><i class="fa fa-headphones" aria-hidden="true"></i></div>
                        <div class="info">
                            <a href="#">
                                <h6 class="normal">Hỗ trợ trực tuyến</h6>
                            </a>
                            <p>Hỗ trợ trực tuyến 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Promo Box -->

        <!-- Promo Banner -->
        <section id="promo-banner" class="section-padding-b">
            <div class="container">
                <div class="row">
                    <!--Left Side-->
                    <div class="col-md-6">
                        <div class="row">
                            @foreach ($sliders1 as $sliderItem1)
                                <div class="col-12 mb-30">
                                    <!-- banner No.1 -->
                                    <div class="promo-banner-wrap">
                                        <a href="{{ $sliderItem1->post_link }}" class="promo-image-wrap">
                                            <img src="{{ $sliderItem1->image_path }}" alt="Accesories" />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            @foreach ($sliders2 as $sliderItem2)
                                <div class="col-12 mb-30">
                                    <!-- banner No.1 -->
                                    <div class="promo-banner-wrap">
                                        <a href="{{ $sliderItem2->post_link }}" class="promo-image-wrap">
                                            <img src="{{ $sliderItem2->image_path }}" alt="Accesories" />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Promo Banner -->

        <!-- Product (Tab with Slider) -->
        @include('frontend.layouts.product_home')
        <!-- End Product (Tab with Slider) -->

        <!-- Categories -->
        <section class="">
            <div class="section-padding container-fluid bg-image text-center overlay-light90"
                data-background-img="{{ asset('frontend_assets/img/bg/bg_4.jpg') }}" data-bg-position-x="center center">
                <div class="container">
                    <h2 class="page-title">Mua sắm theo danh mục</h2>
                </div>
            </div>
            <div class="container container-margin-minus-t">
                <div class="row">
                    @foreach ($categories as $itemCategory)
                        <div class="col-md-3">
                            <div class="categories-box">
                                <div class="categories-image-wrap">
                                    <img src="{{ $itemCategory->image }}" alt="" style="height: 230px; width: 100%;" />
                                </div>
                                <div class="categories-content">
                                    <a href="{{ route('category.parent', $itemCategory->slug) }}">
                                        <div class="categories-caption">
                                            <h6 class="normal">{{ $itemCategory->name }}</h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Categories -->

        <!-- New Product -->
        <section class="section-padding">
            <div class="container">
                <h2 class="page-title">XU HƯỚNG MỚI</h2>
            </div>
            <div class="container">
                <div id="new-tranding" class="product-item-4 owl-carousel owl-theme nf-carousel-theme1">
                    <!-- item.1 -->
                    @foreach ($product_trending as $itemProductTrending)
                        <div class="product-item">
                            <div class="product-item-inner">
                                <div class="product-img-wrap">
                                    <img src="{{ $itemProductTrending->getProductVariant()->where('status', 0)->first()->image }}"
                                        alt="">
                                </div>
                                <div class="product-button">
                                    <a href="#" class="js_tooltip" data-mode="top" data-tip="Compare"><i
                                            class="fa fa-exchange"></i></a>
                                    <a href="#" class="js_tooltip" data-mode="top" data-tip="Add To Whishlist"><i
                                            class="fa fa-heart"></i></a>
                                    <a href="#" class="js_tooltip" data-mode="top" data-tip="Quick&nbsp;View"><i
                                            class="fa fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-detail">
                                <p class="product-title"><a
                                        href="{{ route('client.product.detail', $itemProductTrending->slug) }}">{{ $itemProductTrending->name }}</a>
                                </p>
                                <h5 class="item-price">
                                    <del>{{ number_format(
    $itemProductTrending->getProductVariant()->where('status', 0)->first()->price,
) }}
                                        Đ</del>
                                    {{ number_format(
    $itemProductTrending->getProductVariant()->where('status', 0)->first()->price -
        ($itemProductTrending->getProductVariant()->where('status', 0)->first()->price *
            $itemProductTrending->getProductVariant()->where('status', 0)->first()->discount) /
            100,
) }}
                                    Đ
                                </h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End New Product -->

        <!-- Like & Share Banner -->
        <section id="like-share" class="like-share">
            <div class="container">
                <div class="like-share-inner overlay-black40">
                    <h3>Thích và chia sẻ trang của chúng tôi để được giảm giá <span class="color">10%</span></h3>
                    <ul class="social-icon">
                        <li><a href="{{ getConfigValueSetting('facebook_link') }}" target="_blank"><i
                                    class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="{{ getConfigValueSetting('facebook_link') }}" target="_blank"><i
                                    class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href="{{ getConfigValueSetting('instagram_link') }}" target="_blank"><i
                                    class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="{{ getConfigValueSetting('linkedin_link') }}" target="_blank"><i
                                    class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Like & Share Banner -->

        <!-- Blog & News -->
        <section class="section-padding">
            <div class="container">
                <h2 class="page-title">BÀI VIẾT NỔI BẬT</h2>
            </div>
            <div class="container">
                <div id="blog-carousel" class="blog-carousel owl-carousel owl-theme nf-carousel-theme1">
                    <!-- item.1 -->
                    @for ($i = 0; $i < 4; $i++)
                        <div class="product-item">
                            <div class="blog-box">
                                <div class="blog-img-wrap">
                                    <img src="{{ asset('frontend_assets/img/blog/blog_02.jpg') }}" alt="philos" />
                                </div>
                                <div class="blog-box-content">
                                    <div class="blog-box-content-inner">
                                        <h4 class="blog-title"><a href="blog-single.html">Bài Viết Đầu Tiên Trong
                                                Tuần</a>
                                        </h4>
                                        <p class="info"><span>by <a href="#">Chúc Anh Quân</a></span><span>29 Jan
                                                2017</span>
                                        </p>
                                        <div class="blog-description-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor
                                                incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipiscing
                                                aptent taciti sociosqu ad litora torquent...</p>
                                        </div>
                                        <a class="btn btn-xs btn-gray">Read More <i class="fa fa-long-arrow-right right"
                                                aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>
        <!-- End Blog & News -->

        <!-- Newsletter -->

        <section class="section-padding dark-bg container-fluid bg-image text-center overlay-black40"
            data-background-img="{{ asset('frontend_assets/img/bg/bg_6.jpg') }}" data-bg-position-x="center top">
            <div class="container newsletter section-padding-b">
                <h2 class="page-title">ĐĂNG KÍ ĐỂ NHẬN THÔNG BÁO MỚI</h2>
                <form name="form-newsletter" class="newsletter-from" id="form-newsletter" method="post">
                    <div class="form-input">
                        <input class="input-lg" name="frmemail" id="frmemail" placeholder="Enter Email Address..."
                            title="Nhập địa chỉ email của bạn..." type="text">
                    </div>
                    <button class="btn btn-lg btn-color">Đăng kí</button>
                </form>
                <p class="italic">Đăng ký để được cập nhật độc quyền, hàng mới và giảm giá chỉ dành cho người dùng nội
                    bộ.
                </p>
            </div>
        </section>

        <!-- Newsletter -->

        <!-- About blocks -->
        <section class="">
            <div class="container container-margin-minus-t">
                <div class="home-about-blocks">
                    <div class="col-12 about-blocks-wrap">
                        <div class="row">
                            <!--Customer Say-->
                            <div class="col-sm-6 col-md-6 customer-say">
                                <div class="about-box-inner">
                                    <h4 class="mb-25">KHÁCH HÀNG NÓI GÌ</h4>

                                    <!--Customer Carousel-->
                                    <div class="testimonials-carousel owl-carousel owl-theme nf-carousel-theme1">
                                        @for ($i = 0; $i < 4; $i++)
                                            <div class="product-item">
                                                <p class="large quotes">Sản phẩm ở đây rất tốt, tôi thật sự bị mê hoặc,
                                                    tôi
                                                    sẽ
                                                    ủng hộ của hàng lâu dài !</p>
                                                <h6 class="quotes-people">- Chúc Anh Quân</h6>
                                            </div>
                                        @endfor
                                    </div>
                                    <!--End Customer Carousel-->
                                </div>
                            </div>

                            <!--About Shop-->
                            <div class="col-sm-6 col-md-6 about-shop">
                                <div class="about-box-inner">
                                    <h4 class="mb-25">GIỚI THIỆU VỀ CHÚNG TÔI</h4>
                                    <p class="mb-20">Chào mừng các bạn đến với <b class="black">AnhQuanStore</b> - Hãy
                                        tìm
                                        hiểu về chúng tôi, bạn sẽ muốn trở thành khách hàng quen thuộc của của hàng này.
                                    </p>
                                    <a href="#" class="btn btn-xs btn-black">Chi tiết <i
                                            class="fa fa-angle-right right"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About blocks -->

        <!-- Brnad Logo -->
        <section id="brand-logo" class="section-padding brand-logo">
            <div class="container">
                <ul class="list-none-ib brand-logo-carousel owl-carousel owl-theme">
                    <li class="brand-item"><a href="#">
                            <img src="{{ asset('frontend_assets/img/logo/01.png') }}" alt="nileforest" />
                        </a>
                    </li>
                    <li class="brand-item">
                        <a href="#">
                            <img src="{{ asset('frontend_assets/img/logo/02.png') }}" alt="niletheme" />
                        </a>
                    </li>
                    <li class="brand-item">
                        <a href="#">
                            <img src="{{ asset('frontend_assets/img/logo/03.png') }}" alt="nile" />
                        </a>
                    </li>
                    <li class="brand-item">
                        <a href="#">
                            <img src="{{ asset('frontend_assets/img/logo/04.png') }}" alt="forest" />
                        </a>
                    </li>
                </ul>
            </div>
        </section>
        <!-- End Brnad Logo -->

        <!-- Instagram -->
        <section class="section-padding instagram bg-gray">
            <div class="container text-center">
                <h2 class="page-title">KHOẢNG KHẮC FACEBOOK</h2>
                <p class="">Theo dõi fanpage <a target="_blank" class="strong"
                        href="{{ getConfigValueSetting('facebook_link') }}">AnhQuanStore</a></p>
            </div>
            <div class="container">
                <ul class="intagram-feed">
                    <li>
                        <a href="#">
                            <img src="{{ asset('frontend_assets/img/instagram/insta-1.jpg') }}" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ asset('frontend_assets/img/instagram/insta-1.jpg') }}" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ asset('frontend_assets/img/instagram/insta-1.jpg') }}" alt="">
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ asset('frontend_assets/img/instagram/insta-1.jpg') }}" alt="">
                        </a>
                    </li>

                </ul>
            </div>
        </section>
        <!-- End Instagram -->
    </div>
@endsection
