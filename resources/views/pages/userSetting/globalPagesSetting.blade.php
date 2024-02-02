@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    {{--  Extra Library CSS  --}}
    @yield("LibraryCSS-Setting")
@endsection

@section("CSSExtraPage")
    {{--  Extra Manual CSS  --}}
    @yield("ManualCSS-Setting")
@endsection

@section("ContentPage")
    @include("alerts.success")
    @include("alerts.errors")
    <div class="nk-block">
        <div class="card">
            <div class="card-aside-wrap">
                @yield("ContentSideSetting")
                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                     data-toggle-body="true" data-content="userAside" data-toggle-screen="lg"
                     data-toggle-overlay="true">
                    <div class="card-inner-group" data-simplebar>
                        <div class="card-inner">
                            <div class="user-card">
                                <div class="user-avatar bg-primary">
                                    <span>
                                        {{ strtoupper(substr(Auth()->user()->first_name, 0, 1)
                                            . substr(Auth()->user()->last_name, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="user-info">
                                    <span class="lead-text">
                                        {{ Auth()->user()->name ?? "-" }}
                                    </span>
                                    <span class="sub-text">
                                        {{ Auth()->user()->email ?? "-" }}
                                    </span>
                                </div>
                                <div class="user-action">
                                    <div class="dropdown">
                                        <a class="btn btn-icon btn-trigger me-n2" data-bs-toggle="dropdown" href="#">
                                            <em class="icon ni ni-more-v"></em>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li>
                                                    <a href="">
                                                        <label for="file-image-account">
                                                            <em class="icon ni ni-camera-fill"></em>
                                                            <span>
                                                            @lang("messages.change-phot")
                                                        </span>
                                                        </label>
                                                        <form action="{{ route("user.update",Auth()->user()->id) }}"
                                                              enctype="multipart/form-data"
                                                              hidden>
                                                            <input type="file" class="FieldsSubmit"
                                                                   id="file-image-account" hidden>
                                                            <input type="hidden" name="local_id"
                                                                   value="{{ app()->getLocale() }}">
                                                            <input type="hidden" name="first_name"
                                                                   value="{{ Auth()->user()->first_name ?? "" }}">
                                                            <input type="hidden" name="last_name"
                                                                   value="{{ Auth()->user()->last_name ?? "" }}">
                                                            <input type="hidden" name="email"
                                                                   value="{{ Auth()->user()->email ?? "" }}">
                                                        </form>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner p-0">
                            <ul class="link-list-menu">
                                <li>
                                    <a class="{{ Request::is('profile.show') ? "active" : "" }}"
                                       href="{{ route("profile.show") }}">
                                        <em class="icon ni ni-user-fill-c"></em>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ Request::is('account.setting.show') ? "active" : "" }}"
                                       href="{{ route("account.setting.show") }}">
                                        <em class="icon ni ni-lock-alt-fill"></em>
                                        <span>Security Settings</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("ModalPopup")
    {{--  Popup Modal  --}}
    @yield("PopupModalSetting")
@endsection

@section("extraScriptsPage")
    @yield("ScriptSetting")
@endsection
