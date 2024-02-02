@extends("pages.master")

@section("CSSLibrary_Extra")
    {{--  Extra Library CSS  --}}
    @yield("CSSLibraryExtraPage")
@endsection

@section("CSS_Extra")
    {{--  Extra Manual CSS  --}}
    @yield("CSSExtraPage")
@endsection

@section("MainContent")
    <div class="nk-app-root">
        <div class="nk-main">
            <div class="nk-wrap">
                <div class="nk-content">
                    @yield("ContentPage")
                </div>
            </div>
        </div>
    </div>
    @yield("ModalPopup")
@endsection

@section("extraScripts")
    <script src="{{ asset("System/assets/js_2/master.js") }}"></script>
    @yield("extraScriptsPage")
@endsection
