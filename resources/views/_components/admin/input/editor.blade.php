<div class="form-group">
    <label class="control-label" for="input_{{ $id ?? 'content' }}">
        @isset($star)
        <span class="text-danger forced_input">*</span>
        @endisset
        {{ $title ?? 'توضیحات' }}
        @if(isset($tooltip))
        &nbsp;<abbr data-toggle="tooltip" title="{{ $tooltip ?? '' }}">؟</abbr>
        @endif
    </label>

    @if(isset($payment_hint))
        <span class="badge badge-danger float-left">نیازمند پرداخت ویزیت</span>
    @endif

    <textarea class="form-control @if(isset($editor))
    {{ isset($minimum) ? 'tinymce_minimum' : 'tinymce'}}
    @endif" id="input_{{ $id ?? 'content' }}" rows="{{ $rows ?? 5 }}" name="{{ $id ?? 'content' }}"
        placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
        style="resize:vertical;direction: {{ isset($direct) ? $direct: 'rtl'}};"
        {{ isset($editable) ? $editable: ''}}>{{ $slot ?? '' }}</textarea>
</div>
