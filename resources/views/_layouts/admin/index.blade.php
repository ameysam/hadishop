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

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/admin/images/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/admin/images/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/admin/images/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/admin/images/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/admin/images/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/admin/images/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/admin/images/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/admin/images/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/admin/images/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/admin/images/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/admin/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/admin/images/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/admin/images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/admin/images/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/admin/images/favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('assets/admin/images/favicon/site.webmanifest') }}">
    <link href="{{ asset('assets/admin/css/app.css') }}" rel='stylesheet'>
    <link href="{{ asset('assets/admin/css/extra.css') }}" rel='stylesheet'>

    @stack('style_lib')
    @stack('styles')
    @stack('style')

    <style>
        .a-disabled {
            cursor: not-allowed;
            pointer-events: none;
            color: #bbb !important;
        }
        .a-disabled i {
            color: #bbb !important;
        }
    </style>
</head>

<body class="rtl">
    <!-- Left Panel -->
    @include('_layouts/admin/includes/sidebar')
    <!-- /#left-panel -->

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
    <script>
        window.$ = window.jQuery = jQuery;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    {{-- <script src="{{ asset('assets/pages/admin/script.js') }}"></script> --}}

    @stack('script_lib')
    @stack('scripts')
</body>
</html>
