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
            data-selected-text-format="count > {{ $show_count ?? 1 }}"
            data-size={{ $size ?? 6 }}
            name="{{ $id }}[]"
            id="{{ $id }}"
            class="selectpicker form-control"
            data-live-search-placeholder="جستجو"
            multiple
            {!! isset($max) ? "data-max-options='{$max}'" : ''  !!}
            >
            {{ $options ?? '' }}
    </select>

    @isset($selected_ids)
        @push('scripts')
            <script>
                $(function () {
                    $('#{{ $id }}').val(@json($selected_ids));
                });
            </script>
        @endpush
    @endisset
</div>
