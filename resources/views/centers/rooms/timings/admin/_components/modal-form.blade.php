<div class="modal" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title float-right">جلسه جدید</h5>
          <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div id="div-selected-times" class="row number-fa">
                <div class="col-3"><i class="fa fa-calendar text-gray"> </i> روز <br><span id="spn-selected-day"></span></div>
                <div class="col-3"><i class="fa fa-clock text-gray"> </i> از <br><span id="spn-selected-start-time"></span></div>
                <div class="col-3"><i class="fa fa-clock text-gray"> </i> تا <br><span id="spn-selected-finish-time"></span></div>
                <div class="col-3">
                    <br>
                    <button id="btn-append-item" type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><i class="fas fa-edit"></i>&nbsp;ویرایش زمان</button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-10">
                    <input type="hidden" name="force_save" id="force_save" value="0">
                    @component('_components.admin.input.input')
                        @slot('id', 'name')
                        @slot('title', 'نام رویداد')
                        @slot('star', true)
                        @slot('slot', $record->name ?? '')
                    @endcomponent
                </div>
                <div class="col-2">
                    @component('_components.admin.input.input')
                        @slot('id', 'color')
                        @slot('type', 'color')
                        @slot('title', 'رنگ')
                        @slot('star', true)
                        @slot('slot', $record->color ?? '#dc3545')
                    @endcomponent
                </div>
                <div class="col-12">
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
                </div>
                <div class="col-12">
                    @component('_components.admin.select.multiple_with_search')
                        @slot('name', 'users')
                        @slot('url', route('admin.search.auto.user'))
                        @slot('title', 'اعضا')
                        @if(isset($record))
                            @slot('options')
                                @foreach($record->users as $user)
                                    <option value="{{ $user->id }}" selected="selected">{{ $user->full_name }} ({{ $user->id_no }})</option>
                                @endforeach
                            @endslot
                        @endif
                    @endcomponent
                </div>
                <div class="col-12">
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
                </div>
                <div class="col-12">
                    @component('_components.admin.input.editor')
                        @slot('id', 'description')
                        @slot('title', 'توضیحات')
                        @slot('rows', 2)
                        @slot('slot', $record->description ?? '')
                    @endcomponent
                </div>
                <div class="col-12">
                    <div class="row">
                        @foreach($periodic_types as $periodic_type_key => $periodic_type_value)
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
                                    @slot('input_class', '')
                                    @if (!$periodic_type_key)
                                        @slot('checked', true)
                                    @endif
                                @endcomponent
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" id="btn-register-events" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i>&nbsp;ثبت</button>
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>&nbsp;انصراف</button>
        </div>
      </div>
    </div>
  </div>
</form>
