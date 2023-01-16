<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    {{--<meta charset="utf-8">--}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{$_page_title ?? 'مدیریت'}}</title> --}}
    <title>{{ config('app.name') }}</title>
    <meta name="author" content="میثم علیپور">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/favicon/site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link href="{{ asset('assets/admin/css/app.css') }}" rel='stylesheet'>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

    @stack('style_lib')
    @stack('styles')
    @stack('style')
</head>

<body class="rtl">
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        @include('_layouts/admin/includes/header')
        <!-- /#header -->

        @include('_components.admin.breadcrumb')

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                @yield('content')

                @yield('modal-content')
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>

        <!-- Footer -->
        @include('_layouts/admin/includes/footer')
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <script src="{{ asset('assets/admin/js/manifest.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>

    <!-- Scripts -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script> --}}

    <script>
        window.$ = window.jQuery = jQuery;
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ asset('assets/pages/admin/script.js') }}"></script>

    @stack('script_lib')
    @stack('scripts')
</body>
</html>
