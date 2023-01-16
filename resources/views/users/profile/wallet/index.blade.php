@extends('_layouts.admin.index')

@section('content')

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body p-3">
                <h4 class="box-title">موجودی: 
                    @if($user->wallet == 0)
                    -
                    @else
                    <span class="number-fa text-success">{{ number_format($user->wallet) }}</span>
                     تومان
                    @endif
                </h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="box-title mb-2">سابقه تراکنش ها</h4>

                <table class="table table-striped table-bordered">
                    <thead class="bg-secondary">
                        <tr>
                            <th class="text-white text-center">مبلغ</th>
                            <th class="text-white text-center">علت</th>
                            <th class="text-white text-center">تاریخ</th>
                            {{-- <th class="text-white text-center">مرکز</th> --}}
                            {{-- <th class="text-white text-center">بخش</th> --}}
                            <th class="text-white text-center">توضیحات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($records as $record)
                        <tr>
                            <th class="text-center">
                                @if($record->amount < 0)
                                    <span class="text-danger number-fa">{{ number_format($record->amount) }}</span>
                                @else
                                    <span class="text-success number-fa">+{{ number_format($record->amount) }}</span>
                                @endif
                            </th>
                            <td class="text-center">{{ $record->cause_fa }}</td>
                            <td class="text-center number-fa">{{ $record->created_at_fa }}</td>
                            {{-- <td class="text-center">{{ $record->center->name ?? '' }}</td>
                            <td class="text-center">{{ $record->section->name ?? '' }}</td> --}}
                            <td class="text-center">{{ $record->description ?? '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $records->links() }}
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h4 class="box-title mb-2">افزایش اعتبار</h4>

                @if (session('message'))
                    @if(session('status') == '1')
                    <div class="alert alert-success">
                    @else
                    <div class="alert alert-danger">
                    @endif
                        {{ session('message') }}
                    </div>
                @endif

                <form id="frmChargeWallet" action="{{ $wallet_charge_url }}" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            @component('_components.admin.input')
                                @slot('id', 'amount')
                                @slot('type', 'number')
                                @slot('title', 'مبلغ')
                                @slot('fa_num', ' number-fa')
                                @slot('dir', 'ltr')
                                @slot('star', true)
                            @endcomponent

                            <div class="text-center">
                                <small id="currency" class="number-fa font-weight-bold"></small>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            @component('_components.admin.editor')
                                @slot('id', 'description')
                                @slot('title', 'توضیحات')
                            @endcomponent
                        </div>
                        <div class="col-sm-12">
                            <div class="float-left">
                                <div class="page-button">
                                    <button id="btn-charge" class="btn btn-success btn-sm" type="button"><i class="fas fa-dollar-sign align-middle"></i>&nbsp;شارژ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function(){
            $('#btn-charge').click(function(){
                $.LoadingOverlay("show");

                var $this = $(this);
                $this.prop('disabled', true);
                $this.html("شارژ&nbsp;<i class='fas fa-spinner fa-pulse align-middle'></i>");

                var $form = $('#frmChargeWallet');
                var data = $form.serialize();
                var url = $form.attr('action');

                $.post(url, data, function (result) {
                    if (result.status)
                    {
                        window.location = result.redirect_url;
                    }
                    else
                    {
                        $.LoadingOverlay("hide");
                        make_alert('اخطار!', result.message, 'orange');
                    }

                }, 'json').fail(function (jqXhr)
                {
                    make_alert('خطا!', get_errors(jqXhr), 'red');
                    show_errors(jqXhr);
                    $.LoadingOverlay("hide");
                }).always(function ()
                {
                    setTimeout(function(){
                        $this.prop('disabled', false);
                        $this.html('<i class="fas fa-dollar-sign"></i>&nbsp;شارژ');
                    }, 750);
                });

            });

            $('#input_amount').on('keyup', function() {
                var value = $("#input_amount").val();
                if(value)
                {
                    $('#currency').html(formatMoney(value) + ' ' + 'تومان');
                }
                else
                {
                    $('#currency').html('');
                }
            });

            $('#input_amount').on('change', function() {
                $(this).trigger('keyup');
            });
        });

        function formatMoney(amount, decimalCount = 0, decimal = ".", thousands = "،") {
            try {
                decimalCount = Math.abs(decimalCount);
                decimalCount = isNaN(decimalCount) ? 3 : decimalCount;

                const negativeSign = amount < 1 ? "-" : "";

                let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
                let j = (i.length > 3) ? i.length % 3 : 0;

                return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(3) : "");
            } catch (e) {
                console.log(e)
            }
        };
    </script>
@endpush
