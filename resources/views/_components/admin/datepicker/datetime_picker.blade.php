@if(isset($with_assets))
    @script(md-bootstrap-datepicker/jquery.md.bootstrap.datetimepicker.js)
    @style(md-bootstrap-datepicker/jquery.md.bootstrap.datetimepicker.style.css)
@endif

<div class="form-group">
    <label for="{{ $name ?? $id}}">
        @isset($star)
            <span class="text-danger forced_input">*</span>
        @endisset
        {{ $title }} :</label>
    <div class="input-group">
        <input type="text" readonly name="{{ $name ?? $id}}"
               id="{{ $name ?? $id}}" class="form-control date_time_picker_input"
               data-MdDateTimePicker="true"
               data-TargetSelector="#{{ $name ?? $id}}"
               data-EnableTimePicker="{{ isset($time) ? 'true' : ''}}" data-Placement="{{$direction ?? 'right'}}"
               {{ isset($date) ? 'data-FromDateCustom=' . $date[0] . ' data-ToDateCustom=' . $date[1] : '' }}
               data-Trigger="click"
               value="{{ $value ?? $slot ?? ''}}">
        <span class="input-group-addon date-remover"
              title="حذف تاریخ" style="color:#a94442">X</span>
    </div>
</div>
