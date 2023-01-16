@extends('_layouts.admin.index')

@section('content')
    @component('_components.admin.page_title')
        @slot('title', isset($record) ? 'ویرایش نقش' : 'تعریف نقش جدید')
        @slot('button_title', 'ثبت')
        @slot('button_route', $form['action'])
        @slot('location_route', route('admin.center.role.index', $g_center->id))
        @slot('back_route', route('admin.center.role.index', $g_center->id))
        @slot('with_assets', true)
        @slot('method', $form['method'] ?? 'post')
    @endcomponent

    <form action="#" method="post" id="form1">
        <div class="row">
            <div id="form-errors" class="col-lg-12 hide">

            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body select-all-container">
                        <div class="row">
                            <div class="col-sm-12">
                                @component('_components.admin.checkbox.select_all')
                                    @slot('id', 'select_all')
                                    @slot('title', 'انتخاب همه')
                                    @slot('value', '0')
                                    @slot('status_class', 'p-danger-o')
                                    @slot('icon_class', 'fas fa-check')
                                    @slot('input_class', 'all-checker')
                                    @slot('with_assets', true)
                                @endcomponent
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            @foreach ($permissionTitles as $permissionTitle)
                            <div class="col-sm-3 permission-title-fieldset select-all-container">
                                <div class="row permission-title">
                                    <div class="col-sm-12">
                                        @component('_components.admin.checkbox.select_all')
                                            @slot('id', 'select_all_[]')
                                            @slot('title', $permissionTitle['title'])
                                            @slot('value', '0')
                                            @slot('status_class', 'p-success-o')
                                            @slot('icon_class', 'fas fa-check')
                                            @slot('input_class', 'select-all-child all-checker')
                                        @endcomponent
                                    </div>
                                </div>
                                <div class="row permission-items">
                                    @foreach ($permissionTitle['centerPermissions'] as $permission)
                                        <div class="col-sm-12">
                                            @component('_components.admin.checkbox.simple')
                                                @slot('id', 'permissions[]')
                                                @slot('thick', true)
                                                @slot('curve', true)
                                                @slot('title', $permission->title)
                                                @slot('value', $permission->id)
                                                @slot('status_class', 'p-primary-o')
                                                @slot('input_class', 'select-all-child')
                                                @if(isset($record) && $record->permissions->contains($permission->id)))
                                                    @slot('checked', true)
                                                @elseif($permission->name == "panel-show")
                                                    @slot('checked', true)
                                                @endif
                                            @endcomponent
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-12">
                                @component('_components.admin.input.input')
                                    @slot('id', 'slug')
                                    @slot('title', 'نام')
                                    @slot('star', true)
                                    @slot('placeholder', 'فقط حروف انگلیسی (doctor, nurse, assistant)')
                                    @slot('slot', $record->slug ?? '')
                                    @slot('tooltip', 'فقط از حروف انگلیسی و خط فاصله استفاده شود به عنوان مثال: "doctor", "my-doctor", "nurse"')
                                    @slot('english_validate', true)
                                    @slot('validation_method', 'validateOnlySmallLettersDash')
                                    @if(isset($disable_edit) && $disable_edit)
                                        @slot('readonly', 'readonly')
                                    @endif
                                @endcomponent
                            </div>

                            <div class="col-sm-12">
                                @component('_components.admin.input.input')
                                    @slot('id', 'title')
                                    @slot('title', 'عنوان')
                                    @slot('star', true)
                                    @slot('slot', $record->title ?? '')
                                    @if(isset($disable_edit) && $disable_edit)
                                        @slot('readonly', 'readonly')
                                    @endif
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('styles')
<style>
    .permission-title-fieldset{
        margin-bottom: 20px;
    }
    .permission-title{
        margin-bottom: 10px;
        font-weight: bolder;
        /* color: red; */
    }
    .permission-title label{
        font-weight: bold !important;
        font-size: 16px;
    }

    .permission-items{
        margin-right: 0;
    }
</style>
@endpush
