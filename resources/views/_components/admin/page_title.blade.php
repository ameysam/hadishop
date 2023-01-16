<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-2">
                <div class="page-header form-header float-right">
                    <div class="page-title">
                        {{ $title ?? 'رکورد جدید' }}
                    </div>
                </div>
                <div class="float-left">
                    <div class="page-button">
                        @isset($back_route)
                            <button id="btn_cancel" class="btn btn-danger btn-sm" onclick="history.go(-1);"><i class="fas fa-times-circle align-middle"></i>&nbsp;{{ $cancel_button_title ?? 'انصراف' }}</button>
                        @endisset
                        <button id="btn_register" class="btn btn-success btn-sm" type="button"><i class="fas fa-check-circle align-middle"></i>&nbsp;{{ $button_title ?? 'ثبت' }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window._form_id = 'form1';
        window._form_cancel_button_title = "{{ $cancel_button_title ?? 'انصراف' }}";
        window._form_location_back_url = "{{ $back_route ?? '#' }}";
        window._form_location_url = "{{ $location_route ?? '#' }}";
        window._form_button_url = '{{ $button_route ?? '' }}';

        @if(isset($method) && $method != 'post')
            // data += '&_method=put';
            window._form__method = 'put';

        @endif
    </script>
@endpush

