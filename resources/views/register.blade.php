<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ثبت نام {{ config('app.name') }}</title>

        <!-- Fonts -->

        <link href="{{ asset('assets/admin/css/app.css') }}" rel='stylesheet'>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-8 offset-2">
                    <br>
                    {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-md-4 offset-md-4 text-center">
                            <span class="font-weight-bold">ثبت نام</span>
                        </div>
                    </div>
                    <br>
                    <form id="frm-register" action="{{ $url }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                @component('_components.admin.input.input_post')
                                    @slot('id', 'first_name')
                                    @slot('title', 'نام')
                                    @slot('star', true)
                                    @slot('slot', old('first_name') ?? '')
                                @endcomponent
                            </div>
                            <div class="col-6">
                                @component('_components.admin.input.input_post')
                                    @slot('id', 'last_name')
                                    @slot('title', 'نام خانوادگی')
                                    @slot('star', true)
                                    @slot('slot', old('last_name') ?? '')
                                @endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                @component('_components.admin.input.input_post')
                                    @slot('id', 'mobile_no')
                                    @slot('title', 'شماره همراه')
                                    @slot('star', true)
                                    @slot('slot', old('mobile_no') ?? '')
                                @endcomponent
                            </div>
                            <div class="col-6">
                                @component('_components.admin.input.input_post')
                                    @slot('id', 'id_no')
                                    @slot('title', 'کد ملی (شماره پرسنلی)')
                                    @slot('star', true)
                                    @slot('slot', old('id_no') ?? '')
                                @endcomponent
                            </div>
                        </div>
                        <div class="row">
                           <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6 email-div">
                                        @component('_components.admin.input.input_post')
                                            @slot('id', 'email')
                                            @slot('title', 'ایمیل')
                                            @slot('star', true)
                                            @slot('dir', 'rtl')
                                            @slot('slot', old('email') ?? '')
                                        @endcomponent
                                    </div>
                                    @component('_components.admin.select.province_cities')
                                        @slot('record', $record ?? null)
                                        @slot('first_call', true)
                                        @slot('star', true)
                                        @slot('size', '6')
                                        @slot('province_title', 'استان')
                                        @slot('city_title', 'شهر')
                                        @slot('province_id', 'province_id')
                                        @slot('city_id', 'city_id')
                                        @slot('province_selected', old('province_id'))
                                        @slot('city_selected', old('city_id'))
                                    @endcomponent
                               </div>
                           </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                @component('_components.admin.input.input_post')
                                    @slot('id', 'password')
                                    @slot('type', 'password')
                                    @slot('title', 'رمزعبور')
                                    @slot('star', true)
                                @endcomponent
                            </div>
                            <div class="col-6">
                                @component('_components.admin.input.input_post')
                                    @slot('id', 'password_confirmation')
                                    @slot('type', 'password')
                                    @slot('title', 'تکرار رمزعبور')
                                    @slot('star', true)
                                @endcomponent
                            </div>
                        </div>
                        <div class="row text-left">
                            @foreach ($activation_types as $key => $value)
                                <div class="col-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input activation-type" type="radio" name="activation_type" id="activationBy{{ $key }}" value="{{ $key }}" {{ (empty(old('activation_type')) || old('activation_type') == $key) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="activationBy{{ $key }}">{{ $value }}</label>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-6 offset-6">
                                <div class="row">
                                    <div class="col-md-6 text-left">
                                        <a class="btn btn-outline-dark btn-sm" href="{{ route('login.index') }}"><i class="fas fa-sign-in-alt align-middle"></i> اکانت دارم برو به صفحه لاگین</a>
                                    </div>
                                    <div class="col-md-6">
                                        @component('_components.admin.button.button')
                                            @slot('title', 'ثبت نام')
                                            @slot('type', 'submit')
                                            @slot('color', 'primary')
                                            @slot('font', 'fas fa-user-plus')
                                        @endcomponent
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="{{ mix('assets/admin/js/manifest.js') }}"></script>
        <script src="{{ mix('assets/admin/js/vendor.js') }}"></script>
        <script src="{{ mix('assets/admin/js/app.js') }}"></script>

        <script>
            window.$ = window.jQuery = jQuery;

            $(function(){
                function onload()
                {
                    var $this = $('.activation-type:checked');
                    var loginBy = $this.val();
                    var $input = $('.email-div');
                    if(loginBy == '1')
                    {
                        $input.find('.forced_input').addClass('d-none');
                    }
                    else
                    {
                        $input.find('.forced_input').removeClass('d-none');
                    }
                }
                onload();
                $('.activation-type').change(function(){
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

                $('#frm-register').submit(function(){
                // $('#btn-submit').click(function(){
                    $('#btn-submit').attr("disabled", true);
                });
            });
        </script>
        @stack('script_lib')
        @stack('scripts')
    </body>
</html>
