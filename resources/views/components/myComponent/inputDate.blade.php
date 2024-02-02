<div class="form-group">
    <label class="form-label" for="{{ $InputID }}">
        {{ $InputLabel }}
    </label>
    <div class="form-control-wrap">
        @if(isset($IsWithIcon) && $IsWithIcon != "")
            <div class="form-icon form-icon-left">
                <em class="icon ni ni-calendar"></em>
            </div>
        @endif
        <input type="text" class="form-control date-picker"
               name="{{ $InputName ?? "" }}"
               id="{{ $InputID }}" value="{{ $InputDefault ?? "" }}"
               {{ (isset($IsRequire) && $IsRequire == "true") ? "required" : "" }}
               placeholder="{{ $InputPlaceholder }}"
               data-date-format="{{ $InputDateFormat ?? "" }}">
    </div>
    @if(isset($InputNote))
        <label class="form-note" for="{{ $InputID }}">
            {{ $InputNote }}
        </label>
    @endif
</div>


{{--

    $InputID =>
    $InputLabel =>
    $InputName =>
    $IsWithIcon =>
    $IsRequire =>
    $InputPlaceholder =>
    $InputDateFormat =>
    $InputNote =>

--}}
