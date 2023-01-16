<div class="form-group input-group-sm {{ (isset($type) && $type == 'password') ? 'password-group' : '' }}">
    <label class="control-label float-right" for="input_{{ $id }}">
        @isset($star)
            <span class="text-danger forced_input">*</span>
        @endisset
        {{ $title ?? 'عنوان' }}
        @if(isset($tooltip))
            &nbsp;<abbr data-toggle="tooltip" title="{{ $tooltip ?? '' }}">؟</abbr>
        @endif
    </label>

    <input type="{{ $type ?? 'text' }}"
           class="form-control @error("{$id}") is-invalid @enderror @if(isset($type) && $type == 'password') password @endif"
           style="direction: {{ isset($dir) ? $dir: 'rtl'}}; {{(isset($dir) && $dir = 'ltr')? 'font-family: tahoma': ''}}"
           name="{{ $id }}"
           id="input_{{ $id }}"
           value="{{ $slot ?? ''}}"
           {{ $readonly ?? '' }}
           placeholder="{{ isset($placeholder) ? $placeholder : ($id == 'link' ? request()->root() : '') }}"
           min="{{ $min ?? 0 }}"
           max="{{ $max ?? null }}"
           @if(isset($english_validate))
           onkeypress="return validateOnlyLettersDashDot();"
           @endif
           >

           @if(isset($type) && $type == 'password')
            <span onclick="togglePasswordField(this, 'input_{{ $id }}')" class="fa fa-fw fa-eye password-toggle-icon has-label"></span>
           @endif

    @error("{$id}")
        <div class="alert alert-danger text-left">{{ $message }}</div>
    @enderror
</div>
