<div class="form-group">
    <label class="form-label" for="{{ $InputID }}">{{ $InputLabel }}</label>
    <div class="form-control-wrap">
        @if(isset($IsWithIcon) && $IsWithIcon !== "")
            <div class="form-icon form-icon-left">
                <em class="icon {{ $IsWithIcon }}"></em>
            </div>
        @endif
        <input type="{{ $InputType }}" class="form-control"
               name="{{ $InputName ?? "" }}"
               value="{{ $InputDefault ?? "" }}"
               {{ (isset($IsRequire) && $IsRequire == "true") ? "required" : "" }}
               {{ isset($IsHaveMinNumber) ? "min='".$IsHaveMinNumber."'" : "" }}
               {{ isset($IsHaveMaxNumber) ? "max='".$IsHaveMaxNumber."'" : "" }}
               id="{{ $InputID }}" placeholder="{{ $InputPlaceholder ?? "" }}">
    </div>
    @if(isset($InputNote))
        <label class="form-note" for="{{ $InputID }}">
            {{ $InputNote }}
        </label>
    @endif
</div>

{{--

    @include("components.myComponent.input" , [
        $InputID => "" ,
        $InputLabel => "" ,
        $InputName => "" ,
        $IsWithIcon => "" , //
        $InputType => "" ,
        $InputDefault => "" ,
        $IsRequire => "" , //
        $IsHaveMinNumber => , //
        $IsHaveMaxNumber => , //
        $InputPlaceholder => , //
        $InputNote => , //
    ])

    Note :
    1- this "//" Mean If You Not Use Remove It

--}}
