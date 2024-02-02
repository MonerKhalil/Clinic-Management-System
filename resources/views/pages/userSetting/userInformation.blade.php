@extends("pages.userSetting.globalPagesSetting")

@section("LibraryCSS-Setting")
    {{-- CSS-Setting Extra --}}
@endsection

@section("ManualCSS-Setting")
    {{-- Manual CSS Extra --}}
@endsection

@section("ContentSideSetting")
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Personal Profile Info</h4>
                    <div class="nk-block-des">
                        <p>Basic info, like your name and address, that you use on Nio Platform.</p>
                    </div>
                </div>
                <div class="nk-block-head-content align-self-start d-lg-none">
                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em
                            class="icon ni ni-menu-alt-r"></em></a>
                </div>
            </div>
        </div>
        <div class="nk-block text-end">
            <a href="#" data-bs-toggle="modal" data-bs-target="#user-edit"
               class="btn btn-white btn-outline-light">
                <em class="icon ni ni-edit"></em>
                <span>{{__("messages.Reset Filter")}}</span>
            </a>
        </div>
        <div class="nk-block">
            <div class="nk-data data-list">
                <div class="data-head">
                    <h6 class="overline-title">Basics</h6>
                </div>
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">@lang("messages.first-name")</span>
                        <span class="data-value">{{ Auth()->user()->first_name ?? "-" }}</span>
                    </div>
                </div>
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">@lang("messages.last-name")</span>
                        <span class="data-value">{{ Auth()->user()->last_name ?? "-" }}</span>
                    </div>
                </div>
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">@lang("messages.email")</span>
                        <span class="data-value">{{ Auth()->user()->email ?? "-" }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("PopupModalSetting")
    <div class="modal fade" role="dialog" id="user-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang("messages.update-account")</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <form class="form-validate"
                      action="{{ route("profile.edit") }}"
                      autocomplete="off" method="post">
                    @csrf
                    @method("put")
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="langSelect">
                                <span class="text-danger">*</span>
                                @lang("messages.lang-name-account")
                            </label>
                            <div class="form-control-wrap">
                                <select class="form-select js-select2"
                                        name="local_id" id="langSelect" data-search="on"
                                        data-placeholder="{{ __("messages.lang-name-account") }}">
                                    @foreach(allLanguges() as $item)
                                        <option value="{{ $item->id }}" {{ ($item->id == defaultLang()->id) ? "selected" : "" }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="first-name-account">
                                <span class="text-danger">*</span>
                                @lang("messages.first-name-account")
                            </label>
                            <div class="form-control-wrap">
                                <input type="text" id="first-name-account"
                                       class="form-control" name="first_name"
                                       placeholder="{{ __("messages.first-name-account") }}"
                                       value="{{ Auth()->user()->first_name ?? "" }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="last-name-account">
                                <span class="text-danger">*</span>
                                @lang("messages.last-name-account")
                            </label>
                            <div class="form-control-wrap">
                                <input type="text" id="last-name-account"
                                       class="form-control" name="last_name"
                                       placeholder="{{ __("messages.last-name-account") }}"
                                       value="{{ Auth()->user()->last_name ?? "" }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email-account">
                                <span class="text-danger">*</span>
                                @lang("messages.email-account")
                            </label>
                            <div class="form-control-wrap">
                                <input type="email" id="email-account"
                                       class="form-control" name="email"
                                       placeholder="{{ __("messages.email-account") }}"
                                       value="{{ Auth()->user()->email ?? "" }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                @lang("messages.updateData")
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("ScriptSetting")
    {{-- Script Setting --}}
@endsection
