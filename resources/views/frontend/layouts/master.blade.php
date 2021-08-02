<!DOCTYPE html>
<html>

<head>
    @include('frontend.layouts.head')
</head>

<body>
    {{-- sidebar menu --}}
    @include('frontend.layouts.cart_home')
    {{-- end sidebar menu --}}

    <!-- Oô tìm kiếm ----------------------------------------------------->
    <section class="search-overlay-menu">
        <!-- Close Icon -->
        <a href="javascript:void(0)" class="search-overlay-close"></a>
        <!-- End Close Icon -->
        <div class="container">
            <!-- Search Form -->
            <form role="search" id="searchform" action="https://theme.nileforest.com/search" method="get">
                <div class="search-icon-lg">
                    <img src="{{ asset('frontend_assets/img/search-icon-lg.png') }}" alt="" />
                </div>
                <label class="h6 normal search-input-label" for="search-query">Enter keywords to Search Product</label>
                <input value="" name="q" type="search" placeholder="Search..." />
                <button type="submit">
                    <img src="{{ asset('frontend_assets/img/search-lg-go-icon.png') }}" alt="" />
                </button>
            </form>
            <!-- End Search Form -->

        </div>
    </section>
    <!-- End ô tìm kiếm ------------------------------------------------>

    <!--==========================================-->
    <!-- wrapper -->
    <!--==========================================-->
    <div class="wraper">
        <!-- Header -->
        @include('frontend.layouts.header')
        <!-- End Header -->

        <!-- Page Content Wraper -->
        @yield('main')
        <!-- End Page Content Wraper -->

        <!-- Footer Section -------------->
        @include('frontend.layouts.footer')
        <!-- End Footer Section -------------->

    </div>
    <!-- End wrapper =============================-->

    <!--==========================================-->
    @include('frontend.layouts.js')
    @yield('js')
</body>

<!-- Mirrored from theme.nileforest.com/html/philos/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Jul 2021 10:25:24 GMT -->

</html>
