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
        <div class="nk-main ">
            <div class="nk-wrap nk-wrap-nosidebar">
                <div class="nk-content">
                    @yield("ContentPage")
                    <footer class="nk-footer nk-auth-footer-full">
                        <div class="container wide-lg">
                            <div class="row g-3">
                                <div class="col-lg-6 order-lg-last">
                                    <ul class="nav nav-sm justify-content-center justify-content-lg-end">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Terms &amp; Condition</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Privacy Policy</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Help</a>
                                        </li>
                                        <li class="nav-item dropup active current-page">
                                            <a class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-bs-toggle="dropdown" data-offset="0,10"><span>English</span></a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                <ul class="language-list">
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="{{ asset("System/assets/images/flags/english.png") }}"
                                                                 alt="" class="language-flag">
                                                            <span class="language-name">English</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="{{ asset("System/assets/images/flags/french.png") }}"
                                                                 alt="" class="language-flag">
                                                            <span class="language-name">French</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="{{ asset("System/assets/images/flags/turkey.png") }}"
                                                                 alt="" class="language-flag">
                                                            <span class="language-name">Türkçe</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="language-item">
                                                            <img src="{{ asset("System/assets/images/flags/china.png") }}"
                                                                 alt="" class="language-flag">
                                                            <span class="language-name">China</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <div class="nk-block-content text-center text-lg-left">
                                        <p class="text-soft">© 2023 Dashlite. All Rights Reserved.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    {{--  Modal Popups  --}}
    @yield("ModalPopup")
@endsection

@section("extraScripts")
    <script src="{{ asset("System/assets/js_2/master.js") }}"></script>
    {{--  Extra Script  --}}
    @yield("extraScriptsPage")
@endsection
