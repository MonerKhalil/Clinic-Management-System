@extends("pages.notification.globalPage")

@section("LibraryCSS-Notifications")
    {{-- CSS-Setting Extra --}}
@endsection

@section("ManualCSS-Notifications")
    {{-- Manual CSS Extra --}}
@endsection

@section("ContentSideNotification")
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head nk-block-head-md">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    @yield("headerInformation")
                </div>
                <div class="nk-block-head-content align-self-start d-lg-none">
                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside">
                        <em class="icon ni ni-menu-alt-r"></em>
                    </a>
                </div>
            </div>
        </div>
        <div class="nk-block text-end mb-4">
            <a href="#" data-bs-toggle="modal"
               data-bs-target="#notification-filter"
               class="btn btn-white btn-outline-light">
                <em class="icon ni ni-filter-alt"></em>
                <span>
                    @lang("messages.filter")
                </span>
            </a>
        </div>
        <div class="nk-block card card-bordered p-0 mb-2">
            @yield("contentNotifications")
        </div>
        <!-- Pagination Notification -->
        @if($notifications instanceof \Illuminate\Pagination\LengthAwarePaginator && $notifications->hasPages())
            <div class="nk-block p-0">
                <div class="card-inner">
                    <div class="nk-block-between-md g-3">
                        @include('pages.crud.pagination-area' , [
                            "data" => $notifications
                        ])
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section("PopupModalNotifications")
    <div class="modal fade" role="dialog"
         id="notification-filter">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @lang("messages.notification-filter")
                    </h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                @yield("external-form-filter")
            </div>
        </div>
    </div>
@endsection

@section("ScriptNotifications")
    {{-- Script Setting --}}
@endsection
