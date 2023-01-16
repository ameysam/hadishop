@extends('_layouts.admin.index')


@section('content')

@component('_components.admin.page_title')
    @slot('title', 'ویرایش اطلاعات')
    @slot('button_title', 'ثبت')
    @slot('button_route', $form['action'])
    @slot('location_route', route('admin.profile.edit'))
    @slot('back_route', route('admin.home.index'))
    @slot('with_assets', true)
    @slot('method', $form['method'] ?? 'post')
@endcomponent

<form action="#" method="post" id="form1">
    <div class="row">
        <div id="form-errors" class="col-lg-12 d-none">

        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title mb-3">اطلاعات شناسایی</h4>
                    <div class="row">
                        <div class="col-6">
                            @component('_components.admin.input.input_post')
                                @slot('id', 'mobile_no')
                                @slot('title', 'شماره همراه')
                                @slot('star', true)
                                @slot('slot', $record->mobile_no ?? '')
                            @endcomponent
                        </div>
                        <div class="col-6">
                            @component('_components.admin.input.input_post')
                                @slot('id', 'id_no')
                                @slot('title', 'کد ملی (شماره پرسنلی)')
                                @slot('star', true)
                                @slot('slot', $record->id_no ?? '')
                            @endcomponent
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="row">
                        <div class="col-6">
                            @component('_components.admin.input.input_post')
                                @slot('id', 'first_name')
                                @slot('title', 'نام')
                                @slot('star', true)
                                @slot('slot', $record->first_name ?? '')
                            @endcomponent
                        </div>
                        <div class="col-6">
                            @component('_components.admin.input.input_post')
                                @slot('id', 'last_name')
                                @slot('title', 'نام خانوادگی')
                                @slot('star', true)
                                @slot('slot', $record->last_name ?? '')
                            @endcomponent
                        </div>
                        <div class="col-6">
                            @component('_components.admin.input.input_post')
                                @slot('id', 'email')
                                @slot('title', 'ایمیل')
                                @slot('star', true)
                                @slot('dir', 'rtl')
                                @slot('slot', $record->email ?? '')
                            @endcomponent
                        </div>
                        <div class="col-md-6">
                            @component('_components.admin.select.radio_gender')
                                @slot('id', 'gender')
                                @slot('star', true)
                                @slot('selected_value', $record->gender ?? null)
                                @slot('title', 'جنسیت')
                            @endcomponent
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-3">

        </div> --}}

        <div class="col-lg-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title mb-3">لوکیشن</h4>
                            <div class="row">
                                @component('_components.admin.select.province_cities')
                                    @slot('record', $record ?? null)
                                    @slot('first_call', true)
                                    @slot('star', true)
                                    @slot('size', '12')
                                    @slot('province_title', 'استان')
                                    @slot('city_title', 'شهر')
                                    @slot('province_id', 'province_id')
                                    @slot('city_id', 'city_id')
                                    @slot('province_selected', $record->province_id ?? null)
                                    @slot('city_selected', $record->city_id ?? null)
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="box-title mb-3">رمزعبور</h4>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <span class="text-danger">در صورت نیاز به ویرایش رمز عبور این قسمت را کامل کنید.</span>
                                </div>
                                <div class="col-12">
                                    @component('_components.admin.input.input_post')
                                        @slot('id', 'password')
                                        @slot('type', 'password')
                                        @slot('title', 'رمزعبور')
                                        @slot('star', true)
                                        @slot('dir', 'ltr')
                                        @endcomponent
                                    </div>
                                    <div class="col-12">
                                        @component('_components.admin.input.input_post')
                                        @slot('dir', 'ltr')
                                        @slot('id', 'password_confirmation')
                                        @slot('type', 'password')
                                        @slot('title', 'تکرار رمزعبور')
                                        @slot('star', true)
                                    @endcomponent
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
