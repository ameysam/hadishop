<div class="form-group input-group-sm text-left {{$class ?? ''}}">
    <label for="{{ $id_hr }}">
        @if(isset($star) && $star === true)
            <span class="text-danger forced_input">*</span>
        @endif
        {!! $title  ?? '&nbsp;' !!}
    </label>
    <br>
        <select style="width: 35%; float:right"
            name="{{ $id_mn }}"
            id="{{ $id_mn }}"
            class="form-control text-center @error("{$id_mn}") is-invalid @enderror"
            >
            @if(!isset($doesnt_have_default))
                <option value="">{{ $default ?? 'انتخاب کنید...' }}</option>
            @endif
            {{ $options_mn ?? '' }}
        </select>
        <select style="width: 35%; float:right; margin-right:1%"
            name="{{ $id_hr }}"
            id="{{ $id_hr }}"
            class="form-control text-center @error("{$id_hr}1") is-invalid @enderror"
            >
            @if(!isset($doesnt_have_default))
                <option value="">{{ $default ?? 'انتخاب کنید...' }}</option>
            @endif
            {{ $options_hr ?? '' }}
        </select>
    @error("{$id_hr}")
        <div class="alert alert-danger text-right">{{ $message }}</div>
    @enderror
</div>
