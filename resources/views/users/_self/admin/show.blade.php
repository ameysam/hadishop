@extends('_layouts.admin.index')

@section('content')

    @component('_components.admin.page_title_show')
        @role('admin')
            @slot('edit_route', route('admin.user.edit', $record->id))
        @endrole
        @slot('back_route', route('admin.user.index'))
    @endcomponent

    <div class="row">
        <div class="col-md-8 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title mb-2">مشخصات</h4>

                    <table class="table table-striped table-bordered">
                        <thead class="bg-secondary">
                            <tr>
                                <th class="text-white text-center" style="width: 20%">عنوان</th>
                                <th class="text-white text-center">اطلاعات</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th class="text-center">نام</th>
                                <td class="text-center">{{ $record['first_name'] }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">نام خانوادگی</th>
                                <td class="text-center">{{ $record['last_name'] }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">کد شناسایی</th>
                                <td class="text-center number-fa">{{ $record->id_no }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">شماره همراه</th>
                                <td class="text-center number-fa" dir="ltr">{{ $record->mobile_no }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">ایمیل</th>
                                <td class="text-center">{{ $record->email }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">تاریخ تولد</th>
                                <td class="text-center number-fa">{{ $record->birthdate ? jdate($record->birthdate)->format('Y/m/d') : '' }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">جنسیت</th>
                                <td class="text-center">{{ $record->gender_fa }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">وضعیت</th>
                                <td class="text-center">{{ $record->activation_status_fa }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">نوع فعال سازی</th>
                                <td class="text-center">{{ $record->activation_type_fa }}</td>
                            </tr>

                            <tr>
                                <th class="text-center">تاریخ ثبت نام</th>
                                <td class="text-center number-fa" dir="ltr">{{ jdate($record->created_at)->format('Y/m/d H:i:s') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title mb-2">محل سکونت</h4>

                    <table class="table table-striped table-bordered">
                        <thead class="bg-secondary">
                            <tr>
                                <th class="text-white text-center" style="width: 40%">عنوان</th>
                                <th class="text-white text-center">اطلاعات</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th class="text-center">استان</th>
                                <td class="text-center">{{ $record['province']['title'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">شهر</th>
                                <td class="text-center">{{ $record['city']['title'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title mb-2">آواتار</h4>
                    <img src="{{ $record->image ? asset("storage/{$record->image}") : '' }}" width="100%" class="img-thumbnail rounded mx-auto d-block" alt="">
                </div>
            </div>
        </div> --}}
    </div>
@endsection
