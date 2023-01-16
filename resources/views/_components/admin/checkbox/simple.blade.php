<div class="pretty p-default{{ isset($round) ? ' p-round' : ''  }}{{ isset($thick) ? ' p-thick' : ''  }}{{ isset($fill) ? ' p-fill' : ''  }}{{ isset($curve) ? ' p-curve' : ''  }}">
    <input type="checkbox" class="{{ $input_class ?? '' }}" value="{{ $value ?? '' }}" name="{{ $name ?? $id }}" id="{{ $id }}" {{ isset($checked) ? ' checked' : ''  }}/>
    <div class="state {{ $status_class ?? 'p-success' }}">
        <label>{{ $title }}</label>
    </div>
</div>
