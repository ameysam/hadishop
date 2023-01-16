@extends('_layouts.admin.index')

@section('content')
    {{-- @script(tinymce/tinymce.js) --}}
    @component('_components.admin.page_title')
        @slot('title', isset($record) ? 'ویرایش زمان‌بندی' : 'تعریف زمان‌بندی جدید')
        @slot('button_title', 'ثبت')
        @slot('button_route', $form['action'])
        @slot('location_route', route('admin.center.show', $g_center->id))
        @slot('back_route', route('admin.center.show', $g_center->id))
        {{-- @slot('location_route', route('admin.center.room.index', $g_center->id))
        @slot('back_route', route('admin.center.room.index', $g_center->id)) --}}
        @slot('with_assets', true)
        @slot('method', $form['method'] ?? 'post')
    @endcomponent

    <form action="#" method="post" id="form1">
        <div class="row">
            <div id="form-errors" class="col-lg-12 d-none">

            </div>
            <div class="col-lg-4 offset-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @component('_components.admin.input.input')
                                    @slot('id', 'name')
                                    @slot('title', 'عنوان زمان‌بندی')
                                    @slot('star', true)
                                    @slot('slot', $record->name ?? '')
                                @endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @component('_components.admin.datepicker.persian_datepicker')
                                    @slot('id', 'started_date')
                                    @slot('title', 'از تاریخ')
                                    @slot('star', true)
                                    @slot('with_assets', true)
                                    @slot('value_j', (isset($record) && $record->terminated_at) ? jdate($record->terminated_at)->format('Y/m/d H:i:s') : null)
                                    @slot('value_g', $record->terminated_at ?? null)
                                @endcomponent
                            </div>
                            <div class="col-md-6">
                                @component('_components.admin.datepicker.persian_datepicker')
                                    @slot('id', 'finished_date')
                                    @slot('title', 'تا تاریخ')
                                    @slot('star', true)
                                    {{-- @slot('with_assets', true) --}}
                                    @slot('value_j', (isset($record) && $record->terminated_at) ? jdate($record->terminated_at)->format('Y/m/d H:i:s') : null)
                                    @slot('value_g', $record->terminated_at ?? null)
                                @endcomponent
                            </div>
                            <div class="col-md-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'started_time')
                                    @slot('type', 'time')
                                    @slot('title', 'از ساعت')
                                    @slot('slot', $record->started_time ?? '00:00')
                                @endcomponent
                            </div>
                            <div class="col-md-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'finished_time')
                                    @slot('type', 'time')
                                    @slot('title', 'تا ساعت')
                                    @slot('slot', $record->finished_time ?? '00:00')
                                @endcomponent
                            </div>
                            <div class="col-md-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'reserve_duration')
                                    @slot('type', 'number')
                                    @slot('min', '10')
                                    @slot('auto_select', true)
                                    @slot('title', 'مدت زمان هر رزرو (دقیقه)')
                                    @slot('slot', $record->reserve_duration ?? '10')
                                @endcomponent
                            </div>
                            <div class="col-md-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'gap_duration')
                                    @slot('auto_select', true)
                                    @slot('type', 'number')
                                    @slot('min', '0')
                                    @slot('title', 'فاصله بین هر رزرو (دقیقه)')
                                    @slot('slot', $record->gap_duration ?? '0')
                                @endcomponent
                            </div>
                            <div class="col-md-12">
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

    var $startedDateFa = $('#input_started_date');
    var $startedDate = $('#started_date');

    var $finishedDateFa = $('#input_finished_date');
    var $finishedDate = $('#finished_date');

    var $startedTime = $('#input_started_time');
    var $finishedTime = $('#input_finished_time');

    var reserveDuration = 0;
    var gapDuration = 0;

    var started_at = null;
    var started_at_tmp_start = null;
    var started_at_tmp_finish = null;
    var finished_at = null;
    var finished_at_string = null;

    var durations = [];
    var gaps = [];

    var templates = {
        'd0': [],
        'd1': [],
        'd2': [],
        'd3': [],
        'd4': [],
        'd5': [],
        'd6': [],
    };

    $(document).on('click', '.delete-time', function(){
       var $this = $(this) ;
       var $row = $this.closest('.item');
       $row.find('.times_start').attr('name', 'times_dis[]');
       $row.find('.times_finish').attr('name', 'times_dis[]');
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

    function addItem()
    {
        var tmp_start_en = started_at_tmp_start.format('YYYY-MM-DD HH:mm:ss');
        var tmp_start_fa = started_at_tmp_start.format('jYYYY/jMM/jDD HH:mm');

        started_at_tmp_finish.add(reserveDuration, 'minutes');
        var tmp_finish_en = started_at_tmp_finish.format('YYYY-MM-DD HH:mm:ss');
        var tmp_finish_fa = started_at_tmp_finish.format('HH:mm');

        templates['d' + started_at_tmp_start.day()].push('<div class="col-md-12  mb-2 item">' +
                        '<input name="times_start[]" type="hidden" class="times_start" value="'+ tmp_start_en +'">' +
                        '<input name="times_finish[]" type="hidden" class="times_finish" value="'+ tmp_finish_en +'">' +
                        '<div class="float-right mx-2">' +
                            '<span class="text-danger cursor-pointer delete-time"><i class="fas fa-times"></i></span>' +
                            '<span class="text-success cursor-pointer restore-time d-none"><i class="fas fa-plus"></i></span>' +
                        '</div>' +
                        '<div class="float-right">' +
                            '<span class="spn-datetime number-fa">'+ tmp_start_fa + ' - ' + tmp_finish_fa + '</span>' +
                        '</div>' +
                '</div>');


        if(gapDuration > 0)
        {
            started_at_tmp_start = started_at_tmp_start.add(gapDuration, 'minutes');
            started_at_tmp_finish = started_at_tmp_finish.add(gapDuration, 'minutes');
        }
    }


    $(function(){
        $btnCalc.click(function(){
            $.LoadingOverlay("show");

            reserveDuration = $('#input_reserve_duration').val();
            gapDuration = $('#input_gap_duration').val();


            var errors = [];
            if(!$startedDate.val())
            {
                errors.push('<span class="text-danger">فیلد «تاریخ شروع» را انتخاب کنید.</span>');
            }
            if(!$finishedDate.val())
            {
                errors.push('<span class="text-danger">فیلد «تاریخ پایان» را انتخاب کنید.</span>');
            }
            if(!reserveDuration || reserveDuration < 10)
            {
                errors.push('<span class="text-danger">مقدار فیلد «مدت زمان هر رزرو» اشتباه است.</span>');
            }
            if(!gapDuration || reserveDuration < 0)
            {
                errors.push('<span class="text-danger">مقدار فیلد «فاصله بین هر رزرو» اشتباه است.</span>');
            }
            if(errors.length)
            {
                $.LoadingOverlay("hide");
                makeAlert('خطا!', errors.join('<br>'), 'red');
                return false;
            }

            started_at = moment($startedDate.val() + ' ' + $startedTime.val());
            started_at_tmp_start = moment($startedDate.val() + ' ' + $startedTime.val());
            started_at_tmp_finish = moment($startedDate.val() + ' ' + $startedTime.val());
            finished_at = moment($finishedDate.val() + ' ' + $finishedTime.val());
            finished_at_tmp = moment($finishedDate.val() + ' ' + $finishedTime.val());
            finished_at_tmp.add(-reserveDuration, 'minutes');

            if(started_at >= finished_at)
            {
                $.LoadingOverlay("hide");
                makeAlert('خطا!', '<span class="text-danger">«تاریخ شروع» باید پس از «تاریخ پایان» باشد.</span>', 'red');
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


            setTimeout(function(){

                addItem();

                while(finished_at_tmp > started_at_tmp_start){

                    started_at_tmp_start = started_at_tmp_start.add(reserveDuration, 'minutes');
                    // started_at_tmp_finish = started_at_tmp_finish.add(reserveDuration, 'minutes');
                    if(started_at_tmp_finish <= finished_at_tmp)
                    {
                        addItem();
                    }
                }

                $('.d0').find('.days').html(templates['d0'].join(''));
                $('.d1').find('.days').html(templates['d1'].join(''));
                $('.d2').find('.days').html(templates['d2'].join(''));
                $('.d3').find('.days').html(templates['d3'].join(''));
                $('.d4').find('.days').html(templates['d4'].join(''));
                $('.d5').find('.days').html(templates['d5'].join(''));
                $('.d6').find('.days').html(templates['d6'].join(''));

                $.LoadingOverlay("hide");
           }, 1000)
        });
    });
</script>
@endpush
