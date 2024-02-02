@extends("pages.userSetting.globalPagesSetting")

@section("LibraryCSS-Setting")
    {{-- CSS-Setting Extra --}}
@endsection

@section("ManualCSS-Setting")
    {{-- Manual CSS Extra --}}
@endsection

@section("ContentSideSetting")
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head nk-block-head-lg">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">
                        Personal Security Settings
                    </h4>
                    <div class="nk-block-des">
                        <p>These settings are helps you keep your account secure.</p>
                    </div>
                </div>
                <div class="nk-block-head-content align-self-start d-lg-none">
                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em
                            class="icon ni ni-menu-alt-r"></em></a>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <div class="card card-bordered">
                <div class="card-inner-group">
{{--                    <div class="card-inner">--}}
{{--                        <div class="between-center flex-wrap flex-md-nowrap g-3">--}}
{{--                            <div class="nk-block-text">--}}
{{--                                <h6>Save my Activity Logs</h6>--}}
{{--                                <p>You can save your all activity logs including unusual activity detected.</p>--}}
{{--                            </div>--}}
{{--                            <div class="nk-block-actions">--}}
{{--                                <ul class="align-center gx-3">--}}
{{--                                    <li class="order-md-last">--}}
{{--                                        <div class="custom-control custom-switch me-n2">--}}
{{--                                            <input type="checkbox" class="custom-control-input" checked="" id="activity-log">--}}
{{--                                            <label class="custom-control-label" for="activity-log"></label>--}}
{{--                                        </div>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="card-inner">
                        <div class="between-center flex-wrap g-3">
                            <div class="nk-block-text">
                                <h6>Change Password</h6>
                                <p>Set a unique password to protect your account.</p>
                            </div>
                            <div class="nk-block-actions flex-shrink-sm-0">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                    <li class="order-md-last">
                                        <a href="{{ route("password.edit") }}" class="btn btn-primary">Change Password</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("PopupModalSetting")
    {{-- Popup Modal Setting --}}
@endsection

@section("ScriptSetting")
    {{-- Script Setting --}}
@endsection
