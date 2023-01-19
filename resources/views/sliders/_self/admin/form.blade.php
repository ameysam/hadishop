@extends('_layouts.admin.index')

@script(croppie/croppie.js)
@style(croppie/croppie.css)

@section('content')
    @component('_components.admin.page_title')
        @slot('title', isset($record) ? 'ویرایش اسلایدر' : 'تعریف اسلایدر جدید')
        @slot('button_title', 'ثبت')
        @slot('button_route', $form['action'])
        @slot('location_route', route('admin.slider.index'))
        @slot('back_route', route('admin.slider.index'))
        @slot('with_assets', true)
        @slot('method', $form['method'] ?? 'post')
    @endcomponent

    <form action="#" method="post" id="form1">
        <div class="row">
            <div id="form-errors" class="col-lg-12 d-none">

            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-12">
                                @component('_components.admin.input.input')
                                    @slot('id', 'name')
                                    @slot('title', 'عنوان اسلایدر')
                                    @slot('star', true)
                                    @slot('slot', $record->name ?? '')
                                @endcomponent
                            </div>

                            <div class="col-sm-12">
                                @component('_components.admin.input.input')
                                    @slot('id', 'link')
                                    @slot('title', 'لینک اسلایدر')
                                    @slot('slot', $record->link ?? '')
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-md-4">
                                    <label for="file">تصویر</label>
                                    <input type="file" id="file" name="file" accept="image/png, image/jpeg">
                                </div>

                                @if(isset($record) && $record->file)
                                    <div class="col-md-4">
                                        <div>
                                            <i data-input-name="delete_photo" title="حذف" class="fas fa-times remove-thumb-icon bg-danger rounded cursor-pointer position-absolute p-1"></i>
                                            <img src="{{ $record->file_path }}" alt="" class="img-thumbnail"  width="125px">
                                        </div>
                                    </div>
                                @endif
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
