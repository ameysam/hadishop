@extends('_layouts.admin.index')

@section('content')
    @component('_components.admin.page_title_show')
    @hasp('schedule-edit', $g_center->id)
        @slot('edit_route', route('admin.center.schedule.edit', [$g_center->id, $record->id]))
    @endhasp
        @slot('back_route', route('admin.center.schedule.index', $g_center->id))
    @endcomponent

    <div class="row">
        <div class="col-6">
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

                        <tbody class="number-fa">
                            <tr>
                                <th>عنوان</th>
                                <td>{{ $record['name'] }}</td>
                            </tr>

                            <tr>
                                <th>تاریخ شروع</th>
                                <td>{{ jdate($record['started_date'])->format('Y/m/d') }}</td>
                            </tr>

                            <tr>
                                <th>تاریخ پایان</th>
                                <td>{{ jdate($record['finished_date'])->format('Y/m/d') }}</td>
                            </tr>

                            <tr>
                                <th>ساعت شروع</th>
                                <td>{{ jdate($record['started_time'])->format('H:i') }}</td>
                            </tr>

                            <tr>
                                <th>ساعت پایان</th>
                                <td>{{ jdate($record['finished_time'])->format('H:i') }}</td>
                            </tr>

                            <tr>
                                <th>سقف زمان رزرو</th>
                                <td>{{ $record['reserve_duration'] }} دقیقه</td>
                            </tr>

                            <tr>
                                <th>فاصله بین هر رزرو</th>
                                <td>{{ $record['gap_duration'] }} دقیقه</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title mb-2">روزها</h4>
                    <table class="table table-striped table-bordered">
                        <thead class="bg-secondary">
                            <tr>
                                <th class="text-white text-center">روز</th>
                                <th class="text-white text-center">تاریخ</th>
                                <th class="text-white text-center">ساعت شروع</th>
                                <th class="text-white text-center">ساعت پایان</th>
                            </tr>
                        </thead>

                        <tbody class="number-fa">
                            @foreach ($details as $item)
                                <tr>
                                    <td class="text-center">{{ jdate($item['started_at'])->format('%A') }}</td>
                                    <td class="text-center">{{ jdate($item['started_at'])->format('Y/m/d') }}</td>
                                    <td class="text-center">{{ jdate($item['started_at'])->format('H:i') }}</td>
                                    <td class="text-center">{{ jdate($item['finished_at'])->format('H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
