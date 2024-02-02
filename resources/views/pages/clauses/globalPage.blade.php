@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    {{--  Extra Library CSS  --}}
@endsection

@section("CSSExtraPage")
    {{--  Extra Manual CSS  --}}
@endsection

@section("ContentPage")
    <div class="content-page wide-md m-auto">
        @yield("ContentPageClauses")
    </div>
@endsection

@section("ModalPopup")
    {{--  Modal Popups  --}}
@endsection

@section("extraScriptsPage")
    {{--  Extra JS Library  --}}
@endsection
