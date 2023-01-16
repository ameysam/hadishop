@extends('_layouts.admin.index')

@section('content')
    <!-- Widgets  -->
    <form action="" id="form1">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9 col-12 number-fa">
                            {{ $schedules->links() }}
                        </div>
                        <div class="col-md-3 col-12 text-right">
                            <button type="button" id="btn-mobile-set-meeting" class="btn btn-primary btn-sm d-none"><i class="fas fa-clock align-middle"></i>&nbsp;ثبت جلسه</button>
                            <a href="{{ route('admin.meeting.index') }}" class="btn btn-danger btn-sm"><i class="fas fa-times-circle align-middle"></i>&nbsp;بازگشت</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered text-center reservation-table edit-reserved-table">
                                <thead class="thead-dark ">
                                <tr>
                                    <th class="align-middle text-center disabled bg-info" style="width: 6.25%">از</th>
                                    {{-- <th class="align-middle text-center disabled" style="width: 6.25%">تا</th> --}}
                                    @foreach ($schedules as $item)
                                        <th class="align-middle text-center number-fa disabled bg-info" style="width: 12.5%" scope="col">{{ jdate($item->started_at)->format('%A Y/m/d') }}</th>
                                    @endforeach
                                    @if ($additional_days)
                                        @foreach ($additional_days as $item)
                                            <th class="align-middle text-center number-fa disabled" style="width: 12.5%" scope="col">{{ jdate($item)->format('%A Y/m/d') }}</th>
                                        @endforeach
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $start_time = Carbon\Carbon::parse($min_started_time);
                                        $finish_time = Carbon\Carbon::parse($min_started_time)->add(15, 'minute');
                                        $max_finished_time = Carbon\Carbon::parse($max_finished_time);
                                        $now = now();
                                        $step = 0;

                                        $reserves = [];
                                        $editables = [];
                                    @endphp
                                    @while ($finish_time->lte($max_finished_time))
                                        @php
                                            $col = 0;
                                            $step++;
                                        @endphp
                                        <tr>
                                            <td scope="row" class="align-middle number-fa disabled">{{ $start_time->format('H:i') }}</td>
                                            {{-- <td scope="row" class="align-middle number-fa disabled">{{ $finish_time->format('H:i') }}</td> --}}

                                            @foreach ($schedules as $item)
                                                @php
                                                    $col++;
                                                    $meeting = $room->meetings->where('day', Carbon\Carbon::parse($item->started_at)->format('Y-m-d'))->where('started_time', '<=', $start_time->format('H:i:s'))->where('finished_time', '>=', $finish_time->format('H:i:s'))->first();
                                                    if($meeting)
                                                    {
                                                        $at = Carbon\Carbon::parse($item->started_at)->format('Y-m-d') . "_{$start_time->format('H-i')}-{$finish_time->format('H-i')}";
                                                        $at1 = Carbon\Carbon::parse($item->started_at)->format('Y-m-d') . " {$finish_time->format('H:i:s')}";
                                                        $reserves[] = [
                                                            'at' => $at,
                                                            'at1' => $at1,
                                                            'meeting' => $meeting->id,
                                                            'name' => ($meeting->id == $record->id) ? $meeting->name : 'رزرو',
                                                            'color' => '#007bff',
                                                            'editable' => ($meeting->id == $record->id),
                                                        ];
                                                    }
                                                @endphp

                                                @if(Carbon\Carbon::parse($item->finished_at)->setTime($finish_time->hour, $finish_time->minute, 0)->gt($now))
                                                    @component('centers.rooms.timings.admin._components.cell')
                                                        @slot('day', Carbon\Carbon::parse($item->started_at)->format('Y-m-d'))
                                                        @slot('step', $step)
                                                        @slot('col', $col)
                                                        @slot('meeting_id', $meeting->id ?? 'not')
                                                        @slot('start_time_', $start_time->format('H-i'))
                                                        @slot('finish_time_', $finish_time->format('H-i'))
                                                        @slot('start_time', $start_time->format('H:i'))
                                                        @slot('finish_time', $finish_time->format('H:i'))
                                                    @endcomponent
                                                @else
                                                    @component('centers.rooms.timings.admin._components.cell-outdate')
                                                        @slot('day', Carbon\Carbon::parse($item->started_at)->format('Y-m-d'))
                                                        @slot('step', $step)
                                                        @slot('col', $col)
                                                        @slot('meeting_id', $meeting->id ?? 'not')
                                                        @slot('start_time_', $start_time->format('H-i'))
                                                        @slot('finish_time_', $finish_time->format('H-i'))
                                                        @slot('start_time', $start_time->format('H:i'))
                                                        @slot('finish_time', $finish_time->format('H:i'))
                                                    @endcomponent
                                                @endif
                                            @endforeach

                                            @if ($additional_days)
                                                @foreach ($additional_days as $item)
                                                    <td class="selectable disabled bg-disable">
                                                        <span class="spn-title"></span>
                                                    </td>
                                                @endforeach
                                            @endif

                                            @php
                                                $start_time->add(15, 'minute');
                                                $finish_time->add(15, 'minute');
                                            @endphp
                                        </tr>
                                    @endwhile
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal-content')
    @component('centers.rooms.timings.admin._components.modal-form')
        @slot('title', 'ویرایش جلسه')
        @slot('record', $record)
        @slot('periodic_types', $periodic_types)
    @endcomponent
@endsection

@push('scripts')
    <script>
        var $modal = $('#modal');
        var $btnSetMeeting = $('#btn-mobile-set-meeting');
        var first_select = null;
        var selected_day = null;
        var selected_steps = [];

        var schedules = @json($schedules);
        var reserves = @json($reserves);
        var editables = @json($editables);
        var reserve_duration = '{{ $room->schedule->reserve_duration }}';
        var gap_duration = '{{ $room->schedule->gap_duration }}';
        var gap_count = (gap_duration / 15);

        var meeting_first = {};
        var meeting_last = {};

        var improvement_start_hr = [];
        var improvement_start_min = [];
        var improvement_finish_hr = [];
        var improvement_finish_min = [];

        function refresh()
        {
            if($(".highlighted").length == 0)
            {
                selected_day = null;
                selected_steps = [];
                first_select = null;
            }
        }

        function showSetMeetingBtn()
        {
            if($('.highlighted').length > 0 && inMobileView())
            {
                $btnSetMeeting.removeClass('d-none');
            }
            else
            {
                $btnSetMeeting.addClass('d-none');
            }
        }

        $(function(){

            var select_disable = false;

            var isMouseDown = false, isHighlighted;

            reserves.forEach(function(item){
                var $itemTemp = $(`#${item.at}`);


                if(item.editable)
                {
                    $itemTemp.css('background-color', item.color);
                    $itemTemp.find('.spn-title').text(item.name);
                }
                else
                {
                    $itemTemp.addClass('reserved').addClass('disabled bg-disable').css({"border-right-color":"#dbdbdb"});
                }

                meeting_last[item.meeting] = item.at;

                if(!meeting_first[item.meeting])
                {
                    meeting_first[item.meeting] = item.at;
                }
            });

            for (const [key, value] of Object.entries(meeting_last)) {
                var row = parseInt($(`#${value}`).attr('data-row'));
                var col = $(`#${value}`).attr('data-col');

                for(var i = 0;i < gap_count; i++)
                {
                    row++;
                    $('.row-'+row+'.coll-'+col).addClass('disabled bg-disable').text('');
                }
            }

            for (const [key, value] of Object.entries(meeting_first)) {
                var row = parseInt($(`#${value}`).attr('data-row'));
                var col = $(`#${value}`).attr('data-col');

                for(var i = 0;i < gap_count; i++)
                {
                    row--;
                    $('.row-'+row+'.coll-'+col).addClass('disabled bg-disable').text('');
                }
            }

            $("table td")
                .mousedown(function (event) {
                    if(event.which != 1)
                    {
                        return false;
                    }
                    var $this = $(this);

                    if(!$(this).hasClass('disabled') && !$(this).hasClass('outdated') && !$(this).hasClass('reserved'))
                    {
                        selected_day = $this.find('.data-day').attr('data-day');
                        selected_steps.push($this.find('.data-step').attr('data-step'));

                        if(first_select === null)
                        {
                            first_select = selected_day;
                        }

                        if(selected_day != first_select)
                        {
                            makeAlert('خطا!', 'امکان انتخاب روز دیگر وجود ندارد.', 'red', function(){
                                $('td').removeClass('highlighted');
                                refresh();
                            });
                            return false;
                        }

                        if(!$this.hasClass("highlighted") && ($(".highlighted").length * 15) >= reserve_duration)
                        {
                            makeAlert('اخطار!', 'بیشتر ازین نمیشه.', 'orange', function(){
                                // $('td').removeClass('highlighted');
                                // refresh();
                                // $("table td").trigger('mouseup');
                                $modal.modal();
                            });
                            return false;
                        }

                        isMouseDown = true;
                        $(this).toggleClass("highlighted");
                        isHighlighted = $(this).hasClass("highlighted");

                        refresh();
                        showSetMeetingBtn();

                        return false;
                    }
                })
                .mouseover(function () {

                    var $this = $(this);

                    if (isMouseDown && !$(this).hasClass('disabled') && !$(this).hasClass('outdated') && !$(this).hasClass('reserved'))
                    {
                        selected_day = $this.find('.data-day').attr('data-day');
                        if(selected_day != first_select)
                        {
                            makeAlert('خطا!', 'امکان انتخاب روز دیگر وجود ندارد.', 'red', function(){
                                $('td').removeClass('highlighted');
                                refresh();
                            });
                            return false;
                        }
                        if(!$this.hasClass("highlighted") && ($(".highlighted").length * 15) >= reserve_duration)
                        {
                            makeAlert('اخطار!', 'بیشتر ازین نمیشه.', 'orange', function(){
                                // $('td').removeClass('highlighted');
                                // refresh();
                                $modal.modal();
                            });

                            return false;
                        }
                        selected_steps.push($this.find('.data-step').attr('data-step'));
                        $(this).toggleClass("highlighted", isHighlighted);

                        refresh();
                        showSetMeetingBtn();
                    }
                });


            $("table td").mouseup(function(event){
                if(!inMobileView() && event.which == 1 && !$(this).hasClass('disabled') && !$(this).hasClass('outdated') && !$(this).hasClass('reserved') && $('.highlighted').length)
                {
                    $modal.modal();
                }
            });

            $(document).mouseup(function () {
                isMouseDown = false;
            });

            $('#modal').on('show.bs.modal', function (event) {

                var day = moment(selected_day).locale('fa').format('YYYY/MM/DD');
                var finished_time = null;
                var started_time = null;

                $('.highlighted').each(function(i, obj) {
                    var $item = $(this);
                    if(i == 0)
                    {
                        // var day = $item.find('.data-day').attr('data-day');
                        started_time = $item.find('.data-started-time').attr('data-started-time');
                    }
                    if(i == $('.highlighted').length - 1)
                    {
                        finished_time = $item.find('.data-finished-time').attr('data-finished-time');
                    }
                });

                $('#spn-selected-day').text(day)
                $('#spn-selected-start-time').text(started_time)
                $('#spn-selected-finish-time').text(finished_time)
            });

            $('#modal').on('hide.bs.modal', function (event) {
                var clickedButtonId = $(document.activeElement).attr('id');
                if(clickedButtonId !== 'btn-append-item')
                {
                    $('td').removeClass('highlighted');
                    selected_day = null;
                    first_select = null;
                }
                showSetMeetingBtn();
            })

            $btnSetMeeting.click(function(){
                $modal.modal();
            });

            $('#btn-register-events').click(function(){
                var eventName = $('#input_name').val();
                var $highlighted = $('.highlighted');
                if(!eventName)
                {
                    return false;
                }

                $.LoadingOverlay("show");

                $.ajaxSetup({
                    contentType: false,
                    processData: false
                });

                var $this = $(this);
                $this.prop('disabled', true);
                $this.find('i').attr('class', "fas fa-spinner fa-pulse");

                $highlighted.find('.spn-title').text(eventName);
                $highlighted.find('.meeting-name').text(eventName);

                var formData = new FormData(document.getElementById('form1'));
                formData.append('_method', "{{$form['method']}}");

                $highlighted.each(function(i, obj) {
                    var $item = $(this);
                    if(i == 0)
                    {
                        var day = $item.find('.data-day').attr('data-day');
                        var started_time = $item.find('.data-started-time').attr('data-started-time');
                        formData.append('day', day);
                        formData.append('started_time', started_time);
                    }
                    else if(i == $highlighted.length - 1)
                    {
                        var finished_time = $item.find('.data-finished-time').attr('data-finished-time');
                        formData.append('finished_time', finished_time);
                    }
                });

                $.post("{{$form['action']}}", formData, function (result) {
                    console.log(result)
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
                        if(result.type == 'confirm')
                        {
                            var messages = result.message.split(",");
                            var message = "";
                            messages.forEach(function(item){
                                message += '<li class="number-fa">'+item+'</li>';
                            });

                            makeAlert('<span style="font-size:large">زمان‌های زیر دچار تداخل هستند آیا مایل هستید که سایر زمان‌هایی که تداخل ندارند ثبت شوند ؟</span>', message, 'orange', function(){
                                $('#force_save').val('1');
                                $('#btn-register-events').trigger('click');
                            }, 'confirm', function(){
                                $('#force_save').val('0');
                            });
                        }
                        else
                        {
                            makeAlert('اخطار!', result.message, 'orange');
                        }
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
        });
    </script>
@endpush
