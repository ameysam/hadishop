@extends('_layouts.admin.index')

@section('content')

@component('_components.admin.page-title')
@slot('title', 'ویرایش رمز عبور')
@slot('button_title', 'ثبت')
@slot('button_route', $form['action'])
@slot('location_route', route('admin.profile.password.edit'))
@slot('back_route', route('admin.profile.password.edit'))
@slot('with_assets', true)
@slot('method', $form['method'] ?? 'post')
@endcomponent

<form action="#" method="post" id="form1">
    <div class="row">
        <div id="form-errors" class="col-lg-12 d-none"></div>

        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-5 offset-md-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    @component('_components.admin.input')
                                    @slot('id', 'old_password')
                                    @slot('title', 'رمز عبور قدیمی')
                                    @slot('dir', 'ltr')
                                    @slot('star', true)
                                    @slot('type', 'password')
                                    @endcomponent
                                </div>

                                <div class="col-sm-12">
                                    @component('_components.admin.input')
                                    @slot('id', 'password')
                                    @slot('title', 'رمز عبور جدید')
                                    @slot('dir', 'ltr')
                                    @slot('star', true)
                                    @slot('type', 'password')
                                    @slot('placeholder', 'a-z , A-Z , 0-9 , _')
                                    @endcomponent
                                </div>

                                <div class="col-sm-12">
                                    @component('_components.admin.input')
                                    @slot('id', 'password_confirmation')
                                    @slot('title', 'تکرار رمز عبور جدید')
                                    @slot('star', true)
                                    @slot('dir', 'ltr')
                                    @slot('type', 'password')
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
