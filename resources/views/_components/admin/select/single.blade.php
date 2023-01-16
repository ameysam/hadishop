<div class="form-group input-group-sm text-left {{$class ?? ''}}">
    <label for="{{ $id }}">
        @if(isset($star) && $star === true)
            <span class="text-danger forced_input">*</span>
        @endif
        {!! $title  ?? '&nbsp;' !!}
    </label>
    <select
        name="{{ $id }}"
        id="{{ $id }}"
        class="form-control js-select2-w-100 single-select @error("{$id}") is-invalid @enderror"
        readonly
        >
        @if(!isset($doesnt_have_default))
            <option value="">{{ $default ?? 'انتخاب کنید...' }}</option>
        @endif
        {{ $options ?? '' }}
    </select>
    @error("{$id}")
        <div class="alert alert-danger text-left">{{ $message }}</div>
    @enderror
</div>
