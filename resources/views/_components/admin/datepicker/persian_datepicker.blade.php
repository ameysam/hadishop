@if(isset($with_assets))
    @script(md-bootstrap-datepicker/jquery.md.bootstrap.datetimepicker.js)
    @style(md-bootstrap-datepicker/jquery.md.bootstrap.datetimepicker.style.css)
@endif

<div class="form-group">
    <label for="{{ $id }}">
        @isset($star)
            <span class="text-danger forced_input">*</span>
        @endisset
        {{ $title }}
        @if(isset($tooltip))
            &nbsp;<abbr data-toggle="tooltip" title="{{ $tooltip ?? '' }}">؟</abbr>
        @endif
    </label>

    <div class="input-group input-group-sm">
        <div class="input-group-append">
            <span class="input-group-text cursor-pointer text-success" id="date_{{ $id }}"><i class="far fa-calendar-plus"></i></span>
        </div>

        <input
            type="text"
            id="input_{{ $id }}"
            class="form-control"
            placeholder="{{ $placeholder ?? '' }}"
            aria-label="date_{{ $id }}"
            aria-describedby="date_{{ $id }}"
            {{ !isset($editable) ? 'readonly' : '' }}
        >

        <input type="hidden" id="{{ $id }}" name="{{ $id }}">

        <div class="input-group-prepend">
            <span class="input-group-text cursor-pointer text-danger date-remover"><i class="far fa-calendar-times"></i></span>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function () {
            var rangeSelector = "{{ isset($range) ? true : false }}";

            var timePicker = "{{ isset($time) ? true : false }}";

            var textFormat = "{{ $format_text ?? 'yyyy/MM/dd' }}";

            var dateFormat = "{{ $format_date ?? 'yyyy-MM-dd' }}";

            if(timePicker == true)
            {
                textFormat += ' HH:mm:ss';
                dateFormat += ' HH:mm:ss';
            }

            var months_before_count = parseInt("{{ $months_before_count ?? 0 }}");

            var months_after_count = parseInt("{{ $months_after_count ?? 0 }}");

            $('#date_{{ $id }}').MdPersianDateTimePicker({
                targetTextSelector: '#input_{{ $id }}',
                targetDateSelector: '#{{ $id }}',
                enableTimePicker: timePicker,
                textFormat: textFormat,
                dateFormat: dateFormat,
                rangeSelector: rangeSelector,
                monthsToShow: [months_before_count, months_after_count],
            });

            $('#input_{{ $id }}').click(function(){
                $('#date_{{ $id }}').trigger('click')
            });

            @isset($value_g)
                $('#{{ $id }}').val('{{ $value_g }}');
            @endisset
            @isset($value_j)
                $('#input_{{ $id }}').val('{{ Illuminate\Support\Str::numberFa($value_j) }}');
            @endisset
        });
    </script>
@endpush
