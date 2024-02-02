<div class="form-group">
    <label class="form-label" for="{{ $InputID }}">{{ $InputLabel }}</label>
    <div class="form-control-wrap">
        <textarea class="form-control" id="{{ $InputID }}"
                  name="{{ $InputName ?? "" }}"
                    {{ (isset($IsRequire) && $IsRequire == "true") ? "required" : "" }}
        >{{ $InputDefault ?? "" }}</textarea>
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
    $InputDefault =>
    $IsRequire =>
    $InputNote =>

--}}
