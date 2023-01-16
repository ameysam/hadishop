@extends('_layouts.admin.index')

@section('content')
<div class="row">
    <div class="col-12 text-left">
        <span class="text-white font-weight-bold bg-dark px-2">جهت رزرو اتاق، مرکز مورد نظر خود را انتخاب کنید</span>
    </div>
</div>
<br>
<div class="row">
    {{-- @if($records->isEmpty())
        <div class="col-12 text-center">
            <span class="text-danger">شما به هیچ مرکزی درسترسی ندارید.</span>
        </div>
    @else
        @foreach ($records as $record)
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('admin.center.show', $record->id) }}">{{ $record->name }}</a>
                            <span class="text-info small">({{ $record->type->name }})</span>
                        </h5>
                        <span class="text-muted">({{ $record->rooms_count }} اتاق)</span>


                        <a href="{{ route('admin.center.show', $record->id) }}" class="rounded text-light bg-primary p-1 small float-left"><i class="fas fa-hand-pointer"> انتخاب</i></a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif --}}
</div>

@push('styles')
    <style>
        .card-text{
            height: 20px;
        }
    </style>
@endpush

@endsection

