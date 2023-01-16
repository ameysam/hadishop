@extends('_layouts.admin.index')

@section('content')
    @component('_components.admin.page_title_show')
        @hasp('room-edit', $g_center->id)
            @slot('edit_route', route('admin.center.room.edit', [$g_center->id, $record->id]))
        @endhasp
        @slot('back_route', route('admin.center.show', $g_center->id))
        {{-- @slot('back_route', route('admin.center.room.index', $g_center->id)) --}}
    @endcomponent

    <div class="row">
        <div class="col-12">
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
                                <th>نام</th>
                                <td>{{ $record['name'] }}</td>
                            </tr>

                            <tr>
                                <th>ظرفیت</th>
                                <td>{{ $record['capacity'] }} (نفر)</td>
                            </tr>

                            @if ($record->schedule)
                            <tr>
                                <th>زمان‌بندی</th>
                                <td>
                                    <a href="{{ route('admin.center.schedule.show', [$g_center->id, $record->schedule_id]) }}" target="_blank">{{ $record['schedule']['name'] }}</a>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <th>نوع</th>
                                <td>{{ $record['type_fa'] }}</td>
                            </tr>

                            <tr>
                                <th>توضیحات</th>
                                <td>{!! nl2br($record['description']) !!}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
