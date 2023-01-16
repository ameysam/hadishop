@php
    if(isset($value) && $value != ''){
        if((isset($enable_current_time) && $enable_current_time == true) || isset($disable_timepicker)){
            $date = $value;
        }else{
            $datetime = explode(' ', $value);
            $date = $datetime[0] . ' 00:00:00';
        }
    }

@endphp

@if(isset($with_assets) && $with_assets == true)
    @script(md-bootstrap-datepicker/jquery.md.bootstrap.datetimepicker.js)
    @style(md-bootstrap-datepicker/jquery.md.bootstrap.datetimepicker.style.css)

    @push('scripts')
        <script>
            $(function () {
                $('.clear-date').click(function () {
                    $(this).closest('.input-group').find('input').val('');
                });
            });
        </script>
    @endpush
@endif

@if(!isset($no_title) || !$no_title)
<div class="form-group">
        <label for="input_{{ $name }}" class="control-label">
            @isset($star)
                <span class="text-danger forced_input">*</span>
            @endisset
            {{ $title }}

            @if(isset($tooltip))
                &nbsp;<abbr data-toggle="tooltip" title="{{ $tooltip ?? '' }}">؟</abbr>
            @endif
            @endif
        </label>
        <div class="input-group position-relative">
            <div class="input-group-addon"
                 data-mddatetimepicker="true"
                 data-trigger="click"
                 data-targetselector="#{{ $name }}"
                 {!! $disable_timepicker ?? 'data-enabletimepicker="true"' !!}
                 data-placement="{{ $data_placement ?? 'top' }}"
                 data-englishnumber="true"
                 data-format="yyyy/MM/dd"
                 data-disablebeforetoday="{{$disablebeforetoday ?? 'false'}}"
                    {{ $attributes ?? '' }}>
                <span class="fa fa-calendar"></span>
            </div>
            <input type="text"
                   data-mddatetimepicker="true"
                   data-trigger="click"
                   data-targetselector="#{{ $name }}"
                   {!! $disable_timepicker ?? 'data-enabletimepicker="true"' !!}
                   data-placement="{{ $data_placement ?? 'top' }}"
                   data-englishnumber="true"
                   data-format="yyyy/MM/dd"
                   data-disablebeforetoday="{{$disablebeforetoday ?? 'false'}}"
                   {{ $attributes ?? '' }}
                   name="{{ $name }}"
                   class="form-control datepicker"
                   id="{{ $name }}"
                   readonly placeholder="{{ $placeholder ?? '' }}"
                   {{ isset($date_interval) ? 'data-FromDateCustom=' . $date_interval[0] . ' data-ToDateCustom=' . $date_interval[1] : '' }}
                   {{ isset($editable) ?? ' readonly' }}
                   value="{{ $date ?? null}}">
            @if(!isset($deactive_trash) || !$deactive_trash)
            <span class="clear-date input-group-addon">
                <i class="{{$trash_icon ?? 'fa fa-trash-o'}}"></i>
            </span>
            @endif
        </div>
</div>
