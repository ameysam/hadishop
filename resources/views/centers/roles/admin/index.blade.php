@extends('_layouts.admin.index')

@section('content')

@hasp('role-add', $g_center->id)
<div class="row">
    <div class="col-12">
        <a href="{{ route('admin.center.role.create', $g_center->id) }}" class="btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;نقش جدید</a>
    </div>
</div>
<br>
@endhasp
<div class="row">
    @foreach ($records as $record)
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('admin.center.role.show', [$g_center->id, $record->id]) }}">{{ $record->title }}</a>
                    </h5>
                    <span class="text-primary">{{ $record->type_fa }}</span><br>
                    @hasp('role-delete', $record->id)
                        <a class="text-danger float-left ml-2" title="حذف" href="javascript:void(0);" data-url="{{ route('admin.center.role.delete', [$g_center->id, $record->id]) }}"><i class="fas fa-trash role-deleter"></i></a>
                    @endhasp
                    @hasp('role-edit', $record->id)
                        <a href="{{ route('admin.center.role.edit', [$g_center->id, $record->id]) }}" class="text-gray float-left" title="ویرایش"><i class="fas fa-pen-alt"></i></a>
                    @endhasp
                    <a href="{{ route('admin.center.role.show', [$g_center->id, $record->id]) }}" class="text-gray float-left mr-2" title="مشاهده"><i class="fas fa-eye"></i></a>
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

@push('scripts')
    <script>
        $(function(){
            $(document).on('click', '.role-deleter', function(){
                var $this = $(this);
                var url = $this.parent().attr('data-url');

                makeAlert('<span style="font-size:large">آیا تایید می‌کنید ؟</span>', '', 'orange', function(){
                    $.LoadingOverlay("show");

                    var data = {'_method' : 'DELETE'};

                    $.post(url, data, function( result ) {
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
                    }, 'json').fail(function (jqXhr) {
                        makeAlert('خطا!', getErrors(jqXhr), 'red');
                        showErrors(jqXhr);
                        $.LoadingOverlay("hide");
                    });
                }, 'confirm');
            });
        });
    </script>
@endpush

@endsection

