<div class="form-group">
    <label for="{{ $id }}">
        @isset($star)
            <span class="text-danger forced_input">*</span>
        @endisset
        {{ $title }}
    </label>

    <div class="mb-2 overflow-hidden"></div>

    @foreach ($_genders as $key => $value)
        <div class="pretty p-icon p-round p-jelly">

            <input class="form-check-input" type="radio" value="{{ $key }}" id="gender_{{ $key }}" name="gender" {{ (isset($selected_value) && $key == $selected_value) ? 'checked' : '' }}>

            <div class="state p-{{ $key == App\Constants\Types\User\UserGenderType::USER_GENDER_FEMALE ? 'danger' : 'primary' }}">
                <i class="icon fas fa-{{ $key == App\Constants\Types\User\UserGenderType::USER_GENDER_FEMALE ? 'female' : 'male' }}"></i>
                <label for="gender_{{ $key }}">{{ $value }}</label>
            </div>

        </div>
    @endforeach

    @if ($errors->has("{$id}"))
        <div class="invalid-feedback" style="display:block">
            <strong>{{ $errors->first("{$id}") }}</strong>
        </div>
    @endif
</div>
