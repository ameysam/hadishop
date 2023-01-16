<div class="modal" id="mdl-form" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title float-right">رويداد جدید</h5>
          <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="frm-event" action="" method="POST">
                <div class="row">
                    <div class="col-12">
                        @component('_components.admin.input.input')
                            @slot('id', 'name')
                            @slot('title', 'نام رویداد')
                            @slot('star', true)
                            @slot('slot', $record->name ?? '')
                        @endcomponent
                    </div>
                    {{-- <div class="col-2">
                        @component('_components.admin.input.input')
                            @slot('id', 'color')
                            @slot('type', 'color')
                            @slot('title', 'رنگ')
                            @slot('star', true)
                            @slot('slot', $record->color ?? '#dc3545')
                        @endcomponent
                    </div> --}}
                    <div class="col-md-6">
                        @component('_components.admin.datepicker.persian_datepicker')
                            @slot('id', 'day')
                            @slot('title', 'تاريخ')
                            @slot('star', true)
                            @slot('with_assets', true)
                            @slot('value_j', null)
                            @slot('value_g', null)
                        @endcomponent
                    </div>
                    </div>
                    <div class="row">
                    <div class="col number-fa">
                        @component('_components.admin.input.input')
                            @slot('id', 'started_time')
                            @slot('type', 'time')
                            @slot('title', 'شروع')
                            @slot('star', true)
                        @endcomponent
                    </div>
                    <div class="col number-fa">
                        @component('_components.admin.input.input')
                            @slot('id', 'finished_time')
                            @slot('type', 'time')
                            @slot('title', 'پایان')
                        @endcomponent
                    </div>
                    {{-- <div class="col-12">
                        @component('_components.admin.select.single_live_search')
                            @slot('id', 'secretary_id')
                            @slot('url', route('admin.search.auto.user'))
                            @slot('title', 'دبیر')
                            @if(isset($record) && $record->secretary)
                                @slot('options')
                                    <option value="{{ $record->secretary->id }}" selected="selected">{{ $record->secretary->full_name }} ({{ $record->secretary->id_no }})</option>
                                @endslot
                            @endif
                        @endcomponent
                    </div> --}}
                    {{-- <div class="col-md-6">
                        @component('_components.admin.datepicker.persian_datepicker')
                            @slot('id', 'started_at')
                            @slot('title', 'تاريخ شروع')
                            @slot('star', true)
                            @slot('with_assets', true)
                            @slot('time', true)
                            @slot('value_j', isset($record) ? (jdate($record->started_date)->format('Y/m/d') . ' - ' . jdate($record->finished_date)->format('Y/m/d')) : null)
                            @slot('value_g', isset($record) ? ("{$record->started_date} - {$record->finished_date}") : null)
                        @endcomponent
                    </div>
                    <div class="col-md-6">
                        @component('_components.admin.datepicker.persian_datepicker')
                            @slot('id', 'finished_at')
                            @slot('title', 'تاريخ پايان')
                            @slot('time', true)
                            @slot('value_j', isset($record) ? (jdate($record->started_date)->format('Y/m/d') . ' - ' . jdate($record->finished_date)->format('Y/m/d')) : null)
                            @slot('value_g', isset($record) ? ("{$record->started_date} - {$record->finished_date}") : null)
                        @endcomponent
                    </div> --}}
                    <div class="col-12">
                        @component('_components.admin.select.multiple_with_search')
                            @slot('name', 'users')
                            @slot('taggable', true)
                            @slot('url', route('admin.search.auto.user'))
                            @slot('title', 'اعضا')
                            {{-- @if(isset($record))
                                @slot('options')
                                    @foreach($record->users as $user)
                                        <option value="{{ $user->id }}" selected="selected">{{ $user->full_name }} ({{ $user->id_no }})</option>
                                    @endforeach
                                @endslot
                            @endif --}}
                        @endcomponent
                    </div>
                    <div class="col-12">
                        @component('_components.admin.select.single_live_search')
                            @slot('id', 'room_id')
                            @slot('url', route('admin.search.auto.centers-rooms'))
                            @slot('title')
                                مرکز و اتاق 
                                &nbsp;<span type="button" class="float-left" id="btn-remove-selected-room"><i class="fas fa-trash btn-sm text-danger" title="حذف مرکز و اتاق"></i></span>
                            @endslot
                        @endcomponent
                    </div>
                    {{-- <div class="col-12">
                        @component('_components.admin.select.multiple_with_search')
                            @slot('name', 'roles')
                            @slot('url', route('admin.center.role.search', $g_center->id))
                            @slot('title', 'نقش‌ها(چارت سازمانی)')
                            @if(isset($record))
                                @slot('options')
                                    @foreach($record->roles as $role)
                                        <option value="{{ $role->id }}" selected="selected">{{ $role->title }}</option>
                                    @endforeach
                                @endslot
                            @endif
                        @endcomponent
                    </div> --}}
                    <div class="col-12">
                        @component('_components.admin.input.editor')
                            @slot('id', 'description')
                            @slot('title', 'توضیحات')
                            @slot('rows', 2)
                            @slot('slot', $record->description ?? '')
                        @endcomponent
                    </div>
                    <div class="col-12 div-periodic-section">
                        <div class="row">
                            <div class="col-12">
                                @component('_components.admin.checkbox.with_font')
                                    @slot('id', "periodic_type_0")
                                    @slot('name', "periodic_type")
                                    @slot('type', 'radio')
                                    @slot('jelly', true)
                                    @slot('round', true)
                                    @slot('title', 'بدون تکرار')
                                    @slot('value', '0')
                                    @slot('status_class', 'p-primary-o')
                                    @slot('icon_class', 'fas fa-check')
                                    @slot('input_class', 'periodic_type')
                                    @slot('checked', true)
                                @endcomponent
                            </div>

                            @foreach($periodic_types as $periodic_type_key => $periodic_type_value)
                                @if ($periodic_type_key == 0)
                                    @continue
                                @endif
                                <div class="col">
                                    @component('_components.admin.checkbox.with_font')
                                        @slot('id', "periodic_type_{$periodic_type_key}")
                                        @slot('name', "periodic_type")
                                        @slot('type', 'radio')
                                        @slot('jelly', true)
                                        @slot('round', true)
                                        @slot('title', $periodic_type_value)
                                        @slot('value', $periodic_type_key)
                                        @slot('status_class', 'p-primary-o')
                                        @slot('icon_class', 'fas fa-check')
                                        @slot('input_class', 'periodic_type')
                                        {{-- @if (!$periodic_type_key)
                                            @slot('checked', true)
                                        @endif --}}
                                    @endcomponent
                                </div>
                            @endforeach
                        </div>
                        <div class="row div-step-count">
                            <div class="col-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'step_count')
                                    @slot('type', 'number')
                                    @slot('min', '1')
                                    @slot('max', '365')
                                    @slot('title', 'تعداد تکرار')
                                    @slot('slot', 1)
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" id="btn-register-events" class="btn btn-sm btn-success" data-method="POST"><i class="fas fa-check-circle"></i>&nbsp;ثبت</button>
            <button type="button" id="btn-delete-events" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>&nbsp;حذف</button>
            <button type="button" class="btn btn-sm btn-warning text-light" data-dismiss="modal"><i class="fas fa-times-circle"></i>&nbsp;انصراف</button>
        </div>
      </div>
    </div>
  </div>
</form>

@push('scripts')
    <script>
        // $('.periodic_type').
        $(function(){
            $('.div-step-count').hide();

            $('.periodic_type').change(function(){
                if($(this).val() != '0'){
                    $('.div-step-count').show();
                }
                else
                {
                    $('.div-step-count').hide();
                }
            });
        });
    </script>
@endpush
