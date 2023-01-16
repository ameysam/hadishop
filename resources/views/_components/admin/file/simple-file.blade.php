<div class="form-group input-group-sm">
    <label class="control-label" for="{{ $id }}">
        @isset($star)
            <span class="text-danger forced_input">*</span>
        @endisset
        {{ $title ?? 'فایل' }}
    </label>
    <input class="form-control" type="file" id="{{ $id }}" name="{{ $id }}" accept="{{ $accept ?? '' }}">
</div>
