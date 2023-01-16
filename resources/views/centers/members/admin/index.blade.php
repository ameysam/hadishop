@extends('_layouts.admin.index')

@section('content')

@hasp('center-edit', $g_center->id)
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-md-2 col-6">
                <button type="button" data-toggle="modal" data-target="#mdl-add-members" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>&nbsp;افزودن عضو جدید</a>
            </div>
            <div class="col-md-2 col-6">
                <button type="button" data-toggle="modal" data-target="#mdl-create-member" class="btn btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;تعریف عضو جدید</a>
            </div>
        </div>
    </div>
</div>
<br>
@endhasp
<div class="row">
    @foreach ($records as $record)
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        @if($record->users_center_creator_id == $g_center->id)
                            <a class="text-dark" target="_blank" href="{{ route('admin.center.member.show', [$g_center->id, $record->id]) }}">
                                {{ $record->users_first_name }} {{ $record->users_last_name }}
                            </a>
                        @else
                            {{ $record->users_first_name }} {{ $record->users_last_name }}
                        @endif
                        <span class="text-muted small text-smaller">( {{ $record->users_id_no }} )</span>
                    </h5>
                    <br>
                    @if($record->roles_title)
                        نقش:
                        <span class="font-weight-bold text-info">{{ Illuminate\Support\Str::limit($record->roles_title, 20) }}</span><br>
                    @else
                        <span class="font-weight-bold text-dark">بدون نقش</span><br>
                    @endif
                    {{-- <a href="{{ route('admin.center.show', $record->id) }}" class="text-success float-left" title="مشاهده"><i class="fas fa-eye"></i></a> --}}

                    @if($record->roles_title)
                    @hasp('center-edit', $g_center->id)
                        <a href="javascript:void(0);" class="text-danger float-left btn-remove-user" data-id="{{ $record->id }}" title="حذف"><i class="fas fa-trash"></i></a>
                    @endhasp
                    @endif
                    @if($record->users_center_creator_id == $g_center->id)
                        <a href="{{ route('admin.center.member.edit', [$g_center->id, $record->id]) }}" class="text-primary float-left mr-2" title="ویرایش"><i class="fas fa-edit"></i></a>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    @if ($records->lastPage() > 1)
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9 number-fa">
                            {{ $records->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>



<div class="modal fade" id="mdl-add-members" tabindex="-1" role="dialog" aria-labelledby="operationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title float-right" id="operationModalLabel">افزودن اعضا جدید</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form1" method="post">
                    <div class="row">
                        <div class="col-sm-12">
                            @component('_components.admin.select.multiple_with_search')
                                @slot('name', 'members')
                                @slot('url', route('admin.search.auto.user'))
                                @slot('title', 'اعضا')
                                @slot('star', true)
                            @endcomponent
                        </div>
                        <div class="col-sm-12">
                            @component('_components.admin.select.bootstrap-multiple')
                                @slot('title', 'نقش (ها)')
                                @slot('id', 'roles_id')
                                @slot('search', true)
                                @slot('star', true)
                                @slot('size', 10)
                                @slot('show_count', 3)
                                @slot('options')
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endforeach
                                @endslot
                            @endcomponent
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn-cancel" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-times-circle align-middle"></i>&nbsp;انصراف</button>
                <button id="btn-add-members" class="btn btn-success btn-sm" type="button"><i class="fas fa-check-circle align-middle"></i>&nbsp;ثبت</button>

                @push('scripts')
                    <script>
                        $(function(){
                            $mdlAddMembers.on('hidden.bs.modal', function (event) {
                                // resetTags();
                                $('.selectpicker').val('').selectpicker('refresh');
                            });

                            $('#btn-add-members').click(function () {

                                $.LoadingOverlay("show");
                                var $this = $(this);
                                $this.prop('disabled', true);
                                $this.find('i').attr("class", "fas fa-spinner align-middle fa-pulse");

                                var url = '{{ $route_add_member }}';

                                var formData = new FormData(document.getElementById('form1'));

                                $.post(url, formData, function (result) {
                                    if (result.status)
                                    {
                                        makeAlert('پاسخ', result.message, 'green', function () {
                                            $mdlAddMembers.modal('toggle');
                                            location.reload();
                                        });
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
                                        $this.find('i').attr("class", "fas fa-check-circle align-middle");
                                    }, 750);
                                });
                            });
                        });
                    </script>
                @endpush

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdl-create-member" tabindex="-1" role="dialog" aria-labelledby="operationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title float-right" id="operationModalLabel">تعریف عضو جدید</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="frm-create-member">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    @component('_components.admin.input.input')
                                        @slot('id', 'id_no')
                                        @slot('title', 'کد ملی (شماره پرسنلی)')
                                        @slot('star', true)
                                        @slot('dir', 'ltr')
                                        @slot('slot', $record->id_no ?? '')
                                    @endcomponent
                                </div>

                                <div class="col-sm-6 col-12">
                                    @component('_components.admin.input.input')
                                        @slot('id', 'mobile_no')
                                        @slot('title', 'شماره همراه')
                                        @slot('star', true)
                                        @slot('dir', 'ltr')
                                        @slot('slot', $record->mobile_no ?? '')
                                    @endcomponent
                                </div>

                                <div class="col-12">
                                    @component('_components.admin.select.bootstrap-multiple')
                                        @slot('title', 'نقش (ها)')
                                        @slot('id', 'roles_ids')
                                        @slot('search', true)
                                        @slot('star', true)
                                        @slot('size', 10)
                                        @slot('show_count', 3)
                                        @slot('options')
                                            @foreach ($roles as $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                            @endforeach
                                        @endslot
                                    @endcomponent
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    @component('_components.admin.input.input')
                                        @slot('id', 'first_name')
                                        @slot('title', 'نام')
                                        @slot('star', true)
                                        @slot('slot', $record->first_name ?? '')
                                    @endcomponent
                                </div>

                                <div class="col-sm-6 col-12">
                                    @component('_components.admin.input.input')
                                        @slot('id', 'last_name')
                                        @slot('title', 'نام خانوادگی')
                                        @slot('star', true)
                                        @slot('slot', $record->last_name ?? '')
                                    @endcomponent
                                </div>

                                <div class="col-sm-6 col-12">
                                    @component('_components.admin.input.input')
                                        @slot('id', 'email')
                                        @slot('title', 'ایمیل')
                                        @slot('dir', 'ltr')
                                        @slot('slot', $record->email ?? '')
                                    @endcomponent
                                </div>

                                {{-- @component('_components.admin.select.province_cities')
                                    @slot('record', $record ?? null)
                                    @slot('first_call', true)
                                    @slot('star', true)
                                    @slot('size', '6')
                                    @slot('province_title', 'استان')
                                    @slot('city_title', 'شهر')
                                    @slot('province_id', 'province_id')
                                    @slot('city_id', 'city_id')
                                    @slot('province_selected', old('province_id') ?? $record->province_id ?? null)
                                    @slot('city_selected', old('city_id') ?? $record->city_id ?? null)
                                @endcomponent --}}

                                <div class="col-md-6 col-12">
                                    @component('_components.admin.select.radio_gender')
                                        @slot('id', 'gender')
                                        @slot('star', true)
                                        @slot('selected_value', $record->gender ?? null)
                                        @slot('title', 'جنسیت')
                                    @endcomponent
                                </div>
                            </div>

                            <hr class="mb-4">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    @component('_components.admin.input.input_post')
                                        @slot('id', 'password')
                                        @slot('type', 'password')
                                        @slot('title', 'رمزعبور')
                                        @slot('star', true)
                                    @endcomponent
                                </div>
                                <div class="col-md-6 col-12">
                                    @component('_components.admin.input.input_post')
                                        @slot('id', 'password_confirmation')
                                        @slot('type', 'password')
                                        @slot('title', 'تکرار رمزعبور')
                                        @slot('star', true)
                                    @endcomponent
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btn-cancel" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fas fa-times-circle align-middle"></i>&nbsp;انصراف</button>
                <button id="btn-create-member" class="btn btn-success btn-sm" type="button"><i class="fas fa-check-circle align-middle"></i>&nbsp;ثبت</button>

                @push('scripts')
                    <script>
                        $(function(){


                            $mdlCreateMember.on('hidden.bs.modal', function (event) {
                                $('input').val('');
                            });

                            $('#btn-create-member').click(function () {

                                $.LoadingOverlay("show");
                                var $this = $(this);
                                $this.prop('disabled', true);
                                $this.find('i').attr("class", "fas fa-spinner align-middle fa-pulse");

                                var url = '{{ $route_create_member }}';

                                var formData = new FormData(document.getElementById('frm-create-member'));

                                $.post(url, formData, function (result) {
                                    if (result.status)
                                    {
                                        makeAlert('پاسخ', result.message, 'green', function () {
                                            $mdlCreateMember.modal('toggle');
                                            location.reload();
                                        });
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
                                        $this.find('i').attr("class", "fas fa-check-circle align-middle");
                                    }, 750);
                                });
                            });
                        });
                    </script>
                @endpush

            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .card-text{
            height: 20px;
        }
    </style>
@endpush

@endsection

@push('scripts')
    <script>
        var $mdlAddMembers = $('#mdl-add-members');
        var $mdlCreateMember = $('#mdl-create-member');

        $(function(){
            $.ajaxSetup({
                contentType: false,
                processData: false
            });
            $('.btn-remove-user').click(function () {
                var $this = $(this);
                var id = $this.attr('data-id');

                makeAlert('<span style="font-size:large">آیا تایید می‌کنید ؟</span>', '', 'orange', function(){
                    $.LoadingOverlay("show");
                    $this.prop('disabled', true);
                    $this.find('i').attr("class", "fas fa-spinner align-middle fa-pulse");

                    var url = "{{ route('admin.center.member.index', $g_center->id) }}";

                    url += ('/' + id);

                    console.log(url)

                    var formData = new FormData();

                    formData.append('_method', 'DELETE')

                    $.post(url, formData, function (result) {
                        if (result.status)
                        {
                            makeAlert('پاسخ', result.message, 'green', function () {
                                location.reload();
                            });
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
                            $this.find('i').attr("class", "fas fa-trash align-middle");
                        }, 750);
                    });
                }, 'confirm');
            });
        });
    </script>
@endpush

