<section class="section-padding-b">
    <div class="container">
        <h2 class="page-title">SẢN PHẨM</h2>
    </div>
    <div class="container">
        <ul class="product-filter nav" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#latest" role="tab" data-toggle="tab">Mới nhất</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#best-sellar" role="tab" data-toggle="tab">Bán chạy nhất</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#features" role="tab" data-toggle="tab">Đặc biệt</a>
            </li>
        </ul>
        <div class="tab-content">
            <!-- Tab1 - Latest Product -->
            <div id="latest" role="tabpanel" class="tab-pane fade in active">
                <div id="new-product" class="product-item-4 owl-carousel owl-theme nf-carousel-theme1">
                    <!-- item.1 -->
                    @foreach ($product_latest as $itemProductLatest)
                        <div class="product-item">
                            <div class="product-item-inner">
                                <div class="product-img-wrap">
                                    <img src="{{ $itemProductLatest->getProductVariant()->where('status', 0)->first()->image }}"
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
                                        href="{{ route('client.product.detail', $itemProductLatest->slug) }}">{{ $itemProductLatest->name }}</a>
                                </p>
                                <h5 class="item-price">
                                    <del>{{ number_format(
    $itemProductLatest->getProductVariant()->where('status', 0)->first()->price,
) }}
                                        Đ</del>
                                    {{ number_format(
    $itemProductLatest->getProductVariant()->where('status', 0)->first()->price -
        ($itemProductLatest->getProductVariant()->where('status', 0)->first()->price *
            $itemProductLatest->getProductVariant()->where('status', 0)->first()->discount) /
            100,
) }}
                                    Đ
                                </h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab2 - Best Sellar -->
            <div id="best-sellar" role="tabpanel" class="tab-pane fade">
                <div id="popular-product" class="product-item-4 owl-carousel owl-theme nf-carousel-theme1">
                    <!-- item.1 -->
                    @for ($i = 0; $i < 7; $i++)
                        <div class="product-item">
                            <div class="product-item-inner">
                                <div class="product-img-wrap">
                                    <img src="{{ asset('frontend_assets/img/product-img/big/product_125470001.jpg') }}"
                                        alt="">
                                </div>
                                <div class="product-button">
                                    <a href="#" class="js_tooltip" data-mode="top" data-tip="Add To Cart"><i
                                            class="fa fa-shopping-bag"></i></a>
                                    <a href="#" class="js_tooltip" data-mode="top" data-tip="Add To Whishlist"><i
                                            class="fa fa-heart"></i></a>
                                    <a href="#" class="js_tooltip" data-mode="top" data-tip="Quick&nbsp;View"><i
                                            class="fa fa-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-detail">
                                <p class="product-title"><a href="product_detail.html">United Colors of
                                        Benetton</a></p>
                                <h5 class="item-price">400.000 đ</h5>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Tab3 - Features -->
            <div id="features" role="tabpanel" class="tab-pane fade">
                <div id="features-product" class="product-item-4 owl-carousel owl-theme nf-carousel-theme1">
                    @foreach ($product_pulish as $itemProductPulish)
                        <div class="product-item">
                            <div class="product-item-inner">
                                <div class="product-img-wrap">
                                    <img src="{{ $itemProductPulish->getProductVariant()->where('status', 0)->first()->image }}"
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
                                        href="{{ route('client.product.detail', $itemProductPulish->slug) }}">{{ $itemProductPulish->name }}</a>
                                </p>
                                <h5 class="item-price">
                                    <del>{{ number_format(
    $itemProductPulish->getProductVariant()->where('status', 0)->first()->price,
) }}
                                        Đ</del>
                                    {{ number_format(
    $itemProductPulish->getProductVariant()->where('status', 0)->first()->price -
        ($itemProductPulish->getProductVariant()->where('status', 0)->first()->price *
            $itemProductPulish->getProductVariant()->where('status', 0)->first()->discount) /
            100,
) }}
                                    Đ
                                </h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
