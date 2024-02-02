@extends("pages.auth.globalPage")

@section("CSSLibraryExtraPage")
    {{--  Extra Lib CSS  --}}
@endsection

@section("CSSExtraPage")
    {{--  Extra Manual CSS  --}}
@endsection

@section("ContentPage")
    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
        <div class="brand-logo pb-4 text-center">
            <a href="#" class="logo-link">
                <img class="logo-light logo-img logo-img-lg"
                     src="https://placehold.co/130x40"
                     alt="logo">
                <img class="logo-dark logo-img logo-img-lg"
                     src="https://placehold.co/130x40"
                     alt="logo-dark">
            </a>
            @include("alerts.success")
            @include("alerts.errors")
        </div>
        <div class="card">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h5 class="nk-block-title">
                            {{ __("messages.verifyTitle") }}
                        </h5>
                        <div class="nk-block-des">
                            <p>
                                {{ __("messages.verifyText") }}
                            </p>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('verification.send') }}">
                    {{-- @include('alerts.errors') --}}
                    @csrf
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">
                            {{ __('messages.verifyEmail') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("ModalPopup")
    {{--  Pupup Page  --}}
@endsection

@section("extraScriptsPage")
    {{--  Script Page  --}}
@endsection
