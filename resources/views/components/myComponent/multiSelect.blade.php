<div class="form-group">
    <label class="form-label" for="{{ $InputID }}">{{ $InputLabel }}</label>
    <div class="form-control-wrap">
        <select class="form-select js-select2"
                name="{{ $InputName ?? "" }}"
                multiple="multiple" id="{{ $InputID }}"
                {{ (isset($IsRequire) && $IsRequire == "true") ? "required" : "" }}
                data-placeholder="{{ $InputPlaceholder ?? "" }}">
            @foreach($Options as $Option)
                <option value="{{ $Option["Value"] }}"
                        @foreach($InputDefault as $DefaultValue)
                            @if($DefaultValue === $Option["Value"])
                                selected
                                @break
                            @endif
                        @endforeach
                >{{ $Option["Label"] }}</option>
            @endforeach
        </select>
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
    $InputDefault => ["1" , "2"]
    $IsRequire =>
    $InputPlaceholder =>
    $InputNote =>
    $Options => [ Value => , Label => ] ,

--}}
