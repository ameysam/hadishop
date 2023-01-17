@extends('_layouts.admin.index')

@script(croppie/croppie.js)
@style(croppie/croppie.css)

@section('content')
    @component('_components.admin.page_title')
        @slot('title', isset($record) ? 'ویرایش رکورد' : 'تعریف رکورد جدید')
        @slot('button_title', 'ثبت')
        @slot('button_route', $form['action'])
        @slot('location_route', route('admin.category.index'))
        @slot('back_route', route('admin.category.index'))
        @slot('with_assets', true)
        @slot('method', $form['method'] ?? 'post')
    @endcomponent

    <form action="#" method="post" id="form1">
        <div class="row">
            <div id="form-errors" class="col-lg-12 d-none">

            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                @component('_components.admin.input.input')
                                    @slot('id', 'name')
                                    @slot('title', 'نام')
                                    @slot('star', true)
                                    @slot('slot', $record->name ?? '')
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection


@section('modal-content')
    {{-- @component('_components.admin.modal.avatar-modal')
        @slot('file_id', 'input_avatar')
        @slot('input_id', 'input_image')
        @slot('image_avatar', 'img_avatar')
    @endcomponent --}}
@endsection

@push('scripts')
    <script>
        $(function(){

            // $('#nationality_country').change(function(){
            //     var $this = $(this);

            //     var code = $this.children("option:selected").attr('data-code');
            //     $country_code.text(code);
            // });
        });
    </script>
@endpush
