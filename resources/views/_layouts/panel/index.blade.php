<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{-- <title>{{ trans('layout.layout.front.title') . ' | ' . trans('layout.auth.login.page.title') }}</title> --}}
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/favicon/site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('assets/admin/css/app.css') }}" rel='stylesheet'>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">

    @stack('style_lib')
    @stack('styles')
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>

<body class="rtl" class="bg-dark">

    @yield('content')

    @yield('modal-content')

    <div class="row">
        <div class="col-12 text-center">
            شماره پشتیبانی:
            <a href="tel:+989194828722"><strong>09194828722</strong></a>
        </div>
    </div>

    <script src="{{ asset('assets/admin/js/manifest.js') }}"></script>
    <script src="{{ asset('assets/admin/js/vendor.js') }}"></script>
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>

    <script>
        window.$ = window.jQuery = jQuery;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function loading($form = null, type = 'show') {
            if (type == 'show') {
                $loading.css('display', 'block');
                if ($form) {
                    $form.css('opacity', '0.4');
                }
            } else {
                $loading.css('display', 'none');
                if ($form) {
                    $form.css('opacity', '1');
                }
            }
        }

        function show_error(jqXhr, $form) {

            if(jqXhr.responseJSON)
            {
                var $errors = jqXhr.responseJSON.errors;

                if($errors)
                {
                    $.each($errors, function (key, value) {
                        var $input = $form.find('input[name="' + key + '"]');
                        $input.addClass('is-invalid');
                        $form.find('.invalid-' + key).removeClass('d-none').html('<strong>' + value + '</strong>');
                    });
                }
                else
                {
                    $.alert({
                        title: 'خطا',
                        content: 'خطایی در سیستم رخ داده، لطفا مجددا تلاش نمایید.',
                        rtl: true,
                        closeIcon: false,
                        icon: 'fas fa-ban fa-fw text-danger',
                        theme : 'material',
                        type: 'red',
                        animationSpeed: 300,
                        animateFromElement: false,
                        animation: 'scaleY',
                        closeAnimation: 'scaleX',
                        animationBounce: 1,
                        typeAnimated: true,
                        draggable: true,
                        dragWindowBorder: true,
                        smoothContent: true,
                        buttons: {
                            confirm: {
                                text: 'بستن',
                                btnClass: 'btn-blue btn-dark',
                                action: function () {

                                }
                            }
                        }
                    });
                }
                // if(typeof $errors == "undefined")
                // {
                //     $errors = jqXhr.responseJSON;
                // }
            }
            else
            {
                $.alert({
                    title: 'خطا',
                    content: 'خطایی در سیستم رخ داده، لطفا مجددا تلاش نمایید.',
                    rtl: true,
                    closeIcon: false,
                    icon: 'fas fa-ban fa-fw text-danger',
                    theme : 'material',
                    type: 'red',
                    animationSpeed: 300,
                    animateFromElement: false,
                    animation: 'scaleY',
                    closeAnimation: 'scaleX',
                    animationBounce: 1,
                    typeAnimated: true,
                    draggable: true,
                    dragWindowBorder: true,
                    smoothContent: true,
                    buttons: {
                        confirm: {
                            text: 'بستن',
                            btnClass: 'btn-blue btn-dark',
                            action: function () {

                            }
                        }
                    }
                });
            }
        }

        function show_simple_error($form, input_key, message) {
            var $input = $form.find('input[name="' + input_key + '"]');
            $input.addClass('is-invalid');
            $form.find('.invalid-' + input_key).removeClass('d-none').find('strong').text(message);
            // $form.find('.invalid-' + input_key).removeClass('d-none').html('<strong>' + message + '</strong>');
        }

    </script>

    <script src="{{ asset('assets/pages/admin/script.js') }}"></script>

    @stack('script_lib')
    @stack('scripts')
</body>

</html>
