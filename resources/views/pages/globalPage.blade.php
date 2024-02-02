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
            {{--  Sidebar  --}}
            @include("layouts.sidebars.admin-sidebar")
            <div class="nk-wrap">
                {{--  Main Header  --}}
                @include("layouts.headers.main-header")
                <div class="nk-content">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <main class="MainContentPage">
                                    @yield("ContentPage")
                                </main>
                            </div>
                        </div>
                    </div>
                </div>
                {{--  Footer  --}}
                @include("layouts.footers.main-footer")
            </div>
        </div>
    </div>
    {{--  Modal Popups  --}}
    @yield("ModalPopup")
@endsection

@section("extraScripts")
    <script src="{{ asset("System/assets/js_2/master.js") }}"></script>
    <script src="{{ asset("System/assets/js_2/tools/filter-sidebar.js") }}"></script>
    <script src="{{ asset("System/assets/js_2/tools/notification-header.js") }}"></script>
    @yield("extraScriptsPage")
@endsection
