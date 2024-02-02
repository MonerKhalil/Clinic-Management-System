<div class="form-group">
    <label class="form-label" for="{{ $InputID }}">{{ $InputLabel }}</label>
    <div class="form-control-wrap">
        @if(isset($IsWithIcon) && $IsWithIcon != "")
            <div class="form-icon form-icon-left">
                <em class="icon ni ni-time"></em>
            </div>
        @endif
        <input type="text" class="form-control time-picker"
               name="{{ $InputName ?? "" }}"
               value="{{ $InputDefault ?? "" }}" id="{{ $InputID }}"
               {{ (isset($IsRequire) && $IsRequire == "true") ? "required" : "" }}
               placeholder="{{ $InputPlaceholder }}">
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
    $InputDefault =>
    $IsRequire =>
    $InputPlaceholder =>
    $InputNote =>

--}}
