@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    @yield("LibraryCSS-Notifications")
@endsection

@section("CSSExtraPage")
    @yield("ManualCSS-Notifications")
@endsection

@section("ContentPage")
    @include("alerts.success")
    @include("alerts.errors")
    <div class="nk-block" id="notificationPage">
        <div class="card">
            <div class="card-aside-wrap flex-md-row flex-column">
                @yield("ContentSideNotification")
                <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg"
                     data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                    <div class="card-inner-group">
                        <div class="card-inner">
                            <div class="user-card">
                                <div class="user-avatar bg-primary">
                                    <span>
                                        {{ strtoupper( substr(Auth()->user()->first_name, 0, 1)
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
                            </div>
                        </div>
                        <div class="card-inner p-0">
                            <ul class="link-list-menu">
                                <li>
                                    <a  class="{{ (Route::currentRouteName() == "notification.with-out-audit") ? "active" : "" }}"
                                        href="{{ route("notification.with-out-audit") }}">
                                        <em class="icon ni ni-home"></em>
                                        <span>@lang("messages.notification-all")</span>
                                    </a>
                                </li>
                                <li>
                                    <a  class="{{ (Route::currentRouteName() == "notification.audit.show") ? "active" : "" }}"
                                        href="{{ route("notification.audit.show") }}">
                                        <em class="icon ni ni-activity-round-fill"></em>
                                        <span>@lang("messages.notification-audit")</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="{{ (Route::currentRouteName() == "notification.print.table.show") ? "active" : "" }}"
                                        href="{{ route("notification.print.table.show") }}">
                                        <em class="icon ni ni-printer-fill"></em>
                                        <span>@lang("messages.notification-print")</span>
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
    @yield("PopupModalNotifications")
@endsection

@section("extraScriptsPage")
    @yield("ScriptNotifications")
@endsection
