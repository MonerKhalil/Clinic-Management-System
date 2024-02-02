@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    <link rel="stylesheet" href="{{ asset("System/assets/css/libs/jstree.css") }}">
    <link rel="stylesheet" href='{{ asset('System/assets/css/trumbowyg-custom.css') }}' type="text/css" />
@endsection

@section("CSSExtraPage")
    {{--  CSS Extra Code  --}}
@endsection

@section("ContentPage")
    <div class="fetch-data-language"
         data-file-lang="RolePermission"
         data-file-content="{{ getLangFile("RolePermission") }}"
    ></div>
    <div class="nk-block nk-block-lg">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    @include("components.myComponent.breadcrumb" , [
                         "TitleBreadcrumb" => __("messages.edit_role") ,
                         "DescriptionBreadcrumb" => "" ,
                         "Pages" => [
                             [ "Route" => "#" , "Title" => __("messages.dashboard") ] ,
                             [ "Title" => __("messages.edit_role") ]
                         ]
                     ])
                    @include("alerts.success")
                    @include("alerts.errors")
                </div>
            </div>
            <form action="{{ route("role.update" , $role["id"]) }}" method="post"
                  class="form-validate" autocomplete="off">
                @csrf
                @method("put")
                <div class="row g-gs">
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">@lang("messages.mainData")</h5>
                                </div>
                                <hr class="preview-hr">
                                <div class="">
                                    <div class="form-group">
                                        <label class="form-label" for="roleName">
                                            <span class="text-danger">*</span>
                                            @lang("messages.name")
                                        </label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control"
                                                   minlength="3" maxlength="255"
                                                   value="{{ $role["name"] }}"
                                                   id="roleName" name="name" required
                                                   placeholder="{{ __("messages.name") }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="roleDisplayName">
                                            <span class="text-danger">*</span>
                                            @lang("messages.display_name")
                                        </label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" required
                                                   value="{{ $role["display_name"] }}"
                                                   minlength="3" maxlength="255"
                                                   name="display_name" id="roleDisplayName"
                                                   placeholder="{{ __("messages.display_name") }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="roleDescription">
                                            <span class="text-danger">*</span>
                                            @lang("messages.description")
                                        </label>
                                        <div class="form-control-wrap">
                                            <textarea class="form-control trumbowygEditor" required
                                                      minlength="3" maxlength="255"
                                                      name="description" id="roleDescription">{{ $role["description"] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="card-head">
                                    <h5 class="card-title">@lang("messages.selectedRole")</h5>
                                </div>
                                <hr class="preview-hr">
                                <div class="">
                                    <div class="form-group">
                                        <div id="RoleTree_JS_Core" class="mb-1"
                                             data-group-name="permissions[]"
                                             data-file-name-lang="RolePermission"
                                             data-input-id-required="roleValidation"
                                             data-jsonRoles="{{ json_encode($finalData) }}"
                                             data-jsonEdit="{{ json_encode($rolePermissions) }}">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <input type="hidden" hidden
                                                       id="roleValidation"
                                                       name="roleValidation" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">@lang("messages.update")</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("ModalPopup")
    {{--  Modal Popups  --}}
@endsection

@section("extraScriptsPage")
    <script src="{{ asset("System/assets/js_2/library/jstree.js") }}"></script>
    {{--  trumbowyg library  --}}
    <script src="{{ asset("System/assets/plugins/trumbowyg/dist/trumbowyg.min.js") }}" type="text/javascript"></script>
    @if(lang(app()->getLocale())->isRTL)
        <script src="{{ asset("System/assets/plugins/trumbowyg/dist/langs/ar.min.js") }}" type="text/javascript"></script>
    @endif
    {{--  scripts  --}}
    <script src="{{ asset("System/assets/js_2/pages/roleTree.js") }}"></script>
@endsection
