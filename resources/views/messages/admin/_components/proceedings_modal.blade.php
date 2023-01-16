@script(tinymce/tinymce.js)

<div class="modal fade" id="mdl-proceedings" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title float-right font-weight-bold" id="mdl-proceeding-title">

                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body number-fa">
                <input type="hidden" class="selected-item-id" value="{{ $selected_id ?? '' }}">
                <form id="form1" action="">
                    <div class="row">
                        <div class="col-12">
                            @component('_components.admin.input.editor')
                                @slot('id', 'proceedings')
                                @slot('title', 'صورتجلسه')
                                @slot('slot', '')
                                @slot('editor', true)
                                @slot('minimum', true)
                            @endcomponent
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="btn-register-proceedings" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i>&nbsp;ثبت</button>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>&nbsp;بستن</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        var $mdlProceedings = $('#mdl-proceedings');

        $(function(){

            $.ajaxSetup({
                contentType: false,
                processData: false
            });

            $(document).on('click', '.btn-proceedings', function(){
                $.LoadingOverlay("show");
                var $this = $(this);
                var id = $this.attr('data-id');

                var url = '{{ route("admin.meeting.preceedings.view", ":id") }}';
                url = url.replace(':id', id);

                $.post(url, {}, function( result ) {
                    if (result.status)
                    {
                        $('#mdl-proceeding-title').text(result.record.name);
                        $mdlProceedings.find('.selected-item-id').val(id);
                        $mdlProceedings.modal('show');
                        if(result.record.proceedings)
                        {
                            tinyMCE.activeEditor.setContent(result.record.proceedings);
                        }
                        else
                        {
                            tinyMCE.activeEditor.setContent('');
                        }
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
            });


            $(document).on('click', '#btn-register-proceedings', function(){
                $.LoadingOverlay("show");

                var id = $mdlProceedings.find('.selected-item-id').val();
                var url = '{{ route("admin.meeting.preceedings.update", ":id") }}';
                url = url.replace(':id', id);

                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('i').attr('class', "fas fa-spinner fa-pulse");

                tinyMCE.triggerSave();
                var formData = new FormData(document.getElementById('form1'));
                formData.append('_method', 'PATCH');

                $.post(url, formData, function (result) {
                    if (result.status)
                    {
                        {!! $after_register_action ?? '' !!}
                        $mdlProceedings.modal('toggle');
                        $.LoadingOverlay("hide");
                    }
                    else
                    {
                        $.LoadingOverlay("hide");
                        makeAlert('اخطار!', result.message, 'orange');
                    }
                    $.LoadingOverlay("hide");
                }, 'json').fail(function (jqXhr)
                {
                    makeAlert('خطا!', getErrors(jqXhr), 'red');
                    showErrors(jqXhr);
                    $.LoadingOverlay("hide");
                }).always(function ()
                {
                    setTimeout(function(){
                        $this.prop('disabled', false);
                        $this.find('i').attr('class', "fas fa-check-circle");
                    }, 750);
                });
            });

            $mdlProceedings.on('hidden.bs.modal', function (event) {
                // $('#mdl-preceedings').find('.selected-item-id').val('');
                tinyMCE.activeEditor.setContent('');
            });
        });
    </script>
@endpush
