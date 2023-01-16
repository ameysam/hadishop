@extends('_layouts.admin.index')

@script(croppie/croppie.js)
@style(croppie/croppie.css)

@section('content')

@component('_components.admin.page-title')
    @slot('title', 'ویرایش اطلاعات')
    @slot('button_title', 'ثبت')
    @slot('button_route', $form['action'])
    @slot('location_route', route('admin.profile.doctor.edit'))
    @slot('back_route', route('admin.profile.doctor.edit'))
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
                    <h4 class="box-title mb-3">اطلاعات پزشکی</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            @component('_components.admin.input')
                                @slot('id', 'specialty_title_fa')
                                @slot('title', 'عنوان تخصص فارسی')
                                @slot('star', true)
                                @slot('slot', $record->specialty_title_fa ?? '')
                            @endcomponent
                        </div>
                        <div class="col-sm-6">
                            @component('_components.admin.input')
                                @slot('id', 'specialty_title_en')
                                @slot('title', 'عنوان تخصص انگلیسی')
                                @slot('dir', 'ltr')
                                @slot('star', true)
                                @slot('slot', $record->specialty_title_en ?? '')
                            @endcomponent
                        </div>
                        <div class="col-sm-6">
                            @component('_components.admin.input')
                                @slot('id', 'medical_system_no')
                                @slot('title', 'شماره نظام پزشکی')
                                @slot('dir', 'ltr')
                                @slot('star', true)
                                @slot('slot', $record->medical_system_no ?? '')
                            @endcomponent
                        </div>
                        <div class="col-sm-6">
                            @component('_components.admin.persian-datepicker')
                                @slot('id', 'medical_license_expire_at')
                                @slot('title', 'تاریخ انقضای پروانه پزشکی')
                                @slot('star', true)
                                @slot('with_assets', true)
                                @slot('value_j', (isset($record) && $record->medical_license_expire_at) ? jdate($record->medical_license_expire_at)->format('Y/m/d') : null)
                                @slot('value_g', $record->medical_license_expire_at ?? null)
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title mb-3">تصویر مهر</h4>
                    @component('_components.admin.image-croper')
                        @slot('img_id', 'img_avatar')
                        @slot('file_name', 'avatar')
                        @slot('input_name', 'stamp_image')
                        @slot('img_src', $record ? $record->imageStamp() : null)
                    @endcomponent
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title mb-3">تصویر امضا</h4>
                    @component('_components.admin.image-croper')
                        @slot('img_id', 'img_avatar1')
                        @slot('file_name', 'avatar1')
                        @slot('input_name', 'signature_image')
                        @slot('img_src', $record ? $record->imageSignature() : null)
                    @endcomponent
                </div>
            </div>

        </div>
    </div>
</form>
@endsection

@section('modal-content')
    @component('_components.admin.modal.image-croper-modal')
        @slot('id', 'mdlCropStamp')
        @slot('id_count', '1')
        @slot('file_id', 'input_avatar')
        @slot('input_id', 'input_stamp_image')
        @slot('image_avatar', 'img_avatar')
    @endcomponent
    @component('_components.admin.modal.image-croper-modal')
        @slot('id', 'mdlCropSignature')
        @slot('id_count', '2')
        @slot('file_id', 'input_avatar1')
        @slot('input_id', 'input_signature_image')
        @slot('image_avatar', 'img_avatar1')
    @endcomponent
@endsection

@push('scripts')
    <script>


    </script>
@endpush


@push('styles')
    <style>
        .input-group-text {
            direction: ltr;
            letter-spacing: 1px;
        }
    </style>
@endpush
