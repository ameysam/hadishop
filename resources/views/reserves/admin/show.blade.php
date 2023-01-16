@extends('_layouts.admin.index')

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="box-title float-right">{{ $record->name }}</h4>
                @if ($record->isCanceled())
                    &nbsp;<small class="text-danger box-title number-fa">({{ $record->status_fa }})</small>
                @endif
                @if ($record->isPeriodic())
                    <span class="text-danger font-weight-bold number-fa float-left">دوره ای {{$record->periodic_type}} روزه</span>
                @endif

                @if($_current_user->isSuperAdmin() || $_current_user->hasRole(['admin', $record->center->adminRoleName()]))
                    <button type="button" class="btn btn-primary btn-sm float-left" id="btn-change-status" data-status="{{ $record->status }}">
                        <i class="fas fa-edit"></i>&nbsp;
                        @if ($record->isActive())
                        لغو
                        @else
                        فعال سازی
                        @endif
                    </button>

                    @push('scripts')
                        <script>
                            $(function(){
                                $(document).on('click', '#btn-change-status', function(){
                                    var $this = $(this);

                                    $.ajaxSetup({
                                        contentType: false,
                                        processData: false
                                    });

                                    makeAlert('<span style="font-size:large">آیا تایید می‌کنید ؟</span>', '', 'orange', function(){
                                        $.LoadingOverlay("show");
                                        // var status = $this.attr('data-status');

                                        var url = '{{ route('admin.meeting.status.cancellation', $record->id) }}';

                                        var formData = new FormData();
                                        formData.append('_method', 'PATCH');
                                        // formData.append('status', status);

                                        $.post(url, formData, function( result ) {
                                            if (result.status)
                                            {
                                                var new_status = result.new_status;
                                                var btn_text = 'لغو';
                                                if(new_status != 1)
                                                {
                                                    btn_text = 'فعال سازی';
                                                }

                                                $this.attr('data-status', new_status);
                                                $this.html('<i class="fas fa-edit"></i>&nbsp;'+btn_text+'</i>');
                                                makeAlert('پاسخ', result.message, 'green');
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

                @endif
            </div>
        </div>
    </div>

    @component('comments.admin.comment-component')
        @slot('record', $record)
        @slot('record_name', 'meeting')
        @slot('comments', $record->comments)
        @slot('files_mimes', 'image/png,image/jpeg,audio/mpeg,audio/wave,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingm,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
        @slot('files_description')
        <ul class="m-0 pl-2">
            <li>فقط فایل های jpg، png، word، excel، mp3، wav , pdf مجاز هستند.</li>
            <li>تعداد فایل ها حداکثر می تواند تا ۵ عدد باشد.</li>
            <li>حداکثر حجم فایل های تصویر می تواند تا 10 مگابایت باشد.</li>
            <li>حداکثر حجم فایل های متنی می تواند تا 10 مگابایت باشد.</li>
            <li>حداکثر حجم فایل های صوتی می تواند تا 50 مگابایت باشد.</li>
        </ul>
        @endslot
    @endcomponent

    <div class="col-md-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body number-fa align-middle">
                        <span class="font-weight-bold">{{ jdate($record->day)->format('%A Y/m/d') }}</span> از
                        <span class="font-weight-bold">{{ jdate($record->started_time)->format('H:i') }}</span> تا
                        <span class="font-weight-bold">{{ jdate($record->finished_time)->format('H:i') }}</span>
                        <span class="float-left font-weight-bold text-{{$record->holdingStatusColor()}}">{{ $record->holding_status_fa }}</span>
                    </div>
                </div>
            </div>
            @if (! $record->isExpired() && $record->center->isActive())
                <div class="col-12">
                    <div class="card">
                        <div class="card-body number-fa align-middle">
                            @component('reserves.admin._components.predict_section')
                                @slot('record', $record)
                                @slot('predict_statuses', $predict_statuses)
                                @slot('predicted_value', $record->main_user->pivot->status_predicted ?? null)
                                @slot('with_assets', true)
                                @slot('after_register_action', 'location.reload()')
                            @endcomponent
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12">
                <div class="card">
                    <div class="card-body number-fa align-middle">
                        <h4 class="box-title mb-2">مکان</h4>
                        <div class="row">
                            <div class="col-12">
                                <span class="font-weight-bold">{{ $record->room->name }}</span> در
                                <span class="font-weight-bold">{{ $record->center->name }}</span>
                            </div>
                            <div class="col-12">
                                واقع در <span class="font-weight-bold">{{ $record->center->address }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title mb-2">توضیحات</h4>
                        <div class="row">
                            <div class="col-12">
                                {!! nl2br($record->description) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title mb-2">صورتجلسه</h4>
                        <div class="row">
                            @if ($record->proceedings)
                            <div class="col-12">
                                {!! $record->proceedings !!}
                            </div>
                            @endif
                            @if($record->center->isActive())
                                @if($_current_user->isSuperAdmin() || $_current_user->hasRole($record->center->adminRoleName()) || $record->secretary_id == $_current_user->id)
                                    <div class="col-12">
                                        <button class="btn btn-primary btn-sm btn-proceedings" type="button" id="btn-proceedings" data-id="{{$record->id}}"><i class="far fa-sticky-note"></i>&nbsp;ثبت صورتجلسه</button>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if ($record->users->count() || $record->roles->count())
            <div class="col-12">
                <div class="card">
                    <div class="card-body number-fa align-middle">
                        <h4 class="box-title mb-2">اعضا</h4>
                        <div class="row">
                            <div class="col">
                                @foreach ($record->users as $user)
                                    @php
                                        $icon = 'fas fa-question';
                                        $color = 'dark';
                                        $title = 'نامشخص';
                                        if($user->pivot->status_predicted == App\Constants\Types\MeetingUser\MeetingUserStatusPredictedType::MEETING_USER_STATUS_PREDICTED_I_PARTICIPATE)
                                        {
                                            $color = "success";
                                            $icon = "fas fa-check";
                                            $title = 'شرکت میکنم';
                                        }
                                        else if($user->pivot->status_predicted == App\Constants\Types\MeetingUser\MeetingUserStatusPredictedType::MEETING_USER_STATUS_PREDICTED_I_DONT_PARTICIPATE)
                                        {
                                            $color = "danger";
                                            $icon = "fas fa-times";
                                            $title = 'شرکت نمیکنم';
                                        }
                                        else if($user->pivot->status_predicted == App\Constants\Types\MeetingUser\MeetingUserStatusPredictedType::MEETING_USER_STATUS_PREDICTED_MAYBE_I_PARTICIPATE)
                                        {
                                            $color = "info";
                                            $icon = "fas fa-circle";
                                            $title = 'شاید شرکت کنم';
                                        }

                                    @endphp
                                    <div class="float-right border border-{{$color}} rounded m-1 p-1" title="{{$title}}">
                                        <i class="{{$icon}} text-{{$color}}"></i>&nbsp;
                                        {{ $user->full_name }}
                                    </div>
                                @endforeach
                                @foreach ($record->roles as $role)
                                    @foreach ($role->users as $user)
                                        @if (!$record->users->contains($user->id))
                                            <div class="float-right border border-dark rounded m-1 p-1" title="نامشخص">
                                                <i class="fas fa-question text-dark"></i>&nbsp;
                                                {{ $user->full_name }}
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('modal-content')
    @component('reserves.admin._components.proceedings_modal')
        @slot('selected_id', $record->id)
        @slot('after_register_action', 'location.reload()')
    @endcomponent
@endsection


