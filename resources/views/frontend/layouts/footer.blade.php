<footer class="footer section-padding" style="background-color: #000000">
    <!-- Footer Info -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12 mb-sm-45">
                <div class="footer-block about-us-block">
                    <img src="{{ getConfigValueSetting('logo_footer') }}" width="180" alt="">
                    <p>Chào mừng Quý Khách ghé thăm website bán hàng trực tuyến AnhQuanStore. Website này được
                        phát triển và vận hành bởi nhà bán lẻ quần áo chuyên nghiệp với nhãn hiệu thương mại
                        "ANHQUANSTORE".</p>
                    <ul class="footer-social-icon list-none-ib">
                        <li><a href="{{ getConfigValueSetting('facebook_link') }}" target="_blank"><i
                                    class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="{{ getConfigValueSetting('facebook_link') }}" target="_blank"><i
                                    class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="{{ getConfigValueSetting('facebook_link') }}" target="_blank"><i
                                    class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                        <li><a href="{{ getConfigValueSetting('linkedin_link') }}" target="_blank"><i
                                    class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href="{{ getConfigValueSetting('instagram_link') }}" target="_blank"><i
                                    class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 mb-sm-45">
                <div class="footer-block information-block">
                    <h6>Information</h6>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Delivery Information</a></li>
                        <li><a href="#">Discount</a></li>
                        <li><a href="#">Latest News</a></li>
                        <li><a href="#">Our Sitemap</a></li>
                        <li><a href="#">Terms &amp; Condition</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 mb-sm-45">
                <div class="footer-block links-block">
                    <h6>Our Links</h6>
                    <ul>
                        <li><a href="#">Brands</a></li>
                        <li><a href="#">Gift Vouchers</a></li>
                        <li><a href="#">Affiliates</a></li>
                        <li><a href="#">Special Event</a></li>
                        <li><a href="#">Retunrs</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 mb-sm-45">
                <div class="footer-block extra-block">
                    <h6>Extra</h6>
                    <ul>
                        <li><a href="#">New Collection</a></li>
                        <li><a href="#">Women Dresses</a></li>
                        <li><a href="#">Kids Collection</a></li>
                        <li><a href="#">Mens Collection</a></li>
                        <li><a href="#">Custom Service</a></li>
                        <li><a href="#">Shipping policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="footer-block contact-block">
                    <h6>Liên hệ</h6>
                    <ul>
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i>{{ getConfigValueSetting('address') }}
                        </li>
                        <li><i class="fa fa-envelope" aria-hidden="true"></i><a
                                href="mailto:info@sky.com">{{ getConfigValueSetting('email') }}</a></li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i>{{ getConfigValueSetting('phone_contact') }}
                        </li>
                        <li><i class="fa fa-fax" aria-hidden="true"></i>{{ getConfigValueSetting('phone_contact') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer Info -->

    <!-- Footer Newsletter -->
    <div class="container">
        <div class="footer-newsletter">
            <h4>ĐĂNG KÍ ĐỂ NHẬN THÔNG BÁO</h4>
            <form class="footer-newslettr-inner">
                <input class="input-md fancy" name="footeremail" title="Enter Email Address.."
                    placeholder="Nhập địa chỉ email của bạn..." type="text">
                <button class="btn btn-md btn-color fancy">Đăng kí</button>
            </form>
        </div>
    </div>
    <!-- End Footer Newsletter -->

    <!-- Footer Copyright -->
    <div class="container">
        <div class="copyrights">
            {!! getConfigValueSetting('descreption_footer') !!}
            <p class="payment">
                <img src="{{ asset('frontend_assets/img/payment_logos.png') }}" alt="payment">
            </p>
        </div>
    </div>
    <!-- End Footer Copyright -->
</footer>
