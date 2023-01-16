@extends('_layouts.admin.index')

@section('content')

    @component('_components.admin.page_title_show')
        @hasp('role-edit', $g_center->id)
            @slot('edit_route', route('admin.center.role.edit', [$g_center->id, $record->id]))
        @endhasp
        @slot('back_route', route('admin.center.role.index', $g_center->id))
    @endcomponent
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title mb-2">دسترسی ها</h4>
                    <table class="table table-striped table-bordered">
                        <thead class="bg-secondary">
                            <tr>
                                <th class="text-white text-center">اطلاعات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="row">
                                        @foreach ($permissionTitles as $permissionTitle)

                                        <div class="col-sm-3 permission-title-fieldset select-all-container">
                                            <div class="row permission-title">
                                                <div class="col-sm-12">
                                                    {{ $permissionTitle['title'] }}
                                                </div>
                                            </div>

                                            <div class="row permission-items">
                                                @foreach ($permissionTitle['centerPermissions'] as $permission)
                                                    <div class="col-sm-12">
                                                        @if(isset($record) && $record->permissions->contains($permission->id))
                                                            <i class="fas fa-check text-success"></i>
                                                        @else
                                                            <i class="fas fa-minus text-danger"></i>
                                                        @endif
                                                        <span>{{ $permission->title }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title mb-2">مشخصات</h4>

                    <table class="table table-striped table-bordered">
                        <thead class="bg-secondary">
                            <tr>
                                <th class="text-white text-center" style="width: 40%">عنوان</th>
                                <th class="text-white text-center">اطلاعات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>نام</th>
                                <td>{{ $record['slug'] }}</td>
                            </tr>

                            <tr>
                                <th>عنوان</th>
                                <td>{{ $record['title'] }}</td>
                            </tr>

                            <tr>
                                <th>نوع</th>
                                <td>{{ $record['type_fa'] }}</td>
                            </tr>

                            <tr>
                                <th>تاریخ ایجاد</th>
                                <td class="number-fa">{{ jdate($record['created_at'])->format('Y/m/d H:i:s') }}</td>
                            </tr>

                            <tr>
                                <th>تاریخ بروز رسانی</th>
                                <td class="number-fa">{{ jdate($record['updated_at'])->format('Y/m/d H:i:s') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .permission-title-fieldset{
        margin-bottom: 20px;
    }
    .permission-title{
        margin-bottom: 10px;
        font-weight: bolder;
        /* color: red; */
    }
    .permission-title label{
        font-weight: bold !important;
        font-size: 16px;
    }
    .permission-items{
        margin-right: 0;
    }
</style>
@endpush
