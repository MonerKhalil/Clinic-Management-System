<div class="form-group">
    <label class="form-label" for="{{ $InputID }}">{{ $InputLabel }}</label>
    <div class="form-control-wrap">
        <select id="{{ $InputID }}" class="form-select js-select2"
                name="{{ $InputName ?? "" }}"
                {{ (isset($IsRequire) && $IsRequire == "true") ? "required" : "" }}
                @if(isset($TurnOnSearch) && $TurnOnSearch == "true")
                    data-search="on"
                @else
                    data-search="off"
                @endif
                data-placeholder="{{ $InputPlaceholder ?? "" }}">
            <option value="">-</option>
            @foreach($Options as $Option)
                <option value="{{ $Option["Value"] }}"
                        {{ (isset($InputDefault) && $InputDefault == $Option["Value"]) ? "selected" : "" }}
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
    $InputDefault =>
    $IsRequire =>
    $InputPlaceholder =>
    $InputNote =>
    $Options => [ Value => , Label => ] ,
    $TurnOnSearch =>

--}}

