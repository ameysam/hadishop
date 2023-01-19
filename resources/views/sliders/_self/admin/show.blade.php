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
                                <th class="text-center">عنوان</th>
                                <td class="text-center">{{ $record['name'] }}</td>
                            </tr>
                            <tr>
                                <th class="text-center">تاریخ ثبت</th>
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
                    <h4 class="box-title mb-2">مشخصات</h4>

                    <table class="table table-striped table-bordered">
                        <thead class="bg-secondary">
                            <tr>
                                <th class="text-white text-center" style="width: 40%">عنوان</th>
                                <th class="text-white text-center">اطلاعات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if($record['link'])
                            <tr>
                                <th class="text-center">لینک</th>
                                <td class="text-center">
                                    <a target="blank" href="{{$record['link'] ?? '#'}}">مشاهده لینک</a>
                                </td>
                            </tr>
                            @endif
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
    </div>
@endsection
