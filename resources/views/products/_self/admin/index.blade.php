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
            iconCls: 'fas fa-gift',
            filterBtnIconCls: 'icon-filter',
            rowNumbers: true,
            singleSelect: false,
            pagination: true,
            height: 450,
            width: '100%',
            title: 'فهرست کالاها',
            sortOrder: 'asc',
            url: '{{ $route_items }}',
            columns: [
                [
                    {field: 'checkbox', checkbox: true},
                    {
                        field: 'name', width: 150, sortable: true, title: 'نام', align: 'center',
                        formatter: function (val, row) {
                            return val;
                        }
                    },
                    {
                        field: 'price', width: 100, sortable: true, title: 'قیمت', align: 'center',
                        formatter: function (val, row) {
                            return row.price_fa;
                        }
                    },
                    {
                        field: 'category_id', width: 100, sortable: true, title: 'دسته‌بندی', align: 'center',
                        formatter: function (val, row) {
                            if(row.category)
                            {
                                return '<span dir="ltr" class="number-fa">' + row.category.name + '</span>';
                            }
                            return '<span dir="ltr" class="number-fa">فاقد دسته‌بندی</span>';
                        }
                    },
                    {
                        field: 'special', width: 100, sortable: true, title: 'ویژه', align: 'center',
                        formatter: function (val, row) {
                            if(row.special == 1)
                            {
                                return '<span class="text-success">'+row.special_farsi+'</span>';
                            }
                            return '<span class="text-danger">'+row.special_farsi+'</span>';
                        }
                    },
                    {
                        field: 'suggest', width: 100, sortable: true, title: 'پیشنهاد شده', align: 'center',
                        formatter: function (val, row) {
                            if(row.suggest == 1)
                            {
                                return '<span class="text-success">'+row.suggest_farsi+'</span>';
                            }
                            return '';
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
                // {
                //     id: 'btnSoftDelete',
                //     disabled: true,
                //     text: 'حذف',
                //     iconCls: 'fas fa-trash-alt',
                //     handler: function () {
                //         let ids = [];
                //         let rows = $('#grid1').datagrid('getSelections');
                //         for (let i = 0; i < rows.length; i++) {
                //             ids.push(rows[i].id);
                //         }
                //         if (ids.length > 0) {
                //             $.messager.confirm('توجه', 'آیا از حذف مطمئن هستید؟', function (r) {
                //                 if (r) {
                //                     var params = {
                //                         _method: 'PATCH',
                //                     };
                //                     $.post('{{ $route_index }}/' + ids, params, function (data) {
                //                         if (data.ok)
                //                         {
                //                             $('#grid1').datagrid('reload');
                //                         }
                //                         else
                //                         {
                //                             $.messager.alert('توجه', data.message, 'error');
                //                         }
                //                     }, 'json').fail(function () {
                //                         $.messager.alert('توجه', 'خطا در برقراری ارتباط با سرور', 'error');
                //                     });
                //                 }
                //             });
                //         }
                //         else {
                //             $.messager.alert('توجه', 'لطفا یک ردیف انتخاب کنید', 'warning');
                //         }
                //     }
                // }, '-',
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
                field: 'category_id',
                type: 'combobox',
                options: {
                    panelHeight: 'auto',
                    data: {!! $categories !!},
                    onChange: function (value) {
                        if (value == '') {
                            dg.datagrid('removeFilterRule', 'category_id');
                        } else {
                            dg.datagrid('addFilterRule', {
                                field: 'category_id',
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
