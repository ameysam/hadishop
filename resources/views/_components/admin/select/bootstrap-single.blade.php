<div class="form-group input-group-sm">
    <label for="{{ $id }}">
        @isset($star)
            <span class="text-danger forced_input">*</span>
        @endisset
        {{ $title }}
    </label>
    <select
            data-header="انتخاب کنید"
            data-style="btn-default"
            @if(isset($search))
                data-live-search="true"
            @endif
            data-none-selected-text="{{ $none_selected_text ?? 'موردی انتخاب نشده است.' }}"
            data-selected-text-format="count"
            data-size={{ $size ?? 6 }}
            name="{{ $id }}"
            id="{{ $id }}"
            class="selectpicker form-control"
            data-live-search-placeholder="جستجو"
            >
            @if(!isset($doesnt_have_default))
                <option value="">{{ $default ?? 'انتخاب کنید...' }}</option>
            @endif
            {{ $options ?? '' }}
    </select>
</div>
