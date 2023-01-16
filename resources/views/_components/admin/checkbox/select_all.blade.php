@component('_components.admin.checkbox.with_font')
    @slot('id', $id)
    @slot('jelly', true)
    @slot('title', $title)
    @slot('value', $value ?? '')
    @slot('status_class', $status_class)
    @slot('icon_class', $icon_class)
    @slot('input_class', $input_class ?? '')
@endcomponent

@isset($with_assets)
    @push('scripts')
    <script>
        $(function(){
            $('.all-checker').change(function() {
                var $this = $(this);
                var checkboxes = $this.closest('.select-all-container').find('.select-all-child');

                if ($this.is(":checked"))
                {
                    checkboxes.prop('checked', true);
                }
                else
                {
                    checkboxes.prop('checked', false);
                }
            });
        })
    </script>
    @endpush
@endisset
