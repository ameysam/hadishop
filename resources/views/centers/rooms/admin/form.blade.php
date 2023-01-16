@extends('_layouts.admin.index')

@section('content')
    {{-- @script(tinymce/tinymce.js) --}}
    @component('_components.admin.page_title')
        @slot('title', isset($record) ? 'ویرایش اتاق' : 'تعریف اتاق جدید')
        @slot('button_title', 'ثبت')
        @slot('button_route', $form['action'])
        {{-- @slot('location_route', route('admin.center.room.index', $g_center->id))
        @slot('back_route', route('admin.center.room.index', $g_center->id)) --}}
        @slot('location_route', route('admin.center.show', $g_center->id))
        @slot('back_route', route('admin.center.show', $g_center->id))
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
                                    @slot('title', 'نام اتاق')
                                    @slot('star', true)
                                    @slot('slot', $record->name ?? '')
                                @endcomponent
                            </div>
                            <div class="col-sm-6">
                                @component('_components.admin.select.single')
                                    @slot('title', 'نوع اتاق')
                                    @slot('id', 'type')
                                    @slot('star', true)
                                    @slot('options')
                                        @foreach ($room_types as $key => $value)
                                            <option value="{{ $key }}" {{ (isset($record) && $record->type == $key) ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>
                            <div class="col-sm-6">
                                @component('_components.admin.select.single')
                                    @slot('title', 'زمان‌بندی')
                                    @slot('id', 'schedule_id')
                                    @slot('options')
                                        @foreach ($schedules as $item)
                                            <option value="{{ $item->id }}" {{ (isset($record) && $record->schedule_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>
                            <div class="col-md-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'capacity')
                                    @slot('type', 'number')
                                    @slot('title', 'ظرفیت')
                                    {{-- @slot('star', true) --}}
                                    @slot('slot', $record->capacity ?? '')
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @component('_components.admin.input.editor')
                                    @slot('id', 'description')
                                    @slot('title', 'توضیحات')
                                    @slot('slot', $record->description ?? '')
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
