<div class="product-filter-content">
    <div class="product-filter-content-inner">

        <!--Product Sort By-->
        <form class="product-sort-by" action="">
            <label for="short-by">Sắp xếp bởi</label>
            <select name="short_by" id="short-by" class="nice-select-box">
                <option value="{{ config('common.sortBy.mac_dinh') }}"
                    {{ request()->short_by == config('common.sortBy.mac_dinh') ? 'selected' : '' }}>Sắp xếp mặc định
                </option>
                <option value="{{ config('common.sortBy.pho_bien') }}"
                    {{ request()->short_by == config('common.sortBy.pho_bien') ? 'selected' : '' }}>Phổ biến</option>
                <option value="{{ config('common.sortBy.ban_chay_nhat') }}"
                    {{ request()->short_by == config('common.sortBy.ban_chay_nhat') ? 'selected' : '' }}>Bán chạy nhất
                </option>
                <option value="{{ config('common.sortBy.moi_nhat') }}"
                    {{ request()->short_by == config('common.sortBy.moi_nhat') ? 'selected' : '' }}>Mới nhất</option>
                <option value="{{ config('common.sortBy.thap_cao') }}"
                    {{ request()->short_by == config('common.sortBy.thap_cao') ? 'selected' : '' }}>Giá: thấp đến cao
                </option>
                <option value="{{ config('common.sortBy.cao_thap') }}"
                    {{ request()->short_by == config('common.sortBy.cao_thap') ? 'selected' : '' }}>Giá: cao đến thấp
                </option>
            </select>
        </form>




        <!--Product List/Grid Icon-->
        <div class="product-view-switcher">
            <label>Xem</label>
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
