<!DOCTYPE html>
<html dir="rtl" style="" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>
    <meta name="keywords" content="{{ config('app.name') }}">
    <meta name="description" content="{{ config('app.name') }}">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="https://filenter.ir/molla/assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://filenter.ir/molla/assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://filenter.ir/molla/assets/images/icons/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('assets/front/images/site.webmanifest')}}">
    <link rel="mask-icon" href="https://filenter.ir/molla/assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="https://filenter.ir/molla/assets/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('assets/front/line-awesome.min.css')}}">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/front/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/jquery.countdown.css')}}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/front/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/skin-demo-4.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/front/demo-4.css')}}">
</head>

<body class="loaded" style="overflow-x: hidden;">
    <div class="page-wrapper">
        <header class="header header-intro-clearance header-4">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <a href="https://filenter.ir/molla/tel_3A#"><i class="icon-phone"></i>تلفن تماس : 02155667788</a>
                    </div><!-- End .header-left -->

                    <div class="header-right">

                        <ul class="top-menu">
                            <li>
                                <a href="#">لینک ها</a>
                                <ul>
                                    <li>
                                        <div class="header-dropdown">
                                            {{-- <a href="#">تومان</a>
                                            <div class="header-menu">
                                                <ul>
                                                    <li><a href="#">دلار</a></li>
                                                    <li><a href="#">تومان</a></li>
                                                </ul>
                                            </div><!-- End .header-menu --> --}}
                                        </div>
                                    </li>
                                    <li>
                                        <div class="header-dropdown">
                                            {{-- <a href="#">فارسی</a>
                                            <div class="header-menu">
                                                <ul>
                                                    <li><a href="#">انگلیسی</a></li>
                                                    <li><a href="#">فرانسوی</a></li>
                                                    <li><a href="#">ترکی استانبولی</a></li>
                                                </ul>
                                            </div><!-- End .header-menu --> --}}
                                        </div><!-- End .header-dropdown -->
                                    </li>
                                    {{-- <li><a href="#signin-modal" data-toggle="modal">ورود / ثبت نام</a></li> --}}
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->

                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">فهرست</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="{{ route('front.home.index') }}" class="logo">
                            <img src="{{ asset('assets/front/logo.png')}}" alt="Molla Logo" width="105" height="25">
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                            <form action="#" method="get">
                                <div class="header-search-wrapper search-wrapper-wide">
                                    <label for="q" class="sr-only">جستجو</label>
                                    <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="جستجوی محصول ..." required="">
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->
                    </div>

                    <div class="header-right">
                        {{-- <div class="dropdown compare-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="مقایسه محصولات" aria-label="Compare Products">
                                <div class="icon">
                                    <i class="icon-random"></i>
                                </div>
                                <p>مقایسه</p>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="compare-products">
                                    <li class="compare-product">
                                        <a href="#" class="btn-remove" title="حذف محصول"><i class="icon-close"></i></a>
                                        <h4 class="compare-product-title"><a href="https://filenter.ir/molla/product.html">گوشی سامسونگ مدل S9</a>
                                        </h4>
                                    </li>
                                    <li class="compare-product">
                                        <a href="#" class="btn-remove" title="حذف محصول"><i class="icon-close"></i></a>
                                        <h4 class="compare-product-title"><a href="https://filenter.ir/molla/product.html">گوشی سامسونگ مدل S8</a>
                                        </h4>
                                    </li>
                                </ul>

                                <div class="compare-actions">
                                    <a href="#" class="action-link">حذف همه</a>
                                    <a href="https://filenter.ir/molla/compare.html" class="btn btn-outline-primary-2"><span>مقایسه</span><i class="icon-long-arrow-left"></i></a>
                                </div>
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .compare-dropdown -->

                        <div class="wishlist">
                            <a href="https://filenter.ir/molla/wishlist.html" title="لیست محصولات مورد علاقه شما">
                                <div class="icon">
                                    <i class="icon-heart-o"></i>
                                    <span class="wishlist-count badge">3</span>
                                </div>
                                <p>علاقه مندی</p>
                            </a>
                        </div> --}}
                        <!-- End .compare-dropdown -->

                        {{-- <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <div class="icon">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="cart-count">2</span>
                                </div>
                                <p>سبد خرید</p>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-cart-products">
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="https://filenter.ir/molla/product.html">کتونی ورزشی مخصوص دویدن رنگ بژ</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty">1 x </span>
                                                84,000 تومان
                                            </span>
                                        </div><!-- End .product-cart-details -->

                                        <figure class="product-image-container">
                                            <a href="https://filenter.ir/molla/product.html" class="product-image">
                                                <img src="{{ asset('assets/front/product-1.jpg')}}" alt="product">
                                            </a>
                                        </figure>
                                        <a href="#" class="btn-remove" title="حذف محصول"><i class="icon-close"></i></a>
                                    </div><!-- End .product -->

                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="https://filenter.ir/molla/product.html">لباس زنانه آبی</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty">1 x </span>
                                                76,000 تومان
                                            </span>
                                        </div><!-- End .product-cart-details -->

                                        <figure class="product-image-container">
                                            <a href="https://filenter.ir/molla/product.html" class="product-image">
                                                <img src="{{ asset('assets/front/product-2_002.jpg')}}" alt="product">
                                            </a>
                                        </figure>
                                        <a href="#" class="btn-remove" title="حذف محصول"><i class="icon-close"></i></a>
                                    </div><!-- End .product -->
                                </div><!-- End .cart-product -->

                                <div class="dropdown-cart-total">
                                    <span>مجموع</span>

                                    <span class="cart-total-price">160,000 تومان</span>
                                </div><!-- End .dropdown-cart-total -->

                                <div class="dropdown-cart-action">
                                    <a href="https://filenter.ir/molla/cart.html" class="btn btn-primary">مشاهده سبد خرید</a>
                                    <a href="https://filenter.ir/molla/checkout.html" class="btn btn-outline-primary-2"><span>پرداخت</span><i class="icon-long-arrow-left"></i></a>
                                </div><!-- End .dropdown-cart-total -->
                            </div><!-- End .dropdown-menu -->
                        </div> --}}
                        <!-- End .cart-dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="sticky-wrapper"><div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-left">
                        <div class="dropdown category-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="دسته بندی فروشگاه">
                                فهرست دسته بندی ها <i class="icon-angle-down"></i>
                            </a>

                            <div class="dropdown-menu">
                                <nav class="side-nav">
                                    <ul class="menu-vertical sf-arrows sf-js-enabled" style="touch-action: pan-y;">
                                        @foreach ($categories as $item)
                                        <li class="item-lead"><a href="#">{{ $item->name }}</a></li>
                                        {{-- <li><a href="#">تخت خواب</a></li> --}}
                                        @endforeach
                                    </ul><!-- End .menu-vertical -->
                                </nav><!-- End .side-nav -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .category-dropdown -->
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <nav class="main-nav">
                            <ul class="menu sf-arrows sf-js-enabled" style="touch-action: pan-y;">
                                <li class="megamenu-container active">
                                    <a href="{{ route('front.home.index') }}" class="sf-with-ul">خانه</a>
                                </li>
                                <li>
                                    <a href="https://filenter.ir/molla/category.html" class="sf-with-ul">فروشگاه</a>

                                    <div class="megamenu megamenu-md" style="display: none;">
                                        <div class="row no-gutters">
                                            <div class="col-md-8">
                                                <div class="menu-col">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="menu-title">فروشگاه با سایدبار</div>
                                                            <!-- End .menu-title -->
                                                            <ul>
                                                                <li><a href="https://filenter.ir/molla/category-list.html">فروشگاه لیست</a></li>
                                                                <li><a href="https://filenter.ir/molla/category-2cols.html">فروشگاه 2 ستونه</a>
                                                                </li>
                                                                <li><a href="https://filenter.ir/molla/category.html">فروشگاه 3 ستونه</a></li>
                                                                <li><a href="https://filenter.ir/molla/category-4cols.html">فروشگاه 4 ستونه</a>
                                                                </li>
                                                                <li><a href="https://filenter.ir/molla/category-market.html"><span>فروشگاه
                                                                            بازار<span class="tip tip-new">جدید</span></span></a>
                                                                </li>
                                                            </ul>

                                                            <div class="menu-title">فروشگاه بدون سایدبار</div>
                                                            <!-- End .menu-title -->
                                                            <ul>
                                                                <li><a href="https://filenter.ir/molla/category-boxed.html"><span>فروشگاه با حالت
                                                                            باکس<span class="tip tip-hot">ویژه</span></span></a>
                                                                </li>
                                                                <li><a href="https://filenter.ir/molla/category-fullwidth.html">فروشگاه تمام
                                                                        صفحه</a></li>
                                                            </ul>
                                                        </div><!-- End .col-md-6 -->

                                                        <div class="col-md-6">
                                                            <div class="menu-title">دسته بندی محصولات</div>
                                                            <!-- End .menu-title -->
                                                            <ul>
                                                                <li><a href="https://filenter.ir/molla/product-category-boxed.html">دسته بندی
                                                                        محصولات با حالت باکس</a></li>
                                                                <li><a href="https://filenter.ir/molla/product-category-fullwidth.html"><span>دسته
                                                                            بندی محصولات تمام صفحه<span class="tip tip-new">جدید</span></span></a>
                                                                </li>
                                                            </ul>
                                                            <div class="menu-title">صفحات فروشگاه</div>
                                                            <!-- End .menu-title -->
                                                            <ul>
                                                                <li><a href="https://filenter.ir/molla/cart.html">سبد خرید</a></li>
                                                                <li><a href="https://filenter.ir/molla/cart2.html">سبد خرید 2</a></li>
                                                                <li><a href="https://filenter.ir/molla/cart-empty.html">سبد خرید خالی</a></li>
                                                                <li><a href="https://filenter.ir/molla/checkout.html">پرداخت</a></li>
                                                                <li><a href="https://filenter.ir/molla/checkout2.html">پرداخت 2</a></li>
                                                                <li><a href="https://filenter.ir/molla/compare.html">مقایسه محصولات</a></li>
                                                                <li><a href="https://filenter.ir/molla/compare2.html">مقایسه محصولات 2</a></li>
                                                                <li><a href="https://filenter.ir/molla/wishlist.html">لیست علاقه مندی ها</a></li>
                                                                <li><a href="https://filenter.ir/molla/gift-cart.html">کارت هدیه</a></li>
                                                                <li><a href="https://filenter.ir/molla/dashboard.html">داشبورد</a></li>

                                                            </ul>
                                                        </div><!-- End .col-md-6 -->
                                                    </div><!-- End .row -->
                                                </div><!-- End .menu-col -->
                                            </div><!-- End .col-md-8 -->

                                            <div class="col-md-4">
                                                <div class="banner banner-overlay">
                                                    <a href="https://filenter.ir/molla/category.html" class="banner banner-menu">
                                                        <img src="{{ asset('assets/front/banner-1.jpg')}}" alt="Banner">

                                                        <div class="banner-content banner-content-top">
                                                            <div class="banner-title text-white">آخرین
                                                                <br>شانس<br><span><strong>فروش</strong></span></div>
                                                            <!-- End .banner-title -->
                                                        </div><!-- End .banner-content -->
                                                    </a>
                                                </div><!-- End .banner banner-overlay -->
                                            </div><!-- End .col-md-4 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .megamenu megamenu-md -->
                                </li>
                                <li>
                                    <a href="https://filenter.ir/molla/product.html" class="sf-with-ul">محصول</a>

                                    <div class="megamenu megamenu-sm" style="display: none;">
                                        <div class="row no-gutters">
                                            <div class="col-md-6">
                                                <div class="menu-col">
                                                    <div class="menu-title">جزئیات محصول</div>
                                                    <!-- End .menu-title -->
                                                    <ul>
                                                        <li><a href="https://filenter.ir/molla/product.html">پیش فرض</a></li>
                                                        <li><a href="https://filenter.ir/molla/product-centered.html">توضیحات وسط چین</a></li>
                                                        <li><a href="https://filenter.ir/molla/product-extended.html"><span>توضیحات گسترده<span class="tip tip-new">جدید</span></span></a></li>
                                                        <li><a href="https://filenter.ir/molla/product-gallery.html">گالری</a></li>
                                                        <li><a href="https://filenter.ir/molla/product-sticky.html">اطلاعات چسبیده</a></li>
                                                        <li><a href="https://filenter.ir/molla/product-sidebar.html">صفحه جمع با سایدبار</a></li>
                                                        <li><a href="https://filenter.ir/molla/product-fullwidth.html">تمام عرض</a></li>
                                                        <li><a href="https://filenter.ir/molla/product-masonry.html">اطلاعات چسبیده</a></li>
                                                    </ul>
                                                </div><!-- End .menu-col -->
                                            </div><!-- End .col-md-6 -->

                                            <div class="col-md-6">
                                                <div class="banner banner-overlay">
                                                    <a href="https://filenter.ir/molla/category.html">
                                                        <img src="{{ asset('assets/front/banner-2.jpg')}}" alt="Banner">

                                                        <div class="banner-content banner-content-bottom">
                                                            <div class="banner-title text-white">محصولات
                                                                جدید<br><span><strong>بهار 1401</strong></span>
                                                            </div><!-- End .banner-title -->
                                                        </div><!-- End .banner-content -->
                                                    </a>
                                                </div><!-- End .banner -->
                                            </div><!-- End .col-md-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .megamenu megamenu-sm -->
                                </li>
                                <li>
                                    <a href="#" class="sf-with-ul">صفحات </a>

                                    <ul style="display: none;">
                                        <li>
                                            <a href="https://filenter.ir/molla/about.html" class="sf-with-ul">درباره ما</a>

                                            <ul style="display: none;">
                                                <li><a href="https://filenter.ir/molla/about.html">درباره ما 01</a></li>
                                                <li><a href="https://filenter.ir/molla/about-2.html">درباره ما 02</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="https://filenter.ir/molla/contact.html" class="sf-with-ul">تماس با ما</a>

                                            <ul style="display: none;">
                                                <li><a href="https://filenter.ir/molla/contact.html">تماس با ما 01</a></li>
                                                <li><a href="https://filenter.ir/molla/contact-2.html">تماس با ما 02</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="https://filenter.ir/molla/invoice-template/invoice-template.html" class="sf-with-ul">قالب
                                                فاکتور</a>

                                            <ul style="display: none;">
                                                <li><a href="https://filenter.ir/molla/invoice-template/invoice-template.html">قالب فاکتور 01</a></li>
                                                <li><a href="https://filenter.ir/molla/invoice-template/invoice-template2.html">قالب فاکتور 02</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="https://filenter.ir/molla/email-template/email-template.html" class="sf-with-ul">قالب
                                                ایمیل</a>

                                            <ul style="display: none;">
                                                <li><a href="https://filenter.ir/molla/email-template/email-template.html">قالب ایمیل 01</a>
                                                </li>
                                                <li><a href="https://filenter.ir/molla/email-template/email-order-success.html">قالب ایمیل 02 - سفارش موفق</a>
                                                </li>
                                                <li><a href="https://filenter.ir/molla/email-template/email-promotional.html">قالب ایمیل 03</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="https://filenter.ir/molla/login.html">ورود</a></li>
                                        <li><a href="https://filenter.ir/molla/forget-password.html">فراموشی رمز عبور</a></li>
                                        <li><a href="https://filenter.ir/molla/track-order.html">پیگیری سفارش</a></li>
                                        <li><a href="https://filenter.ir/molla/faq.html">سوالات متداول</a></li>
                                        <li><a href="https://filenter.ir/molla/404.html">خطای 404</a></li>
                                        <li><a href="https://filenter.ir/molla/coming-soon.html">به زودی</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="https://filenter.ir/molla/blog.html" class="sf-with-ul">اخبار</a>

                                    <ul style="display: none;">
                                        <li><a href="https://filenter.ir/molla/blog.html">کلاسیک</a></li>
                                        <li><a href="https://filenter.ir/molla/blog-listing.html">لیست</a></li>
                                        <li>
                                            <a href="#" class="sf-with-ul">شبکه بندی</a>
                                            <ul style="display: none;">
                                                <li><a href="https://filenter.ir/molla/blog-grid-2cols.html">2 ستونه</a></li>
                                                <li><a href="https://filenter.ir/molla/blog-grid-3cols.html">3 ستونه</a></li>
                                                <li><a href="https://filenter.ir/molla/blog-grid-4cols.html">4 ستونه</a></li>
                                                <li><a href="https://filenter.ir/molla/blog-grid-sidebar.html">با سایدبار</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="sf-with-ul">سایز های مختلف</a>
                                            <ul style="display: none;">
                                                <li><a href="https://filenter.ir/molla/blog-masonry-2cols.html">2 ستونه</a></li>
                                                <li><a href="https://filenter.ir/molla/blog-masonry-3cols.html">3 ستونه</a></li>
                                                <li><a href="https://filenter.ir/molla/blog-masonry-4cols.html">4 ستونه</a></li>
                                                <li><a href="https://filenter.ir/molla/blog-masonry-sidebar.html">با سایدبار</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="sf-with-ul">ماسک</a>
                                            <ul style="display: none;">
                                                <li><a href="https://filenter.ir/molla/blog-mask-grid.html">نوع 1</a></li>
                                                <li><a href="https://filenter.ir/molla/blog-mask-masonry.html">نوع 2</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="sf-with-ul">پست تکی</a>
                                            <ul style="display: none;">
                                                <li><a href="https://filenter.ir/molla/single.html">پیش فرض با سایدبار</a></li>
                                                <li><a href="https://filenter.ir/molla/single-fullwidth.html">تمام صفحه بدون سایدبار</a></li>
                                                <li><a href="https://filenter.ir/molla/single-fullwidth-sidebar.html">تمام صفحه باسایدبار</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="https://filenter.ir/molla/elements-list.html" class="sf-with-ul">عناصر طراحی</a>

                                    <ul style="display: none;">
                                        <li><a href="https://filenter.ir/molla/elements-products.html">محصولات</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-typography.html">تایپوگرافی</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-titles.html">عناوین</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-banners.html">بنرها</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-product-category.html">دسته بندی محصولات</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-video-banners.html">بنرهای ویدیویی</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-buttons.html">دکمه ها</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-accordions.html">آکاردئون</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-lookbook.html">لوک بوک</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-tabs.html">تب ها</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-testimonials.html">توصیف و نقل قول</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-blog-posts.html">اخبار</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-portfolio.html">نمونه کار</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-cta.html">پاسخ به عمل</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-icon-boxes.html">باکس های آیکون</a></li>
                                    </ul>
                                </li>
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-center -->

                    <div class="header-right">
                        <i class="la la-lightbulb-o"></i>
                        <p>خرید<span class="highlight">&nbsp;تا 30 درصد تخفیف</span></p>
                    </div>
                </div><!-- End .container -->
            </div></div><!-- End .header-bottom -->
        </header><!-- End .header -->

        <main class="main">
            @yield('content')
        </main><!-- End .main -->

        <footer class="footer">
            <div class="cta bg-image bg-dark pt-4 pb-5 mb-0" style="background-image: url({{ asset('assets/front/images/bg-5.jpg') }});">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-10 col-md-8 col-lg-6">
                            <div class="cta-heading text-center">
                                <h3 class="cta-title text-white">دریافت آخرین پیشنهادات</h3><!-- End .cta-title -->
                                <p class="cta-desc text-white text-center">و دریافت <span class="font-weight-normal">کد
                                        تخفیف 20 هزار تومانی</span> برای اولین خرید</p><!-- End .cta-desc -->
                            </div><!-- End .text-center -->

                            <form action="#">
                                <div class="input-group input-group-round">
                                    <input type="email" class="form-control form-control-white" placeholder="آدرس ایمیل خود را وارد کنید" aria-label="Email Adress" required="">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><span>عضویت</span><i class="icon-long-arrow-left"></i></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                        </div><!-- End .col-sm-10 col-md-8 col-lg-6 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .cta -->
            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="widget widget-about">
                                <img src="{{ asset('assets/front/logo-footer.png')}}" class="footer-logo" alt="Footer Logo" width="105" height="25">
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با تولید سادگی
                                    نامفهوم. </p>

                                <div class="widget-call">
                                    <i class="icon-phone"></i>
                                    سوالی دارید؟ 7روز هفته/24ساعته
                                    <a href="tel:#">02155667788</a>
                                </div><!-- End .widget-call -->
                            </div><!-- End .widget about-widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">لینک های مفید</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="https://filenter.ir/molla/about.html">درباره ما</a></li>
                                    <li><a href="#">خدمات</a></li>
                                    <li><a href="#">نحوه خرید</a></li>
                                    <li><a href="https://filenter.ir/molla/faq.html">سوالات متداول</a></li>
                                    <li><a href="https://filenter.ir/molla/contact.html">تماس با ما</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">خدمات مشتری</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="#">شیوه پرداخت</a></li>
                                    <li><a href="#">گارانتی بازگشت وجه</a></li>
                                    <li><a href="#">شیوه ارسال محصولات</a></li>
                                    <li><a href="#">قوانین و مقررات</a></li>
                                    <li><a href="#">خط مشی</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3">
                            <div class="widget">
                                <h4 class="widget-title">حساب کاربری</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="#">ورود</a></li>
                                    <li><a href="https://filenter.ir/molla/cart.html">سبد خرید</a></li>
                                    <li><a href="#">لیست علاقه مندی ها</a></li>
                                    <li><a href="#">پیگیری سفارشات</a></li>
                                    <li><a href="#">راهنما</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-middle -->

            <div class="footer-bottom">
                <div class="container">
                    <p class="footer-copyright">کپی رایت © 2019 تمامی حقوق محفوظ است.</p>
                    <!-- End .footer-copyright -->

                    <div class="social-icons social-icons-color">
                        <span class="social-label">شبکه های اجتماعی</span>
                        <a href="#" class="social-icon social-facebook" title="فیسبوک" target="_blank"><i class="icon-facebook-f"></i></a>
                        <a href="#" class="social-icon social-twitter" title="توییتر" target="_blank"><i class="icon-twitter"></i></a>
                        <a href="#" class="social-icon social-instagram" title="اینستاگرام" target="_blank"><i class="icon-instagram"></i></a>
                        <a href="#" class="social-icon social-youtube" title="یوتیوب" target="_blank"><i class="icon-youtube"></i></a>
                        <a href="#" class="social-icon social-pinterest" title="پینترست" target="_blank"><i class="icon-pinterest"></i></a>
                    </div><!-- End .soial-icons -->
                </div><!-- End .container -->
            </div>
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="بازگشت به بالا"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">جستجو</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="جستجو در ..." required="">
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">منو</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">دسته بندی ها</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="active">
                                <a href="{{ route('front.home.index') }}">خانه<span class="mmenu-btn"></span></a>

                                <ul>
                                    <li><a href="{{ route('front.home.index') }}">01 - فروشگاه مبلمان</a></li>
                                    <li><a href="https://filenter.ir/molla/index-2.html">02 - فروشگاه مبلمان</a></li>
                                    <li><a href="https://filenter.ir/molla/index-3.html">03 - فروشگاه لوازم الکترونیکی</a></li>
                                    <li><a href="https://filenter.ir/molla/index-4.html">04 - فروشگاه لوازم الکترونیکی</a></li>
                                    <li><a href="https://filenter.ir/molla/index-5.html">05 - فروشگاه مد و لباس</a></li>
                                    <li><a href="https://filenter.ir/molla/index-6.html">06 - فروشگاه مد و لباس</a></li>
                                    <li><a href="https://filenter.ir/molla/index-7.html">07 - فروشگاه مد و لباس</a></li>
                                    <li><a href="https://filenter.ir/molla/index-8.html">08 - فروشگاه مد و لباس</a></li>
                                    <li><a href="https://filenter.ir/molla/index-9.html">09 - فروشگاه مد و لباس</a></li>
                                    <li><a href="https://filenter.ir/molla/index-10.html">10 - فروشگاه کفش</a></li>
                                    <li><a href="https://filenter.ir/molla/index-11.html">11 - فروشگاه مبل</a></li>
                                    <li><a href="https://filenter.ir/molla/index-12.html">12 - فروشگاه مد</a></li>
                                    <li><a href="https://filenter.ir/molla/index-13.html">13 - بازار</a></li>
                                    <li><a href="https://filenter.ir/molla/index-14.html">14 - بازار تمام عرض</a></li>
                                    <li><a href="https://filenter.ir/molla/index-15.html">15 - مد و زیبایی</a></li>
                                    <li><a href="https://filenter.ir/molla/index-16.html">16 - مد و زیبایی</a></li>
                                    <li><a href="https://filenter.ir/molla/index-17.html">17 - فروشگاه مد و لباس</a></li>
                                    <li><a href="https://filenter.ir/molla/index-18.html">18 - فروشگاه مد (با سایدبار)</a></li>
                                    <li><a href="https://filenter.ir/molla/index-19.html">19 - فروشگاه بازی</a></li>
                                    <li><a href="https://filenter.ir/molla/index-20.html">20 - فروشگاه کتاب</a></li>
                                    <li><a href="https://filenter.ir/molla/index-21.html">21 - فروشگاه ورزشی</a></li>
                                    <li><a href="https://filenter.ir/molla/index-22.html">22 - فروشگاه ابزار</a></li>
                                    <li><a href="https://filenter.ir/molla/index-23.html">23 - فروشگاه مد با نوبار سمت راست</a></li>
                                    <li><a href="https://filenter.ir/molla/index-24.html">24 - فروشگاه ورزشی</a></li>
                                    <li><a href="https://filenter.ir/molla/index-25.html">25 - فروشگاه زیورآلات</a></li>
                                    <li><a href="https://filenter.ir/molla/index-26.html">26 - فروشگاه بازار</a></li>
                                    <li><a href="https://filenter.ir/molla/index-27.html">27 - فروشگاه مُد</a></li>
                                    <li><a href="https://filenter.ir/molla/index-28.html">28 - فروشگاه مواد غذایی</a></li>
                                    <li><a href="https://filenter.ir/molla/index-29.html">29 - فروشگاه تی شرت</a></li>
                                    <li><a href="https://filenter.ir/molla/index-30.html">30 - فروشگاه هدفون</a></li>
                                    <li><a href="https://filenter.ir/molla/index-31.html">31 - فروشگاه یوگا</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="https://filenter.ir/molla/category.html">فروشگاه<span class="mmenu-btn"></span></a>
                                <ul>
                                    <li><a href="https://filenter.ir/molla/category-list.html">فروشگاه لیست</a></li>
                                    <li><a href="https://filenter.ir/molla/category-2cols.html">2 ستونه</a></li>
                                    <li><a href="https://filenter.ir/molla/category.html">3 ستونه</a></li>
                                    <li><a href="https://filenter.ir/molla/category-4cols.html">4 ستونه</a></li>
                                    <li><a href="https://filenter.ir/molla/category-boxed.html"><span>فروشگاه با حالت بسته بدون سایدبار<span class="tip tip-hot">ویژه</span></span></a></li>
                                    <li><a href="https://filenter.ir/molla/category-fullwidth.html">فروشگاه تمام عرض بدون سایدبار</a></li>
                                    <li><a href="https://filenter.ir/molla/product-category-boxed.html">دسته بندی محصولات با حالت بسته</a></li>
                                    <li><a href="https://filenter.ir/molla/product-category-fullwidth.html"><span>دسته بندی محصولات تمام عرض<span class="tip tip-new">جدید</span></span></a></li>
                                    <li><a href="https://filenter.ir/molla/cart.html">سبد خرید</a></li>
                                    <li><a href="https://filenter.ir/molla/checkout.html">پرداخت</a></li>
                                    <li><a href="https://filenter.ir/molla/checkout2.html">پرداخت 2</a></li>
                                    <li><a href="https://filenter.ir/molla/compare.html">مقایسه محصولات</a></li>
                                    <li><a href="https://filenter.ir/molla/compare2.html">مقایسه محصولات 2</a></li>
                                    <li><a href="https://filenter.ir/molla/wishlist.html">لیست علاقه مندی</a></li>
                            <li><a href="https://filenter.ir/molla/gift-cart.html">کارت هدیه</a></li>
                                    <li><a href="https://filenter.ir/molla/dashboard.html">داشبورد</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="https://filenter.ir/molla/product.html" class="sf-with-ul">محصولات<span class="mmenu-btn"></span></a>
                                <ul>
                                    <li><a href="https://filenter.ir/molla/product.html">پیش فرض</a></li>
                                    <li><a href="https://filenter.ir/molla/product-centered.html">توضیحات وسط چین</a></li>
                                    <li><a href="https://filenter.ir/molla/product-extended.html"><span>توضیحات گسترده<span class="tip tip-new">جدید</span></span></a></li>
                                    <li><a href="https://filenter.ir/molla/product-gallery.html">گالری</a></li>
                                    <li><a href="https://filenter.ir/molla/product-sticky.html">اطلاعات چسبیده</a></li>
                                    <li class=""><a href="https://filenter.ir/molla/product-sidebar.html">صفحه جمع با سایدبار</a></li>
                                    <li><a href="https://filenter.ir/molla/product-fullwidth.html">تمام صفحه</a></li>
                                    <li><a href="https://filenter.ir/molla/product-masonry.html">اطلاعات چسبیده</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">صفحات<span class="mmenu-btn"></span></a>
                                <ul>
                                    <li>
                                        <a href="https://filenter.ir/molla/about.html" class="sf-with-ul">درباره ما<span class="mmenu-btn"></span></a>

                                        <ul style="display: none;">
                                            <li><a href="https://filenter.ir/molla/about.html">درباره ما 01</a></li>
                                            <li><a href="https://filenter.ir/molla/about-2.html">درباره ما 02</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="https://filenter.ir/molla/contact.html" class="sf-with-ul">تماس با ما<span class="mmenu-btn"></span></a>

                                        <ul style="display: none;">
                                            <li><a href="https://filenter.ir/molla/contact.html">تماس با ما 01</a></li>
                                            <li><a href="https://filenter.ir/molla/contact-2.html">تماس با ما 02</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="https://filenter.ir/molla/login.html">ورود</a></li>
                                        <li><a href="https://filenter.ir/molla/forget-password.html">فراموشی رمز عبور</a></li>
                                    <li><a href="https://filenter.ir/molla/track-order.html">پیگیری سفارش</a></li>
                                    <li><a href="https://filenter.ir/molla/faq.html">سوالات متداول</a></li>
                                    <li><a href="https://filenter.ir/molla/404.html">خطای 404</a></li>
                                    <li><a href="https://filenter.ir/molla/coming-soon.html">به زودی</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="https://filenter.ir/molla/blog.html">اخبار<span class="mmenu-btn"></span></a>

                                <ul>
                                    <li class=""><a href="https://filenter.ir/molla/blog.html">کلاسیک</a></li>
                                    <li><a href="https://filenter.ir/molla/blog-listing.html">لیست</a></li>
                                    <li>
                                        <a href="#" class="sf-with-ul">شبکه بندی<span class="mmenu-btn"></span></a>
                                        <ul style="display: none;">
                                            <li><a href="https://filenter.ir/molla/blog-grid-2cols.html">2 ستونه</a></li>
                                            <li><a href="https://filenter.ir/molla/blog-grid-3cols.html">3 ستونه</a></li>
                                            <li><a href="https://filenter.ir/molla/blog-grid-4cols.html">4 ستونه</a></li>
                                            <li><a href="https://filenter.ir/molla/blog-grid-sidebar.html">با سایدبار</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" class="sf-with-ul">سایز های مختلف<span class="mmenu-btn"></span></a>
                                        <ul style="display: none;">
                                            <li><a href="https://filenter.ir/molla/blog-masonry-2cols.html">2 ستونه</a></li>
                                            <li><a href="https://filenter.ir/molla/blog-masonry-3cols.html">3 ستونه</a></li>
                                            <li><a href="https://filenter.ir/molla/blog-masonry-4cols.html">4 ستونه</a></li>
                                            <li><a href="https://filenter.ir/molla/blog-masonry-sidebar.html">با سایدبار</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" class="sf-with-ul">ماسک<span class="mmenu-btn"></span></a>
                                        <ul style="display: none;">
                                            <li><a href="https://filenter.ir/molla/blog-mask-grid.html">نوع 1</a></li>
                                            <li><a href="https://filenter.ir/molla/blog-mask-masonry.html">نوع 2</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" class="sf-with-ul">پست تکی<span class="mmenu-btn"></span></a>
                                        <ul style="display: none;">
                                            <li><a href="https://filenter.ir/molla/single.html">پیش فرض با سایدبار</a></li>
                                            <li><a href="https://filenter.ir/molla/single-fullwidth.html">تمام صفحه بدون سایدبار</a></li>
                                            <li><a href="https://filenter.ir/molla/single-fullwidth-sidebar.html">تمام صفحه باسایدبار</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="https://filenter.ir/molla/elements-list.html">عناصر طراحی<span class="mmenu-btn"></span></a>
                                <ul>
                                    <li class=""><a href="https://filenter.ir/molla/elements-products.html">محصولات</a></li>
                                    <li><a href="https://filenter.ir/molla/elements-typography.html">تایپوگرافی</a></li>
                                    <li><a href="https://filenter.ir/molla/elements-titles.html">عناوین</a></li>
                                    <li><a href="https://filenter.ir/molla/elements-banners.html">بنرها</a></li>

                                    <li><a href="https://filenter.ir/molla/elements-product-category.html">دسته بندی محصولات</a></li>
                                    <li><a href="https://filenter.ir/molla/elements-video-banners.html">بنرهای ویدیویی</a></li>
                                    <li><a href="https://filenter.ir/molla/elements-buttons.html">دکمه ها</a></li>
                                    <li><a href="https://filenter.ir/molla/elements-accordions.html">آکاردئون</a></li>
                                        <li><a href="https://filenter.ir/molla/elements-lookbook.html">لوک بوک</a></li>
                                    <li><a href="https://filenter.ir/molla/elements-tabs.html">تب ها</a></li>
                                    <li><a href="https://filenter.ir/molla/elements-testimonials.html">توصیف و نقل قول</a></li>
                                    <li><a href="https://filenter.ir/molla/elements-blog-posts.html">اخبار</a></li>
                                    <li><a href="https://filenter.ir/molla/elements-portfolio.html">نمونه کار</a></li>
                                    <li><a href="https://filenter.ir/molla/elements-cta.html">پاسخ به عمل</a></li>
                                    <li><a href="https://filenter.ir/molla/elements-icon-boxes.html">باکس های آیکون</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav><!-- End .mobile-nav -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        <ul class="mobile-cats-menu">
                            <li><a class="mobile-cats-lead" href="#">پیشنهاد روزانه</a></li>
                            <li><a class="mobile-cats-lead" href="#">هدیه</a></li>
                            <li><a href="#">تخت خواب</a></li>
                            <li><a href="#">روشنایی</a></li>
                            <li><a href="#">مبلمان</a></li>
                            <li><a href="#">فضای ذخیره سازی</a></li>
                            <li><a href="#">میز وصندلی</a></li>
                            <li><a href="#">دکور </a></li>
                            <li><a href="#">کابینت</a></li>
                            <li><a href="#">قهوه</a></li>
                            <li><a href="#">مبلمان خارج از منزل </a></li>
                        </ul><!-- End .mobile-cats-menu -->
                    </nav><!-- End .mobile-cats-nav -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="فیسبوک"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="توییتر"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="اینستاگرام"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="یوتیوب"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">ورود</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">ثبت نام</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="singin-email">نام کاربری یا آدرس ایمیل *</label>
                                            <input type="text" class="form-control" id="singin-email" name="singin-email" required="">
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">رمز عبور *</label>
                                            <input type="password" class="form-control" id="singin-password" name="singin-password" required="">
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>ورود</span>
                                                <i class="icon-long-arrow-left"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">مرا به خاطر
                                                    بسپار</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="#" class="forgot-link">فراموشی رمز عبور؟</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">یا ورود با</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    حساب گوگل
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    حساب فیسبوک
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="register-email">آدرس ایمیل شما *</label>
                                            <input type="email" class="form-control" id="register-email" name="register-email" required="">
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">رمز عبور *</label>
                                            <input type="password" class="form-control" id="register-password" name="register-password" required="">
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>ثبت نام</span>
                                                <i class="icon-long-arrow-left"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required="">
                                                <label class="custom-control-label" for="register-policy">با
                                                    <a href="#">قوانین و مقررات </a>موافقم *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">یا عضویت با</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    حساب گوگل
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    حساب فیسبوک
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->

    <!-- Plugins JS File -->
    <script src="{{ asset('assets/front/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/front/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/front/jquery.hoverIntent.min.js')}}"></script>
    <script src="{{ asset('assets/front/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('assets/front/superfish.min.js')}}"></script>
    <script src="{{ asset('assets/front/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('assets/front/bootstrap-input-spinner.js')}}"></script>
    <script src="{{ asset('assets/front/jquery.plugin.min.js')}}"></script>
    <script src="{{ asset('assets/front/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('assets/front/jquery.countdown.min.js')}}"></script>
    <!-- Main JS File -->
    <script src="{{ asset('assets/front/main.js')}}"></script>
    <script src="{{ asset('assets/front/demo-4.js')}}"></script>


    @stack('script_lib')
    @stack('scripts')

</body>
</html>
