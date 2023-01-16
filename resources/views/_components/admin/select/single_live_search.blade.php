<div class="form-group input-group-sm text-left {{$class ?? ''}}">
    <label class="w-100" for="{{ $id }}">
        @if(isset($star) && $star === true)
            <span class="text-danger forced_input">*</span>
        @endif
        {!! $title  ?? '&nbsp;' !!}
    </label>
    <select
        name="{{ $id }}"
        id="{{ $id }}"
        class="form-control js-select2-w-100 js-select2-live-search @error("{$id}") is-invalid @enderror"
        data-url="{{ $url }}"
        readonly
        >
        @if(!isset($doesnt_have_default))
            <option value="">{{ $default ?? 'انتخاب کنید...' }}</option>
        @endif
        {{ $options ?? '' }}
    </select>
    @error("{$id}")
        <div class="alert alert-danger text-right">{{ $message }}</div>
    @enderror
</div>
