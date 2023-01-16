@extends('_layouts.admin.index')

@section('content')
    <!-- Widgets  -->
    <form action="" id="form1">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead class="thead-dark ">
                        <tr>
                            <th class="text-center disabled">از</th>
                            <th class="text-center disabled">تا</th>
                            @foreach ($schedules as $item)
                                <th class="text-center number-fa day-times disabled" scope="col">{{ jdate($item->started_at)->format('%A y/m/d') }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $start_time = Carbon\Carbon::parse($min_started_time);
                                $finish_time = Carbon\Carbon::parse($min_started_time)->add(15, 'minute');
                                $max_finished_time = Carbon\Carbon::parse($max_finished_time);
                                $now = now();
                                $step = 0;
                            @endphp
                            @while ($finish_time->lte($max_finished_time))
                                @php
                                    $step++;
                                @endphp
                                <tr>
                                    <td scope="row" class="number-fa day-times disabled">{{ $start_time->format('H:i') }}</td>
                                    <td scope="row" class="number-fa day-times disabled">{{ $finish_time->format('H:i') }}</td>

                                    {{-- @for ($i = 0; $i < $schedules->count(); $i++)
                                        @if($meeting = $room->meetings->where('day', Carbon\Carbon::parse($schedules[$i]->started_at)->format('Y-m-d'))->where('started_time', '<=', $start_time->format('H:i:s'))->where('finished_time', '>=', $finish_time->format('H:i:s'))->first())
                                            @php
                                                $schedules[$i]->is_reserved = true;
                                            @endphp
                                            <td class="disabled reserved bg-primary">{{ $meeting->name }}</td>
                                        @else
                                            @if($i > 0 && $schedules[$i - 1]->is_reserved)
                                                <td class="disabled bg-secondary">GAP</td>
                                            @elseif(Carbon\Carbon::parse($schedules[$i]->finished_at)->setTime($finish_time->hour, $finish_time->minute, 0)->gt($now))
                                                @component('centers.rooms.timings.admin._components.cell')
                                                    @slot('day', Carbon\Carbon::parse($schedules[$i]->started_at)->format('Y-m-d'))
                                                    @slot('step', $step)
                                                    @slot('start_time', $start_time->format('H:i'))
                                                    @slot('finish_time', $finish_time->format('H:i'))
                                                @endcomponent
                                            @else
                                                <td class="disabled bg-secondary"></td>
                                            @endif
                                        @endif
                                    @endfor --}}

                                    @foreach ($schedules as $item)
                                        @if($meeting = $room->meetings->where('day', Carbon\Carbon::parse($item->started_at)->format('Y-m-d'))->where('started_time', '<=', $start_time->format('H:i:s'))->where('finished_time', '>=', $finish_time->format('H:i:s'))->first())
                                            <td class="disabled reserved bg-primary">{{ $meeting->name }}</td>
                                        @else
                                            @if(Carbon\Carbon::parse($item->finished_at)->setTime($finish_time->hour, $finish_time->minute, 0)->gt($now))
                                                @component('centers.rooms.timings.admin._components.cell')
                                                    @slot('day', Carbon\Carbon::parse($item->started_at)->format('Y-m-d'))
                                                    @slot('step', $step)
                                                    @slot('start_time', $start_time->format('H:i'))
                                                    @slot('finish_time', $finish_time->format('H:i'))
                                                @endcomponent
                                            @else
                                                <td class="disabled bg-secondary"></td>
                                            @endif
                                        @endif
                                    @endforeach

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


    <div class="modal" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title float-right"></h5>
              <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        @component('_components.admin.input.input')
                            @slot('id', 'name')
                            @slot('title', 'نام رویداد')
                            @slot('star', true)
                        @endcomponent
                    </div>
                    <div class="col-12">
                        @component('_components.admin.input.editor')
                            @slot('id', 'description')
                            @slot('title', 'توضیحات')
                            @slot('rows', 2)
                        @endcomponent
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-register-events" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i>&nbsp;ثبت</button>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i>&nbsp;انصراف</button>
            </div>
          </div>
        </div>
      </div>
    </form>
@endsection

@push('scripts')
    <script>
        var $modal = $('#modal');
        var first_select = null;
        var selected_day = null;
        var selected_steps = [];

        function refresh()
        {
            if($(".highlighted").length == 0)
            {
                selected_day = null;
                selected_steps = [];
                first_select = null;
            }
        }

        $(function(){

            // setInterval(function() {
            //     refresh();
            // }, 1000);

            var select_disable = false;

            var isMouseDown = false, isHighlighted;


            $("table td")
                .mousedown(function (event) {
                    if(event.which != 1)
                    {
                        return false;
                    }
                    var $this = $(this);

                    if(!$(this).hasClass('disabled') && !$(this).hasClass('reserved'))
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

                        if(!$this.hasClass("highlighted") && $(".highlighted").length * 15 >= 120)
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

                        return false;
                    }
                })
                .mouseover(function () {

                    var $this = $(this);

                    if (isMouseDown && !$(this).hasClass('disabled') && !$(this).hasClass('reserved'))
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
                        if(!$this.hasClass("highlighted") && $(".highlighted").length * 15 >= 120)
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
                    }
                });


            $("table td").mouseup(function(event){
                if(event.which == 1)
                {
                    $modal.modal();
                }
            });

            $(document).mouseup(function () {
                isMouseDown = false;
            });

            $('#modal').on('hide.bs.modal', function (event) {
                $('td').removeClass('highlighted');
                $('.spn-title').text('');
                selected_day = null;
                first_select = null;

                // var button = $(event.relatedTarget) // Button that triggered the modal
                // var recipient = button.data('whatever') // Extract info from data-* attributes
                // var modal = $(this)
                // modal.find('.modal-title').text('New message to ' + recipient)
                // modal.find('.modal-body input').val(recipient)
            })

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
                    if (result.status)
                    {
                        // makeAlert('پاسخ', result.message, 'green', function () {
                        //     location.reload();
                        // });
                        console.log(result)
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
        });
    </script>
@endpush
