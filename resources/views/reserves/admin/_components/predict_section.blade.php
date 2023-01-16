<div class="row">
    <div class="col-4 text-center">
        <button data-id="{{ $record->id }}" data-status="{{ $predict_statuses[2] }}" class="btn-predict btn btn-sm {{ (isset($predicted_value) && $predicted_value == $predict_statuses[2]) ? 'btn-outline-danger' : 'text-danger' }}" type="button"><i class="fas fa-times"></i>&nbsp;نمی آیم</button>
    </div>
    <div class="col-4 text-center">
        <button data-id="{{ $record->id }}" data-status="{{ $predict_statuses[3] }}" class="btn-predict btn btn-sm {{ (isset($predicted_value) && $predicted_value == $predict_statuses[3]) ? 'btn-outline-dark' : 'text-dark' }}" type="button"><i class="far fa-circle"></i>&nbsp;شاید بیایم</button>
    </div>
    <div class="col-4 text-center">
        <button data-id="{{ $record->id }}" data-status="{{ $predict_statuses[1] }}" class="btn-predict btn btn-sm {{ (isset($predicted_value) && $predicted_value == $predict_statuses[1]) ? 'btn-outline-success' : 'text-success' }}" type="button"><i class="fas fa-check"></i>&nbsp;می آیم</button>
    </div>
</div>

@isset($with_assets)
    @push('scripts')
        <script>
            $(function(){

                // $.ajaxSetup({
                //     contentType: false,
                //     processData: false
                // });

                $(document).on('click', '.btn-predict', function(){
                    var id = $(this).attr('data-id');
                    var status = $(this).attr('data-status');
                    var url = '{{ route("admin.meeting.predict", ":id") }}';
                    url = url.replace(':id', id);

                    makeAlert('<span style="font-size:large">آیا تایید می‌کنید ؟</span>', '', 'orange', function(){

                        $.LoadingOverlay("show");
                        var formData = new FormData();

                        formData.append('id', id);
                        formData.append('status', status);
                        formData.append('_method', 'PATCH');

                        $.post(url, formData, function( result ) {
                            if (result.status)
                            {
                                makeAlert('پاسخ', result.message, 'green', function () {
                                    // location.reload();
                                    {!! $after_register_action ?? '' !!}
                                });
                            }
                            else
                            {
                                makeAlert('اخطار!', result.message, 'orange');
                            }
                            $.LoadingOverlay("hide");
                        }, 'json').fail(function (jqXhr) {
                            makeAlert('خطا!', getErrors(jqXhr), 'red');
                            showErrors(jqXhr);
                            $.LoadingOverlay("hide");
                        });
                    }, 'confirm');
                });
            });
        </script>
    @endpush
@endisset
