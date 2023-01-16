<div class="modal fade" id="{{ $id ?? 'mdlAssignRole' }}" tabindex="-1" role="dialog" aria-labelledby="operationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title pull-right" id="operationModalLabel">{{ $title ?? 'تخصیص نقش' }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" readonly id="roles-users-selected" value="">
            <form id="form1" method="post">
                <div class="row">
                    <div class="col-sm-12">
                        @component('_components.admin.select.bootstrap-multiple')
                            @slot('title', 'نقش (ها)')
                            @slot('id', 'roles_id')
                            @slot('search', true)
                            @slot('star', true)
                            @slot('size', 10)
                            @slot('show_count', 3)
                        @endcomponent
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button id="btn_cancel" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-times-circle"></i>&nbsp;انصراف</button>
            <button id="btn_assign_roles" class="btn btn-success btn-sm" type="button"><i class="fas fa-check-circle"></i>&nbsp;ثبت</button>
        </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var $mdlAssignRole = $("#{{ $id ?? 'mdlAssignRole' }}");
    var $center_select = $("#{{ $center_id ?? 'center_id' }}");
    var $roles_select = $("#{{ $roles_id ?? 'roles_id' }}");

    $(function(){

        $mdlAssignRole.on('hidden.bs.modal', function() {
            $(this).find('input').val('');
            $roles_select.html('');
            $center_select.val('');
        });

        $center_select.change(function () {
            $.LoadingOverlay("show");
            var $this = $(this);
            var center_id = $this.val();

            var url = '{{ $_center_roles_url_prefix }}/center-roles';
            if(center_id != '')
            {
                url += '/' + center_id;
            }

            $.post(url, {}, function (result) {
                if (result.status)
                {
                    var roles = result.data;
                    var roles_options = '';
                    roles.forEach(function(item){
                        roles_options += '<option value="'+ item.id +'">'+ item.title +'</option>';
                    });
                    $roles_select.html(roles_options);
                    $('.selectpicker').selectpicker('refresh');
                }
                else
                {
                    makeAlert('اخطار!', result.message, 'orange');
                }
                $.LoadingOverlay("hide");
            }, 'json').fail(function (jqXhr)
            {
                makeAlert('خطا!', getErrors(jqXhr), 'red');
                $.LoadingOverlay("hide");
            });
        });


        $('#btn_assign_roles').click(function () {
            $.LoadingOverlay("show");
            var $this = $(this);
            $this.prop('disabled', true);
            $this.html("<i class='fas fa-spinner fa-pulse'></i>&nbsp;ثبت");

            var url = '{{ route("admin.user.assign", ":ids") }}';
            url = url.replace(':ids', $('#roles-users-selected').val());

            var data = $('#form1').serialize();

            $.post(url, data, function (result) {
                if (result.status)
                {
                    makeAlert('پاسخ', result.message, 'green', function () {
                        $mdlAssignRole.modal('toggle')
                        $("#{{ $grid_id ?? 'grid1' }}").datagrid('reload');
                    });
                }
                else
                {
                    makeAlert('اخطار!', result.message, 'orange');
                }
                $.LoadingOverlay("hide");
            }, 'json').fail(function (jqXhr)
            {
                makeAlert('خطا!', getErrors(jqXhr), 'red');
                $.LoadingOverlay("hide");
            }).always(function (){
                setTimeout(function(){
                    $this.prop('disabled', false);
                    $this.html('<i class="fas fa-check-circle"></i>&nbsp;ثبت');
                }, 750);
            });
        });
    });
</script>
@endpush
