@extends('_layouts.admin.index')

@script(croppie/croppie.js)
@style(croppie/croppie.css)

@section('content')
    @component('_components.admin.page_title')
        @slot('title', isset($record) ? 'ویرایش کاربر' : 'تعریف کاربر جدید')
        @slot('button_title', 'ثبت')
        @slot('button_route', $form['action'])
        @slot('location_route', route('admin.user.index'))
        @slot('back_route', route('admin.user.index'))
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
                        <h4 class="box-title mb-3">اطلاعات</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'id_no')
                                    @slot('title', 'کد ملی (شماره پرسنلی)')
                                    @slot('star', true)
                                    @slot('dir', 'ltr')
                                    @slot('slot', $record->id_no ?? '')
                                @endcomponent
                            </div>

                            <div class="col-sm-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'mobile_no')
                                    @slot('title', 'شماره همراه')
                                    @slot('star', true)
                                    @slot('dir', 'ltr')
                                    @slot('slot', $record->mobile_no ?? '')
                                @endcomponent
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row">
                            <div class="col-sm-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'first_name')
                                    @slot('title', 'نام')
                                    @slot('star', true)
                                    @slot('slot', $record->first_name ?? '')
                                @endcomponent
                            </div>

                            <div class="col-sm-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'last_name')
                                    @slot('title', 'نام خانوادگی')
                                    @slot('star', true)
                                    @slot('slot', $record->last_name ?? '')
                                @endcomponent
                            </div>

                            <div class="col-sm-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'email')
                                    @slot('title', 'ایمیل')
                                    @slot('dir', 'ltr')
                                    @slot('slot', $record->email ?? '')
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
                                @slot('province_selected', old('province_id') ?? $record->province_id ?? null)
                                @slot('city_selected', old('city_id') ?? $record->city_id ?? null)
                            @endcomponent

                            <div class="col-md-6">
                                @component('_components.admin.select.radio_gender')
                                    @slot('id', 'gender')
                                    @slot('star', true)
                                    @slot('selected_value', $record->gender ?? null)
                                    @slot('title', 'جنسیت')
                                @endcomponent
                            </div>
                        </div>

                        <hr class="mb-4">
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                {{-- <div class="card">
                    <div class="card-body">
                        <h4 class="box-title mb-3">آواتار</h4>
                        @component('_components.admin.avatar')
                            @slot('img_id', 'img_avatar')
                            @slot('file_name', 'avatar')
                            @slot('input_name', 'image')
                            @isset($record)
                                @slot('img_src', $record->image(8, 8))
                            @endisset
                        @endcomponent
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title mb-3">وضعیت</h4>
                        <div class="row">
                            <div class="col-12">
                                @component('_components.admin.select.single')
                                    @slot('title', 'وضعیت')
                                    @slot('id', 'activation_status')
                                    @slot('star', true)
                                    @slot('options')
                                        @foreach ($activation_statuses as $key => $value)
                                            <option value="{{ $key }}" {{ (isset($record) && $record->activation_status == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>
                            <div class="col-12">
                                @component('_components.admin.select.single')
                                    @slot('title', 'نوع فعال سازی')
                                    @slot('id', 'activation_type')
                                    @slot('star', true)
                                    @slot('options')
                                        @foreach ($activation_types as $key => $value)
                                            <option value="{{ $key }}" {{ (isset($record) && $record->activation_type == $key) ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title mb-3">رمزعبور</h4>
                        <div class="row">
                            @isset($record)
                                <div class="col-12 mb-3">
                                    <span class="text-danger">در صورت نیاز به ویرایش رمز عبور این قسمت را کامل کنید.</span>
                                </div>
                            @endisset
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
                                    @slot('id', 'password_confirmation')
                                    @slot('type', 'password')
                                    @slot('title', 'تکرار رمزعبور')
                                    @slot('star', true)
                                    @slot('dir', 'ltr')
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('modal-content')
    {{-- @component('_components.admin.modal.avatar-modal')
        @slot('file_id', 'input_avatar')
        @slot('input_id', 'input_image')
        @slot('image_avatar', 'img_avatar')
    @endcomponent --}}
@endsection

@push('scripts')
    <script>
        $(function(){

            // $('#nationality_country').change(function(){
            //     var $this = $(this);

            //     var code = $this.children("option:selected").attr('data-code');
            //     $country_code.text(code);
            // });
        });
    </script>
@endpush
