@extends("pages.errors.globalPageError")

@section("CSSLibraryExtraPage")
    {{--  Extra Library CSS  --}}
@endsection

@section("CSSExtraPage")
    {{--  Extra Manual CSS  --}}
@endsection

@section("ContentPage")
    <div class="nk-block nk-block-middle wide-md mx-auto">
        <div class="nk-block-content nk-error-ld text-center">
            <img class="nk-error-gfx" src="{{ asset("System/assets/images/errors/error-504.svg") }}" alt="error_504">
            <div class="wide-xs mx-auto">
                <h3 class="nk-error-title">Gateway Timeout Error</h3>
                <p class="nk-error-text">We are very sorry for inconvenience. It looks like some how our server did not receive a timely response.</p>
                <a href="html/index.html" class="btn btn-lg btn-primary mt-2">Back To Home</a>
            </div>
        </div>
    </div>
@endsection

@section("ModalPopup")
    {{-- Popup Added --}}
@endsection

@section("extraScriptsPage")
    {{-- Extrea JS Library --}}
@endsection
