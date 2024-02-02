<div class="custom-control custom-checkbox {{ isset($ChangeSize) ? "custom-control-".$ChangeSize : "" }}">
    <input type="checkbox" class="custom-control-input"
           name="{{ $InputName ?? "" }}"
           {{ (isset($IsRequire) && $IsRequire == "true") ? "required" : "" }}
           {{ (isset($IsChecked) && $IsChecked == "true") ? "checked" : "" }}
           value="{{ $CheckboxValue ?? "" }}" id="{{ $InputID }}">
    <label class="custom-control-label" for="{{ $InputID }}">
        {{ $InputLabel }}
    </label>
</div>


{{--

    @include("components.myComponent.checkbox" , [
        "InputID" => "" ,
        "InputLabel" => "" ,
        "InputName" => "" ,
        "IsRequire" => "" , //
        "IsChecked" => "" , //
        "CheckboxValue" => "" , //
        "ChangeSize" => "" , //
    ])

--}}
