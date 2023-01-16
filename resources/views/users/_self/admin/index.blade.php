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

{{-- @section('modal-content')
    @component('_components.admin.modal.role-assign-admin-modal')
        @slot('center_id', 'center_id')
        @slot('roles_id', 'roles_id')
    @endcomponent
@endsection --}}

@push('scripts')
    <script>
        var dg = $('#grid1').datagrid({
            remoteFilter: true,
            multiSort: true,
            iconCls: 'fas fa-users',
            filterBtnIconCls: 'icon-filter',
            rowNumbers: true,
            singleSelect: false,
            pagination: true,
            height: 450,
            width: '100%',
            title: 'فهرست کاربران',
            sortOrder: 'asc',
            url: '{{ $route_items }}',
            columns: [
                [
                    {field: 'checkbox', checkbox: true},
                    {
                        field: 'first_name', width: 100, sortable: true, title: 'نام', align: 'center',
                        formatter: function (val, row) {
                            return val;
                        }
                    },
                    {
                        field: 'last_name', width: 100, sortable: true, title: 'نام خانوادگی', align: 'center',
                        formatter: function (val, row) {
                            return val;
                        }
                    },
                    {
                        field: 'mobile_no', width: 100, sortable: true, title: 'شماره همراه', align: 'center',
                        formatter: function (val, row) {
                            return '<span dir="ltr" class="number-fa">' + val + '</span>';
                        }
                    },
                    {
                        field: 'id_no', width: 100, sortable: true, title: 'کدشناسایی', align: 'center',
                        formatter: function (val, row) {
                            return '<span dir="ltr" class="number-fa">' + val + '</span>';
                        }
                    },
                    {
                        field: 'gender', width: 75, sortable: true, title: 'جنسیت', align: 'center',
                        formatter: function (val, row) {
                            return row.gender_farsi;
                        }
                    },
                    {
                        field: 'province', width: 90, sortable: true, title: 'استان', align: 'center',
                        formatter: function (val, row) {
                            if(row.province)
                            {
                                return row.province.title;
                            }
                            return '';
                        }
                    },
                    {
                        field: 'city', width: 90, sortable: true, title: 'شهر', align: 'center',
                        formatter: function (val, row) {
                            if(row.city)
                            {
                                return row.city.title;
                            }
                            return '';
                        }
                    },
                    {
                        field: 'activation_status', width: 90, sortable: true, title: 'وضعیت', align: 'center',
                        formatter: function (val, row) {
                            if(val == 1)
                            {
                                return '<span class="text-success">' + row.activation_status_farsi + '</span>';
                            }
                            return '<span class="text-danger">' + row.activation_status_farsi + '</span>';
                        }
                    }
                ]
            ],
            toolbar: [
                {
                    id: 'btnCreate',
                    disabled: false,
                    text: 'جدید',
                    iconCls: 'fa fa-plus',
                    handler: function () {
                        window.location.href = '{{ $route_index }}/create';
                    }
                }, '-',
                {
                    id: 'btnEdit',
                    disabled: true,
                    text: 'ویرایش',
                    iconCls: 'fa fa-edit',
                    handler: function () {
                        var row = $('#grid1').datagrid('getSelected');
                        if (row)
                        {
                            window.location.href = '{{ $route_index }}/' + row.id + '/edit';
                        }
                        else {
                            $.messager.alert('توجه', " لطفا یک ردیف انتخاب کنید! ");
                        }
                    }
                }, '-',
                {
                    id: 'btnShow',
                    disabled: true,
                    text: 'مشاهده',
                    iconCls: 'fa fa-eye',
                    handler: function () {
                        var row = $('#grid1').treegrid('getSelected');
                        if (row) {
                            window.location.href = '{{ $route_index }}/' + row.id;
                        }
                        else {
                            $.messager.alert('توجه', " لطفا یک ردیف انتخاب کنید! ");
                        }
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
                                        _method: 'PATCH',
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
                }, '-',
                {
                    id: 'btnDestroy',
                    disabled: true,
                    text: 'حذف فیزیکی',
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
                $('#btnEdit').linkbutton('enable');
                $('#btnShow').linkbutton('enable');
                $('#btnSections').linkbutton('enable');
                $('#btnSoftDelete').linkbutton('enable');
                $('#btnDestroy').linkbutton('enable');
                $('#btnAttachRole').linkbutton('enable');
                $('#btnRoles').linkbutton('enable');
            },
            onBeforeLoad: function (param) {
                $('#btnSections').linkbutton('disable');
                $('#btnEdit').linkbutton('disable');
                $('#btnShow').linkbutton('disable');
                $('#btnSoftDelete').linkbutton('disable');
                $('#btnDestroy').linkbutton('disable');
                $('#btnAttachRole').linkbutton('disable');
                $('#btnRoles').linkbutton('disable');
            }
        }).datagrid('enableFilter', [
            {
                field: 'gender',
                type: 'combobox',
                options: {
                    panelHeight: 'auto',
                    data: {!! $genders !!},
                    onChange: function (value) {
                        if (value == '') {
                            dg.datagrid('removeFilterRule', 'gender');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'gender',
                                op: 'equal',
                                value: value
                            });
                        }
                        dg.datagrid('doFilter');
                    }
                },
            },
            {
                field: 'activation_type',
                type: 'combobox',
                options: {
                    panelHeight: 'auto',
                    data: {!! $activation_types !!},
                    onChange: function (value) {
                        if (value == '') {
                            dg.datagrid('removeFilterRule', 'activation_type');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'activation_type',
                                op: 'equal',
                                value: value
                            });
                        }
                        dg.datagrid('doFilter');
                    }
                },
            },
            {
                field: 'activation_status',
                type: 'combobox',
                options: {
                    panelHeight: 'auto',
                    data: {!! $activation_statuses !!},
                    onChange: function (value) {
                        if (value == '') {
                            dg.datagrid('removeFilterRule', 'activation_status');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'activation_status',
                                op: 'equal',
                                value: value
                            });
                        }
                        dg.datagrid('doFilter');
                    }
                },
            },
        ]);

        $(document).find(".datagrid-header-row.datagrid-filter-row td[field='created_at'] , .datagrid-header-row.datagrid-filter-row td[field='birthdate']").each(function (i, val) {
            $(this).closest('td').find('input').hide();
            $(this).find('.datagrid-filter-c').append('<input style="cursor: pointer" placeholder="انتخاب تاریخ" type="text" class="datepicker form-control1 text-center dg-date-picker" id="date-input' + i + '" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#date-input' + i + '" data-groupid="group1" data-fromdate="true" data-enabletimepicker="false" data-englishnumber="true" data-format="dd/MM/yyyy" data-placement="bottom" readonly/>');
        });

        $(document).on('change', '.dg-date-picker', function () {
            $(this).closest('td').find('input').val($(this).val());
        });

    </script>
@endpush
