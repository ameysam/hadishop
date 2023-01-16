@extends('_layouts.admin.index')

@section('content')
    <!-- Widgets  -->
    <div class="row">
        <div class="col-12">
            <button id="btn-new-record" type="button" class="btn btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;رويداد جدید</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <input id="selected_date" type="hidden" class="datepicker-demo" />
                            <div class="inline-datepicker" ></div>
                        </div>

                        <div class="col-12 mt-1">
                            <button type="button" id="btn-month-events" class="btn btn-sm btn-dark btn-block">رویدادهای این ماه</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 id="event-box-title" class="box-title mb-3">رویدادهای این ماه</h4>
                    <hr>
                    <div id="event-item-placement" class="row number-fa">
                        {{-- <div class="col-12">
                            <div class="font-weight-bold">۱ اردیبهشت</div>
                            <ul style="list-style:none">
                                <li>
                                    <span class="font-weight-bold"><i class="fas fa-clock"></i>&nbsp;۱۱:۰۰ تا ۱۲:۰۰</span>
                                    <span>روز بزرگداشت سعدی</span>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 id="meeting-box-title" class="box-title mb-3">جلسات این ماه</h4>
                    <hr>
                    <div id="meeting-item-placement" class="row number-fa">
                        {{-- <div class="col-12">
                            <div class="font-weight-bold">۱ اردیبهشت</div>
                            <ul style="list-style:none">
                                <li>
                                    <span class="font-weight-bold"><i class="fas fa-clock"></i>&nbsp;۱۱:۰۰ تا ۱۲:۰۰</span>
                                    <span>روز بزرگداشت سعدی</span>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal-content')
    @component('events.admin._components.modal-form')
        @slot('title', 'رویداد جدید')
        @slot('periodic_types', $periodic_types)
    @endcomponent
@endsection

@style(persian-datepicker/persian-datepicker.css)
@script(persian-datepicker/persian-date.js)
@script(persian-datepicker/persian-datepicker.js)
@push('scripts')
<script type="text/javascript">
    var $inputPlacement = $('#selected_date');
    var $mdlForm = $('#mdl-form');
    var $btnNewRecord = $('#btn-new-record');
    var $btnDeleteEvent = $('#btn-delete-events');
    var $divEventItemPlacement = $('#event-item-placement');
    var $divMeetingItemPlacement = $('#meeting-item-placement');
    var selected_day_j_fa_global = null;
    var selected_day_j_global = null;
    var selected_day_g_global = null;
    var show_events_type = 'month';
    var $btnMonthEvent = $('#btn-month-events');
    var $divEventBoxTitle = $('#event-box-title');
    var $divMeetingBoxTitle = $('#meeting-box-title');
    var public_title = null;
    var event_title = null;
    var meeting_title = null;


    var replacement = {
        '۰': '0',
        '۱': '1',
        '۲': '2',
        '۳': '3',
        '۴': '4',
        '۵': '5',
        '۶': '6',
        '۷': '7',
        '۸': '8',
        '۹': '9',
        '/': '/',
    };
    var replacement_reverse = {
        '0': '۰',
        '1': '۱',
        '2': '۲',
        '3': '۳',
        '4': '۴',
        '5': '۵',
        '6': '۶',
        '7': '۷',
        '8': '۸',
        '9': '۹',
        '/': '/',
    };

    $(function(){
        $btnDeleteEvent.hide();

        $.ajaxSetup({
            contentType: false,
            processData: false
        });

        $(document).on('click', '#btn-new-record', function(){
            var $this = $(this);
            var currentDate = new Date();
            var started_time_now = currentDate.getHours() + ':' + (currentDate.getMinutes() < 10 ? '0' + currentDate.getMinutes() : currentDate.getMinutes())
            $('#input_started_time').val(started_time_now);
            if(Array.isArray(selected_day_g_global))
            {
                var temp_date = new persianDate([parseInt(selected_day_g_global[0]), parseInt(selected_day_g_global[1]), parseInt(selected_day_g_global[2])]).toCalendar('gregorian');

                var temp_month = temp_date.month();
                if(temp_month < 10)
                {
                    temp_month = '0' + temp_month;
                }
                var temp_day = temp_date.date();
                if(temp_day < 10)
                {
                    temp_day = '0' + temp_day;
                }
                selected_day_g_global = [temp_date.year(), temp_month, temp_day].join('-')
            }
            $('#day').val(selected_day_g_global);
            $('#input_day').val(selected_day_j_fa_global);
            $('#btn-register-events').attr('route', "{{$route_store}}");
            $('#btn-register-events').attr('data-method', "POST");
            $('#btn-delete-events').attr('data-id', '');
            $('#btn-remove-selected-room').trigger('click');
            $btnDeleteEvent.hide();
            $mdlForm.modal('toggle');
        });

        $(document).on('click', '#btn-register-events', function(){
            var $this = $(this);

            $.LoadingOverlay("show");

            $this.prop('disabled', true);
            $this.find('i').attr('class', "fas fa-spinner fa-pulse");

            var formData = new FormData(document.getElementById('frm-event'));

            formData.append('_method', $this.attr('data-method'));

            $.post($this.attr('route'), formData, function (result) {
                if (result.status)
                {
                    makeAlert('پاسخ', result.message, 'green', function () {
                        $mdlForm.modal('toggle');
                        if(result.unseen_messages_count > 0)
                        {
                            $('.unseen_message_count').text(result.unseen_messages_count).removeClass('d-none');
                        }
                        else
                        {
                            $('.unseen_message_count').text('').addClass('d-none');
                        }
                        fetchEvents();
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


        $(document).on('click', '#btn-delete-events', function(){
            var $this = $(this);
            var id = $this.attr('data-id');

            makeAlert('<span style="font-size:large">آیا تایید می‌کنید ؟</span>', '', 'orange', function(){
                $.LoadingOverlay("show");

                $this.prop('disabled', true);
                $this.find('i').attr('class', "fas fa-spinner fa-pulse");

                var url = '{{ route("admin.event.delete", ":id") }}';
                url = url.replace(':id', id);

                var formData = new FormData();
                formData.append('_method', 'DELETE');

                $.post(url, formData, function (result) {
                    if (result.status)
                    {
                        makeAlert('پاسخ', result.message, 'green', function () {
                            $mdlForm.modal('toggle');
                            fetchEvents();
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
                        $this.find('i').attr('class', "fas fa-trash");
                    }, 750);
                });
            }, 'confirm');
        });


        $(document).on('click', '.table-days>tbody>tr>td', function(){
            show_events_type = 'day';
            fetchEvents();
        });


        $('.inline-datepicker').persianDatepicker({
            inline: true,
            altField: '#selected_date',
            altFormat: 'L',
            toolbox:{
                calendarSwitch:{
                    enabled: true
                }
            },
            // navigator:{
            //     scroll:{
            //         enabled: false
            //     }
            // },
            // maxDate: new persianDate().add('month', 3).valueOf(),
            // minDate: new persianDate().subtract('month', 3).valueOf(),
            dayPicker: {
                enabled: true,
            },
            navigator: {
                // enabled: true,
                onNext: function(param){
                    navigator(param);
                },
                onPrev: function(param){
                    navigator(param);
                },
            }
        });


        $(document).on('click', '.item-btn', function(){
            var $this = $(this);
            var id = $this.attr('data-id');

            var url = '{{ route("admin.event.show", ":id") }}';
            url = url.replace(':id', id);

            var formData = new FormData();

            $.post(url, formData, function (result) {
                if (result.status)
                {
                    var record = result.record;
                    // console.log(record)

                    var url_update = '{{ route("admin.event.update", ":id") }}';
                    url_update = url_update.replace(':id', record.id);

                    $('#btn-register-events').attr('route', url_update);
                    $('#btn-register-events').attr('data-method', "PUT");
                    $('#input_name').val(record.name);
                    $('#input_started_time').val(record.start);
                    $('#input_finished_time').val(record.finish);
                    $('#input_description').val(record.description);
                    $('.div-periodic-section').hide();
                    $('#day').val(record.day);
                    $('#input_day').val(record.day_fa);
                    $('#btn-delete-events').attr('data-id', record.id);
                    $('.modal-title').text('ویرایش رویداد');
                    $('#users').html(record.users);
                    if(record.room_center != null)
                    {
                        $('#room_id').html(record.room_center);
                    }
                    else
                    {
                        $('#btn-remove-selected-room').trigger('click');
                    }
                    $btnDeleteEvent.show();
                    $mdlForm.modal('toggle')
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
                $.LoadingOverlay("hide");
            });

        });

        $mdlForm.on('hidden.bs.modal', function (event) {
            $('#input_started_time').val('');
            $('#input_finished_time').val('');
            $('#day').val('');
            $('#input_day').val('');
            $('#input_name').val('');
            $('#input_description').val('');
            $('#btn-register-events').attr('route', "{{$route_store}}");
            $('#btn-register-events').attr('data-method', "POST");
            $('.div-periodic-section').show();
            $('#btn-delete-events').attr('data-id', '');
            $('.modal-title').text('رویداد جدید');
            $('#btn-remove-selected-room').trigger('click');
            $btnDeleteEvent.hide();
        });

        $(document).on('click', '#btn-month-events', function(){

            show_events_type = 'month';
            fetchEvents();
            // $divEventBoxTitle.text($(this).text())
        });

        $(document).on('click', '#btn-remove-selected-room', function(){
            $('#room_id').html('<option value="" data-select2-id="4">انتخاب کنید...</option>');
        });

        $(document).on('click', '.pwt-btn-today', function(){
            $('.pwt-btn-next').trigger('click');
            $('.pwt-btn-prev').trigger('click');
        });

        $('#btn-month-events').trigger('click');
    });

    function getMonthName(number)
    {
        var monthes = {
            '01': 'فروردین',
            '02': 'اردیبهشت',
            '03': 'خرداد',
            '04': 'تیر',
            '05': 'مرداد',
            '06': 'شهریور',
            '07': 'مهر',
            '08': 'آبان',
            '09': 'آذر',
            '10': 'دی',
            '11': 'بهمن',
            '12': 'اسفند',
        };
        return monthes[number];
    }

    function navigator(param)
    {
        var year = param.state.view.year;
        var month = param.state.view.month;
        if(month < 10)
        {
            month = '0' + month;
        }
        var day = param.state.view.date;
        if(day < 10)
        {
            day = '0' + day;
        }
        var date = [year, month, day].join('/');
        date = date.split('');
        var temp = [];
        date.forEach(function(item){
            temp.push(replacement_reverse[item])
        });
        date = temp.join('');

        year = year + '';
        year = year.split('');
        temp = [];
        year.forEach(function(item){
            temp.push(replacement_reverse[item])
        });
        year = temp.join('');

        $inputPlacement.val(date)

        public_title = getMonthName(month) + ' ماه سال '+ year;
        console.log(public_title)
        event_title = 'رویدادهای ' + public_title
        meeting_title = 'جلسات ' + public_title
        // meeting_title = "جلسات " + public_title;

        $btnMonthEvent.text('نمایش آیتم‌های ' + public_title);
        $divEventBoxTitle.text(event_title);
        $divMeetingBoxTitle.text(meeting_title);

        // console.log(param.state.view.month)
        // alert(param.view.month)
        // alert('here')
    }

    function fetchEvents()
    {
        setTimeout(function(){
            var selected_day = $inputPlacement.val()
            selected_day_j_fa_global = selected_day;
            selected_day = selected_day.split('');
            var temp = [];
            selected_day.forEach(function(item){
                temp.push(replacement[item])
            });

            selected_day = temp.join('');
            selected_day_j_global = selected_day;

            $.LoadingOverlay("show");

            var formData = new FormData();
            formData.append('day', selected_day);
            formData.append('type', show_events_type);

            $.post("{{$route_show}}", formData, function (result) {
                if (result.status)
                {
                    var templateEvent = '';
                    var templateMeeting = '';
                    selected_day_g_global = result.day;
                    var events = result.events;
                    var meetings = result.meetings;
                    if(typeof events.length == "undefined")
                    {
                        for (const key in events)
                        {
                            templateEvent += '<div class="col-12">'+
                                            '<div class="font-weight-bold h6">' + key + '</div>'+
                                            '<ul class="ul-item">';

                            events[key].forEach(function(item){
                                templateEvent += '<li class="li-item '+(item.expired ? 'text-danger' : '')+'">'+
                                                '<span class="font-weight-bold"><i class="fas fa-clock item-btn cursor-pointer" title="ويرايش" data-id="'+item.id+'"></i>&nbsp;' + item.start + (item.finish ? ' تا ' + item.finish : '') +'</span>&nbsp;'+
                                                '<span class="item-link">'+
                                                    '<a href="{{ route('admin.event.index') }}/'+item.id+'" target="_black" class="'+(item.expired ? 'text-danger' : 'text-dark')+'">'+
                                                        item.name+
                                                    '</a>'+
                                                '</span>'+
                                            '</li>';
                            });

                            templateEvent += '</ul>'+
                                        '</div>';
                        }
                    }
                    else
                    {
                        templateEvent = '<div class="col text-center"><span class="text-danger font-weight-bold text-center">رویدادی يافت نشد.</span></div>';
                    }

                    if(typeof meetings.length == "undefined")
                    {
                        for (const key in meetings)
                        {
                            templateMeeting += '<div class="col-12">'+
                                            '<div class="font-weight-bold h6">' + key + '</div>'+
                                            '<ul class="ul-item">';

                            meetings[key].forEach(function(item){
                                templateMeeting += '<li class="li-item '+(item.expired ? 'text-danger' : '')+'">'+
                                                '<span class="font-weight-bold"><i class="fas fa-clock" data-id="'+item.id+'"></i>&nbsp;' + item.start + (item.finish ? ' تا ' + item.finish : '') +'</span>&nbsp;'+
                                                '<span class="item-link">'+
                                                    '<a href="{{ route('admin.meeting.index') }}/'+item.id+'" target="_black" class="'+(item.expired ? 'text-danger' : 'text-dark')+'">'+
                                                        item.name+
                                                    '</a>'+
                                                '</span>'+
                                            '</li>';
                            });

                            templateMeeting += '</ul>'+
                                        '</div>';
                        }
                    }
                    else
                    {
                        templateMeeting = '<div class="col text-center"><span class="text-danger font-weight-bold text-center">جلسه‌ای يافت نشد.</span></div>';
                    }

                    $divEventItemPlacement.html(templateEvent);
                    $divMeetingItemPlacement.html(templateMeeting);
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
                $.LoadingOverlay("hide");
            });
        }, 200);
    }

  </script>
@endpush

@push('styles')
    <style>
        .item-link:hover{
            font-weight: bold;
        }
        .li-item{
            line-height:1.5rem;
        }
        .ul-item{
            list-style:none;
        }
        .box-title{
            font-size: 1rem;
        }
    </style>
@endpush
