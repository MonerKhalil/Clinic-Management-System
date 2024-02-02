<div class="form-group">
    <label class="form-label">{{ $GroupName ?? "" }}</label>
    @if(count($checkboxItems) > 0)
        <ul class="custom-control-group g-3 align-center">
            @foreach($checkboxItems as $CheckboxItem)
                <li>
                    <div class="custom-control custom-checkbox {{ isset($CheckboxItem["ChangeSize"]) ? "custom-control-".$CheckboxItem["ChangeSize"] : "" }}">
                        <input type="checkbox" class="custom-control-input"
                               name="{{ $CheckboxItem["InputName"] ?? "" }}"
                               {{ (isset($CheckboxItem["IsRequire"]) && $CheckboxItem["IsRequire"] == "true") ? "required" : "" }}
                               {{ (isset($CheckboxItem["IsChecked"]) && $CheckboxItem["IsChecked"] == "true") ? "checked" : "" }}
                               value="{{ $CheckboxItem["CheckboxValue"] ?? "" }}" id="{{ $CheckboxItem["InputID"] }}">
                        <label class="custom-control-label" for="{{ $CheckboxItem["InputID"] }}">
                            {{ $CheckboxItem["InputLabel"] }}
                        </label>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>

{{--

    @include("components.myComponent.checkboxGroup" , [
        "GroupName" => "" ,
        "checkboxItems" => [

            [
                "InputID" => "" ,
                "InputLabel" => "" ,
                "InputName" => "" ,
                "IsRequire" => "" , //
                "IsChecked" => "" , //
                "CheckboxValue" => "" , //
                "ChangeSize" => "" , //
            ] ,

            [
                "InputID" => "" ,
                "InputLabel" => "" ,
                "InputName" => "" ,
                "IsRequire" => "" , //
                "IsChecked" => "" , //
                "CheckboxValue" => "" , //
                "ChangeSize" => "" , //
            ] ,
        ]

    ])

--}}



