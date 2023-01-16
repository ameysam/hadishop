@isset($with_assets)
    @script(cedarmaps/cedarmaps.js)
    @style(cedarmaps/cedarmaps.css)
@endisset

<div class="form-group">
    <label>
        @isset($star)
            <span class="text-danger forced_input">*</span>
        @endisset
        {{ $title }}
    </label>

<input type="hidden" name="lat" id="latitude"
       value="{{ $lat ?? '35.69982570505505'}}">
<input type="hidden" name="lng" id="longitude"
       value="{{ $lng ?? '51.34170770645142'}}">

    @isset($with_address)
    <button class="my-btn-submit-map text-success" type="button" onclick="getLocality()"><i class="fa fa-address-book-o"></i>&nbsp;دریافت نشانی</button>
    @endisset

    <div id="{{ $id ?? 'map' }}" style="width:100%;height:{!! $height ?? '400' !!}px;" class="thumbnail"></div>
</div>
@push('scripts')
    {{--Google map scripts--}}
    <script>
        L.cedarmaps.accessToken = "{{ $api ?? env('CEDAR_API_TOKEN') }}"; // See the note below on how to get an access token

        var tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;

        var map = L.cedarmaps.map('map', tileJSONUrl, {
            scrollWheelZoom: true
        }).setView([{{ $lat ?? '35.69982570505505'}}, {{ $lng ?? '51.34170770645142'}}], 15);

        var default_marker = new L.Marker([{{ $lat ?? '35.69982570505505'}}, {{ $lng ?? '51.34170770645142'}}], {draggable:true});
        default_marker.on('dragend', markerDrag);

        var markerGroup = L.layerGroup().addTo(map);

        default_marker.addTo(markerGroup);

        map.on('click', function(e){
            remove_markers();
            var marker = new L.Marker(e.latlng, {draggable:true});
            // marker.bindPopup("<strong>"+e.latlng+"</strong>");
            marker.on('dragend', markerDrag);
            marker.addTo(markerGroup);
            representLatLng(e.latlng);
        });

        function markerDrag(e) {
            representLatLng(e.target._latlng);
        }

        function remove_markers(){
            markerGroup.eachLayer(function (layer) {
                map.removeLayer(layer);
            });
        }

        function representLatLng(latlng) {
            document.getElementById('latitude').value = latlng.lat;
            document.getElementById('longitude').value = latlng.lng;
        }

        function getLocality() {
            $.LoadingOverlay("show");

            var lat = document.getElementById('latitude').value;
            var lng = document.getElementById('longitude').value;

            var url = "https://api.cedarmaps.com/v1/geocode/cedarmaps.streets/";
            url += (lat+','+lng);
            url += '.json?access_token=' + L.cedarmaps.accessToken;

            var payload = {
                url: url
            };

            $.post("{{ route('admin.map.cedar.call.url') }}", payload, function( data ) {
                if(data.status == 'OK')
                {
                    var address = [/*data.result.country, data.result.province, data.result.city, */data.result.district, data.result.locality, data.result.address].join(' - ');
                    $('#input_address').val(address);
                    $('#input_district').val(data.result.district);
                    $('#input_locality').val(data.result.locality);
                    $.LoadingOverlay("hide");
                }
                else {
                    make_alert('خطا!', 'خطا در برقراری ارتباط با سرویس نقشه.');
                    $.LoadingOverlay("hide");
                }
            }, 'json').fail(function (jqXhr) {
                make_alert('خطا!', 'خطا در برقراری ارتباط با سرویس نقشه.');
                $.LoadingOverlay("hide");
            });
        }
    </script>
@endpush
@push('styles')
    <style>
        .my-btn-submit-map:focus {
            outline: none;
        }
        .my-btn-submit-map{
            background: transparent;
            border: none;
        }
    </style>
@endpush
