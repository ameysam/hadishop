@extends('_layouts.admin.index')

@section('content')

    @component('_components.admin.page_title_show')
        @role('admin')
            @slot('edit_route', route('admin.product.edit', $record->id))
        @endrole
        @slot('back_route', route('admin.product.index'))
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
                                <td class="text-center">{{ $record['name'] }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">تاریخ ثبت</th>
                                <td class="text-center number-fa" dir="ltr">{{ jdate($record->created_at)->format('Y/m/d H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">توضیحات</th>
                                <td class="text-left">{!! nl2br($record['description']) !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12">
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
                                <th class="text-center">قیمت</th>
                                <td class="text-center">{{ number_format($record['price']) ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">دسته‌بندی</th>
                                <td class="text-center">{{ $record['category']['name'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">وضعیت ویژه</th>
                                <td class="text-center">{{ $record->special_fa ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">وضعیت پیشنهاد</th>
                                <td class="text-center">{{ $record->suggest_fa ?? '' }}</td>
                            </tr>
                            @if ($record['file'])
                                <tr>
                                    <th>تصویر</th>
                                    <td><img style="width: 200px" class="img-thumbnail rounded" src="{{ $record->file_path }}" alt=""></td>
                                </tr>
                            @endif
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
