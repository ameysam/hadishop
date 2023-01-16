<td class="align-middle selectable day-{{ $day }} row-{{$step}} coll-{{$col}} meeting-{{$meeting_id ?? 'not'}}" data-row="{{$step}}" data-start={{$start_time}} data-finish={{$finish_time}} data-col="{{$col}}" id="{{ $day }}_{{ $start_time_ }}-{{ $finish_time_ }}">
    <span class="spn-title"></span>
    <div class="data-day" data-day="{{ $day }}"></div>
    <div class="data-step" data-step="{{ $step }}"></div>
    <div class="data-started-time" data-started-time="{{ $start_time }}"></div>
    <div class="data-finished-time" data-finished-time="{{ $finish_time }}"></div>
    <div class="data-section">

    </div>
    {{-- <input type="hidden" name="days[]" value="{{ $day }}">
    <input type="hidden" name="start_time_{{ $day }}[]" value="{{ $start_time }}">
    <input type="hidden" name="finish_time_{{ $day }}[]" value="{{ $finish_time }}">
    <input type="hidden" class="meeting-name" name="meeting_name_{{ $day }}[]" value=""> --}}
</td>
