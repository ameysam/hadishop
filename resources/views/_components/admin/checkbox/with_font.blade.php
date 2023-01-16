<div class="pretty p-icon {{ isset($round) ? ' p-round' : ''  }}{{ isset($smooth) ? ' p-smooth' : ''  }}{{ isset($rotate) ? ' p-rotate' : ''  }}{{ isset($jelly) ? ' p-jelly' : ''  }}">
    <input type="{{ $type ?? 'checkbox' }}" class="{{ $input_class ?? '' }}" value="{{ $value ?? '' }}" name="{{ $name ?? $id }}" id="{{ $id }}" {{ isset($checked) ? ' checked' : ''  }} />
    <div class="state {{ $status_class ?? 'p-success' }}">
        @isset($icon_class)
            <i class="icon {{ $icon_class }}"></i>
        @endisset
        <label>{!! $title !!}</label>
    </div>
</div>
