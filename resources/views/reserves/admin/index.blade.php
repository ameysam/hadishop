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
                                <a href="{{ route('admin.meeting.index') }}" class="btn-sm btn-danger"><i class="fas fa-eraser"></i>&nbsp;حذف فیلترها</a>
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
    @if($records->count())
        @foreach ($records as $record)
            <div class="col-md-4 col-sm-6 col-12">
                <div class="card {{ $record->isExpired() ? 'disabled' : '' }}">

                    <a href="{{ route("admin.meeting.show", $record->id) }}" target="_blank" class="btn-view">
                        <i class="fas fa-eye text-primary cursor-pointer" data-id="{{ $record->id }}"></i>
                    </a>
                    {{-- <i class="fas fa-eye text-primary cursor-pointer btn-view" data-id="{{ $record->id }}"></i> --}}


                    @if ($record->center->isActive())
                        @if ($_current_user->isSuperAdmin() || $_current_user->hasRole($record->center->adminRoleName()) || $record->secretary_id == $_current_user->id)
                            <i class="far fa-sticky-note text-success cursor-pointer btn-proceedings" data-id="{{ $record->id }}" title="صورتجلسه"></i>
                        @endif

                        @if ($record->isActive() && ($_current_user->isSuperAdmin() || (!$record->isExpired() && ($_current_user->id == $record->user_id || $_current_user->hasp('center-edit', $record->center_id)))))
                            <a href="{{ route('admin.center.room.timing.edit', [$record->center_id, $record->room_id, $record->id]) }}" class="btn-edit">
                                <i class="fas fa-edit text-warning cursor-pointer" data-id="{{ $record->id }}"></i>
                            </a>
                        @endif
                        @if ($_current_user->isSuperAdmin() || (!$record->isExpired() && $record->isNotStartedYet() && ($_current_user->id == $record->user_id || $_current_user->hasp('center-delete', $record->center_id))))
                            <a href="javascript:void(0);" data-href="{{ route('admin.center.room.timing.delete', [$record->center_id, $record->room_id, $record->id]) }}" class="btn-remove">
                                <i class="fas fa-trash text-danger cursor-pointer" data-id="{{ $record->id }}"></i>
                            </a>
                        @endif
                    @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="row">

                                    <div class="col-12">
                                        <h5 class="card-title">
                                            {{ $record->name }}
                                            @if ($record->isCanceled())
                                                <small class="text-danger number-fa">({{ $record->status_fa }})</small>
                                            @endif
                                            @if ($record->isPeriodic())
                                                <small class="text-info number-fa">(دوره ای {{$record->periodic_type}} روزه)</small>
                                            @endif
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
                            @if (! $record->isExpired() && $record->center->isActive())
                                @component('reserves.admin._components.predict_section')
                                    @slot('record', $record)
                                    @slot('predict_statuses', $predict_statuses)
                                    @slot('predicted_value', $record->users[0]->pivot->status_predicted ?? null)
                                    @slot('after_register_action', 'location.reload()')
                                    @if ($loop->first)
                                        @slot('with_assets', true)
                                    @endif
                                @endcomponent
                            @endif
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
    <div class="modal fade" id="mdl-show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title float-right font-weight-bold" id="mdl-title">

                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body number-fa">
                    <div class="row">
                        <div class="col-12">
                            <h6 id="spn-title"></h6>
                        </div>
                        <div class="col-12 mt-2 font-weight-bold">
                            <span id="spn-day"></span>&nbsp;&nbsp;از&nbsp;
                            <span id="spn-started-time"></span>&nbsp;&nbsp;تا&nbsp;
                            <span id="spn-finished-time"></span>
                        </div>
                        <div class="col-12 mt-2">
                            <span id="spn-center-room" class="font-weight-bold"></span>
                        </div>
                        <div class="col-12 mt-2">
                            <span id="spn-center-name" class="font-weight-bold"></span>&nbsp;واقع در&nbsp;
                            <span id="spn-center-address" class="font-weight-bold"></span>
                        </div>
                        <div class="col-12 mt-2">
                            <span id="spn-description"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>&nbsp;بستن</button>
                </div>
            </div>
        </div>
    </div>

    @component('reserves.admin._components.proceedings_modal')
    @endcomponent
@endsection

@push('scripts')
    <script>
        var $mdlShow = $('#mdl-show');

        $(function(){

            $.ajaxSetup({
                contentType: false,
                processData: false
            });

            $(document).on('click', '#btn_search', function(){
                var $this = $(this);
                var user_id = $('#user').val();
                if(user_id)
                {
                    var url = "{{ route('admin.meeting.index') }}";
                    url += ("?user=" + user_id);
                    window.location = url;
                }
                else
                {
                    makeAlert('', 'هیچ فیلتری انتخاب نشده.', 'orange');
                }
            });

            $(document).on('click', '.btn-remove', function(){

                var $this = $(this);
                makeAlert('<span style="font-size:large">آیا تایید می‌کنید ؟</span>', '', 'orange', function(){
                    $.LoadingOverlay("show");

                    var url = $this.attr('data-href');

                    var formData = new FormData();
                    formData.append("_method", "DELETE");
                    $.post(url, formData, function( result ) {
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

            $mdlShow.on('hidden.bs.modal', function (event) {
                $('#mdl-title').removeClass('text-success').removeClass('text-danger').removeClass('text-dark');
            });
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
