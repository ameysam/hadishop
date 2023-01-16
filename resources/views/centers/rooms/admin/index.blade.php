@extends('_layouts.admin.index')

@section('content')

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
@if ($records->isEmpty())
    <div class="col-12 text-center">
        <span class="text-danger">اتاقی برای این مرکز ثبت نشده است.</span>
    </div>
@else
    <div class="row">
        @foreach ($records as $record)
            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fa fa-home"> </i>
                            <a class="text-dark font-weight-bold" href="{{ route('admin.center.room.show', [$g_center->id, $record->id]) }}">{{ $record->name }}</a>
                        </h5>
                        <span class="font-weight-bold text-{{ $record->isMeetings() ? 'success' : 'primary' }}">{{ $record->type_fa }}</span>
                        <span class="text-muted number-fa">(ظرفیت {{ $record->capacity }} نفر)</span>
                        @if($record->schedule)
                            <div class="text-dark number-fa"><a href="{{ route('admin.center.schedule.show', [$g_center->id, $record->schedule_id]) }}" target="_blank">زمان‌بندی تخصیص یافته:‌ {{ $record->schedule->name }}</a></div>
                        @else
                            <div class="text-danger number-fa">امکان رزرو این اتاق به علت عدم تخصیص زمان‌بندی وجود ندارد.</div>
                        @endif
                        <p class="card-text">{{ Str::limit($record->description, 85, '...') }}</p>

                        <div class="dropdown dropright dot-left-menu">
                            <i  class="fas fa-ellipsis-v cursor-pointer dropdown-toggle1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @hasp('room-edit', $g_center->id)
                                <a href="{{ route('admin.center.room.edit', [$g_center->id, $record->id]) }}" class="dropdown-item text-dark" title="ویرایش"><i class="fas fa-edit"></i>&nbsp;ویرایش</a>
                                @endhasp
                                <a href="{{ route('admin.center.room.show', [$g_center->id, $record->id]) }}" class="dropdown-item text-dark mr-2" title="مشاهده"><i class="fas fa-eye"></i>&nbsp;مشاهده</a>
                                @hasp('room-show', $g_center->id)
                                    @if($record->schedule)
                                        <a href="{{ route('admin.center.room.timing.index', [$g_center->id, $record->id]) }}" class="dropdown-item text-dark" title="رزرو"><i class="fas fa-clock"></i>&nbsp;رزرو</a>
                                    @endif
                                @endhasp
                            </div>
                        </div>
                        {{-- @hasp('room-edit', $g_center->id)
                            <a href="{{ route('admin.center.room.edit', [$g_center->id, $record->id]) }}" class="text-danger float-left" title="ویرایش"><i class="fas fa-edit"></i></a>
                        @endhasp
                        <a href="{{ route('admin.center.room.show', [$g_center->id, $record->id]) }}" class="text-primary float-left" title="مشاهده"><i class="fas fa-eye"></i></a>
                        @hasp('room-show', $g_center->id)
                            @if($record->schedule)
                                <a href="{{ route('admin.center.room.timing.index', [$g_center->id, $record->id]) }}" class="text-success float-left" title="رزرو"><i class="fas fa-clock"></i></a>
                            @endif
                        @endhasp --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@push('styles')
    <style>
        .card-text{
            height: 20px;
        }
    </style>
@endpush

@endsection

