<!-- Sidebar Menu (Cart Menu) ------------------------------------------------>
<section id="sidebar-right" class="sidebar-menu sidebar-right">
    <div class="cart-sidebar-wrap">
        <!-- Cart Headiing -->
        <div class="cart-widget-heading">
            <h4>Giỏ Hàng</h4>
            <!-- Close Icon -->
            <a href="javascript:void(0)" id="sidebar_close_icon" class="close-icon-white"></a>
            <!-- End Close Icon -->
        </div>
        <!-- End Cart Headiing -->

        <!-- Cart Product Content -->
        @php
            $totalPrice = 0;
        @endphp
        <div class="cart-widget-content">
            <div class="cart-widget-product ">
                @if (Session::has('cart'))
                    <!-- Cart Products -->
                    <ul class="cart-product-item change-cart">
                        @foreach (Session::get('cart') as $itemCart)
                            <!-- Item -->
                            @php
                                $totalPrice += ($itemCart['price'] - ($itemCart['price'] * $itemCart['discount']) / 100) * $itemCart['quantity'];
                            @endphp
                            <li>
                                <!--Item Image-->
                                <a href="#" class="product-image">
                                    <img src="{{ $itemCart['image'] }}" alt="" /></a>

                                <!--Item Content-->
                                <div class="product-content">
                                    <!-- Item Linkcollateral -->
                                    <a class="product-link" href="#">{{ $itemCart['name'] }}</a>

                                    <!-- Item Cart Totle -->
                                    <div class="cart-collateral">
                                        <span
                                            class="qty-cart">{{ $itemCart['quantity'] }}</span>&nbsp;<span>&#215;</span>&nbsp;<span
                                            class="product-price-amount"><a>{{ number_format($itemCart['price'] - ($itemCart['price'] * $itemCart['discount']) / 100) }}
                                                Đ</a>
                                    </div>

                                    <!-- Item Remove Icon -->
                                    <a class="product-remove" href="javascript:void(0)"><i class="fa fa-times-circle"
                                            aria-hidden="true"></i></a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <!-- Empty Cart -->
                    <div class="cart-empty" style="display: block;">
                        <ul class="cart-product-item change-cart-not-session">
                            <p>Không có sản phẩm nào trong giỏ hàng.</p>
                        </ul>
                    </div>
                    <!-- EndEmpty Cart -->

                @endif
                <!-- End Cart Products -->

            </div>
        </div>
        <!-- End Cart Product Content -->

        <!-- Cart Footer -->
        <div class="cart-widget-footer">
            <div class="cart-footer-inner">

                <!-- Cart Total -->
                <h4 class="cart-total-hedding normal"><span>Tổng tiền :</span><span
                        class="cart-total-price change-price">{{ number_format($totalPrice) }} Đ</span>
                </h4>
                <!-- Cart Total -->

                <!-- Cart Buttons -->

                <div class="cart-action-buttons">
                    <a href="{{ route('show.cart') }}" class="view-cart btn btn-md btn-gray">Xem giỏ hàng</a>
                    <a href="{{ route('checkout.index') }}" class="checkout btn btn-md btn-color">Thanh toán</a>
                </div>

                <!-- End Cart Buttons -->

            </div>
        </div>

        <!-- Cart Footer -->
    </div>
</section>
<!--Overlay-->
<div class="sidebar_overlay"></div>
<!-- End Sidebar Menu (Cart Menu) -------------------------------------------->
