<div class="sidebar-container col-md-3 pull-md-9">

    <!-- Categories -->
    <div class="widget-sidebar">
        <h6 class="widget-title">Shop Categories</h6>
        <ul class="widget-content widget-product-categories jq-accordian">
            <li>
                <a href="#">Accessories</a>
            </li>
            <li>
                <a>Clothings</a>
                <ul class="children">
                    <li><a href="#">All</a></li>
                    <li><a href="#">Coats & Jackets</a></li>
                    <li><a href="#">Shirts</a></li>
                    <li><a href="#">Sportswear</a></li>
                    <li><a href="#">Swimwear</a></li>
                    <li><a href="#">Trousers</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Man</a>
                <ul>
                    <li><a href="#">All</a></li>
                    <li><a href="#">Coats & Jackets</a></li>
                    <li><a href="#">Shirts</a></li>
                    <li><a href="#">Sportswear</a></li>
                    <li><a href="#">Swimwear</a></li>
                    <li><a href="#">Trousers</a></li>
                </ul>
            </li>
            <li><a href="#">Jacket</a></li>
            <li><a href="#">New arrivals</a></li>
            <li><a href="#">Shoes</a></li>
            <li><a href="sdsd.html">Socks</a></li>
        </ul>
    </div>

    <!-- Filter By Price -->
    <div class="widget-sidebar widget-price-range">
        <h6 class="widget-title">Filter By Price</h6>
        <form class="widget-content" method="get" action="#">
            <div class="price-range-slider"></div>
            <div class="price-range-amount">
                <input id="price_range_min" name="price_range_min" value="" data-min="140" placeholder="Min price"
                    style="display: none;" type="text">
                <input id="price_range_max" name="price_range_max" value="" data-max="1100" placeholder="Max price"
                    style="display: none;" type="text">
                <div id="price-range-from-to">
                </div>
            </div>
            <button class="btn btn-xs btn-black pull-right" type="submit">Filter</button>
        </form>
    </div>

    <!-- Filter By Color -->
    <div class="widget-sidebar widget-filter-color">
        <h6 class="widget-title">Filter By Color</h6>
        <ul class="widget-content">
            <li>
                <a href="#">
                    <div class="filter-color-switcher"><span style="background-color: #ff4040"></span>
                    </div>
                    Red
                </a>
                <span class="color-count">(9)</span>
            </li>
            <li>
                <a href="#">
                    <div class="filter-color-switcher"><span style="background-color: #000"></span>
                    </div>
                    Black
                </a>
                <span class="color-count">(112)</span>
            </li>
            <li>
                <a href="#">
                    <div class="filter-color-switcher"><span style="background-color: #ff9000"></span>
                    </div>
                    Orange
                </a>
                <span class="color-count">(56)</span>
            </li>
            <li>
                <a href="#">
                    <div class="filter-color-switcher"><span style="background-color: #ffcf3d"></span>
                    </div>
                    Yellow
                </a>
                <span class="color-count">(24)</span>
            </li>
            <li>
                <a href="#">
                    <div class="filter-color-switcher"><span style="background-color: #55b0da"></span>
                    </div>
                    Blue
                </a>
                <span class="color-count">(18)</span>
            </li>
            <li>
                <a href="#">
                    <div class="filter-color-switcher"><span style="background-color: #9ada55"></span>
                    </div>
                    Green
                </a>
                <span class="color-count">(72)</span>
            </li>
            <li>
                <a href="#">
                    <div class="filter-color-switcher"><span style="background-color: #7a463b"></span>
                    </div>
                    Brown
                </a>
                <span class="color-count">(5)</span>
            </li>
        </ul>
    </div>

    <!-- Filter By Size -->
    <div class="widget-sidebar widget-filter-size">
        <h6 class="widget-title">Filter By Size</h6>
        <ul class="widget-content">
            <li>
                <a href="#">L</a>
                <span>(24)</span>
            </li>
            <li>
                <a href="#">M</a>
                <span>(34)</span>
            </li>
            <li>
                <a href="#">S</a>
                <span>(45)</span>
            </li>
            <li>
                <a href="#">X</a>
                <span>(102)</span>
            </li>
            <li>
                <a href="#">XL</a>
                <span>(60)</span>
            </li>
            <li>
                <a href="#">XS</a>
                <span>(78)</span>
            </li>
            <li>
                <a href="#">XXL</a>
                <span>(35)</span>
            </li>
        </ul>
    </div>

    <!-- Filter By Tag -->
    <div class="widget-sidebar widget-filter-tag">
        <h6 class="widget-title">Popular Tag</h6>
        <ul class="widget-content">
            <li>
                <a href="#">Shirt</a>
            </li>
            <li>
                <a href="#">Bag</a>
            </li>
            <li>
                <a href="#">Vintage</a>
            </li>
            <li>
                <a href="#">Sweaters</a>
            </li>
            <li>
                <a href="#">t-shirt</a>
            </li>
            <li>
                <a href="#">white</a>
            </li>
            <li>
                <a href="#">Black</a>
            </li>
            <li>
                <a href="#">New</a>
            </li>
            <li>
                <a href="#">Popular</a>
            </li>
        </ul>
    </div>

    <!-- Widget Product -->
    <div class="widget-sidebar widget-product">
        <h6 class="widget-title">Popular Product</h6>
        <ul class="widget-content">

            <!--Item-->
            <li>
                <a class="product-img" href="#">
                    <img src="{{ asset('frontend_assets/img/product-img/big/product_125470007.jpg') }}" alt="">
                </a>
                <div class="product-content">
                    <a class="product-link" href="#">Alpha Block Black Polo Sleem T-Shirt</a>
                    <div class="star-rating">
                        <span style="width: 80%;"></span>
                    </div>
                    <span class="product-amount">$399.00</span>
                </div>
            </li>

            <!--Item-->
            <li>
                <a class="product-img" href="#">
                    <img src="{{ asset('frontend_assets/img/product-img/big/product_125470006.jpg') }}" alt="">
                </a>
                <div class="product-content">
                    <a class="product-link" href="#">Red Printed Round Neck T-Shirt</a>
                    <div class="star-rating">
                        <span style="width: 100%;"></span>
                    </div>
                    <span class="product-amount">$399.00</span>
                </div>
            </li>

            <!--Item-->
            <li>
                <a class="product-img" href="#">
                    <img src="{{ asset('frontend_assets/img/product-img/big/product_125470005.jpg') }}" alt="">
                </a>
                <div class="product-content">
                    <a class="product-link" href="#">Maroon Solid Henley T-Shirts</a>
                    <div class="star-rating">
                        <span style="width: 100%;"></span>
                    </div>
                    <span class="product-amount">$399.00</span>
                </div>
            </li>

        </ul>
    </div>
</div>
