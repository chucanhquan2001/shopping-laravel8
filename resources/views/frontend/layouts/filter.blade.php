<div class="product-filter-content">
    <div class="product-filter-content-inner">

        <!--Product Sort By-->
        <form class="product-sort-by">
            <label for="short-by">Short By</label>
            <select name="short-by" id="short-by" class="nice-select-box">
                <option value="default_sorting" selected="selected">Default sorting</option>
                <option value="sort_by_popularity">Popularity</option>
                <option value="sort_by_average_rating">Average rating</option>
                <option value="sort_by_newness">New product</option>
                <option value="price_low_to_high">Price: low to high</option>
                <option value="price_high_to_low">Price: high to low</option>
            </select>
        </form>
        <script>

        </script>
        <!--Product Show-->
        <form class="product-show" action="" role="form">
            <label for="product-show">Show</label>
            <select name="product_show" id="product-show" class="nice-select-box">
                <option value="6" selected="selected">6</option>
                <option value="12" {{ request()->product_show == 12 ? 'selected' : '' }}>12</option>
                <option value="24" {{ request()->product_show == 24 ? 'selected' : '' }}>24</option>
                <option value="36" {{ request()->product_show == 36 ? 'selected' : '' }}>36</option>
                <option value="all" {{ request()->product_show == 'all' ? 'selected' : '' }}>Hiển thị tất cả</option>
            </select>
        </form>



        <!--Product List/Grid Icon-->
        <div class="product-view-switcher">
            <label>View</label>
            <div class="product-view-icon product-grid-switcher product-view-icon-active">
                <a class="" href="#"><i class="fa fa-th" aria-hidden="true"></i></a>
            </div>
            <div class="product-view-icon product-list-switcher">
                <a class="" href="#"><i class="fa fa-th-list" aria-hidden="true"></i></a>
            </div>
        </div>

    </div>
</div>
<!-- End Product Filter -->

<!-- Product filters Toggle-->
