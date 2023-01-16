@extends('_layouts.admin.index')

@section('content')
    {{-- @script(tinymce/tinymce.js) --}}
    @component('_components.admin.page_title')
        @slot('title', isset($record) ? 'ویرایش مرکز' : 'تعریف مرکز جدید')
        @slot('button_title', 'ثبت')
        @slot('button_route', $form['action'])
        @slot('location_route', url()->previous())
        @slot('back_route', url()->previous())
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
                        <div class="row">
                            <div class="col-md-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'name')
                                    @slot('title', 'نام مرکز')
                                    @slot('star', true)
                                    @slot('slot', $record->name ?? '')
                                @endcomponent
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-sm-6">
                                @component('_components.admin.select.single_with_new_item')
                                    @slot('title', 'نوع مرکز')
                                    @slot('id', 'type_id')
                                    @slot('search', true)
                                    @slot('star', true)
                                    @slot('doesnt_have_default', true)
                                    @slot('options')
                                        @foreach ($center_types as $type)
                                            <option value="{{ $type->id }}" {{ (isset($record) && $record->type_id == $type->id) ? 'selected="selected"' : '' }}>{{ $type->name }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>
                            
                            <div class="col-sm-6">
                                @component('_components.admin.select.single')
                                    @slot('title', 'وضعیت')
                                    @slot('id', 'status')
                                    @slot('search', true)
                                    @slot('star', true)
                                    @slot('options')
                                        @foreach ($center_statuses as $key => $value)
                                            <option value="{{ $key }}" {{ (isset($record) && $record->status == $key) ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>

                            <div class="col-sm-12">
                                @component('_components.admin.select.multiple_with_search')
                                    @slot('name', 'admins')
                                    @slot('url', route('admin.search.auto.user'))
                                    @slot('title', 'مسئول مرکز')
                                    @if(isset($record))
                                        @slot('options')
                                            @foreach($record->admins as $user)
                                                <option value="{{ $user->id }}" selected="selected">{{ $user->full_name }} ({{ $user->id_no }})</option>
                                            @endforeach
                                        @endslot
                                    @endif
                                @endcomponent
                            </div>

                            <div class="col-md-6">
                                @component('_components.admin.input.editor')
                                    @slot('id', 'contacts')
                                    @slot('title', 'اطلاعات تماس')
                                    @slot('slot', $record->contacts ?? '')
                                @endcomponent
                            </div>
                            <div class="col-md-6">
                                @component('_components.admin.input.editor')
                                    @slot('id', 'address')
                                    @slot('title', 'آدرس')
                                    @slot('slot', $record->address ?? '')
                                @endcomponent
                            </div>

                            <div class="col-md-4">
                                <label for="file">فایل لوگو</label>
                                <input type="file" id="file" name="file" accept="image/png, image/jpeg">
                            </div>

                            @if(isset($record) && $record->file)
                                <div class="col-md-4">
                                    <div>
                                        <i data-input-name="delete_photo" title="حذف" class="fas fa-times remove-thumb-icon bg-danger rounded cursor-pointer position-absolute p-1"></i>
                                        <img src="{{ asset('/' . config('filesystems.files_link') . "/{$record->file->uploaded_name}") }}" alt="" class="img-thumbnail"  width="125px">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @component('_components.admin.map.cedar.simple')
                                    @slot('title' , 'مکان')
                                    @slot('with_assets' , true)
                                    @slot('with_address' , true)
                                    @slot('star' , true)
                                    @if(isset($record))
                                        @slot('lat' , $record->lat)
                                        @slot('lng' , $record->lng)
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
