@extends('_layouts.admin.index')

@section('content')

@can('center-add')
<div class="row">
    <div class="col-12">
        <a href="{{ route('admin.center.create') }}" class="btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;مرکز جدید</a>
    </div>
</div>
<br>
@endcan
<div class="row">
    @foreach ($records as $record)
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="text-dark" href="{{ route('admin.center.show', $record->id) }}">{{ $record->name }}</a>
                        <span class="small text-{{ $record->isActive() ? 'success' : 'danger' }}">({{ $record->status_fa }})</span>
                    </h5>

                    <img src="{{ asset($record->getLogoDisplayPath()) }}" class="img-thumbnail rounded" alt="">

                    <span class="text-muted">({{ $record->rooms_count }} اتاق)</span><br>
                    <span class="text-muted mr-2"><i class="fa fa-home"></i> {{ $record->rooms_count }}</span>
                    <span class="font-weight-bold text-info"><i class="fa fa-tag text-muted"></i> {{ $record->type->name }}</span><br>
                    <p class="card-text text-muted mb-0"><i class="fa fa-map-marker text-muted"></i> {{ Str::limit($record->address, 85, '...') }}</p>
                    <br/>
                    @hasp('center-edit', $record->id)
                        <a href="{{ route('admin.center.edit', $record->id) }}" class="text-secondary float-left" title="ویرایش"><i class="fas fa-pen-alt"></i></a>
                    @endhasp
                    <a href="{{ route('admin.center.show', $record->id) }}" class="text-secondary float-left mr-1 rounded text-light bg-secondary px-2 small" title="انتخاب"><i class="fas fa-hand-pointer faa-flash animated faa-fast"></i> مدیریت مرکز </a>
                    {{-- @hasp('room-list', $record->id)
                        <a href="{{ route('admin.center.room.index', $record->id) }}" class="text-dark float-left" target="_blank" title="اتاق‌ها"><i class="fas fa-igloo"></i></a>
                    @endhasp
                    @hasp('schedule-list', $record->id)
                        <a href="{{ route('admin.center.schedule.index', $record->id) }}" class="text-danger float-left" target="_blank" title="زمان‌بندی ها"><i class="fas fa-clock"></i></a>
                    @endhasp --}}
                </div>
            </div>
        </div>
    @endforeach
</div>

@push('styles')
    <style>
        .card-text{
            height: 20px;
        }
    </style>
@endpush

@endsection

