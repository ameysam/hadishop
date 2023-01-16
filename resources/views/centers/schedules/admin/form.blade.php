@extends('_layouts.admin.index')

@section('content')
    {{-- @script(tinymce/tinymce.js) --}}
    @component('_components.admin.page_title')
        @slot('title', isset($record) ? 'ویرایش زمان‌بندی' : 'تعریف زمان‌بندی جدید')
        @slot('button_title', 'ثبت')
        @slot('button_route', $form['action'])
        @slot('location_route', route('admin.center.schedule.index', $g_center->id))
        @slot('back_route', route('admin.center.schedule.index', $g_center->id))
        @slot('with_assets', true)
        @slot('method', $form['method'] ?? 'post')
    @endcomponent

    <form action="#" method="post" id="form1">
        <div class="row">
            <div id="form-errors" class="col-lg-12 d-none">

            </div>
            <div class="col-lg-8 col-md-8 col-sm-10 col-12 offset-lg-2 offset-md-2 offset-sm-1">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            {{-- <div class="col-md-12">
                                @component('_components.admin.select.single')
                                    @slot('title', 'نوع اتاق')
                                    @slot('id', 'type')
                                    @slot('star', true)
                                    @slot('doesnt_have_default', true)
                                    @slot('options')
                                        @foreach ($room_types as $key => $value)
                                            <option value="{{ $key }}" {{ (isset($record) && $record->type == $key) ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div> --}}
                            <div class="col-md-6 col-12">
                                @component('_components.admin.input.input')
                                    @slot('id', 'name')
                                    @slot('title', 'عنوان زمان‌بندی')
                                    @slot('star', true)
                                    @slot('slot', $record->name ?? '')
                                @endcomponent
                            </div>
                            <div class="col-md-6 col-12">
                                @component('_components.admin.datepicker.persian_datepicker')
                                    @slot('id', 'dates')
                                    @slot('title', 'بازه زمانی')
                                    @slot('star', true)
                                    @slot('range', true)
                                    @slot('with_assets', true)
                                    @slot('value_j', isset($record) ? (jdate($record->started_date)->format('Y/m/d') . ' - ' . jdate($record->finished_date)->format('Y/m/d')) : null)
                                    @slot('value_g', isset($record) ? ("{$record->started_date} - {$record->finished_date}") : null)
                                @endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-6 number-fa">
                                @component('_components.admin.select.timepicker')
                                    @slot('title', 'از ساعت')
                                    @slot('doesnt_have_title', true)
                                    @slot('id_hr', 'started_time_hr')
                                    @slot('id_mn', 'started_time_min')
                                    @slot('doesnt_have_default', true)
                                    @slot('star', true)
                                    @slot('options_hr')
                                        @foreach ($hours as $hour)
                                            <option value="{{ $hour }}" {{isset($started_time_hr) && $started_time_hr == $hour ? 'selected' : ''}}>{{ $hour }}</option>
                                        @endforeach
                                    @endslot
                                    @slot('options_mn')
                                        @foreach ($minutes as $minute)
                                            <option value="{{ $minute }}" {{isset($started_time_mn) && $started_time_mn == $minute ? 'selected' : ''}}>{{ $minute }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>
                            <div class="col-xl-3 col-6 number-fa">
                                @component('_components.admin.select.timepicker')
                                    @slot('title', 'تا ساعت')
                                    @slot('doesnt_have_title', true)
                                    @slot('id_hr', 'finished_time_hr')
                                    @slot('id_mn', 'finished_time_min')
                                    @slot('doesnt_have_default', true)
                                    @slot('star', true)
                                    @slot('options_hr')
                                        @foreach ($hours as $hour)
                                            <option value="{{ $hour }}" {{isset($finished_time_hr) && $finished_time_hr == $hour ? 'selected' : ''}}>{{ $hour }}</option>
                                        @endforeach
                                    @endslot
                                    @slot('options_mn')
                                        @foreach ($minutes as $minute)
                                            <option value="{{ $minute }}" {{isset($finished_time_mn) && $finished_time_mn == $minute ? 'selected' : ''}}>{{ $minute }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>

                            <div class="col-xl-3 col-6 number-fa">
                                @component('_components.admin.select.timepicker')
                                    @slot('title', 'حداکثر زمان هر رزرو')
                                    @slot('doesnt_have_title', true)
                                    @slot('id_hr', 'reserve_duration_hr')
                                    @slot('id_mn', 'reserve_duration_min')
                                    @slot('doesnt_have_default', true)
                                    @slot('star', true)
                                    @slot('options_hr')
                                        @foreach ($hours as $hour)
                                            <option value="{{ $hour }}" {{isset($reserve_duration_hr) && $reserve_duration_hr == $hour ? 'selected' : ''}}>{{ $hour }}</option>
                                        @endforeach
                                    @endslot
                                    @slot('options_mn')
                                        @foreach ($minutes as $minute)
                                            <option value="{{ $minute }}" {{isset($reserve_duration_mn) && $reserve_duration_mn == $minute ? 'selected' : ''}}>{{ $minute }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>
                            <div class="col-xl-3 col-6 number-fa">
                                @component('_components.admin.select.timepicker')
                                    @slot('title', 'فاصله هر رزرو')
                                    @slot('doesnt_have_title', true)
                                    @slot('id_hr', 'gap_duration_hr')
                                    @slot('id_mn', 'gap_duration_min')
                                    @slot('doesnt_have_default', true)
                                    @slot('star', true)
                                    @slot('options_hr')
                                        @foreach ($hours as $hour)
                                            <option value="{{ $hour }}" {{isset($gap_duration_hr) && $gap_duration_hr == $hour ? 'selected' : ''}}>{{ $hour }}</option>
                                        @endforeach
                                    @endslot
                                    @slot('options_mn')
                                        @foreach ($minutes as $minute)
                                            <option value="{{ $minute }}" {{isset($gap_duration_mn) && $gap_duration_mn == $minute ? 'selected' : ''}}>{{ $minute }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>
                            <div class="col-12 mt-3">
                                @component('_components.admin.button.button')
                                    @slot('id', 'btn_calc')
                                    @slot('title', 'محاسبه و تقسیم بندی')
                                    @slot('type', 'button')
                                    @slot('color', 'primary')
                                    @slot('class', 'btn-block')
                                    @slot('font', 'fas fa-calculator')
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="div-schedules" class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col text-center d6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="text-primary font-weight-bold">شنبه</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row days">
                                        </div>
                                    </div>
                                    <div class="col text-center d0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="text-primary font-weight-bold">یکشنبه</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row days">
                                        </div>
                                    </div>
                                    <div class="col text-center d1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="text-primary font-weight-bold">دوشنبه</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row days">
                                        </div>
                                    </div>
                                    <div class="col text-center d2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="text-primary font-weight-bold">سه شنبه</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row days">
                                        </div>
                                    </div>
                                    <div class="col text-center d3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="text-primary font-weight-bold">چهارشنبه</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row days">
                                        </div>
                                    </div>
                                    <div class="col text-center d4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="text-primary font-weight-bold">پنج شنبه</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row days">
                                        </div>
                                    </div>
                                    <div class="col text-center d5">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="text-primary font-weight-bold">جمعه</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row days">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    var $btnCalc = $('#btn_calc');

    var $dates = $('#dates');
    var $datesFa = $('#input_dates');

    var startedDateFa = null;
    var startedDate = null;

    var finishedDateFa = null;
    var finishedDate = null;

    var $startedTime = $('#started_time_hr');
    var $finishedTime = $('#finished_time_hr');

    var reserveDuration = 0;
    var gapDuration = 0;

    var first_day = null;
    var last_day = null;

    var durations = [];
    var gaps = [];

    var days = [];

    var details_disable = @json($details_disable);

    var started_time = null;
    var finished_time = null;

    var templates = {
        'd0': [],
        'd1': [],
        'd2': [],
        'd3': [],
        'd4': [],
        'd5': [],
        'd6': [],
    };

    function addItem()
    {
        var started_time_en = started_time.format('YYYY-MM-DD HH:mm:ss');
        var started_date_fa = started_time.format('jYYYY/jMM/jDD');
        var started_time_fa = started_time.format('HH:mm');

        var finished_time_en = finished_time.format('YYYY-MM-DD HH:mm:ss');
        var finished_time_fa = finished_time.format('HH:mm');

        if(details_disable.find(item => item.started_at == started_time_en))
        {
            templates['d' + started_time.day()].push('<div class="col-md-12  mb-2 p-2 item border rounded">' +
                '<input name="times_start_dis[]" type="hidden" class="times_start" value="'+ started_time_en +'">' +
                '<input name="times_finish_dis[]" type="hidden" class="times_finish" value="'+ finished_time_en +'">' +
                '<div class="float-right mx-2">' +
                    '<span class="text-danger cursor-pointer delete-time d-none"><i class="fas fa-times"></i></span>' +
                    '<span class="text-success cursor-pointer restore-time"><i class="fas fa-plus"></i></span>' +
                '</div>' +
                // '<br>' +
                '<div class="float-right">' +
                    '<span class="spn-datetime number-fa text-decoration-line-through text-danger">'+ started_date_fa + '<br>' + started_time_fa + ' تا ' + finished_time_fa + '</span>' +
                '</div>' +
            '</div>');
        }
        else
        {
            templates['d' + started_time.day()].push('<div class="col-md-12  mb-2 p-2 item border rounded">' +
                '<input name="times_start[]" type="hidden" class="times_start" value="'+ started_time_en +'">' +
                '<input name="times_finish[]" type="hidden" class="times_finish" value="'+ finished_time_en +'">' +
                '<div class="float-right mx-2">' +
                    '<span class="text-danger cursor-pointer delete-time"><i class="fas fa-times"></i></span>' +
                    '<span class="text-success cursor-pointer restore-time d-none"><i class="fas fa-plus"></i></span>' +
                '</div>' +
                // '<br>' +
                '<div class="float-right">' +
                    '<span class="spn-datetime number-fa">'+ started_date_fa + '<br>' + started_time_fa + ' تا ' + finished_time_fa + '</span>' +
                '</div>' +
            '</div>');
        }
    }
    function addEmptyItem(index)
    {
        templates['d' + index].push('<div class="col-md-12  mb-2 p-2 item border rounded">' +
                        '<div class="float-right">' +
                            '<span class="spn-datetime number-fa  text-danger"><br>&nbsp;</span>' +
                        '</div>' +
                    '</div>');
    }

    $(function(){
        $btnCalc.click(function(){
            reserveDuration = $('#reserve_duration_hr').val() + ':' + $('#reserve_duration_min').val();
            gapDuration = $('#gap_duration_hr').val() + ':' + $('#gap_duration_min').val();

            var datesSplited = $dates.val().split(' - ');
            var datesFaSplited = $datesFa.val().split(' - ');

            startedDateFa = datesFaSplited[0];
            startedDate = datesSplited[0];

            finishedDateFa = datesFaSplited[1];
            finishedDate = datesSplited[1];

            var startedTime = $startedTime.val() + ':' + $('#started_time_min').val();
            var finishedTime = $finishedTime.val() + ':' + $('#finished_time_min').val();

            var errors = [];
            if(!startedDate)
            {
                errors.push('<li class="text-danger">فیلد «تاریخ شروع» را انتخاب کنید.</li>');
            }
            if(!finishedDate)
            {
                errors.push('<li class="text-danger">فیلد «تاریخ پایان» را انتخاب کنید.</li>');
            }
            if(!reserveDuration || reserveDuration <= '00:00' || reserveDuration < 10)
            {
                errors.push('<li class="text-danger">مقدار فیلد «سقف زمان هر رزرو» اشتباه است.</li>');
            }
            if(!gapDuration || gapDuration < '00:00' || reserveDuration < 0)
            {
                errors.push('<li class="text-danger">مقدار فیلد «فاصله بین هر رزرو» اشتباه است.</li>');
            }
            if(startedTime >= finishedTime)
            {
                errors.push('<li class="text-danger">«ساعت شروع» باید پس از «ساعت پایان» باشد.</li>');
            }

            if(errors.length)
            {
                $.LoadingOverlay("hide");
                makeAlert('خطا!', '<ul>' + errors.join('') + '</ul>', 'red');
                return false;
            }

            first_day = moment(startedDate);
            last_day = moment(finishedDate);
            first_day.add(-1, 'days');
            last_day.add(-1, 'days');

            days = [];

            if(first_day >= last_day)
            {
                $.LoadingOverlay("hide");
                makeAlert('خطا!', '<span class="text-danger">«تاریخ شروع» باید پیش از «تاریخ پایان» باشد.</span>', 'red');
                return false;
            }

            templates = {
                'd0': [],
                'd1': [],
                'd2': [],
                'd3': [],
                'd4': [],
                'd5': [],
                'd6': [],
            };


            var while_count = 1;
            var frist_day_index = 6;
            while(first_day.format('YYYY-MM-DD') <= last_day.format('YYYY-MM-DD'))
            {
                var day = first_day.add(1, 'days');
                days.push(day.format('YYYY-MM-DD'));
                if(while_count == 1)
                {
                    console.log(day.format('YYYY-MM-DD'), day.day());
                    frist_day_index = day.day();
                }
                while_count++;
            }

            if(frist_day_index < 6)
            {
                addEmptyItem(6);
                if(frist_day_index != 0)
                {
                    while(frist_day_index > 0)
                    {
                        frist_day_index--;
                        addEmptyItem(frist_day_index);
                    }
                }
            }

            for(var i = 0; i < days.length; i++){
                started_time = moment(days[i] + ' ' + startedTime);
                finished_time = moment(days[i] + ' ' + finishedTime);

                addItem();
            }

            $('.d0').find('.days').html(templates['d0'].join(''));
            $('.d1').find('.days').html(templates['d1'].join(''));
            $('.d2').find('.days').html(templates['d2'].join(''));
            $('.d3').find('.days').html(templates['d3'].join(''));
            $('.d4').find('.days').html(templates['d4'].join(''));
            $('.d5').find('.days').html(templates['d5'].join(''));
            $('.d6').find('.days').html(templates['d6'].join(''));

        });


        $(document).on('click', '.delete-time', function(){
            var $this = $(this) ;
            var $row = $this.closest('.item');
            $row.find('.times_start').attr('name', 'times_start_dis[]');
            $row.find('.times_finish').attr('name', 'times_finish_dis[]');
            $row.find('.spn-datetime').addClass('text-decoration-line-through').addClass('text-danger');
            $this.addClass('d-none');
            $row.find('.restore-time').removeClass('d-none')
        });
        $(document).on('click', '.restore-time', function(){
            var $this = $(this) ;
            var $row = $this.closest('.item');
            $row.find('.times_start').attr('name', 'times_start[]');
            $row.find('.times_finish').attr('name', 'times_finish[]');
            $row.find('.spn-datetime').removeClass('text-decoration-line-through').removeClass('text-danger');
            $this.addClass('d-none');
            $row.find('.delete-time').removeClass('d-none')
        });

        @isset($record)
            $btnCalc.trigger('click');
        @endisset
    });
</script>
@endpush
