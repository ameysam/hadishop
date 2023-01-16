<div class="form-group input-group-sm">
    <label for="{{ $name }}">
        @isset($star)
            <span class="text-danger forced_input">*</span>
        @endisset
        {{ $title }}
    </label>
    <select name="{{ $name }}[]" id="{{ $name }}" class="form-control js-select2-tags" data-tagable="{{ isset($taggable) ? '1' : '0' }}" multiple="multiple"
            data-url="{{ $url }}" style="width: 100%">

            {{ $options ?? '' }}
    </select>
</div>
