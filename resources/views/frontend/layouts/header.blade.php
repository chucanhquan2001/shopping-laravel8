<header class="header">
    <!--Topbar-->
    <div class="header-topbar">
        <div class="header-topbar-inner">
            <!--Topbar Left-->
            <div class="topbar-left hidden-sm-down">
                <div class="phone"><i class="fa fa-phone left" aria-hidden="true"></i>HỖ TRỢ KHÁCH HÀNG :
                    <b>{{ getConfigValueSetting('phone_contact') }}</b>
                </div>
            </div>
            <!--End Topbar Left-->

            <!--Topbar Right-->
            <div class="topbar-right">
                <ul class="list-none">
                    @if (Auth::check())
                        <li class="dropdown-nav">
                            <i class="fa fa-user left" aria-hidden="true"></i><span class="hidden-sm-down">My
                                Account</span><i class="fa fa-angle-down right" aria-hidden="true"></i>
                            <!--Dropdown-->
                            <div class="dropdown-menu">
                                <ul>
                                    @can('admin-access')
                                        <li><a href="{{ route('dashboard') }}">Quản trị trang web</a></li>
                                    @endcan
                                    <li><a href="#">Thông tin tài khoản</a></li>
                                    <li><a href="#">Đơn hàng của tôi</a></li>
                                    <li><a href="{{ route('logout.client') }}" style="color: red"
                                            onclick="return confirm('Bạn có chắc chắn muốn đăng xuất ?')">Đăng xuất</a>
                                    </li>
                                </ul>
                            </div>
                            <!--End Dropdown-->
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login.client') }}"><i class="fa fa-lock left"
                                    aria-hidden="true"></i><span class="hidden-sm-down">Đăng nhập</span></a>
                        </li>
                        <li>
                            <a href="{{ route('register.client') }}"><i class="fa fa-key"></i>&nbsp;<span
                                    class="hidden-sm-down">Đăng kí</span></a>
                        </li>
                    @endif

                </ul>
            </div>
            <!-- End Topbar Right -->
        </div>
    </div>
    <!--End Topbart-->

    <!-- Header Container -->
    <div id="header-sticky" class="header-main">
        <div class="header-main-inner">
            <!-- Logo -->
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ getConfigValueSetting('logo_header') }}" style="margin-top: -10px"
                        alt="AnhQuanStore" />
                </a>
            </div>
            <!-- End Logo -->


            <!-- Right Sidebar Nav -->
            <div class="header-rightside-nav">
                <!-- Sidebar Icon -->
                <div class="sidebar-icon-nav">
                    <ul class="list-none-ib">
                        <!-- Search-->
                        <li><a id="search-overlay-menu-btn"><i aria-hidden="true" class="fa fa-search"></i></a>
                        </li>

                        <!-- Whishlist-->
                        <li><a class="js_whishlist-btn"><i aria-hidden="true" class="fa fa-heart"></i><span
                                    class="countTip">10</span></a></li>

                        <!-- Cart-->
                        <li><a id="sidebar_toggle_btn">
                                <div class="cart-icon">
                                    <i aria-hidden="true" class="fa fa-shopping-bag"></i>
                                </div>

                                <div class="cart-title">
                                    <span class="cart-count">2</span>
                                    /
                                    <span class="cart-price strong">$698.00</span>
                                </div>
                            </a></li>
                    </ul>
                </div>
                <!-- End Sidebar Icon -->
            </div>
            <!-- End Right Sidebar Nav -->


            <!-- Navigation Menu -->
            <nav class="navigation-menu">
                <ul>
                    <li>
                        <a href="{{ route('home') }}">Trang Chủ</a>
                    </li>
                    <li>
                        <a href="#">Cửa Hàng</a>
                        <!-- Drodown Menu ------->
                        <ul class="nav-dropdown js-nav-dropdown">
                            <li class="container">
                                <ul class="row">
                                    <!--Grid 1-->
                                    @foreach ($categories as $category)
                                        <li class="nav-dropdown-grid">
                                            <h6><a
                                                    href="{{ route('category.parent', $category->slug) }}">{{ $category->name }}</a>
                                            </h6>
                                            <ul>
                                                @foreach ($category->categoryChildren as $categoryChildren)
                                                    <li><a
                                                            href="{{ route('category.children', $categoryChildren->slug) }}">{{ $categoryChildren->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <!-- End Drodown Menu -->
                    </li>
                    <li>
                        <a href="#">Tin tức</a>
                        <!-- Drodown Menu ------->
                        <ul class="nav-dropdown js-nav-dropdown">
                            <li class="container">
                                <ul class="row">
                                    <!--Grid 1-->
                                    <li class="nav-dropdown-grid">
                                        <h6>New In</h6>
                                        <ul>
                                            <li><a href="#">New In Clothing</a></li>
                                            <li><a href="#">New In Shoes<span class="new-label">New</span></a>
                                            </li>

                                        </ul>
                                    </li>
                                    <!--Grid 2-->
                                    <li class="nav-dropdown-grid">
                                        <h6>Clothing</h6>
                                        <ul>
                                            <li><a href="#">Polos & Tees</a></li>
                                            <li><a href="#">Casual Trousers</a></li>
                                            <li><a href="#">Formal Shirts<span class="sale-label">Sale</span></a></li>
                                        </ul>
                                    </li>
                                    <!--Grid 3-->
                                    <li class="nav-dropdown-grid">
                                        <h6>ACCESSORIES</h6>
                                        <ul>
                                            <li><a href="#">Mens Jewellery</a></li>
                                            <li><a href="#">Bag</a></li>
                                            <li><a href="#">Sunglasses</a></li>
                                        </ul>
                                    </li>
                                    <!--Grid 4-->
                                    <li class="nav-dropdown-grid">
                                        <h6>Brand</h6>
                                        <ul>
                                            <li><a href="#">Analog</a></li>
                                            <li><a href="#">Chronograph</a></li>
                                            <li><a href="#">Digital</a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                        <!-- End Drodown Menu -->
                    </li>
                    <li>
                        <a href="#">Liên hệ</a>
                    </li>
                    <li>
                        <a href="#">Chính sách mua hàng</a>
                    </li>
                </ul>
            </nav>
            <!-- End Navigation Menu -->

        </div>
    </div>
    <!-- End Header Container -->
</header>
