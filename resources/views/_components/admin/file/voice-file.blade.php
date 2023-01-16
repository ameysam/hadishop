@script(client-browser/client-browser-info.js)

<div class="row send-audio-checkbox d-none">
    <div class="col-12 mb-2">
        @component('_components.admin.checkbox.with_font')
            @slot('id', 'send_audio')
            @slot('jelly', true)
            @slot('round', true)
            @slot('title', 'ارسال فایل صوتی')
            @slot('value', '1')
            @slot('status_class', 'p-primary-o')
            @slot('icon_class', 'fas fa-check')
            @slot('input_class', '')
            {{-- @slot('checked', true) --}}
        @endcomponent
    </div>
</div>

<div class="row audio-record d-none">
    <div class="col-12">

        {{-- رکورد صدا --}}
        {{-- @if($record->details->isNotEmpty()) --}}
        <div id="controls">
            <div id="recorder-lib" class="d-none">
                <button class="btn btn-sm btn-success btn-recorder" id="recordButton"><i class="fa fa-microphone"></i> Record</button>
                <button class="btn btn-sm btn-secondary d-none btn-pauser" id="pauseButton" disabled><i class="fa fa-pause"></i> pause</button>
                <button class="btn btn-sm btn-danger btn-stoper" id="stopButton" disabled><i class="fa fa-stop"></i> Stop</button>
            </div>
            <div id="recorder-custom" class="d-none">
                <button type="button" class="btn btn-sm btn-success btn-recorder" id="recordButtonAndroid"><i class="fa fa-microphone"></i> Record</button>
                <button type="button" class="btn btn-sm btn-danger btn-stoper" id="pauseButtonAndroid" disabled><i class="fa fa-stop"></i> Stop</button>
                <audio id=recordedAudio></audio>
            </div>
            <br>
            <div id="time-place-holder">
                <div class="values">00:00:00</div>
            </div>
        </div>
        <div id="formats"></div>
        <ul id="recordingsList"></ul>
    {{-- @endif --}}
    {{-- رکورد صدا --}}
    </div>
</div>

@push('script_lib')
    <script src="{{ asset('assets/pages/admin/recorder.js') }}"></script>
    <script src="{{ asset('assets/pages/admin/record_audio.js') }}"></script>
    <script src="{{ asset('assets/pages/admin/timer.min.js') }}"></script>
@endpush

@push('scripts')
    <script>

        var $recorderLib = $('#recorder-lib');

        var $recorderCustom = $('#recorder-custom');

        var $sendCheckbox = $('.send-audio-checkbox');

        if(jscd.ios)
        {
            $sendCheckbox.removeClass('d-none');
        }
        else
        {
            document.getElementById("formats").innerHTML="بعد از اتمام پیام روی دکمه Stop کلیک کنید و آن را ارسال نمایید.";
            $sendCheckbox.removeClass('d-none');
            var chrome_condition = (jscd.browser == 'Chrome' && jscd.browserMajorVersion > 51);
            var firefox_condition = (jscd.browser == 'Firefox' && jscd.browserMajorVersion > 36);

            if(chrome_condition || firefox_condition)
            {

                var file_blob = null;
                // var blob_blob = null;

                navigator.mediaDevices.getUserMedia({audio:true})
                    .then(stream => {handlerFunction(stream)})


                function handlerFunction(stream) {
                    rec = new MediaRecorder(stream);
                    rec.ondataavailable = e => {
                        audioChunks.push(e.data);
                        if (rec.state == "inactive"){
                            let blob = new Blob(audioChunks,{type:'audio/mpeg-3'});
                            audio_blob = blob;
                            // var file = new File([blob], "name.mp3");
                            recordedAudio.src = window.URL.createObjectURL(blob);
                            // recordedAudio.src = file;
                            recordedAudio.controls = true;
                            recordedAudio.autoplay = false;
                            // file_blob = file;
                            sendData(blob);
                        }
                    }
                }
                function sendData(data) {}

                recordButtonAndroid.onclick = e => {
                    console.log('start clicked')
                    recordButtonAndroid.disabled = true;
                    pauseButtonAndroid.disabled=false;
                    audioChunks = [];
                    rec.start();
                }

                pauseButtonAndroid.onclick = e => {
                    console.log("stop clicked")
                    recordButtonAndroid.disabled = false;
                    pauseButtonAndroid.disabled = true;
                    rec.stop();
                }
            }
            else
            {
                $sendCheckbox.addClass('d-none');
                alert('مرورگر شما از قابلیت ارسال فایل صوتی پشتیبانی نمیکند');
            }
            console.log(jscd)
        }

        /** audio recording **/
        $(document).ready(function () {
            // شروع رکورد فایل صوتی
            $('#send_audio').change(function(){
                var $this = $(this);
                if($this.is(":checked"))
                {
                    if(jscd.os == 'iOS')
                    {
                        $recorderLib.removeClass('d-none');
                        $recorderCustom.addClass('d-none');
                    }
                    else
                    {
                        $recorderCustom.removeClass('d-none');
                        $recorderLib.addClass('d-none');
                    }
                    // $('.text-record').addClass('d-none');
                    $('.audio-record').removeClass('d-none');
                }
                else
                {
                    $('.audio-record').addClass('d-none');
                    $('.text-record').removeClass('d-none');
                    $('.audio-panel').addClass('d-none');
                    $recorderLib.addClass('d-none');
                    $recorderCustom.addClass('d-none');
                }
            });


            // timer
            var timerInstance = new easytimer.Timer();
            $('.btn-recorder').click(function () {
                timerInstance.start();
            });

            $('.btn-stoper').click(function () {
                timerInstance.reset();
                timerInstance.stop();
            });

            $('.btn-pauser').click(function () {
                timerInstance.stop();
            });

            timerInstance.addEventListener('secondsUpdated', function (e) {
                $('#time-place-holder .values').html(timerInstance.getTimeValues().toString());
            });

            timerInstance.addEventListener('started', function (e) {
                $('#time-place-holder .values').html(timerInstance.getTimeValues().toString());
            });

            timerInstance.addEventListener('reset', function (e) {
                $('#time-place-holder .values').html(timerInstance.getTimeValues().toString());
            });
        });
        /** audio recording **/
    </script>
@endpush
