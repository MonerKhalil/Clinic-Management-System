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
                            {{ __("messages.changePasswordAfterForget") }}
                        </h5>
                        <div class="nk-block-des">
                            <p>
                                {{ __("messages.changePasswordAfterForgetText") }}
                            </p>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="oldPassword">
                                {{ __('messages.oldPassword') }}
                            </label>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="oldPassword">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg" name="current_password"
                                   id="oldPassword" placeholder="{{ __('messages.Enter_your_oldPassword') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="newPassword">
                                {{ __('messages.newPassword') }}
                            </label>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="newPassword">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg" name="password"
                                   id="newPassword" placeholder="{{ __('messages.Enter_your_newPassword') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block">
                            {{ __('messages.sendNewPassword') }}
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
