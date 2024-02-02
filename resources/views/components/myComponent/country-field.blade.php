{{--
    isStateExist = Boolean
    isCityExist = Boolean

    contentClass = String => For Specification Col-Number

    countryName = String
    countryValue = String

    stateName = String ,
    stateValue = String

    cityName = String ,
    cityValue = String

    countryRequired = true ,
    stateRequired = true ,
    cityRequired = true
--}}

<div class="{{ $contentClass }}">
    <div class="form-group">
        <label class="form-label" for="Country_Selected">
            <span class="text-danger">*</span>
            @lang("messages.select-country")
        </label>
        <div class="form-control-wrap">
            <select id="Country_Selected" name="{{$countryName}}"
                    data-search="on" data-placeholder="{{ __("messages.country-choose") }}"
                    data-default-value="{{ $countryValue ?? "" }}"
                    {{ (isset($countryRequired) && $countryRequired) ? "required" : "" }}
                    class="form-select js-select2">
                <option value="">
                    @lang("messages.country-choose")
                </option>
                @if(isset($countriesData))
                    @foreach($countriesData as $Country)
                        <option value="{{ $Country->id }}"
                            {{ (isset($countryValue) && $countryValue == $Country->id) ? "selected" : "" }}>
                            {{ checkObjectInstanceofTranslation($country,"name") }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>

@if(isset($isStateExist) && $isStateExist)
    <div class="{{ $contentClass }}"
         @if(isset($stateValue) && $stateValue)
         style="display: none"
        @endif>
        <div class="form-group">
            <label class="form-label" for="State_Selected">
                <span class="text-danger">*</span>
                @lang("messages.select-state")
            </label>
            <div class="form-control-wrap">
                <select id="State_Selected" name="{{ $stateName }}"
                        data-search="on"
                        data-default-value="{{ $stateValue ?? "" }}"
                        data-placeholder="{{ __("messages.state-choose") }}"
                        {{ (isset($stateRequired) && $stateRequired) ? "required" : "" }}
                        class="form-select js-select2">
                    <option value="" {{ (isset($stateValue) && $stateValue) ? "selected disabled" : "" }}>
                        @lang("messages.state-choose")
                    </option>
                </select>
            </div>
        </div>
    </div>
@endif

@if(isset($isCityExist) && $isCityExist)
    <div class="{{ $contentClass }}"
         @if(isset($cityValue) && $cityValue)
         style="display: none"
        @endif>
        <div class="form-group">
            <label class="form-label" for="City_Selected">
                <span class="text-danger">*</span>
                @lang("messages.select-city")
            </label>
            <div class="form-control-wrap">
                <select id="City_Selected" name="{{ $cityName }}"
                        data-search="on"
                        data-default-value="{{ $cityValue ?? "" }}"
                        data-placeholder="{{ __("messages.city-choose") }}"
                        {{ (isset($cityRequired) && $cityRequired) ? "required" : "" }}
                        class="form-select js-select2">
                    <option value="" {{ (isset($cityValue) && $cityValue) ? "selected disabled" : "" }}>
                        @lang("messages.city-choose")
                    </option>
                </select>
            </div>
        </div>
    </div>
@endif
