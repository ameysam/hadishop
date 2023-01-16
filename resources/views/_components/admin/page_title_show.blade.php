<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-2">
                <div class="page-header form-header float-right">
                    <div class="page-title">
                        {{ $title ?? 'مشاهده' }}
                    </div>
                </div>
                <div class="float-left">
                    <div class="page-button">
                        @isset($back_route)
                            <button id="btn_back" class="btn btn-danger btn-sm align-middle" onclick="history.go(-1);"><i class="fas fa-undo"></i>&nbsp;{{ $cancel_button_title ?? 'بازگشت' }}</button>
                        @endisset
                        @isset($edit_route)
                            <button id="btn_edit" class="btn btn-success btn-sm align-middle" type="button"><i class="fas fa-edit"></i>&nbsp;{{ $button_title ?? 'ویرایش' }}</button>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
         $(function () {
            // $('#btn_back').click(function () {
            //     var $this = $(this);
            //     $('#btn_register').prop('disabled', true);
            //     $this.prop('disabled', true);
            //     $this.html("<i class='fas fa-spinner fa-pulse'></i>&nbsp;{{ $cancel_button_title ?? 'بازگشت' }}");
            //     setTimeout(function(){
            //         window.location = "{{ $back_route ?? '#' }}";
            //     }, 500)
            // });
            $('#btn_edit').click(function () {
                var $this = $(this);
                $('#btn_register').prop('disabled', true);
                $this.prop('disabled', true);
                $this.html("<i class='fas fa-spinner fa-pulse'></i>&nbsp;{{ $button_title ?? 'ویرایش' }}");
                setTimeout(function(){
                    window.location = "{{ $edit_route ?? '#' }}";
                }, 500)
            });
        });
    </script>
@endpush

