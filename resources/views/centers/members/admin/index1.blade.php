@extends('_layouts.admin.index')

@section('content')

    @script(jquery-easyui/jquery-easyui.js)
    @style(jquery-easyui/jquery-easyui.css)

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="grid1"></table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @hasp('center-edit', $g_center) --}}
@hasrole('admin')
@section('modal-content')
<div class="modal fade" id="mdl-add-members" tabindex="-1" role="dialog" aria-labelledby="operationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pull-right" id="operationModalLabel">افزودن اعضا جدید</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form1" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            @component('_components.admin.select.multiple-with-search')
                                @slot('name', 'members')
                                @slot('url', route('admin.search.auto.user'))
                                @slot('title', 'اعضا')
                                @slot('star', true)
                            @endcomponent
                        </div>
                        <div class="col-sm-12">
                            @component('_components.admin.select.bootstrap-multiple')
                                @slot('title', 'نقش (ها)')
                                @slot('id', 'roles_id')
                                @slot('search', true)
                                @slot('star', true)
                                @slot('size', 10)
                                @slot('show_count', 3)
                                @slot('options')
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                @endslot
                            @endcomponent
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn-cancel" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-times-circle align-middle"></i>&nbsp;انصراف</button>
                <button id="btn-add-members" class="btn btn-success btn-sm" type="button"><i class="fas fa-check-circle align-middle"></i>&nbsp;ثبت</button>

                @push('scripts')
                    <script>
                        $(function(){
                            $mdlAddMembers.on('hidden.bs.modal', function (event) {
                                resetTags();
                                $('.selectpicker').val('').selectpicker('refresh');
                            });

                            $('#btn-add-members').click(function () {

                                $.LoadingOverlay("show");
                                var $this = $(this);
                                $this.prop('disabled', true);
                                $this.find('i').attr("class", "fas fa-spinner align-middle fa-pulse");

                                var url = '{{ $route_add_member }}';

                                var data = $('#form1').serialize();

                                $.post(url, data, function (result) {
                                    if (result.status)
                                    {
                                        make_alert('پاسخ', result.message, 'green', function () {
                                            $mdlAddMembers.modal('toggle')
                                            $("#grid1").datagrid('reload');
                                        });
                                    }
                                    else
                                    {
                                        make_alert('اخطار!', result.message, 'orange');
                                    }
                                    $.LoadingOverlay("hide");
                                }, 'json').fail(function (jqXhr)
                                {
                                    make_alert('خطا!', get_errors(jqXhr), 'red');
                                    $.LoadingOverlay("hide");
                                }).always(function (){
                                    setTimeout(function(){
                                        $this.prop('disabled', false);
                                        $this.find('i').attr("class", "fas fa-check-circle align-middle");
                                    }, 750);
                                });
                            });
                        });
                    </script>
                @endpush

            </div>
        </div>
    </div>
</div>
@endsection
@endhasrole

@push('scripts')
    <script>
        var $mdlAddMembers = $('#mdl-add-members');

        var dg = $('#grid1').datagrid({
            remoteFilter: true,
            multiSort: true,
            iconCls: 'fas fa-user-nurse',
            filterBtnIconCls: 'icon-filter',
            rowNumbers: true,
            singleSelect: false,
            pagination: true,
            height: 450,
            width: '100%',
            title: 'فهرست اعضای ' + '«{{ $g_center->full_name }}»',
            sortOrder: 'asc',
            url: '{{ $route_items }}',
            columns: [
                [
                    {field: 'checkbox', checkbox: true},
                    {
                        field: 'users_first_name', width: '10%', sortable: true, title: 'نام', align: 'center',
                        formatter: function (val, row) {
                            return row.users_first_name;
                        }
                    },
                    {
                        field: 'users_last_name', width: '10%', sortable: true, title: 'نام خانوادگی', align: 'center',
                        formatter: function (val, row) {
                            return row.users_last_name;
                        }
                    },
                    {
                        field: 'users_id_no', width: '10%', sortable: true, title: 'کد شناسایی', align: 'center',
                        formatter: function (val, row) {
                            return row.users_id_no;
                        }
                    },
                    {
                        field: 'roles_title', width: '65%', sortable: true, title: 'نقش‌ها(چارت سازمانی)', align: 'center',
                        formatter: function (val, row) {
                            return '<div class="text-left">' + row.roles_title + '</div>';
                        }
                    },
                ]
            ],
            toolbar: [
                @hasrole('admin')
                {
                    id: 'btnAddMember',
                    disabled: false,
                    text: 'اعضا جدید',
                    iconCls: 'fas fa-user-nurse',
                    handler: function () {
                        $mdlAddMembers.modal('show');
                    }
                }, '-',
                {
                    id: 'btnSoftDelete',
                    disabled: true,
                    text: 'حذف',
                    iconCls: 'fas fa-trash-alt',
                    handler: function () {
                        let ids = [];
                        let rows = $('#grid1').datagrid('getSelections');
                        for (let i = 0; i < rows.length; i++) {
                            ids.push(rows[i].id);
                        }
                        if (ids.length > 0) {
                            $.messager.confirm('توجه', 'آیا از حذف مطمئن هستید؟', function (r) {
                                if (r) {
                                    var params = {
                                        _method: 'DELETE',
                                    };
                                    $.post('{{ $route_index }}/' + ids, params, function (data) {
                                        if (data.ok)
                                        {
                                            $('#grid1').datagrid('reload');
                                        }
                                        else
                                        {
                                            $.messager.alert('توجه', data.message, 'error');
                                        }
                                    }, 'json').fail(function () {
                                        $.messager.alert('توجه', 'خطا در برقراری ارتباط با سرور', 'error');
                                    });
                                }
                            });
                        }
                        else {
                            $.messager.alert('توجه', 'لطفا یک ردیف انتخاب کنید', 'warning');
                        }
                    }
                },
                @endhasrole

            ],
            onSelect: function (index, row) {
                $('#btnEdit').linkbutton('enable');
                $('#btnShow').linkbutton('enable');
                $('#btnSoftDelete').linkbutton('enable');
                $('#btnShowSchedules').linkbutton('enable');
                $('#btnDestroy').linkbutton('enable');
            },
            onBeforeLoad: function (param) {
                $('#btnEdit').linkbutton('disable');
                $('#btnShow').linkbutton('disable');
                $('#btnSoftDelete').linkbutton('disable');
                $('#btnShowSchedules').linkbutton('disable');
                $('#btnDestroy').linkbutton('disable');
            }
        }).datagrid('enableFilter', [

        ]);

        $(document).find(".datagrid-header-row.datagrid-filter-row td[field='created_at']").each(function (i, val) {
            $(this).closest('td').find('input').hide();
            $(this).find('.datagrid-filter-c').append('<input style="cursor: pointer" placeholder="انتخاب تاریخ" type="text" class="datepicker form-control1 text-center dg-date-picker" id="date-input' + i + '" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#date-input' + i + '" data-groupid="group1" data-fromdate="true" data-enabletimepicker="false" data-englishnumber="true" data-format="dd/MM/yyyy" data-placement="bottom" readonly/>');
        });

        $(document).on('change', '.dg-date-picker', function () {
            $(this).closest('td').find('input').val($(this).val());
        });

    </script>
@endpush
