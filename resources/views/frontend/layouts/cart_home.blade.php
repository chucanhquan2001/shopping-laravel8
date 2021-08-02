<!-- Sidebar Menu (Cart Menu) ------------------------------------------------>
<section id="sidebar-right" class="sidebar-menu sidebar-right">
    <div class="cart-sidebar-wrap">
        <!-- Cart Headiing -->
        <div class="cart-widget-heading">
            <h4>Shopping Cart</h4>
            <!-- Close Icon -->
            <a href="javascript:void(0)" id="sidebar_close_icon" class="close-icon-white"></a>
            <!-- End Close Icon -->
        </div>
        <!-- End Cart Headiing -->

        <!-- Cart Product Content -->
        <div class="cart-widget-content">
            <div class="cart-widget-product ">

                <!-- Empty Cart -->
                <div class="cart-empty">
                    <p>You have no items in your shopping cart.</p>
                </div>
                <!-- EndEmpty Cart -->

                <!-- Cart Products -->
                <ul class="cart-product-item">

                    <!-- Item -->
                    <li>
                        <!--Item Image-->
                        <a href="#" class="product-image">
                            <img src="{{ asset('frontend_assets/img/product-img/small/product_12547554.jpg') }}"
                                alt="" /></a>

                        <!--Item Content-->
                        <div class="product-content">
                            <!-- Item Linkcollateral -->
                            <a class="product-link" href="#">Alpha Block Black Polo T-Shirt</a>

                            <!-- Item Cart Totle -->
                            <div class="cart-collateral">
                                <span class="qty-cart">1</span>&nbsp;<span>&#215;</span>&nbsp;<span
                                    class="product-price-amount"><span class="currency-sign">$</span>399.00</span>
                            </div>

                            <!-- Item Remove Icon -->
                            <a class="product-remove" href="javascript:void(0)"><i class="fa fa-times-circle"
                                    aria-hidden="true"></i></a>
                        </div>
                    </li>

                    <!-- Item -->
                    <li>
                        <!--Item Image-->
                        <a href="#" class="product-image">
                            <img src="{{ asset('frontend_assets/img/product-img/small/product_12547555.jpg') }}"
                                alt="" /></a>

                        <!--Item Content-->
                        <div class="product-content">
                            <!-- Item Linkcollateral -->
                            <a class="product-link" href="#">Red Printed Round Neck T-Shirt</a>

                            <!-- Item Cart Totle -->
                            <div class="cart-collateral">
                                <span class="qty-cart">2</span>&nbsp;<span>&#215;</span>&nbsp;<span
                                    class="product-price-amount"><span class="currency-sign">$</span>299.00</span>
                            </div>

                            <!-- Item Remove Icon -->
                            <a class="product-remove" href="javascript:void(0)"><i class="fa fa-times-circle"
                                    aria-hidden="true"></i></a>
                        </div>
                    </li>

                </ul>
                <!-- End Cart Products -->

            </div>
        </div>
        <!-- End Cart Product Content -->

        <!-- Cart Footer -->
        <div class="cart-widget-footer">
            <div class="cart-footer-inner">

                <!-- Cart Total -->
                <h4 class="cart-total-hedding normal"><span>Total :</span><span class="cart-total-price">$698.00</span>
                </h4>
                <!-- Cart Total -->

                <!-- Cart Buttons -->
                <div class="cart-action-buttons">
                    <a href="cart.html" class="view-cart btn btn-md btn-gray">View Cart</a>
                    <a href="checkout.html" class="checkout btn btn-md btn-color">Checkout</a>
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
