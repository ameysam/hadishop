<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ورود به سامانه {{ config('app.name') }}</title>

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
                    <div class="row">
                        <div class="col text-center">
                            <span class="font-weight-bold">ورود به حساب کاربری</span>
                        </div>
                    </div>
                    <br>
                    <form action="{{ $url }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input login-type" type="radio" name="login-by" id="loginByMobile" value="mobile" {{ (old('login-by') == 'mobile') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="loginByMobile">ورود با شناسه موبایل</label>
                                </div>
                                </div>
                                <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input login-type" type="radio" name="login-by" id="loginById" value="id" {{ (empty(old('login-by')) || old('login-by') == 'id') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="loginById">ورود با کد ملی (شماره پرسنلی)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group input-group-sm">
                                    <input type="text" class="form-control text-center @error('id') is-invalid @enderror @error('idGhost') is-invalid @enderror" id="id" name="id" value="{{ old('id') }}" placeholder="شناسه موبایل">
                                </div>
                                @error('id')
                                    <div class="alert alert-danger text-left">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group input-group-sm password-group">
                                    <input type="password" class="form-control text-center @error('password') is-invalid @enderror @error('passwordGhost') is-invalid @enderror" id="password" name="password" placeholder="رمز عبور">

                                    <span onclick="togglePasswordField(this, 'password')" class="fa fa-fw fa-eye password-toggle-icon"></span>

                                    <div class="invalid-feedback invalid-password d-none">
                                        <strong></strong>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="alert alert-danger text-left">
                                        <i class="fa fa-times"> </i>
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('passwordGhost')
                                    <div class="alert alert-danger text-left">
                                        <i class="fa fa-times"> </i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-left">
                                <input type="checkbox" id="remember" name="remember" value="1">
                                <label for="remember"> مرا به خاطر بسپار</label><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 text-left">
                                <a class="btn btn-outline-dark btn-sm" href="{{ route('register.create') }}"><i class="fas fa-user-plus"></i>&nbsp;ثبت نام</a>
                            </div>
                            <div class="col-md-6">
                                @component('_components.admin.button.button')
                                    @slot('id', 'btn-submit')
                                    @slot('title', 'ورود')
                                    @slot('type', 'submit')
                                    @slot('color', 'primary')
                                    @slot('font', 'fas fa-sign-in-alt')
                                @endcomponent
                            </div>
                            {{-- <div class="col-md-4">
                                <a href="#">فراموشی رمز عبور</a>
                            </div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- <script src="{{ mix('assets/admin/js/app.js') }}"></script> --}}
        <script src="{{ mix('assets/admin/js/manifest.js') }}"></script>
        <script src="{{ mix('assets/admin/js/vendor.js') }}"></script>
        <script src="{{ mix('assets/admin/js/app.js') }}"></script>
        {{-- <script src="{{ mix('/assets/admin/js/app.js') }}"></script> --}}

    <!-- Scripts -->
    <script>
        window.$ = window.jQuery = jQuery;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>

        $(function(){
            function onload()
            {
                var $this = $('.login-type:checked');
                var loginBy = $this.val();
                var $input = $('#id');
                if(loginBy == 'mobile')
                {
                    $input.attr('placeholder', 'شناسه موبایل');
                }
                else
                {
                    $input.attr('placeholder', 'کد ملی (شماره پرسنلی)');
                }
            }
            onload();
            $('.login-type').change(function(){
                onload();
            });

            $('input.form-control').keypress(function (e) {
                var key = e.which;
                if (key == 13)
                {
                    $('#btn-submit').trigger('click');
                    return false;
                }
            });

        });
    </script>

    <style>

    </style>
    </body>
</html>
