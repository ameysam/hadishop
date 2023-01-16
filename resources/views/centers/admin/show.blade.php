@extends('_layouts.admin.index')

@section('content')

    {{-- @component('centers.admin._components.hmenu')

    @endcomponent --}}

    @component('_components.admin.page_title_show')
        @hasp('center-edit', $record->id)
            @slot('edit_route', route('admin.center.edit', $record->id))
        @endhasp
        @slot('back_route', route('admin.center.index'))
        @slot('title', "مرکز «{$record->name}» و اتاق‌ها")
    @endcomponent

    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title mb-3">اتاق‌های مرکز</h4>
                    <div class="row">
                        <div class="col-12">
                            @hasp('room-add', $g_center->id)
                                <a href="{{ route('admin.center.room.create', [$g_center->id]) }}" class="btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;اتاق جدید</a>
                            @endhasp
                            @hasp('room-edit', $g_center->id)
                                <a href="{{ route('admin.center.room.schedule.index', [$g_center->id]) }}" class="btn-sm btn-primary"><i class="fas fa-link"></i>&nbsp;تخصیص زمان‌بندی به اتاق</a>
                            @endhasp
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        @if ($record->rooms->isEmpty())
                            <div class="col-12 text-center">
                                <span class="text-danger">اتاقی برای این مرکز ثبت نشده است.</span>
                            </div>
                        @else
                            @foreach ($record->rooms as $room)
                                <div class="col-md-4 col-12">
                                    <div class="item border rounded {{ $room->schedule ? 'border-success' : 'border-danger' }} p-2 float-right w-100">
                                        <h5 class="card-title">
                                            <i class="fa fa-home"> </i>
                                            <a class="text-dark font-weight-bold" href="{{ route('admin.center.room.show', [$g_center->id, $room->id]) }}">{{ $room->name }}</a>
                                        </h5>
                                        <span class="text-dark"><i class="fa fa-list"></i> <span class="font-weight-bold text-{{ $room->isMeetings() ? 'success' : 'primary' }}">{{ $room->type_fa }}</span>
                                        <span class="text-muted number-fa">(ظرفیت {{ $room->capacity }} نفر)</span>
                                        <p class="card-text">{{ Str::limit($record->description, 85, '...') }}</p>
                                        @hasp('room-edit', $g_center->id)
                                            <a href="{{ route('admin.center.room.edit', [$g_center->id, $room->id]) }}" class="text-dark float-left" title="ویرایش"><i class="fas fa-edit"></i></a>
                                        @endhasp
                                        <a href="{{ route('admin.center.room.show', [$g_center->id, $room->id]) }}" class="text-dark float-left" title="مشاهده"><i class="fas fa-eye"></i></a>
                                        @if($room->schedule)
                                            <a href="{{ route('admin.center.room.timing.index', [$g_center->id, $room->id]) }}" class="bg-info text-white rounded px-3 float-right" title="رزرو"><i class="fas fa-clock faa-flash animated"></i>&nbsp;رزرو</a>
                                        @else
                                            <span class="d-block w-100 text-center text-danger rounded p-1 btn-sm float-right"><i class="fa fa-times"></i> امکان رزرو این اتاق به علت عدم تخصیص زمان‌بندی وجود ندارد.</span>
                                            {{-- <div class="text-danger number-fa">امکان رزرو این اتاق به علت عدم تخصیص زمان‌بندی وجود ندارد.</div> --}}
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 admin-panel-sidebar">
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

                        <tbody class="number-fa">
                            <tr>
                                <th>نام</th>
                                <td>{{ $record['name'] }}</td>
                            </tr>

                            <tr>
                                <th>تعداد اتاق</th>
                                <td>{{ $record['rooms_count'] }}</td>
                            </tr>

                            <tr>
                                <th>نوع</th>
                                <td>{{ $record['type']['name'] }}</td>
                            </tr>
                            <tr>
                                <th>وضعیت</th>
                                <td>{{ $record['status_fa'] }}</td>
                            </tr>
                            <tr>
                                <th>مسئول</th>
                                <td>
                                    @foreach($record->admins as $user)
                                        {{ $user->full_name }},
                                    @endforeach
                                </td>
                            </tr>

                            <tr>
                                <th>اطلاعات تماس</th>
                                <td>{{ $record['contacts'] }}</td>
                            </tr>

                            <tr>
                                <th>آدرس</th>
                                <td>{{ $record['address'] }}</td>
                            </tr>

                            @if ($record['file'])
                                <tr>
                                    <th>لوگو</th>
                                    <td><img style="width: 200px" class="img-thumbnail rounded" src="{{ '/' . config('filesystems.files_link') . ("/{$record['file']['uploaded_name']}") }}" alt=""></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="box-title mb-2">موقعیت مکانی</h4>

                    @component('_components.admin.map.cedar.only_represent')
                    @slot('with_assets' , true)
                        @if(isset($record))
                            @slot('lat' , $record['lat'])
                            @slot('lng' , $record['lng'])
                        @endif
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
@endsection
