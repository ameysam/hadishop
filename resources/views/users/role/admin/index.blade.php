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

@section('modal-content')
    @component('_components.admin.modal.role-assign-admin-modal')
        @slot('action_url_prefix', $route_index)
        @slot('center_id', 'center_id')
        @slot('roles_id', 'roles_id')
        @slot('url', route('admin.user.role.assign-role', $user->id))
    @endcomponent
@endsection

@push('scripts')
    <script>
        var dg = $('#grid1').datagrid({
            remoteFilter: true,
            multiSort: true,
            iconCls: 'fas fa-hand-paper',
            filterBtnIconCls: 'icon-filter',
            rowNumbers: true,
            singleSelect: false,
            pagination: true,
            height: 450,
            width: '100%',
            title: 'نقش‌های ' + '«{{ $user->full_name }}»',
            sortOrder: 'asc',
            url: '{{ $route_items }}',
            columns: [
                [
                    {field: 'checkbox', checkbox: true},
                    {
                        field: 'role_title', width: 170, sortable: false, title: 'نقش', align: 'center',
                        formatter: function (val, row) {
                            return row.role_title;
                        }
                    },
                    {
                        field: 'center_full_name', width: 170, sortable: false, title: 'مرکز', align: 'center',
                        formatter: function (val, row) {
                            return row.center_full_name;
                        }
                    },
                ]
            ],
            toolbar: [
                {
                    id: 'btnCreate',
                    disabled: false,
                    text: 'جدید',
                    iconCls: 'fas fa-plus',
                    handler: function () {
                        $mdlAssignRole.on('show.bs.modal', function (event) {
                            $('#roles-users-selected').val('{{ $user->id }}');
                            $('#center_id').trigger('change');
                        })
                        .modal('show');
                    }
                }, '-',
                {
                    id: 'btnDestroy',
                    disabled: true,
                    text: 'حذف',
                    iconCls: 'fas fa-trash',
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
            ],
            onSelect: function (index, row) {
                $('#btnDestroy').linkbutton('enable');
            },
            onBeforeLoad: function (param) {
                $('#btnDestroy').linkbutton('disable');
            }
        }).datagrid('enableFilter', [
            {
                field: 'role_title',
                type: 'label',
            },
            {
                field: 'center_full_name',
                type: 'label',
            },
        ]);
    </script>
@endpush

@push('scripts۱۲۳')
    <script>

        var selected_row_id = 0;

        var dg = $('#grid1').datagrid({
            remoteFilter: true,
            multiSort: true,
            iconCls: 'fa fa-certificate',
            filterBtnIconCls: 'icon-filter',
            rowNumbers: true,
            singleSelect: false,
            pagination: true,
            height: 450,
            width: '100%',
            title: 'نقش‌های ' + '«{{ $user->full_name }}»',
            sortOrder: 'asc',
            url: '{{ $route_items }}',
            columns: [
                [
                    {field: 'checkbox', checkbox: true},
                    {
                        field: 'role_title', width: 170, sortable: true, title: 'نقش', align: 'center',
                        formatter: function (val, row) {
                            return row.role_title;
                        }
                    },
                    {
                        field: 'center_full_name', width: 170, sortable: true, title: 'مرکز', align: 'center',
                        formatter: function (val, row) {
                            return row.center_full_name;
                        }
                    },
                ]
            ],
            toolbar: [
                {
                    id: 'btnCreate',
                    disabled: false,
                    text: 'جدید',
                    iconCls: 'fa fa-plus',
                    handler: function () {
                        $('#mdl-role').modal();
                    }
                }, '-',
                {
                    id: 'btnDestroy',
                    disabled: true,
                    text: 'حذف',
                    iconCls: 'fa fa-trash-o',
                    handler: function () {
                        let ids = [];
                        let rows = $('#grid1').datagrid('getSelections');
                        for (let i = 0; i < rows.length; i++) {
                            ids.push(rows[i].role.id);
                        }
                        if (ids.length > 0) {
                            $.messager.confirm('توجه', 'آیا از حذف مطمئن هستید؟', function (r) {
                                if (r) {
                                    var params = {
                                        _method: 'DELETE',
                                    };
                                    $.post('#' + ids, params, function (data) {
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
            ],
            onSelect: function (index, row) {
                $('#btnDestroy').linkbutton('enable');
            },
            onBeforeLoad: function (param) {
                $('#btnDestroy').linkbutton('disable');
            }
        });
    </script>
@endpush

