<div class="form-group">
    <label class="form-label" for="{{ $InputID }}">{{ $InputLabel }}</label>
    <div class="form-control-wrap">
        <div class="form-file">
            <input type="file" multiple class="form-file-input"
                   name="{{ $InputName ?? "" }}" title=""
                   value="{{ $InputDefault ?? "" }}"
                   {{ (isset($IsRequire) && $IsRequire == "true") ? "required" : "" }}
                   id="{{ $InputID }}">
            <label class="form-file-label" for="{{ $InputID }}">{{ __('messages.Choose file') }}</label>
        </div>
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
