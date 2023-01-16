<div class="select-head-div col-md-{{ $size ?? '12' }}">
    @component('_components.admin.select.single')
        @slot('title', $province_title)
        @slot('id', $province_id)
        @slot('search', true)
        @slot('star', $star ?? false)
        @slot('options')
            @foreach ($_provinces as $province)
                <option value="{{ $province->id }}" {{ (isset($province_selected) && $province_selected == $province->id) ? 'selected' : '' }}>{{ $province->title }}</option>
            @endforeach
        @endslot
    @endcomponent
</div>
<div class="select-head-div col-md-{{ $size ?? '12' }}">
    @component('_components.admin.select.single')
        @slot('title', $city_title)
        @slot('id', $city_id)
        @slot('search', true)
        @slot('star', $star ?? false)
    @endcomponent
</div>

@push('scripts')
    <script>
        @isset($first_call)
        function hideEmptySelects()
        {
            $('.single-select').each(function(){
                var $this = $(this);
                // console.log($this.find('option').length);

                if($this.find('option').length > 1)
                {
                    $this.closest('.select-head-div').removeClass('d-none');
                }
                else
                {
                    $this.closest('.select-head-div').addClass('d-none');
                }
            });
        }
        @endisset

        $(function(){
            hideEmptySelects();

            $("#{{ $province_id }}").change(function(){
                var $this = $(this);
                var id = $this.val();
                if (id)
                {
                    $.get('{{ route('province.index') }}/' + id + '/cities/', function (data) {
                        if(data.status)
                        {
                            $("#{{ $city_id }}").html('<option value="">انتخاب کنید... </option>');
                            if(data.cities.length > 0)
                            {
                                data.cities.forEach(function (item) {
                                    if ('{{ $city_selected ?? "" }}' == item.id)
                                    {
                                        $("#{{ $city_id }}").append('<option value='+item.id+' selected="selected">'+item.title+'</option>');
                                    }
                                    else
                                    {
                                        $("#{{ $city_id }}").append('<option value='+item.id+'>'+item.title+'</option>');
                                    }
                                });
                                hideEmptySelects();
                            }
                            else
                            {
                                hideEmptySelects();
                            }
                        }
                    }, 'json').fail(function (jqXhr) {
                        console.log(jqXhr);
                    });
                }
                else
                {
                    $("#{{ $city_id }}").html('<option value="">انتخاب کنید... </option>');
                    $("#{{ $city_id }}").change();
                    hideEmptySelects();
                }
                hideEmptySelects()
            });

            // $('#nationality_country').change(function(){
            //     var $this = $(this);

            //     var code = $this.children("option:selected").attr('data-code');
            //     $country_code.text(code);
            // });

        
        @if($province_selected)
            $.LoadingOverlay("show");
            setTimeout(function(){
                $("#{{ $province_id }}").trigger('change');
                $.LoadingOverlay("hide");
            }, 500);
        @endif

        });
    </script>
@endpush
