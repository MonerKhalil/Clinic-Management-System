<div class="custom-control custom-radio">
    <input type="radio" id="{{ $InputID }}"
           {{ (isset($IsRequire) && $IsRequire == "true") ? "required" : "" }}
           {{ (isset($IsChecked) && $IsChecked == "true") ? "checked" : "" }}
           value="{{ $RadioValue ?? "" }}"
           name="{{ $InputName ?? "" }}" class="custom-control-input">
    <label class="custom-control-label" for="{{ $InputID }}">
        {{ $InputLabel }}
    </label>
</div>


{{--

    $InputID =>
    $InputLabel =>
    $InputName =>
    $IsRequire =>
    $IsChecked =>
    $RadioValue =>

--}}
