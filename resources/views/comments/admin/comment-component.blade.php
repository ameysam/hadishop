<div class="col-md-8">
    @if($comments)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @foreach ($comments as $item)
                                <div class="visit-text rounded-lg mb-3 p-2 border border-dark">
                                <div class="row">
                                    <div class="col-md-12 mb-3 text-muted">
                                        <span><i class="fas fa-user"></i>&nbsp;{{ $item->user->full_name }}</span>
                                        <span class="number-fa float-left" dir="ltr">{{ jdate($item->created_at)->format('%A، Y/m/d - H:i:s') }}&nbsp;<i class="fas fa-clock align-middle"></i></span>
                                    </div>
                                    <div class="col-md-12">
                                        <p>
                                            {!! nl2br($item->content) !!}
                                        </p>
                                    </div>

                                    <div class="col-md-12">
                                        @if($item->files->count())
                                            @foreach ($item->files as $key => $file)
                                                @if (in_array($file->extension, ["mp3", "wav"]))
                                                    <audio controls>
                                                        <source src="{{ asset($file->getPath()) }}" type="{{ $file->type }}">
                                                    </audio>
                                                @else
                                                    <a target="_blank" href="{{ asset($file->getPath())}}">
                                                        <small class="text-info number-fa"><i class="fas fa-file-image"></i>&nbsp;فایل شماره {{ $key + 1 }}</small>
                                                    </a>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body number-fa">
                    <form action="" id="form_comment">
                        <input type="hidden" name="record_id" value="{{ $record->id }}">
                        <input type="hidden" name="record_name" value="{{ $record_name }}">
                        <div class="row">
                            <div class="col-12">
                                @component('_components.admin.input.editor')
                                    @slot('id', 'content')
                                    @slot('title', 'پیام')
                                    @slot('placeholder', 'درج پیام')
                                @endcomponent
                            </div>

                            <div class="col-12">
                                @component('_components.admin.file.multiple-files')
                                    @slot('id', 'files')
                                    @slot('title', 'فایل')
                                    @slot('accept', $files_mimes)
                                    @slot('alerts')
                                        {!! $files_description ?? '' !!}
                                    @endslot
                                @endcomponent
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <div class="row">

                                <div class="col-12 text-right">
                                    {{-- <a href="" onclick="history.go(-1);" class="btn btn-danger btn-sm"><i class="fas fa-times-circle align-middle"></i>&nbsp;انصراف</a> --}}

                                    <button id="btn_register" class="btn btn-success btn-sm" type="button">
                                        <i class="fas fa-briefcase-medical align-middle"></i>&nbsp;ارسال پیام
                                    </button>
                                    @php
                                        $current_url = url()->current();
                                    @endphp
                                    @push('scripts')
                                        <script>
                                            $(function(){
                                                window._form_id = 'form_comment';
                                                // window._form_cancel_button_title = "{{ $cancel_button_title ?? 'انصراف' }}";
                                                window._form_location_back_url = "{{ $current_url }}";
                                                window._form_location_url = "{{ $current_url }}";
                                                window._form_button_url = "{{ route('admin.comment.store') }}";
                                            });
                                        </script>
                                    @endpush
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
