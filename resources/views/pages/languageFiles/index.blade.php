@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    {{--  Extra Library CSS  --}}
@endsection

@section("CSSExtraPage")
    {{--  Extra Manual CSS  --}}
@endsection

@section("ContentPage")
    <div id="languageFilesPage">
        @include("components.myComponent.breadcrumb" , [
        "TitleBreadcrumb" => "setting files" ,
        "DescriptionBreadcrumb" => "اختر احد تلك الملفات من علامات التبويب وقم باضافة الكلمات التي تريدها الى كل ملف" ,
        "Pages" => [
            [ "Route" => "#" , "Title" => "Dashboard" ] ,
            [ "Title" => "setting files" ]
        ]
    ])
        @include("alerts.success")
        @include("alerts.errors")
        <div class="nk-block">
            <div class="nk-block-head">
                <div class="toggle-wrap nk-block-tools-toggle text-end">
                    <a href="#add-key-language" class="dropdown-toggle btn btn-icon btn-primary"
                       id="button-add" data-bs-toggle="modal">
                        <em class="icon ni ni-plus"></em>
                    </a>
                </div>
            </div>
        </div>
        <div class="nk-block">
            <div class="card mb-3">
                <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                    @foreach($finalData as $key => $items)
                        <li class="nav-item">
                            <a class="nav-link {{ ($key === "messages") ? "active" : "" }}"
                               data-bs-toggle="tab" href="#{{ $key }}">
                                <em class="icon ni ni-laptop"></em>
                                <span>@lang("messages.".$key)</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="card-inner">
                    <form action="{{ route("lang.file.editoredit") }}"
                          method="post" class="form-settings form-validate">
                        @csrf
                        @php
                            $Counter_InputDefault = 0 ;
                        @endphp
                        @foreach($finalData as $key => $items)
                            <input type="hidden" name="main_data[{{ $Counter_InputDefault }}][name_file]" value="{{ $key }}">
                            <input type="hidden" name="main_data[{{ $Counter_InputDefault }}][content_file][XXXX]" value="___">
                            @php
                                $Counter_InputDefault++ ;
                            @endphp
                        @endforeach
                        <div class="tab-content">
                            @php
                                $counter = 0 ;
                            @endphp
                            @foreach($finalData as $key => $items)
                                <div class="tab-pane {{ ($key === "messages") ? "active" : "" }}" id="{{ $key }}">
                                    <div class="content-form row gy-4">
                                        @foreach($items as $keyItems => $item)
                                            <div class="col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="{{ $key }}_{{ $keyItems }}">
                                                        <span class="text-danger">*</span>
                                                        {{ $keyItems }}
                                                    </label>
                                                    <div class="form-control-wrap">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <button class="btn btn-dim btn-outline-danger btn-delete-input"
                                                                        type="button">
                                                                    <em class="icon ni ni-cross"></em>
                                                                </button>
                                                            </div>
                                                            <input type="hidden" value="{{ $key }}"
                                                                   name="main_data[{{ $counter }}][name_file]">
                                                            <input type="text" class="form-control"
                                                                   name="main_data[{{ $counter }}][content_file][{{ $keyItems }}]"
                                                                   value="{{ $item }}"
                                                                   id="{{ $key }}_{{ $keyItems }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @php
                                    $counter++ ;
                                @endphp
                            @endforeach
                            <hr class="preview-hr">
                            <div class="row gy-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            {{__("messages.change-all-files")}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("ModalPopup")
    {{--  Modal Popups  --}}
    <div class="modal fade" id="add-key-language">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">add new key</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <form class="form-validate no-loader">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="key-lang">
                                <span class="text-danger">*</span>
                                key language
                            </label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control"
                                       minlength="3" maxlength="20"
                                       id="key-lang" name="key-lang" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="value-lang">
                                value language
                            </label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control"
                                       id="value-lang" name="value-lang">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">add one</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("extraScriptsPage")
    <script src="{{ asset("System/assets/js_2/pages/settingLanguageFile.js") }}"
            type="text/javascript"></script>
@endsection
