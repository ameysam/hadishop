<div class="form-group">
    <button id="{{ $id ?? 'btn-submit' }}" type="{{ $type ?? 'button' }}" class="btn btn-{{ $color ?? 'primary' }} btn-sm {{ $class ?? '' }}">
        @isset($font)
            <i class="{{ $font }} align-middle"></i>&nbsp;
        @endisset
        {{ $title ?? 'ذخیره' }}
    </button>

    @isset($scripts)
        @push('scripts')
            {{ $scripts }}
        @endpush
    @endisset
</div>
