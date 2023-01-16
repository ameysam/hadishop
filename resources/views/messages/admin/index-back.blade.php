@extends('_layouts.admin.index')

@section('content')

@can('meeting-list-search')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="box-title">فیلتر</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4 col-12">
                                        @component('_components.admin.select.single_live_search')
                                        @slot('id', 'user')
                                        @slot('url', route('admin.search.auto.user'))
                                        @slot('title', 'اعضا')
                                        @if(isset($user))
                                            @slot('options')
                                                <option value="{{ $user->id }}" selected="selected">{{ $user->full_name }} ({{ $user->id_no }})</option>
                                            @endslot
                                        @endif
                                        @endcomponent
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-right">
                                <button type="button" id="btn_search" class="btn btn-sm btn-success"><i class="fas fa-search"></i>&nbsp;جستجو</button>
                                <a href="{{ route('admin.event.index') }}" class="btn-sm btn-danger"><i class="fas fa-eraser"></i>&nbsp;حذف فیلترها</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <a href="{{ route('admin.center.room.create', [$g_center->id]) }}" class="btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;اتاق جدید</a>
        <a href="{{ route('admin.center.room.schedule.index', [$g_center->id]) }}" class="btn-sm btn-primary" target="_blank"><i class="fas fa-link"></i>&nbsp;تخصیص زمان‌بندی به اتاق</a> --}}
    </div>
</div>
@endcan

<div class="row">
    <div class="col-12">
        <button id="btn-new-record" type="button" class="btn btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;رويداد جدید</button>
    </div>
</div>
<br>
<div class="row">
    @if($records->count())
        @foreach ($records as $record)
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card {{ $record->isExpired() ? 'disabled' : '' }}">

                    <a href="{{ route("admin.event.items", $record->id) }}" target="_blank" class="btn-view">
                        <i class="fas fa-eye text-primary cursor-pointer" data-id="{{ $record->id }}"></i>
                    </a>
                    {{-- <i class="fas fa-eye text-primary cursor-pointer btn-view" data-id="{{ $record->id }}"></i> --}}


                    {{-- @if ($record->center->isActive())
                        @if ($_current_user->isSuperAdmin() || $_current_user->hasRole($record->center->adminRoleName()) || $record->secretary_id == $_current_user->id)
                            <i class="far fa-sticky-note text-success cursor-pointer btn-proceedings" data-id="{{ $record->id }}" title="صورتجلسه"></i>
                        @endif

                        @if ($_current_user->isSuperAdmin() || (!$record->isExpired() && ($_current_user->id == $record->user_id || $_current_user->hasp('center-edit', $record->center_id))))
                            <a href="{{ route('admin.center.room.timing.edit', [$record->center_id, $record->room_id, $record->id]) }}" class="btn-edit">
                                <i class="fas fa-edit text-warning cursor-pointer" data-id="{{ $record->id }}"></i>
                            </a>
                        @endif
                        @if ($_current_user->isSuperAdmin() || (!$record->isExpired() && $record->isNotStartedYet() && ($_current_user->id == $record->user_id || $_current_user->hasp('center-delete', $record->center_id))))
                            <a href="javascript:void(0);" data-href="{{ route('admin.center.room.timing.delete', [$record->center_id, $record->room_id, $record->id]) }}" class="btn-remove">
                                <i class="fas fa-trash text-danger cursor-pointer" data-id="{{ $record->id }}"></i>
                            </a>
                        @endif
                    @endif --}}

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="row">

                                    <div class="col-12">
                                        <h5 class="card-title">
                                            {{ $record->name }}
                                        </h5>
                                    </div>
                                    {{-- <div class="col-2">
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <h6 class="card-title">
                                    {{ $record->center->name }} - {{ $record->room->name }}
                                </h6>
                            </div>
                            <div class="col-12 number-fa">
                                <span class="">ساعت: {{ jdate($record->started_time)->format('H:i') }}</span>&nbsp;&nbsp;
                                <span class="">{{ jdate($record->day)->format('%A Y/m/d') }}</span>
                            </div>
                        </div>

                        {{-- <span class="font-weight-bold text-{{ $record->isMeetings() ? 'success' : 'primary' }}">{{ $record->type_fa }}</span>
                        <span class="text-muted number-fa">({{ $record->capacity }} نفر)</span>
                        @if($record->schedule)
                            <div class="text-dark number-fa"><a href="{{ route('admin.center.schedule.show', [$g_center->id, $record->schedule_id]) }}" target="_blank">زمان‌بندی {{ $record->schedule->name }}</a></div>
                        @endif
                        <p class="card-text">{{ Str::limit($record->description, 30, '...') }}</p>
                        <a href="{{ route('admin.center.room.edit', [$g_center->id, $record->id]) }}" class="text-warning float-left" title="ویرایش"><i class="fas fa-edit"></i></a>
                        @if($record->schedule)
                            <a href="{{ route('admin.center.room.timing.index', [$g_center->id, $record->id]) }}" class="text-danger float-left" title="رزرو"><i class="fas fa-clock"></i></a>
                        @endif --}}


                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12 text-center">
            <span class="text-danger">رکوردی یافت نشد.</span>
        </div>
    @endif

    @if ($records->lastPage() > 1)
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9 number-fa">
                            {{ $records->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('modal-content')
    @component('events.admin._components.modal-form')
        @slot('title', 'جلسه جدید')
        {{-- @slot('periodic_types', $periodic_types) --}}
    @endcomponent
@endsection

@push('scripts')
    <script>
        var $mdlForm = $('#mdl-form');
        var $btnNewRecord = $('#btn-new-record');

        $(function(){

            $.ajaxSetup({
                contentType: false,
                processData: false
            });

            $(document).on('click', '#btn-new-record', function(){
                var $this = $(this);

                $mdlForm.modal('toggle');
            });
            $(document).on('click', '#btn-register-events', function(){
                var $this = $(this);

                // var eventName = $('#input_name').val();
                // var $highlighted = $('.highlighted');
                // if(!eventName)
                // {
                //     return false;
                // }

                $.LoadingOverlay("show");

                $this.prop('disabled', true);
                $this.find('i').attr('class', "fas fa-spinner fa-pulse");

                var formData = new FormData(document.getElementById('frm-event'));

                $.post("{{$form['action']}}", formData, function (result) {
                    if (result.status)
                    {
                        makeAlert('پاسخ', result.message, 'green', function () {
                            location.reload();
                        });
                        // console.log(result)
                        // $('td.highlighted').addClass('reserved').removeClass('highlighted');
                        // $('#input_name').val('');
                    }
                    else
                    {
                        makeAlert('اخطار!', result.message, 'orange');
                    }
                    $.LoadingOverlay("hide");
                }, 'json').fail(function (jqXhr)
                {
                    makeAlert('خطا!', getErrors(jqXhr), 'red');
                    showErrors(jqXhr);
                    $.LoadingOverlay("hide");
                }).always(function ()
                {
                    setTimeout(function(){
                        $this.prop('disabled', false);
                        $this.find('i').attr('class', "fas fa-check-circle");
                    }, 750);
                });
            });

            // $mdlShow.on('hidden.bs.modal', function (event) {
            //     $('#mdl-title').removeClass('text-success').removeClass('text-danger').removeClass('text-dark');
            // });
        });
    </script>
@endpush

@push('styles')
    <style>
        .btn-view{
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 100;
        }
        .btn-edit{
            position: absolute;
            top: 60px;
            left: 20px;
            z-index: 100;
        }
        .btn-proceedings{
            position: absolute;
            top: 40px;
            left: 20px;
            z-index: 100;
        }
        .btn-remove{
            position: absolute;
            top: 80px;
            left: 20px;
            z-index: 100;
        }
    </style>
@endpush
