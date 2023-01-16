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

    <button class="my-btn-submit-map text-success" type="button" onclick="getLocality()"><i class="fa fa-address-book-o"></i>&nbsp;دریافت نشانی</button>

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


        var hubIcon = L.icon({
            iconUrl: 'http://mypakat.com/assets/images/admin/markers/marker-red.png',
            iconSize:     [48, 48], // size of the icon
            iconAnchor:   [35, 45], // point of the icon which will correspond to marker's location
            shadowAnchor: [0, 0],  // the same for the shadow
            popupAnchor:  [-10, -35] // point from which the popup should open relative to the iconAnchor
        });
        var default_marker = new L.Marker([{{ $lat ?? '35.69982570505505'}}, {{ $lng ?? '51.34170770645142'}}], {icon: hubIcon});
        default_marker.on('dragend', markerDrag);
        default_marker.bindPopup("<strong>هاب</strong>");
        default_marker.addTo(map);

        // L.marker([51.5, -0.09], {icon: greenIcon}).addTo(map);

        var markerGroup = L.layerGroup().addTo(map);
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

            $.post("{{ route('admin.cedar.locality') }}", payload, function( data ) {
                if(data.status == 'OK')
                {
                    var address = [data.result.country, data.result.province, data.result.city, data.result.district, data.result.locality, data.result.address].join(' - ');
                    var name = data.result.locality;
                    $('#input_address').val(address);
                    $('#input_name').val(name);
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
