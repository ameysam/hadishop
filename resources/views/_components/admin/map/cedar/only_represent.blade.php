{{-- <script src='{{ asset('assets/cedarmaps/cedarmaps.js') }}'></script>
    <link href='https://api.cedarmaps.com/cedarmaps.js/v1.8.0/cedarmaps.css' rel='stylesheet' /> --}}

@isset($with_assets)
    @script(cedarmaps/cedarmaps.js)
    @style(cedarmaps/cedarmaps.css)
@endisset

<div class="form-group1">
    @isset($title)
    <label>
        {{ $title }}
    </label>
    @endisset

<input type="hidden" name="lat" id="latitude"
       value="{{ $lat ?? '35.69982570505505'}}">
<input type="hidden" name="lng" id="longitude"
       value="{{ $lng ?? '51.34170770645142'}}">

    <div id="{{ $id ?? 'map' }}" style="width:100%;height:{!! $height ?? '400' !!}px;" class="thumbnail"></div>
</div>
@push('scripts')
    <script>
        L.cedarmaps.accessToken = "{{ $api ?? env('CEDAR_API_TOKEN') }}"; // See the note below on how to get an access token

        var tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;

        var map = L.cedarmaps.map('map', tileJSONUrl, {
            scrollWheelZoom: true
        }).setView([{{ $lat ?? '35.69982570505505'}}, {{ $lng ?? '51.34170770645142'}}], 15);

        var default_marker = new L.Marker([{{ $lat ?? '35.69982570505505'}}, {{ $lng ?? '51.34170770645142'}}], {draggable:false});

        default_marker.addTo(map);

    </script>
@endpush
