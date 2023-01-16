<div class="form-group input-group-sm">
    <label class="control-label" for="input_{{ $id }}">
        @isset($star)
            <span class="text-danger forced_input">*</span>
        @endisset
        {{ $title ?? 'عنوان' }}
        @if(isset($tooltip))
            &nbsp;<abbr data-toggle="tooltip" title="{{ $tooltip ?? '' }}">؟</abbr>
        @endif
    </label>

    @if(isset($payment_hint))
        <span class="badge badge-danger float-left">نیازمند پرداخت ویزیت</span>
    @endif

    <input type="{{ $type ?? 'text' }}"
           class="form-control{{ $fa_num ?? ''}} @if(isset($type) && $type == 'password') password @endif"
           {{-- style="direction: {{ isset($dir) ? $dir: 'rtl'}}; font-family: {{(isset($dir) && $dir = 'ltr')? 'tahoma': ''}}" --}}
           style="direction: {{ isset($dir) ? $dir: 'rtl'}};"
           @isset($auto_select)
                {!! 'onClick="this.select();"' !!}
           @endisset
           name="{{ $id }}"
           id="input_{{ $id }}"
           value="{{ $slot ?? ''}}"
           {{ $readonly ?? '' }}
           placeholder="{{ isset($placeholder) ? $placeholder : ($id == 'link' ? request()->root() : '') }}"
           min="{{ $min ?? 0 }}"
           max="{{ $max ?? null }}"
           {{ isset($editable) ? $editable: ''}}
           @if(isset($english_validate))
           onkeypress="return {!! $validation_method ?? 'validateOnlyLettersDashDot'!!}();"
           @endif
           >

           @if(isset($type) && $type == 'password')
            <span id="password-field" onclick="togglePasswordField(this, 'input_{{ $id }}')" class="fa fa-fw fa-eye password-toggle-icon has-label"></span>
           @endif
</div>
