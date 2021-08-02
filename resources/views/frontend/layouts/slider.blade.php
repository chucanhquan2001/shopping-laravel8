<section id="intro" class="intro">
    <!-- Revolution Slider -->
    <div id="rev_slider_1078_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-source="gallery"
        style="background-color: transparent; padding: 0px;">
        <!-- START REVOLUTION SLIDER 5.3.0.2 fullwidth mode -->
        <div id="rev_slider_1078_1" class="rev_slider fullwidthabanner" style="display: none;" data-version="5.3.0.2">
            <ul>
                @foreach ($banners as $slider)
                    <li data-index="rs-2" data-transition="random" data-slotamount="7" data-masterspeed="500"
                        data-thumb="" data-saveperformance="off" data-title="02" class="tp-revslider-slidesli"
                        style="width: 100%; height: 100%; overflow: hidden;">
                        <!-- Main Image Layer 0-->
                        <div class="slotholder"
                            style="position:absolute; top:0px; left:0px; z-index:0;width:100%;height:100%;">
                            <a href="{{ $slider->post_link }}">
                                <div class="tp-bgimg defaultimg "
                                    style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url(&quot;{{ $slider->image_path }}&quot;); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 0;"
                                    src="{{ $slider->image_path }}"></div>
                            </a>
                        </div>
                        <!-- LAYERS -->

                        <!--Layer 1-->
                        <div class="tp-parallax-wrap " style="position:absolute;display:block;;visibility:hidden">
                            <div class="tp-loop-wrap" style="position:absolute;display:block;;">
                                <div class="tp-mask-wrap" style="position:absolute;display:block;;">
                                    <h1 class="tp-caption NotGeneric-Title tp-resizeme"
                                        style="letter-spacing: 0px; line-height: 60px; visibility: hidden;" data-x="150"
                                        data-y="center" data-hoffset="" data-voffset="-100" data-transform_idle="o:1;"
                                        data-width="['auto','auto','auto','auto']"
                                        data-height="['auto','auto','auto','auto']"
                                        data-transform_in="y:50px;opacity:0;s:700;e:Power3.easeOut;"
                                        data-transform_out="s:500;e:Power3.easeInOut;s:500;e:Power3.easeInOut;"
                                        data-start="500" data-speed="500" data-endspeed="500" data-splitin="none"
                                        data-splitout="none" data-responsive_offset="on" id="layer-80176769">
                                        {{ $slider->title }}
                                    </h1>
                                </div>
                            </div>
                        </div>


                        <!--Layer 2-->
                        <div class="tp-parallax-wrap " style="position:absolute;display:block;;visibility:hidden">
                            <div class="tp-loop-wrap" style="position:absolute;display:block;;">
                                <div class="tp-mask-wrap" style="position:absolute;display:block;;">
                                    <h3 class="tp-caption NotGeneric-Title tp-resizeme h3 normal "
                                        style="letter-spacing: 0px; visibility: hidden;" data-x="150" data-y="center"
                                        data-hoffset="" data-voffset="0" data-transform_idle="o:1;"
                                        data-width="['auto','auto','auto','auto']"
                                        data-height="['auto','auto','auto','auto']"
                                        data-transform_in="y:50px;opacity:0;s:700;e:Power3.easeOut;"
                                        data-transform_out="s:500;e:Power3.easeInOut;s:500;e:Power3.easeInOut;"
                                        data-start="800" data-speed="500" data-endspeed="500" data-splitin="none"
                                        data-splitout="none" data-responsive_offset="on" id="layer-915794933">
                                        {{ $slider->description }}
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <!--Layer 3-->
                        <div class="tp-parallax-wrap " style="position:absolute;display:block;;visibility:hidden">
                            <div class="tp-loop-wrap" style="position:absolute;display:block;;">
                                <div class="tp-mask-wrap" style="position:absolute;display:block;;"><a
                                        class="tp-caption NotGeneric-Title tp-resizeme btn btn-md btn-color"
                                        data-x="150" data-y="center" data-hoffset="" data-voffset="75"
                                        data-transform_idle="o:1;" data-width="['auto','auto','auto','auto']"
                                        data-height="['auto','auto','auto','auto']"
                                        data-transform_in="y:50px;opacity:0;s:700;e:Power3.easeOut;"
                                        data-transform_out="s:500;e:Power3.easeInOut;s:500;e:Power3.easeInOut;"
                                        data-start="1100" data-speed="500" data-endspeed="500" data-splitin="none"
                                        data-splitout="none" data-responsive_offset="on" id="layer-943027503"
                                        style="visibility: hidden;" href="{{ $slider->post_link }}">Chi Tiết
                                    </a></div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- End Revolution Slider -->
</section>
