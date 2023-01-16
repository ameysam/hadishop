@extends('_layouts.admin.index')

@section('content')
    @component('_components.admin.page_title')
        @slot('title', 'تخصیص زمان‌بندی به اتاق')
        @slot('button_title', 'ثبت')
        @slot('button_route', $form['action'])
        @slot('location_route', route('admin.center.room.schedule.index', $g_center->id))
        @slot('back_route', '')
        @slot('with_assets', true)
        @slot('method', $form['method'] ?? 'post')
    @endcomponent

        <div class="row">
            <div id="form-errors" class="col-lg-12 d-none">

            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="post" id="form1">
                        <div class="row">
                            <div class="col-md-12">
                                @component('_components.admin.select.single')
                                    @slot('title', 'اتاق')
                                    @slot('id', 'room_id')
                                    @slot('star', true)
                                    @slot('options')
                                        @foreach ($roomsWithoutSchedule as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }} ({{ $item->type_fa }})</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>
                            <div class="col-md-12">
                                @component('_components.admin.select.single')
                                    @slot('title', 'زمان‌بندی')
                                    @slot('id', 'schedule_id')
                                    @slot('star', true)
                                    @slot('options')
                                        @foreach ($schedules as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="post" id="form2">
                        <div class="row">
                            <div class="col">
                                @if (count($roomsWithSchedule) > 0)
                                <ul class="list-group pl-0">
                                    @foreach ($roomsWithSchedule as $item)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="w-25"><a href="{{ route('admin.center.room.show', [$g_center->id, $item->id]) }}" target="_blank" class="text-dark">{{ $item->name }}</a></span>
                                            <span class="w-25"><a href="{{ route('admin.center.schedule.show', [$g_center->id, $item->schedule_id]) }}" target="_blank" class="text-dark">{{ $item->schedule->name }}</a></span>
                                            <span class="badge badge-danger badge-pill cursor-pointer" title="حذف زمان‌بندی" data-id="{{ $item->id }}"><i class="fas fa-trash"></i></span>
                                        </li>
                                    @endforeach
                                  </ul>
                                @else
                                    <span class="font-weight-bold text-center text-danger">پیش از این هیچ زمان‌بندی‌ای به اتاقی نسبت داده نشده است</span>
                                @endempty
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    <script>
        $(function(){
            $('.badge-pill').click(function(){
                var id = $(this).attr('data-id');

                $.ajaxSetup({
                    contentType: false,
                    processData: false
                });

                makeAlert('<span style="font-size:large">آیا تایید می‌کنید ؟</span>', '', 'orange', function(){

                    var formData = new FormData();

                    formData.append('room_id', id);
                    formData.append('_method', 'DELETE');

                    $.post("{{ route('admin.center.room.schedule.delete', [$g_center->id]) }}", formData, function( result ) {
                        if (result.status)
                        {
                            makeAlert('پاسخ', result.message, 'green', function () {
                                window.location = window._form_location_url;
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
