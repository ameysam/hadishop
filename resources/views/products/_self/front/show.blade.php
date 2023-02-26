@extends('_layouts.front.index')

@section('content')

    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">خانه</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('front.product.index') }}">فروشگاه</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $record->name }}</li>
            </ol>

            {{-- <nav class="product-pager mr-auto" aria-label="Product">
                <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                    <i class="icon-angle-right"></i>
                    <span>قبلی</span>
                </a>

                <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                    <span>بعدی</span>
                    <i class="icon-angle-left"></i>
                </a>
            </nav><!-- End .pager-nav --> --}}
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="{{ $record->file_path }}"
                                        data-zoom-image="{{ $record->file_path }}"
                                        alt="{{ $record->name }}">

                                    <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure><!-- End .product-main-image -->

                                {{-- <div id="product-zoom-gallery" class="product-image-gallery">
                                    <a class="product-gallery-item active" href="#"
                                        data-image="assets/images/products/single/1.jpg"
                                        data-zoom-image="assets/images/products/single/1-big.jpg">
                                        <img src="assets/images/products/single/1-small.jpg"
                                            alt="توضیحات تصویر">
                                    </a>

                                    <a class="product-gallery-item" href="#"
                                        data-image="assets/images/products/single/2.jpg"
                                        data-zoom-image="assets/images/products/single/2-big.jpg">
                                        <img src="assets/images/products/single/2-small.jpg"
                                            alt="توضیحات تصویر">
                                    </a>

                                    <a class="product-gallery-item" href="#"
                                        data-image="assets/images/products/single/3.jpg"
                                        data-zoom-image="assets/images/products/single/3-big.jpg">
                                        <img src="assets/images/products/single/3-small.jpg"
                                            alt="توضیحات تصویر">
                                    </a>

                                    <a class="product-gallery-item" href="#"
                                        data-image="assets/images/products/single/4.jpg"
                                        data-zoom-image="assets/images/products/single/4-big.jpg">
                                        <img src="assets/images/products/single/4-small.jpg" alt="product back">
                                    </a>
                                </div><!-- End .product-image-gallery --> --}}
                            </div><!-- End .row -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $record->name }}</h1>
                            <!-- End .product-title -->

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: {{ $record->visit_count * 5 }}%;"></div><!-- End .ratings-val -->
                                </div><!-- End .ratings -->
                                {{-- <a class="ratings-text" href="#product-review-link" id="review-link">( 2 نظر
                                    )</a> --}}
                            </div><!-- End .rating-container -->

                            <div class="product-price">
                                {{ number_format($record->price) }} تومان
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                <p>
                                    {{ $record->description }}
                                    {{ $record->description }}
                                    {{ $record->description }}
                                    {{ $record->description }}
                                    {{ $record->description }}
                                    {{ $record->description }}
                                </p>
                            </div><!-- End .product-content -->

                            {{-- <div class="details-filter-row details-row-size">
                                <label>رنگ : </label>

                                <div class="product-nav product-nav-thumbs">
                                    <a href="#" class="active">
                                        <img src="assets/images/products/single/1-thumb.jpg" alt="product desc">
                                    </a>
                                    <a href="#">
                                        <img src="assets/images/products/single/2-thumb.jpg" alt="product desc">
                                    </a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .details-filter-row --> --}}

                            <div class="details-filter-row details-row-size">
                                <label>بازدید : </label>
                                {{ $record->visit_count }}
                            </div><!-- End .details-filter-row -->

                            <div style="visibility: hidden" class="details-filter-row details-row-size">
                                <label for="size">سایز : </label>
                                <div class="select-custom">
                                    <select name="size" id="size" class="form-control">
                                        <option value="#" selected="selected">سایز را انتخاب کنید</option>
                                        <option value="s">کوچک (Small)</option>
                                        <option value="m">متوسط (Medium)</option>
                                        <option value="l">بزرگ (Large)</option>
                                        <option value="xl">خیلی بزرگ (XLarge)</option>
                                    </select>
                                </div><!-- End .select-custom -->

                                <a href="#" class="size-guide"><i class="icon-th-list"></i>راهنمای اندازه</a>
                            </div><!-- End .details-filter-row -->

                            <div style="visibility: hidden" class="details-filter-row details-row-size">
                                <label for="qty">تعداد : </label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" class="form-control" value="1" min="1"
                                        max="10" step="1" data-decimals="0" required>
                                </div><!-- End .product-details-quantity -->
                            </div><!-- End .details-filter-row -->

                            <div style="visibility: hidden" class="product-details-action">
                                <a href="#" class="btn-product btn-cart"><span>افزودن به سبد خرید</span></a>

                                <div class="details-action-wrapper">
                                    <a href="#" class="btn-product btn-wishlist"
                                        title="لیست علاقه مندی"><span>افزودن
                                            به
                                            علاقه مندی</span></a>
                                    <a href="#" class="btn-product btn-compare" title="مقایسه"><span>افزودن به
                                            لیست مقایسه</span></a>
                                </div><!-- End .details-action-wrapper -->
                            </div><!-- End .product-details-action -->

                            <div class="product-details-footer">
                                <div class="product-cat text-center">
                                    <span>دسته بندی : </span>
                                    <a href="#">{{ $record->category->name ?? '' }}</a>
                                </div><!-- End .product-cat -->

                                <div class="social-icons social-icons-sm">
                                    <span class="social-label">اشتراک گذاری : </span>
                                    <a href="#" class="social-icon" title="فیسبوک" target="_blank"><i
                                            class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="توییتر" target="_blank"><i
                                            class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="اینستاگرام" target="_blank"><i
                                            class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="پینترست" target="_blank"><i
                                            class="icon-pinterest"></i></a>
                                </div>
                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab"
                            href="#product-desc-tab" role="tab" aria-controls="product-desc-tab"
                            aria-selected="true">توضیحات</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab"
                            role="tab" aria-controls="product-info-tab" aria-selected="false">اطلاعات بیشتر</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab"
                            href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab"
                            aria-selected="false">ارسال و بازگشت</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab"
                            href="#product-review-tab" role="tab" aria-controls="product-review-tab"
                            aria-selected="false">نظرات (2)</a>
                    </li> --}}
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                        aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <h3>اطلاعات محصول</h3>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید
                                سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن
                                ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید سادگی نامفهوملورم
                                ایپسوم متن ساختگی با تولید سادگی نامفهوملورم ایپسوم متن ساختگی با تولید سادگی
                                نامفهوم. </p>
                            <ul>
                                <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم </li>
                                <li>لورم ایپسوم متن ساختگی با تولید سادگی.</li>
                                <li>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم</li>
                            </ul>

                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید
                                سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید سادگی نامفهوملورم ایپسوم متن
                                ساختگی با تولید سادگی نامفهوم، لورم ایپسوم متن ساختگی با تولید سادگی نامفهوملورم
                                ایپسوم متن ساختگی با تولید سادگی نامفهوملورم ایپسوم متن ساختگی با تولید سادگی
                                نامفهوملورم ایپسوم متن ساختگی با تولید سادگی نامفهوم. </p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->

                    <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                        aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <h3>ارسال و بازگشت</h3>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید
                                سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن
                                ساختگی با تولید سادگی نامفهوم<br>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید
                                سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید سادگی نامفهوملورم ایپسوم متن
                                ساختگی با تولید سادگی نامفهوملورم ایپسوم متن ساختگی با تولید سادگی نامفهوم.</a>
                            </p>
                        </div><!-- End .product-desc-content -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane fade" id="product-review-tab" role="tabpanel"
                        aria-labelledby="product-review-link">
                        <div class="reviews">
                            <h3>نظر (2)</h3>
                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">کاربر 1</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 80%;"></div>
                                                <!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                        <span class="review-date">4 روز پیش</span>
                                    </div><!-- End .col -->
                                    <div class="col-12">
                                        <h4>عالی، سایز فوق العاده</h4>

                                        <div class="review-content">
                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم،لورم ایپسوم متن
                                                ساختگی با تولید سادگی نامفهوم، لورم ایپسوم متن ساختگی با تولید
                                                سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم!</p>
                                        </div><!-- End .review-content -->

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>مثبت (2)</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>منفی (0)</a>
                                        </div><!-- End .review-action -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->

                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">کاربر 2</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 100%;"></div>
                                                <!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                        <span class="review-date">2 روز پیش</span>
                                    </div><!-- End .col -->
                                    <div class="col-12">
                                        <h4>خیلی عالی</h4>

                                        <div class="review-content">
                                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم، لورم ایپسوم متن
                                                ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید
                                                سادگی نامفهوم.</p>
                                        </div><!-- End .review-content -->

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>مثبت (0)</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>منفی (0)</a>
                                        </div><!-- End .review-action -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->
                        </div><!-- End .نظر -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">محصولاتی که شاید بپسندید</h2><!-- End .title text-center -->

            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "rtl": true,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>

                @foreach ($records as $item)
                    @component('products._self.front.item')
                        @slot('item', $item)
                    @endcomponent
                @endforeach

            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->

@endsection
