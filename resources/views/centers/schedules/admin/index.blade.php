@extends('_layouts.admin.index')

@section('content')

<div class="row">
    <div class="col-12">
        @hasp('schedule-add', $g_center->id)
            <a href="{{ route('admin.center.schedule.create', [$g_center->id]) }}" class="btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;زمان‌بندی جدید</a>
        @endhasp
        @hasp('room-edit', $g_center->id)
            <a href="{{ route('admin.center.room.schedule.index', [$g_center->id]) }}" class="btn-sm btn-primary"><i class="fas fa-link"></i>&nbsp;تخصیص زمان‌بندی به اتاق</a>
        @endhasp
    </div>
</div>
<br>
<div class="row">
    @if ($records->count())
        @foreach ($records as $record)
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="text-dark" href="{{ route('admin.center.schedule.show', [$g_center->id, $record->id]) }}">{{ $record->name }}</a>
                    </h5>
                    <div class="text-primary number-fa"><i class="fa fa-calendar"></i> از تاریخ {{jdate($record->started_date)->format('Y/m/d')}} تا {{jdate($record->finished_date)->format('Y/m/d')}}</div>
                    <div class="text-success number-fa"><i class="fa fa-clock"></i> از ساعت {{jdate($record->started_time)->format('H:i')}} تا {{jdate($record->finished_time)->format('H:i')}}</div>
                    <div class="text-muted number-fa">سقف زمان رزرو {{$record->reserve_duration}} دقیقه</div>
                    <div class="text-muted number-fa">فاصله بین هر رزرو {{$record->gap_duration}} دقیقه</div>
                    @if ($record->rooms->count())
                        @foreach ($record->rooms as $room)
                            <span class="rounded text-light bg-dark px-2 small">{{$room->name}}</i></span>
                        @endforeach
                    @else
                        @hasp('schedule-delete', $g_center->id)
                            <a href="javascript:void(0);" class="text-danger float-left btn-remove-item" data-id="{{ $record->id }}" title="حذف"><i class="fas fa-trash"></i></a>
                        @endhasp
                    @endif
                    @hasp('schedule-edit', $g_center->id)
                        <a href="{{ route('admin.center.schedule.edit', [$g_center->id, $record->id]) }}" class="text-primary float-left mr-2" title="ویرایش"><i class="fas fa-edit"></i></a>
                    @endhasp
                    {{-- <a href="{{ route('admin.center.room.edit', [$g_center->id, $record->id]) }}" class="text-warning float-left" title="ویرایش"><i class="fas fa-edit"></i></a> --}}
                </div>
            </div>
        </div>
        @endforeach
    @else
        <div class="col-12 text-center">
            <span class="text-danger">هیچ رکوردی یافت نشد.</span>
        </div>
    @endif
</div>

@push('styles')
    <style>
        .card-text{
            height: 20px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(function(){
            $.ajaxSetup({
                contentType: false,
                processData: false
            });
            $('.btn-remove-item').click(function () {
                var $this = $(this);
                var id = $this.attr('data-id');

                makeAlert('<span style="font-size:large">آیا تایید می‌کنید ؟</span>', '', 'orange', function(){
                    $.LoadingOverlay("show");
                    $this.prop('disabled', true);
                    $this.find('i').attr("class", "fas fa-spinner align-middle fa-pulse");

                    var url = "{{ route('admin.center.schedule.index', $g_center->id) }}";

                    url += ('/' + id);

                    console.log(url)

                    var formData = new FormData();

                    formData.append('_method', 'DELETE')

                    $.post(url, formData, function (result) {
                        if (result.status)
                        {
                            makeAlert('پاسخ', result.message, 'green', function () {
                                location.reload();
                            });
                        }
                        else
                        {
                            makeAlert('اخطار!', result.message, 'orange');
                        }
                        $.LoadingOverlay("hide");
                    }, 'json').fail(function (jqXhr)
                    {
                        makeAlert('خطا!', getErrors(jqXhr), 'red');
                        $.LoadingOverlay("hide");
                    }).always(function (){
                        setTimeout(function(){
                            $this.prop('disabled', false);
                            $this.find('i').attr("class", "fas fa-trash align-middle");
                        }, 750);
                    });
                }, 'confirm');
            });
        });
    </script>
@endpush

@endsection

