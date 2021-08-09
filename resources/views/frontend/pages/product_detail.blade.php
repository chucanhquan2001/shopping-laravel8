@extends('frontend.layouts.master')
@section('title_url')
    <title> {{ $product_main->name }} </title>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
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
                            <a href="#">Sản phẩm</a>
                            <span> {{ $product_main->name }}</span>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- Bread Crumb -->

        <!-- Page Content -->
        <section id="product-ID_XXXX" class="content-page single-product-content">
            <!-- Product -->
            <div id="product-detail" class="container">
                <div class="row">
                    <!-- Product Image -->
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                        <div class="product-page-image">
                            <!-- Slick Image Slider -->
                            <div class="product-image-slider product-image-gallery" id="product-image-gallery"
                                data-pswp-uid="3">
                                @foreach ($products as $itemProduct)
                                    <div class="item">
                                        <a class="product-gallery-item" href="{{ $itemProduct->image }}" data-size=""
                                            data-med="{{ $itemProduct->image }}" data-med-size="">
                                            <img src="{{ $itemProduct->image }}" alt="image 1"
                                                id="show-img-{{ $itemProduct->sku }}" />
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                            <!-- End Slick Image Slider -->

                            <a href="javascript:void(0)" id="zoom-images-button" class="zoom-images-button"><i
                                    class="fa fa-expand" aria-hidden="true"></i></a>


                        </div>

                        <!-- Slick Thumb Slider -->
                        <div class="product-image-slider-thumbnails">
                            @foreach ($products as $itemProduct2)
                                <div class="item">
                                    <img src="{{ $itemProduct2->image }}" class="click-image-{{ $itemProduct2->sku }}"
                                        alt="image 1" />
                                </div>
                            @endforeach
                        </div>
                        <!-- End Slick Thumb Slider -->
                    </div>
                    <!-- End Product Image -->

                    <!-- Product Content -->
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                        <div class="product-page-content">
                            <h2 class="product-title">{{ $product_main->name }}</h2>
                            <div class="product-rating">
                                <div class="star-rating" itemprop="reviewRating" itemscope=""
                                    itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
                                    <span style="width: {{ round($reviews->avg('rating_star')) * 2 }}0%"></span>
                                </div>
                                <a href="#" class="product-rating-count"><span
                                        class="count">{{ $product_main->getReviews->count() }}</span> Đánh giá</a>
                            </div>
                            <div class="product-price">
                                <del class="product-price-old">{{ number_format($product_main->price) }}
                                    Đ</del><span class="product-price-text">
                                    {{ number_format($product_main->price - ($product_main->price * $product_main->discount) / 100) }}
                                    Đ
                                </span>
                            </div>
                            <p class="product-description">
                                {!! $product_main->description !!}
                            </p>
                            <br>
                            <form id="form-add-cart" action="{{ route('add.cart') }}" method="post">
                                @csrf
                                <div class="row product-filters" style="margin-left: 5px">
                                    <select name="product_variant_id" id="select-color"
                                        class="nice-select-box select-color">
                                        @foreach ($products as $itemColor)
                                            <option value="{{ $itemColor->product_variant_id }}">
                                                {{ $itemColor->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <br>
                                </div>
                                <br>

                                <div class="single-variation-wrap">
                                    @if ($product_main->quantity > 0)
                                        <div class="product-quantity">
                                            <span data-value="+" class="quantity-btn quantityPlus"></span>
                                            <input class="quantity input-lg" step="1" min="1"
                                                max="{{ $product_main->quantity }}" name="quantity" value="1"
                                                title="Quantity" type="number" />
                                            <span data-value="-" class="quantity-btn quantityMinus"></span>
                                        </div>
                                        <button class="btn btn-lg btn-black add-cart"><i class="fa fa-shopping-bag"
                                                aria-hidden="true" class="button-add-cart"></i>Add to cart</button>
                                    @else
                                        <i>SẢN PHẨM TẠM THỜI HẾT HÀNG</i>
                                    @endif
                                </div>
                            </form>
                            <div class="single-add-to-wrap">
                                <a class="single-add-to-wishlist"><i class="fa fa-heart left"
                                        aria-hidden="true"></i><span>Add to Wishlist</span></a>
                                <a class="single-add-to-compare "><i class="fa fa-refresh left"
                                        aria-hidden="true"></i><span>Add to Compare</span></a>
                            </div>
                            <div class="product-meta">
                                <span>Số lượng sản phẩm : <span class="quantity"
                                        itemprop="sku">{{ $product_main->quantity }}</span></span>
                                <span>SKU : <span class="sku" itemprop="sku">{{ $product_main->sku }}</span></span>
                                <span>Danh mục : <span class="category"
                                        itemprop="category">{{ $product_main->getCate->name }}</span></span>
                                <span>Thẻ tag : <span class="tag" itemprop="tag">
                                        @foreach ($product_main->getTag as $itemTag)
                                            <a href="#"><i>{{ $itemTag->name }}</i> &nbsp;</a>
                                        @endforeach
                                    </span></span>
                            </div>

                            <div class="product-share">
                                <span>Chia sẻ :</span>
                                <ul>
                                    <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-envelope"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Product -->

            <!-- Product Content Tab -->
            <div class="product-tabs-wrapper container">
                <ul class="product-content-tabs nav nav-tabs" role="tablist">

                    <li class="nav-item">
                        <a class="active" href="#tab_description" role="tab" data-toggle="tab">Mô tả</a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="#tab_additional_information" role="tab" data-toggle="tab">
                            Thông số</a>
                    </li>
                    <li class="nav-item">
                        <a class="" href="#tab_reviews" role="tab" data-toggle="tab">Đánh giá
                            (<span>{{ $product_main->getReviews->count() }}</span>)</a>
                    </li>

                </ul>
                <div class="product-content-Tabs_wraper tab-content container">
                    <div id="tab_description" role="tabpanel" class="tab-pane fade in active">
                        <!-- Accordian Title -->
                        <h6 class="product-collapse-title" data-toggle="collapse" data-target="#tab_description-coll">
                            Description</h6>
                        <!-- End Accordian Title -->
                        <!-- Accordian Content -->
                        <div id="tab_description-coll" class="shop_description product-collapse collapse container">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! $product_main->content !!}
                                </div>
                            </div>
                        </div>
                        <!-- End Accordian Content -->
                    </div>

                    <div id="tab_additional_information" role="tabpanel" class="tab-pane fade">
                        <!-- Accordian Title -->
                        <h6 class="product-collapse-title" data-toggle="collapse"
                            data-target="#tab_additional_information-coll">Additional Information</h6>
                        <!-- End Accordian Title -->
                        <!-- Accordian Content -->
                        <div id="tab_additional_information-coll" class="container product-collapse collapse">

                            <table class="shop_attributes">
                                <tbody>
                                    <tr>
                                        <th>Các màu sắc</th>
                                        <td>
                                            @foreach ($products as $itemColor2)
                                                {{ $itemColor2->value }} &nbsp;
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Số lượng sản phẩm</th>
                                        <td>
                                            @foreach ($products as $itemQuantity)
                                                {{ $itemQuantity->quantity }} &nbsp;
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ảnh chi tiết</th>
                                        <td>
                                            @foreach ($products as $itemImageDescription)
                                                <img src="{{ $itemImageDescription->image }}" alt=""
                                                    style="max-width: 100px;"> &nbsp;
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Thẻ tag</th>
                                        <td>
                                            @foreach ($product_main->getTag as $itemTag2)
                                                <a href="#"><i>{{ $itemTag2->name }}</i> &nbsp;</a>
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <!-- End Accordian Content -->
                    </div>
                    <div id="tab_reviews" role="tabpanel" class="tab-pane fade">
                        <!-- Accordian Title -->
                        <h6 class="product-collapse-title" data-toggle="collapse" data-target="#tab_reviews-coll">
                            Reviews
                            (0)</h6>
                        <!-- End Accordian Title -->
                        <!-- Accordian Content -->
                        <div id="tab_reviews-coll" class=" product-collapse collapse container">
                            <div class="row">
                                <div class="review-form-wrapper col-md-6">
                                    <h6 class="review-title">Thêm đánh giá của bạn </h6>
                                    @if (Session::has('success'))
                                        <input type="text" class="input_alert" value="{{ Session::get('success') }}"
                                            hidden>
                                    @endif
                                    <form action="{{ route('add.review') }}" class="comment-form" method="post">
                                        @csrf
                                        <div class="form-field-wrapper">
                                            <label>Xếp hạng</label>
                                            <input type="text" name="rating_star" id="rating_star" placeholder hidden>
                                            <div id="rateYo"></div>
                                            <input type="text" name="product_id" value="{{ $product_main->id }}" hidden>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <label>Đánh giá chi tiết<span class="required">*</span></label>
                                            <textarea id="comment" class="form-full-width" name="comment" cols="45" rows="8"
                                                aria-required="true" required=""></textarea>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <label>Họ tên <span class="required">*</span></label>
                                            <input id="author" class="input-md form-full-width" name="name" size="30"
                                                aria-required="true" required="" type="text">
                                        </div>
                                        <div class="form-field-wrapper">
                                            <label>Email <span class="required">*</span></label>
                                            <input id="email" class="input-md form-full-width" name="email" size="30"
                                                aria-required="true" required="" type="email">
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input name="submit" id="submit" class="submit btn btn-md btn-color"
                                                value="Submit" type="submit">
                                        </div>
                                    </form>
                                </div>
                                <div class="comments col-md-6">
                                    <h6 class="review-title">Đánh giá của khách hàng</h6>
                                    @if ($product_main->getReviews->count() == 0)
                                        <p class="review-blank">Chưa có đánh giá nào cho sản phẩm.</p>
                                    @else
                                        <ul class="commentlist">
                                            @foreach ($reviews as $itemReview)
                                                <li id="comment-101" class="comment-101">
                                                    <img src="{{ asset('frontend_assets/img/avatar.jpg') }}"
                                                        class="avatar" alt="author" />
                                                    <div class="comment-text">
                                                        <div class="star-rating" itemprop="reviewRating" itemscope=""
                                                            itemtype="http://schema.org/Rating" title="Rated 4 out of 5">
                                                            <span
                                                                style="width: {{ round($itemReview->rating_star) * 2 }}0%"></span>
                                                        </div>
                                                        <p class="meta">
                                                            <strong itemprop="author">{{ $itemReview->name }}</strong>
                                                            &nbsp;&mdash;&nbsp;
                                                            <time itemprop="datePublished"
                                                                datetime="">{{ $itemReview->created_at }}</time>
                                                        </p>
                                                        <div class="description" itemprop="description">
                                                            <p>{{ $itemReview->comment }}</p>
                                                        </div>
                                                        @can('review-reply')
                                                            <a style="font-size: 14px; color: gray; float: right"
                                                                class="show-form"
                                                                data-review="{{ $itemReview->id }}">Reply</a>
                                                        @endcan
                                                    </div>

                                                </li>

                                                @foreach ($itemReview->getReplies()->where('status', config('common.status.pulish'))->get()
        as $itemReply)
                                                    <li id="comment-102" class="comment-102" style="margin-left: 44px;">
                                                        <img src="{{ asset('frontend_assets/img/avatar.jpg') }}"
                                                            class="avatar" alt="author" />
                                                        <div class="comment-text">
                                                            <p class="meta">
                                                                <strong itemprop="author">ADMIN</strong>
                                                                &nbsp;&mdash;&nbsp;
                                                                <time itemprop="datePublished"
                                                                    datetime="">{{ $itemReply->created_at }}</time>
                                                            </p>
                                                            <div class="description" itemprop="description">
                                                                <p>{{ $itemReply->comment }}</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                @can('review-reply')
                                                    <form action="{{ route('add.reply') }}" method="POST"
                                                        class="form-reply-{{ $itemReview->id }}"
                                                        style="display: none;margin-top: -15px;margin-bottom: 33px">
                                                        @csrf
                                                        <input type="text" hidden name="review_id"
                                                            value="{{ $itemReview->id }}">
                                                        <div class="row" style="margin-bottom: 10px">
                                                            <div class="col-md-1">

                                                            </div>
                                                            <div class="col-md-2">
                                                                <img src="{{ asset('frontend_assets/img/avatar.jpg') }}"
                                                                    class="avatar" alt="author" />
                                                            </div>
                                                            <div class="col-md-7">
                                                                <input id="author" class="input-md form-full-width"
                                                                    name="comment" size="35" aria-required="true" required=""
                                                                    type="text" style="margin-top: 5px;width: 100%;"
                                                                    placeholder="Trả lời khách hàng ...">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="submit" style="margin-top: 23px;height: 25px;"
                                                                    value="Gửi">
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endcan
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Accordian Content -->
                    </div>
                </div>
            </div>
            <!-- End Product Content Tab -->

            <!-- Product Carousel -->
            <div class="container product-carousel">
                <h2 class="page-title">SẢN PHẨM LIÊN QUAN</h2>
                <div id="new-tranding" class="product-item-4 owl-carousel owl-theme nf-carousel-theme1">
                    <!-- item.1 -->
                    @foreach ($product_related as $itemProductRelated)
                        <div class="product-item">
                            <div class="product-item-inner">
                                <div class="product-img-wrap">
                                    <img src="{{ $itemProductRelated->getProductVariant()->where('status', 0)->first()->image }}"
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
                                        href="{{ route('client.product.detail', $itemProductRelated->slug) }}">{{ $itemProductRelated->name }}</a>
                                </p>
                                <h5 class="item-price">
                                    <del>{{ number_format(
    $itemProductRelated->getProductVariant()->where('status', 0)->first()->price,
) }}
                                        Đ</del>
                                    {{ number_format(
    $itemProductRelated->getProductVariant()->where('status', 0)->first()->price -
        ($itemProductRelated->getProductVariant()->where('status', 0)->first()->price *
            $itemProductRelated->getProductVariant()->where('status', 0)->first()->discount) /
            100,
) }}
                                    Đ
                                </h5>
                            </div>
                        </div>
                    @endforeach
                    <!-- item.2 -->

                </div>
            </div>
            <!-- End Product Carousel -->

        </section>
        <!-- End Page Content -->

    </div>

@endsection
@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>
        // rating 
        $("#rateYo").rateYo({
            rating: 0,
            starWidth: "20px",
            ratedFill: "yellow",
        }).on("rateyo.set", function(e, data) {
            $("#rating_star").val(data.rating);
        });

        // hiện thị thông báo thêm đánh giá thành công !
        if ($('.input_alert').val()) {
            alert($('.input_alert').val());
        }

        // hiển thị form trả lời bình luận
        $(".show-form").click(function() {
            let idReview = $(this).data("review");

            $(".form-reply-" + idReview).slideToggle();

        });

        // add giỏ hàng
        $("#form-add-cart").submit(function(event) {
            /* stop form from submitting normally */
            event.preventDefault();

            /* get the action attribute from the <form action=""> element */
            var $form = $(this),
                urlRequest = $form.attr('action');

            $.ajax({
                url: urlRequest,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    product_variant_id: $("[name='product_variant_id']").val(),
                    quantity: $(".quantity").val(),
                },
                success: function(data) {
                    if (data.code === 200) {

                        // in ra html cart modal
                        let datas = data.carts;
                        let htmlCartModal = ``;

                        // tính tổng tiền
                        let totalPrices = parseFloat(data.totalPrice);

                        Object.values(datas).forEach(val => {
                            let priceUnit = val['price'] - (val['price'] * val['discount'] /
                                100);
                            htmlCartModal += `
                                <li>
                                <!--Item Image-->
                                <a href="#" class="product-image">
                                    <img src="${val['image']}" alt="" /></a>

                                <!--Item Content-->
                                <div class="product-content">
                                    <!-- Item Linkcollateral -->
                                    <a class="product-link" href="#">${val['name']}</a>

                                    <!-- Item Cart Totle -->
                                    <div class="cart-collateral">
                                        <span
                                            class="qty-cart">${val['quantity']}</span>&nbsp;<span>&#215;</span>&nbsp;<span
                                            class="product-price-amount"><a>${priceUnit}
                                                Đ</a>
                                    </div>

                                    <!-- Item Remove Icon -->
                                    <a class="product-remove" href="javascript:void(0)"><i class="fa fa-times-circle"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                            `;
                        });
                        $(".change-cart").html(htmlCartModal);
                        $(".change-cart-not-session").html(htmlCartModal);


                        // in ra tổng tiền ở modal cart
                        let moneyFormatPrice = new Intl.NumberFormat('ja-JP').format(totalPrices);
                        $(".change-price").html(moneyFormatPrice + " Đ");
                        $(".strong").html(moneyFormatPrice + " Đ");
                        $(".cart-count").html(data.totalQuantity);
                        swal("Thêm vào giỏ hàng thành công !", {
                            icon: "warning",
                        });
                    }
                },
                dataType: 'json'
            });
        });



        // đổi anh và giá khi thay đổi thuộc tính
        $("[name='product_variant_id']").change(function() {
            let idProductVariant = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('change.product.variant') }}",
                data: {
                    idProductVariant: idProductVariant,
                },
                success: function(data) {
                    // đổi ảnh
                    $('.click-image-' + data.sku).click();

                    // đổi giá 
                    let moneyFormatPrice = new Intl.NumberFormat('ja-JP').format(data
                        .price);
                    $('.product-price-old').html(moneyFormatPrice + " Đ");

                    let moneyFormat = new Intl.NumberFormat('ja-JP').format(data.price - (
                        data.price * data.discount /
                        100));
                    $('.product-price-text').html(moneyFormat + " Đ");

                    // đổi sku
                    $(".sku").html(data.sku);

                    // đổi quantity
                    $(".quantity").html(data.quantity);

                    if (data.quantity <= 0) {
                        $('.single-variation-wrap').html(
                            "<i>SẢN PHẨM TẠM THỜI HẾT HÀNG</i>");
                    } else {
                        $('.single-variation-wrap').html(
                            `<div class="product-quantity">
                                        <span data-value="+" class="quantity-btn quantityPlus"></span>
                                        <input class="quantity input-lg" step="1" min="1"
                                            max="${data.quantity}" name="quantity" value="1"
                                            title="Quantity" type="number" />
                                        <span data-value="-" class="quantity-btn quantityMinus"></span>
                                    </div>
                                    <button class="btn btn-lg btn-black add-cart"><i class="fa fa-shopping-bag"
                                            aria-hidden="true" class="button-add-cart"></i>Add to cart</button>`
                        );
                    }
                },
                error: function() {
                    alert('Error');
                }
            });
        });
    </script>
@endsection
