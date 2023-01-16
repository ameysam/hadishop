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

@push('scripts')
    <script>
        var dg = $('#grid1').datagrid({
            remoteFilter: true,
            multiSort: true,
            iconCls: 'fas fa-handshake',
            filterBtnIconCls: 'icon-filter',
            rowNumbers: true,
            singleSelect: false,
            pagination: true,
            height: 450,
            width: '100%',
            title: 'فهرست نقش‌ها(چارت سازمانی) ',
            sortOrder: 'asc',
            url: '{{ $route_items }}',
            columns: [
                [
                    {field: 'checkbox', checkbox: true},
                    {
                        field: 'title', width: 170, sortable: true, title: 'عنوان', align: 'center',
                        formatter: function (val, row) {
                            return val;
                        }
                    },
                    {
                        field: 'slug', width: 170, sortable: true, title: 'نام', align: 'center',
                        formatter: function (val, row) {
                            return val;
                        }
                    },
                    // {
                    //     field: 'type', width: 170, sortable: true, title: 'نوع', align: 'center',
                    //     formatter: function (val, row) {
                    //         if(row.type == 1)
                    //         {
                    //             return '<span class="text-success">'+row.type_fa+'</span>';
                    //         }
                    //         return '<span class="text-primary">'+row.type_fa+'</span>';
                    //     }
                    // },
                    {
                        field: 'created_at', width: 170, sortable: true, title: 'تاریخ ایجاد', align: 'center',
                        formatter: function (val, row) {
                            return '<span class="number-fa">' + row.created_at_farsi + '</span>';
                        }
                    },
                ]
            ],
            toolbar: [
                @can('role-add')
                {
                    id: 'btnCreate',
                    disabled: false,
                    text: 'جدید',
                    iconCls: 'fa fa-plus',
                    handler: function () {
                        window.location.href = '{{ $route_index }}/create';
                    }
                },
                @endcan
                @can('role-show')
                '-',
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
                },
                @endcan
                @can('role-edit')
                 '-',
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
                    id: 'btnDestroy',
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
                @endcan
            ],
            onSelect: function (index, row) {
                $('#btnEdit').linkbutton('enable');
                $('#btnShow').linkbutton('enable');
                $('#btnDestroy').linkbutton('enable');
            },
            onBeforeLoad: function (param) {
                $('#btnEdit').linkbutton('disable');
                $('#btnShow').linkbutton('disable');
                $('#btnDestroy').linkbutton('disable');
            }
        }).datagrid('enableFilter', [
            {
                field: 'type',
                type: 'combobox',
                options: {
                    panelHeight: 'auto',
                    data: {!! $types !!},
                    onChange: function (value) {
                        if (value == '') {
                            dg.datagrid('removeFilterRule', 'type');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'type',
                                op: 'equal',
                                value: value
                            });
                        }
                        dg.datagrid('doFilter');
                    }
                },
            }
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
