@extends('_layouts.admin.index')

@section('content')

<div class="row">
    @foreach ($records as $record)
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <a class="text-dark btn-show-message" data-id="{{ $record->id }}" href="javascript:void(0);">{{ Str::limit($record->title, 20, '...') }}</a>
                        @if($record->seen_status_fa)
                            <span class="small text-danger spn-new-label">({{ $record->seen_status_fa }})</span>
                        @endif
                        {{-- <span class="small text-{{ $record->is_seen ? 'success' : 'danger' }}">{{ $record->seen_status_fa ? "({$record->seen_status_fa})" : '' }}</span> --}}
                    </h5>

                    <span class="font-weight-bold text-info"><i class="fa fa-user text-muted"></i> {{ $record->sender_name }}</span><br>
                    <span class="number-fa text-muted"><i class="fa fa-clock text-muted"></i> {{ $record->created_at_fa }}</span><br>
                    {{-- <p class="card-text text-muted mb-0"><i class="fa fa-comment text-muted"></i> {{ Str::limit($record->content, 85, '...') }}</p> --}}
                    <br/>
                    <button type="button" data-id="{{ $record->id }}" class="btn btn-sm btn-info btn-show-message float-left mr-1 rounded text-light px-2 small" title="مشاهده پیام"><i class="fas fa-eye align-middle"></i> مشاهده پیام </button>
                </div>
            </div>
        </div>
    @endforeach
    @if ($records->lastPage() > 1)
        <div class="col-12 number-fa">
            {{ $records->links() }}
        </div>
    @endif
</div>
@endsection

@push('styles')
    <style>
        .card-text{
            height: 20px;
        }
        #div-content > p {
            margin-top: 10px;
            border: 1px solid #343a40!important;
            border-radius: 3px;
            padding: 8px;
        }
    </style>
@endpush

@section('modal-content')
    <div class="modal" id="mdl-show" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title float-right"></h5>
            <button type="button" class="close float-left" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="frm-event" action="" method="POST">
                    <div class="row">
                        <div id="div-sender-name" class="col-12 font-weight-bold">

                        </div>
                        <div id="div-content" class="col-12">
                            <p class="number-fa"></p>
                        </div>
                        <div id="div-time" class="col-12">
                            <span class="number-fa text-muted"><i class="fa fa-clock text-muted"></i> <label for=""></label> </span><br>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary text-light" data-dismiss="modal"><i class="fas fa-times-circle"></i>&nbsp;بستن</button>
            </div>
        </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(function(){
            $.ajaxSetup({
                contentType: false,
                processData: false
            });

            $(document).on('click', '.btn-show-message', function(){
                var $this = $(this);
                var id = $this.attr('data-id');
                $.LoadingOverlay("show");
                $this.prop('disabled', true);

                $this.find('i').attr("class", "fas fa-spinner align-middle fa-pulse");

                var url = '{{ route("admin.message.show", ":id") }}';
                url = url.replace(':id', id);

                var formData = new FormData();

                $.post(url, formData, function (result) {
                    if (result.status)
                    {
                        var record = result.record;
                        $('#div-sender-name').text(record.sender_name + ' :')
                        $('#div-content').find('p').html(record.content)
                        $('#div-time').find('label').text(record.created_at_farsi)
                        $('.modal-title').text(record.title)
                        $('#mdl-show').modal('toggle');
                        $this.closest('.card-body').find('.spn-new-label').hide();
                        if(result.unseen_messages_count > 0)
                        {
                            $('.unseen_message_count').text(result.unseen_messages_count).show();
                        }
                        else
                        {
                            $('.unseen_message_count').text('').hide();
                        }
                    }
                    else
                    {
                        makeAlert('اخطار!', result.message, 'orange');
                    }
                    $.LoadingOverlay("hide");
                }, 'json').fail(function (jqXhr)
                {
                    makeAlert('خطا!', getErrors(jqXhr), 'red');
                    $.LoadingOverlay("hide");
                }).always(function (){
                    setTimeout(function(){
                        $this.prop('disabled', false);
                        $this.find('i').attr("class", "fas fa-eye align-middle");
                    }, 750);
                });
            });
        });
    </script>
@endpush

