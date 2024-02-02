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
    <div class="nk-block" id="settingPage">
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
                                        {{ Auth()->user()->first_name . ' ' . Auth()->user()->last_name ?? "" }}
                                    </span>
                                    <span class="sub-text">
                                        {{ Auth()->user()->email ?? "" }}
                                    </span>
                                </div>
                                <div class="user-action">
                                    <div class="dropdown">
                                        <a class="btn btn-icon btn-trigger me-n2" data-bs-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#"><em class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($dataPass && $dataPass["IsHaveLanguage"])
                            <div class="card-inner">
                                <div class="user-account-info py-0">
                                    <h6 class="overline-title-alt">
                                        <label for="langSelect">
                                            @lang("messages.langSelect")
                                        </label>
                                    </h6>
                                    <select class="SelectLanguageUpdate form-select js-select2" id="langSelect"
                                            data-search="on" data-json="{{ json_encode($settings) }}"
                                            data-form-id="updateSettingData" data-input-id="langSettingCompany"
                                            data-method-name="setting-custom"
                                            data-json-key-def='{ "TransKey" : "translation" }'
                                            data-placeholder="Language Select">
                                        @foreach(allLanguges() as $item)
                                            <option value="{{ $item->id }}" {{ ($item->id == defaultLang()->id) ? "selected" : "" }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="card-inner p-0">
                            <ul class="link-list-menu">
                                <li>
                                    <a href="{{ route("setting.control.show") }}"
                                       class="{{ (Route::currentRouteName() == "setting.control.show") ? "active" : "" }}">
                                        <em class="icon ni ni-setting"></em>
                                        <span>@lang("messages.settingControl")</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route("setting.show") }}"
                                       class="{{ (Route::currentRouteName() == "setting.show") ? "active" : "" }}">
                                        <em class="icon ni ni-briefcase"></em>
                                        <span>@lang("messages.settingCompany")</span>
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
    @if($dataPass && $dataPass["IsHaveLanguage"])
        <script src="{{ asset("System/assets/js_2/pages/settingPage.js") }}" type="text/javascript"></script>
    @endif
    {{--  Script Section  --}}
    @yield("ScriptSetting")
@endsection
