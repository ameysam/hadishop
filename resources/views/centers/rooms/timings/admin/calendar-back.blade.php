@extends('_layouts.admin.index')

@section('content')
    <!-- Widgets  -->
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
                                <th class="text-center number-fa disabled" scope="col">{{ jdate($item->started_at)->format('%A y/m/d') }}</th>
                            @endforeach
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $shcedule_counts = $schedules->count();
                                $start_time = Carbon\Carbon::parse($min_started_time);
                                $reserve_duration = $room->schedule->reserve_duration;
                                $gap_time = Carbon\Carbon::parse($min_started_time)->add($reserve_duration, 'minute');
                                $gap_duration = $room->schedule->gap_duration;
                                $finish_time = Carbon\Carbon::parse($min_started_time)->add(15, 'minute');
                                $max_finished_time = Carbon\Carbon::parse($max_finished_time);
                                $step = 0;
                                $now = now();
                            @endphp
                            @while ($finish_time->lte($max_finished_time))
                                <tr>
                                    <td scope="row" class="number-fa disabled">{{ $start_time->format('H:i') }}</td>
                                    <td scope="row" class="number-fa disabled">{{ $finish_time->format('H:i') }}</td>

                                    @if($gap_duration)
                                        @if($gap_time->gt($start_time))
                                            @php
                                                $step = 0;
                                            @endphp
                                            @foreach ($schedules as $item)
                                                @if(Carbon\Carbon::parse($item->finished_at)->setTime($finish_time->hour, $finish_time->minute, 0)->gt($now))
                                                    @component('centers.rooms.timings.admin._components.cell')
                                                        @slot('day', Carbon\Carbon::parse($item->started_at)->format('Y-m-d'))
                                                        @slot('start_time', $start_time->format('H:i:s'))
                                                        @slot('finish_time', $finish_time->format('H:i:s'))
                                                    @endcomponent
                                                @else
                                                    <td class="disabled bg-secondary"></td>
                                                @endif
                                            @endforeach
                                        @else
                                            @php
                                                $step += 15;
                                                if($step >= $gap_duration)
                                                {
                                                    $gap_time->add($gap_duration + $reserve_duration, 'minute');
                                                }
                                            @endphp
                                            @for ($j = 0; $j < $shcedule_counts; $j++)
                                                <td class="disabled bg-dark"></td>
                                            @endfor
                                        @endif
                                    @else
                                        @foreach ($schedules as $item)
                                            @if(Carbon\Carbon::parse($item->finished_at)->setTime($finish_time->hour, $finish_time->minute, 0)->gt($now))
                                                @component('centers.rooms.timings.admin._components.cell')
                                                    @slot('day', Carbon\Carbon::parse($item->started_at)->format('Y-m-d'))
                                                    @slot('start_time', $start_time->format('H:i:s'))
                                                    @slot('finish_time', $finish_time->format('H:i:s'))
                                                @endcomponent
                                            @else
                                                <td class="disabled bg-secondary"></td>
                                            @endif
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
                            @slot('id', 'contacts')
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

@endsection

@push('scripts')
    <script>
        var $modal = $('#modal');

        $(function(){
            // $(document).on('click', '.selectable', function(){
            //     var $this = $(this);

            //     $this.toggleClass('bg-success');
            // });

            var select_disable = false;

            var isMouseDown = false,
            isHighlighted;

            // $(".disabled").mousedown(function () {
            //         // alert('heeeeey nemishe')
            //         select_disable = true;
            //         return false;
            //     }).mouseover(function () {
            //         if (isMouseDown) {
            //             // alert('heeeeey nemishe')
            //             select_disable = true;
            //             isMouseDown = false;

            //             if($('.highlighted').length)
            //             {
            //                 $modal.modal();
            //             }

            //             return false;
            //         }
            //     });
            ;

            $("table td").mousedown(function () {
                // if(select_disable)
                // {
                //     alert('hoy koja');
                //     return false;
                // }
                if(!$(this).hasClass('disabled') && !$(this).hasClass('reserved'))
                {
                    isMouseDown = true;
                    $(this).toggleClass("highlighted");
                    isHighlighted = $(this).hasClass("highlighted");
                    return false; // prevent text selection
                }

                })
                .mouseover(function () {
                    // if(select_disable)
                    // {
                    //     alert('hoy koja');
                    //     return false;
                    // }
                    if (isMouseDown && !$(this).hasClass('disabled') && !$(this).hasClass('reserved'))
                    {
                        $(this).toggleClass("highlighted", isHighlighted);
                    }
                });

            $("table td").mouseup(function(){
                $modal.modal();
            });

            $(document).mouseup(function () {
                isMouseDown = false;
            });

            $('#modal').on('hide.bs.modal', function (event) {
                $('td').removeClass('highlighted')
                // var button = $(event.relatedTarget) // Button that triggered the modal
                // var recipient = button.data('whatever') // Extract info from data-* attributes
                // var modal = $(this)
                // modal.find('.modal-title').text('New message to ' + recipient)
                // modal.find('.modal-body input').val(recipient)
            })

var meetingIndex = 1;
            $('#btn-register-events').click(function(){
                var eventName = $('#input_name').val();
                var $highlighted = $('.highlighted');
                if(!eventName)
                {
                    return false;
                }
                $highlighted.find('.spn-title').text(eventName);
                $highlighted.find('.meeting-name').text(eventName);

                $('.highlighted').each(function(i, obj) {
                    console.log($(obj).get(0).outerHTML)
                    var $td = $.parseHTML($(obj).get(0).outerHTML)[0];
                    console.log($td.find('.data-day').attr('data-day'))
                    // var day = $td.find('.data-day');
                    // console.log(day)
                    // var dataInput = '<input class="data-input" type="hidden" name="meeting_'+ meetingIndex +'_name" value="'+eventName+'">'+
                    //                 '<input class="data-input" type="hidden" name="meeting_'+ meetingIndex +'_days[]" value="2021-01-26">'+
                    //                 '<input class="data-input" type="hidden" name="meeting_'+ meetingIndex +'_days_2021-01-26_start[]" value="08:00:00">'+
                    //                 '<input class="data-input" type="hidden" name="meeting_'+ meetingIndex +'_days_2021-01-26_finish[]" value="09:00:00">';
                });



                // $highlighted.find(eventName);
                $('td.highlighted').addClass('reserved').removeClass('highlighted');
                $modal.modal('hide');
                $('#input_name').val('');
            })
        })
    </script>
@endpush
