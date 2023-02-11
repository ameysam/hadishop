{{-- http://www.shreethemes.in/landrick/layouts/index-digital-agency.html --}}

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>iMedFolder - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Premium Bootstrap 4 Landing Page Template" />
    <meta name="keywords" content="bootstrap 4, premium, marketing, multipurpose" />
    <meta name="author" content="Shreethemes" />
    <meta name="Version" content="2.1" />
    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- Magnific -->
    {{-- <link href="{{ asset('assets/front/css/magnific-popup.css') }}" rel="stylesheet" type="text/css" /> --}}
    <!-- Slider -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/front/css/owl.theme.default.min.css') }}" /> --}}
    <!-- Main Css -->
    {{-- <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet" type="text/css" id="theme-opt" /> --}}
    {{-- <link href="{{ asset('assets/front/css/default.css') }}" rel="stylesheet" id="color-opt"> --}}

    <link href="{{ asset('assets/front/css/app.css') }}" rel="stylesheet" type="text/css" id="theme-opt" />
    <link href="{{ asset('assets/front/css/extra.css') }}" rel="stylesheet" type="text/css"/>

    @stack('style_lib')
    @stack('styles')
</head>

<body class="rtl">
    <!-- Navbar STart -->
    <header id="topnav" class="defaultscroll sticky">
        <div class="container">
            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <!-- Logo container-->
            <div>
                <a class="logo" href="{{ route('front.home.index') }}">iMedFolder</a>
            </div>

            <div class="buy-button">
                <a href="{{ route('login.index') }}" class="btn btn-pills btn-primary mb-2">ورود </a>
                <a href="{{ route('register.index') }}" class="btn btn-pills btn-success mb-2">ثبت نام
                    سامانه</a>

            </div>
            <!--end login button-->

            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li><a href="{{ route('front.home.index') }}">صفحه اصلی</a></li>

                    <li><a href="{{ route('front.about-us.index') }}">درباره ما</a></li>

                    <li><a href="{{ route('front.contact.index') }}">تماس با ما</a></li>

                    <li><a href="{{ route('front.cooporation.index') }}">همکاری با ما</a></li>
                </ul>
                <!--end navigation menu-->
                <!--end login button-->
            </div>
            <!--end navigation-->
        </div>
        <!--end container-->
    </header>
    <!--end header-->
    <!-- Navbar End -->

    @yield('content')

    <footer class="footer footer-bar">
        <div class="container text-center">
            <div class="row align-items-center">
                <div class="col-md-4 col-sm-12 text-sm-center">
                    Copyright &copy; 2021 <a class="text-decoration" href="{{ route('front.home.index') }}">Meetings</a>
                </div>
                <div class="col-md-4 col-sm-12">
                    شماره پشتیبانی:
                    <a href="tel:+989194828722"><strong>09194828722</strong></a>
                </div>
                <div class="col-md-4 col-sm-12 text-sm-center">
                    طراحی و پیاده سازی توسط <a class="text-decoration text-info" href="{{ route('front.home.index') }}">داده‌پرداز پویا</a>
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </footer>
    <!--end footer-->
    <!-- Footer End -->

    <!-- Back to top -->
    <a href="#" class="back-to-top rounded text-center" id="back-to-top">
        <i data-feather="chevron-up" class="icons d-inline-block"></i>
    </a>
    <!-- Back to top -->

    <!-- Javascript -->
    <script src="{{ asset('assets/front/js/manifest.js') }}"></script>
    <script src="{{ asset('assets/front/js/vendor.js') }}"></script>
    <script src="{{ asset('assets/front/js/unicons-monochrome.js') }}"></script>
    <!-- Main Js -->
    <script src="{{ asset('assets/front/js/app.js') }}"></script>
    <script src="{{ asset('assets/front/js/glider.min.js') }}"></script>

    @stack('script_lib')
    @stack('scripts')
</body>

</html>
