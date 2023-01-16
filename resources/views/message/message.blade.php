<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <link href="{{ asset('assets/admin/css/app.css') }}" rel='stylesheet'>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-4 offset-4">
                    <br>
                    <br>
                    @if (session('message'))
                        <div class="alert alert-{{ session('status') ?? 'success' }} text-center">
                            {{ session('message') }}
                        </div>
                    @endif
                    <br>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col text-center">
                            <a class="btn btn-sm btn-primary" href="{{ route('front.home.index') }}"><i class="fas fa-home"></i>&nbsp;صفحه اصلی</a>
                        </div>
                        @auth
                        <div class="col text-center">
                            <a class="btn btn-sm btn-success" href="{{ route('admin.home.index') }}"><i class="fas fa-tachometer-alt"></i>&nbsp;پنل مدیریت</a>
                        </div>
                        @endauth
                        @guest
                        <div class="col text-center">
                            <a class="btn btn-sm btn-success" href="{{ route('register.create') }}"><i class="fas fa-user-plus"></i>&nbsp;ثبت نام</a>
                        </div>
                        <div class="col text-center">
                            <a class="btn btn-sm btn-dark" href="{{ route('login.index') }}"><i class="fas fa-sign-in-alt"></i>&nbsp;ورود به سیستم</a>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ mix('assets/admin/js/manifest.js') }}"></script>
        <script src="{{ mix('assets/admin/js/vendor.js') }}"></script>
        <script src="{{ mix('assets/admin/js/app.js') }}"></script>
    </body>
</html>
