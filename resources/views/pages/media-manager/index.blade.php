@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    {{--  Extra Library CSS  --}}
@endsection

@section("CSSExtraPage")
    {{--  Extra Manual CSS  --}}
@endsection

@section("ContentPage")
    <div class="fetch-data-language"
         data-file-lang="MediaManager"
         data-file-content="{{ getLangFile("MediaManager") }}"
    ></div>
    <div id="mediaManagerPage"
         data-file-name-lang="MediaManager"
         class="nk-fmg">
        <div class="nk-fmg-aside"
             data-content="files-aside" data-toggle-overlay="true" data-toggle-body="true" data-toggle-screen="lg" data-simplebar>
            <div class="nk-fmg-aside-wrap">
                <div class="nk-fmg-aside-top" data-simplebar>
                    <ul class="nk-fmg-menu">
                        <li class="active">
                            <a class="nk-fmg-menu-item" href="#">
                                <em class="icon ni ni-folder"></em>
                                <span class="nk-fmg-menu-text">ALL</span>
                            </a>
                        </li>
                        <li data-type-filter="pdf">
                            <a class="nk-fmg-menu-item" href="#">
                                <em class="icon ni ni-file-pdf"></em>
                                <span class="nk-fmg-menu-text">PDF</span>
                            </a>
                        </li>
                        <li data-type-filter="xlsx">
                            <a class="nk-fmg-menu-item" href="#">
                                <em class="icon ni ni-file-xls"></em>
                                <span class="nk-fmg-menu-text">XLSX</span>
                            </a>
                        </li>
                        <li data-type-filter="docs">
                            <a class="nk-fmg-menu-item" href="#">
                                <em class="icon ni ni-file-doc"></em>
                                <span class="nk-fmg-menu-text">DOCX</span>
                            </a>
                        </li>
                        <li data-type-filter="jpg">
                            <a class="nk-fmg-menu-item" href="#">
                                <em class="icon ni ni-file-img"></em>
                                <span class="nk-fmg-menu-text">JPG</span>
                            </a>
                        </li>
                        <li data-type-filter="jpeg">
                            <a class="nk-fmg-menu-item" href="#">
                                <em class="icon ni ni-file-img"></em>
                                <span class="nk-fmg-menu-text">JPEG</span>
                            </a>
                        </li>
                        <li data-type-filter="png">
                            <a class="nk-fmg-menu-item" href="#">
                                <em class="icon ni ni-file-img"></em>
                                <span class="nk-fmg-menu-text">PNG</span>
                            </a>
                        </li>
                        <li data-type-filter="csv">
                            <a class="nk-fmg-menu-item" href="#">
                                <em class="icon ni ni-file-xls"></em>
                                <span class="nk-fmg-menu-text">CSV</span>
                            </a>
                        </li>
                        <li data-type-filter="gif">
                            <a class="nk-fmg-menu-item" href="#">
                                <em class="icon ni ni-file-img"></em>
                                <span class="nk-fmg-menu-text">GIF</span>
                            </a>
                        </li>
                        <li data-type-filter="svg">
                            <a class="nk-fmg-menu-item" href="#">
                                <em class="icon ni ni-file-img"></em>
                                <span class="nk-fmg-menu-text">SVG</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="nk-fmg-body">
            <div class="nk-fmg-body-head d-none d-lg-flex">
                <div class="nk-fmg-search">
                    <em class="icon ni ni-search"></em>
                    <input id="filterNameField" type="text" class="form-control border-transparent form-focus-none" placeholder="Search files, folders">
                </div>
                <div class="nk-fmg-actions">
                    <ul class="nk-block-tools g-3">
                        <li>
                            <a href="#file-upload" id="btn-file-upload" class="btn btn-primary" data-bs-toggle="modal">
                                <em class="icon ni ni-upload-cloud"></em>
                                <span>Upload</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nk-fmg-body-content">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between position-relative">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Files</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-1">
                                <li class="d-lg-none">
                                    <a href="#" class="btn btn-trigger btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                </li>
                                <li class="d-lg-none">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-trigger btn-icon" data-bs-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="#file-upload" data-bs-toggle="modal"><em class="icon ni ni-upload-cloud"></em><span>Upload File</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-file-plus"></em><span>Create File</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-folder-plus"></em><span>Create Folder</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-lg-none me-n1"><a href="#" class="btn btn-trigger btn-icon toggle" data-target="files-aside"><em class="icon ni ni-menu-alt-r"></em></a></li>
                            </ul>
                        </div>
                        <div class="search-wrap px-2 d-lg-none" data-search="search">
                            <div class="search-content">
                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by user or message">
                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-fmg-listing nk-block-lg">
                    <div class="nk-block-head-xs">
                        <div class="nk-block-between g-2">
                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools g-3 nav">
                                    <li><a data-bs-toggle="tab" href="#file-grid-view" class="nk-switch-icon active"><em class="icon ni ni-view-grid3-wd"></em></a></li>
                                    <li><a data-bs-toggle="tab" href="#file-list-view" class="nk-switch-icon"><em class="icon ni ni-view-row-wd"></em></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane py-2 active" id="file-grid-view">
                            <div class="nk-files nk-files-view-grid">
                                <div class="nk-files-list">

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="file-list-view">
                            <div class="nk-files nk-files-view-list">
                                <div class="nk-files-head">
                                    <div class="nk-file-item">
                                        <div class="nk-file-info">
                                            <div class="tb-head px-4">Name</div>
                                        </div>
                                        <div class="nk-file-meta">
                                            <div class="tb-head">Create Date</div>
                                        </div>
                                        <div class="nk-file-type">
                                            <div class="tb-head">Type</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-files-list">
                                    <div class="nk-file-item nk-file">
                                        <div class="nk-file-info">
                                            <div class="nk-file-title">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="file-check-n1">
                                                    <label class="custom-control-label" for="file-check-n1"></label>
                                                </div>
                                                <div class="nk-file-icon">
                                                                            <span class="nk-file-icon-type">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                                                                    <g>
                                                                                        <rect x="32" y="16" width="28" height="15" rx="2.5" ry="2.5" style="fill:#f29611" />
                                                                                        <path d="M59.7778,61H12.2222A6.4215,6.4215,0,0,1,6,54.3962V17.6038A6.4215,6.4215,0,0,1,12.2222,11H30.6977a4.6714,4.6714,0,0,1,4.1128,2.5644L38,24H59.7778A5.91,5.91,0,0,1,66,30V54.3962A6.4215,6.4215,0,0,1,59.7778,61Z" style="fill:#ffb32c" />
                                                                                        <path d="M8.015,59c2.169,2.3827,4.6976,2.0161,6.195,2H58.7806a6.2768,6.2768,0,0,0,5.2061-2Z" style="fill:#f2a222" />
                                                                                    </g>
                                                                                </svg>
                                                                            </span>
                                                </div>
                                                <div class="nk-file-name">
                                                    <div class="nk-file-name-text">
                                                        <a href="#" class="title">UI/UX Design</a>
                                                        <div class="nk-file-star asterisk"><a href="#"><em class="asterisk-off icon ni ni-star"></em><em class="asterisk-on icon ni ni-star-fill"></em></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-file-meta">
                                            <div class="tb-lead">Today, 08:29 AM</div>
                                        </div>
                                        <div class="nk-file-members">
                                            <div class="tb-lead">Only Me</div>
                                        </div>
                                        <div class="nk-file-actions">
                                            <div class="dropdown">
                                                <a href="" class="dropdown-toggle btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-plain no-bdr">
                                                        <li><a href="#file-details" data-bs-toggle="modal"><em class="icon ni ni-eye"></em><span>Details</span></a></li>
                                                        <li><a href="#file-share" data-bs-toggle="modal"><em class="icon ni ni-share"></em><span>Share</span></a></li>
                                                        <li><a href="#file-copy" data-bs-toggle="modal"><em class="icon ni ni-copy"></em><span>Copy</span></a></li>
                                                        <li><a href="#file-move" data-bs-toggle="modal"><em class="icon ni ni-forward-arrow"></em><span>Move</span></a></li>
                                                        <li><a href="#" class="file-dl-toast"><em class="icon ni ni-download"></em><span>Download</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-pen"></em><span>Rename</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="preview-hr">
            <div class="nk-fmg-body-pagination">
                <ul class="pagination">
                    <!-- Items Pagination From JS -->
                </ul>
            </div>
        </div>
    </div>
@endsection

@section("ModalPopup")
    <div class="modal fade" tabindex="-1" role="dialog" id="file-details">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header align-center">
                    <div class="nk-file-title">
                        <div class="nk-file-icon">
                            <span class="nk-file-icon-type">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 72 72">
                                    <path fill="#6C87FE" d="M57.5,31h-23c-1.4,0-2.5-1.1-2.5-2.5v-10c0-1.4,1.1-2.5,2.5-2.5h23c1.4,0,2.5,1.1,2.5,2.5v10
	C60,29.9,58.9,31,57.5,31z" />
                                    <path fill="#8AA3FF" d="M59.8,61H12.2C8.8,61,6,58,6,54.4V17.6C6,14,8.8,11,12.2,11h18.5c1.7,0,3.3,1,4.1,2.6L38,24h21.8
	c3.4,0,6.2,2.4,6.2,6v24.4C66,58,63.2,61,59.8,61z" />
                                    <path display="none" fill="#8AA3FF" d="M62.1,61H9.9C7.8,61,6,59.2,6,57c0,0,0-31.5,0-42c0-2.2,1.8-4,3.9-4h19.3
	c1.6,0,3.2,0.2,3.9,2.3l2.7,6.8c0.5,1.1,1.6,1.9,2.8,1.9h23.5c2.2,0,3.9,1.8,3.9,4v31C66,59.2,64.2,61,62.1,61z" />
                                    <path fill="#798BFF" d="M7.7,59c2.2,2.4,4.7,2,6.3,2h45c1.1,0,3.2,0.1,5.3-2H7.7z" />
                                </svg>
                            </span>
                        </div>
                        <div class="nk-file-name">
                            <div class="nk-file-name-text"><span class="title">UI/UX Design</span></div>
                        </div>
                    </div>
                    <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                </div>
                <div class="modal-body">
                    <div class="nk-file-details">
                        <div class="nk-file-details-row" data-name-option-file="type">
                            <div class="nk-file-details-col">Type</div>
                            <div class="nk-file-details-col">Folder</div>
                        </div>
                        <div class="nk-file-details-row" data-name-option-file="size">
                            <div class="nk-file-details-col">Size</div>
                            <div class="nk-file-details-col">35.48 MB</div>
                        </div>
                        <div class="nk-file-details-row" data-name-option-file="createBy">
                            <div class="nk-file-details-col">Created By</div>
                            <div class="nk-file-details-col">Admin</div>
                        </div>
                        <div class="nk-file-details-row" data-name-option-file="updateDate">
                            <div class="nk-file-details-col">Modified</div>
                            <div class="nk-file-details-col">Feb 19, 2020 by Abu Bit Istiyak</div>
                        </div>
                        <div class="nk-file-details-row" data-name-option-file="createDate">
                            <div class="nk-file-details-col">Created</div>
                            <div class="nk-file-details-col">Feb 19, 2020</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-stretch bg-light">
                    <div class="modal-footer-between">
                        <div class="g">
                            <ul class="btn-toolbar g-3">
                                <li>
                                    <a href="#" target="_blank" class="btn btn-primary file-dl-toast">
                                        @lang("messages.download")
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="file-upload">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <div class="nk-upload-form">
                        <h5 class="title mb-3">Upload File</h5>
                        <div id="uploadZone" data-can-multiple="multiple"
                             class="upload-zone small bg-lighter">
                            <div class="dz-message" data-dz-message="">
                                <span class="dz-message-text">Drag and drop file</span>
                                <span class="dz-message-or">or</span>
                                <button type="button" class="btn btn-primary btn-select-file">SELECT</button>
                            </div>
                        </div>
                    </div>
                    <div class="nk-upload-list">
                        <h6 class="title">Uploaded Files (تم رفعها بل ajax)</h6>
                    </div>
                    <div class="nk-modal-action justify-end">
                        <ul class="btn-toolbar g-4 align-center">
                            <li><button id="cancelAdd" class="link link-primary">Cancel</button></li>
                            <li><button id="addFile" class="btn btn-primary">Add Files</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="file-delete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-lg text-center">
                    <div class="nk-modal">
                        <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                        <h4 class="nk-modal-title">
                            {{ __('DeleteInfo_Soft') }} : Sure About That!
                        </h4>
                        <div class="nk-modal-text">
                            <p class="lead">
                                {{__('messages.areYouSure')}}
                            </p>
                        </div>
                        <form>
                            <div class="nk-modal-action mt-5">
                                <button type="submit" class="btn btn-lg btn-mw btn-danger">
                                    {{__('messages.yes')}}
                                </button>
                                <a href="#" class="btn btn-lg btn-mw btn-light"
                                   data-bs-dismiss="modal">{{__('messages.close')}}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("extraScriptsPage")
    <script src="{{ asset("System/assets/js_2/pages/media-manager.js") }}" type="text/javascript"></script>
@endsection
