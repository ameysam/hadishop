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
    <link rel="stylesheet" href="{{ asset('assets/front/nouislider.css')}}">
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
                            <form action="{{ route('front.product.index') }}" method="get">
                                <div class="header-search-wrapper search-wrapper-wide">
                                    <label for="q" class="sr-only">جستجو</label>
                                    <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="جستجوی کالا ..." value="{{ app('request')->input('q') }}">
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->
                    </div>

                    <div class="header-right">

                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="sticky-wrapper"><div class="header-bottom sticky-header">
                <div class="container">

                    @component('_layouts.front.components.categories')
                        @slot('categories', $_main_categories)
                    @endcomponent

                    @component('_layouts.front.components.menus')
                        @slot('categories', $_main_categories)
                    @endcomponent



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
                    <p class="footer-copyright">کپی رایت © 2023 تمامی حقوق محفوظ است.</p>
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
                    @component('_layouts.front.components.menus_mobile')
                    @endcomponent
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    @component('_layouts.front.components.categories_mobile')
                        @slot('categories', $_main_categories)
                    @endcomponent
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
