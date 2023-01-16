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
                            <th></th>
                            <th class="text-center number-fa" scope="col">شنبه 17/01</th>
                            <th class="text-center number-fa" scope="col">یکشنبه 18/01</th>
                            <th class="text-center number-fa" scope="col">دوشنبه 19/01</th>
                            <th class="text-center number-fa" scope="col">سه شنبه 20/01</th>
                            <th class="text-center number-fa" scope="col">چهارشنبه 21/01</th>
                            <th class="text-center number-fa" scope="col">پنج شنبه 22/01</th>
                            <th class="text-center number-fa" scope="col">جمعه 23/01</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td scope="row">1:00 AM</td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="disabled bg-danger">انتخاب شده</td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="disabled bg-secondary">غیرقابل انتخاب</td>
                          </tr>
                          <tr>
                            <td scope="row">2:00 AM</td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                          </tr>
                          <tr>
                            <td scope="row">3:00 AM</td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                            <td class="selectable"></td>
                          </tr>
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

            $(".disabled").mousedown(function () {
                    // alert('heeeeey nemishe')
                    select_disable = true;
                    return false;
                }).mouseover(function () {
                    if (isMouseDown) {
                        // alert('heeeeey nemishe')
                        select_disable = true;
                        isMouseDown = false;

                        if($('.highlighted').length)
                        {
                            $modal.modal();
                        }

                        return false;
                    }
                });
            ;

            $("table td").not('.reserved').not('.disabled').mousedown(function () {
                // if(select_disable)
                // {
                //     alert('hoy koja');
                //     return false;
                // }
                    isMouseDown = true;
                    $(this).toggleClass("highlighted");
                    isHighlighted = $(this).hasClass("highlighted");
                    return false; // prevent text selection
                })
                .mouseover(function () {
                    // if(select_disable)
                    // {
                    //     alert('hoy koja');
                    //     return false;
                    // }
                    if (isMouseDown) {
                        $(this).toggleClass("highlighted", isHighlighted);
                    }
                });

            $("table td").not('.reserved').not('.disabled').mouseup(function(){
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

            $('#btn-register-events').click(function(){
                var eventName = $('#input_name').val();
                if(!eventName)
                {
                    return false;
                }
                $('.highlighted').text(eventName);
                $('td.highlighted').addClass('reserved').removeClass('highlighted');
                $modal.modal('hide');
                $('#input_name').val('');
            })
        })
    </script>
@endpush
