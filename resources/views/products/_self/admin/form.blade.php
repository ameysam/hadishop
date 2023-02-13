@extends('_layouts.admin.index')

@script(croppie/croppie.js)
@style(croppie/croppie.css)

@section('content')
    @component('_components.admin.page_title')
        @slot('title', isset($record) ? 'ویرایش کالا' : 'تعریف کالا جدید')
        @slot('button_title', 'ثبت')
        @slot('button_route', $form['action'])
        @slot('location_route', route('admin.product.index'))
        @slot('back_route', route('admin.product.index'))
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
                                    @slot('title', 'نام کالا')
                                    @slot('star', true)
                                    @slot('slot', $record->name ?? '')
                                @endcomponent
                            </div>

                            <div class="col-sm-12">
                                @component('_components.admin.input.editor')
                                    @slot('id', 'description')
                                    @slot('title', 'توضیحات')
                                    @slot('slot', $record->description ?? '')
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                {{-- <div class="card">
                    <div class="card-body">
                        <h4 class="box-title mb-3">تصویر</h4>
                        @component('_components.admin.avatar')
                            @slot('img_id', 'img_avatar')
                            @slot('file_name', 'avatar')
                            @slot('input_name', 'image')
                            @isset($record)
                                @slot('img_src', $record->image(8, 8))
                            @endisset
                        @endcomponent
                    </div>
                </div> --}}
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                @component('_components.admin.input.input')
                                    @slot('id', 'price')
                                    @slot('type', 'number')
                                    @slot('title', 'قیمت')
                                    @slot('star', true)
                                    @slot('slot', $record->price ?? '')
                                @endcomponent
                            </div>
                            <div class="col-12">
                                @component('_components.admin.select.single')
                                    @slot('title', 'دسته‌بندی')
                                    @slot('id', 'category_id')
                                    @slot('search', true)
                                    @slot('star', true)
                                    @slot('options')
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ (isset($record) && $record->category_id == $category->id) ? 'selected="selected"' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    @endslot
                                @endcomponent
                            </div>
                            <div class="col-12">
                                @component('_components.admin.select.single')
                                    @slot('title', 'وضعیت ویژه')
                                    @slot('id', 'special')
                                    @slot('star', true)
                                    @slot('options')
                                        <option value="0" {{ (isset($record) && $record->special !== 1) ? 'selected="selected"' : '' }}>معمولی</option>
                                        <option value="1" {{ (isset($record) && $record->special === 1) ? 'selected="selected"' : '' }}>ویژه</option>
                                    @endslot
                                @endcomponent
                            </div>
                            <div class="col-12">
                                @component('_components.admin.select.single')
                                    @slot('title', 'وضعیت پیشنهاد')
                                    @slot('id', 'suggest')
                                    @slot('star', true)
                                    @slot('options')
                                        <option value="0" {{ (isset($record) && $record->suggest !== 1) ? 'selected="selected"' : '' }}>پیشنهاد نشده</option>
                                        <option value="1" {{ (isset($record) && $record->suggest === 1) ? 'selected="selected"' : '' }}>پیشنهاد شده</option>
                                    @endslot
                                @endcomponent
                            </div>
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
