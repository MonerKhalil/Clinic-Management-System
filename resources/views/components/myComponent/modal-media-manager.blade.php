<!-- Modal Content Code -->
<div class="modal fade" tabindex="-1" role="dialog" id="modal-media-manager-choose">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content media-manager">
            <div class="top-header">
                <div class="modal-header justify-content-end">
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
            </div>
            <div class="top-header-1">
                <div class="modal-header">
                    <div class="button-group">
                        <ul class="nav nav-tabs row-gap-2 border-bottom-0">
                            <li class="nav-item" role="presentation">
                                <a href="#selectFile" class="btn btn-dim btn-secondary active"
                                   data-bs-toggle="tab" aria-selected="true" role="tab">@lang("messages.select-file")</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#fileUpload" class="btn btn-dim btn-secondary"
                                   data-bs-toggle="tab" aria-selected="false" role="tab">@lang("messages.upload-new")</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="media-manager-content">
                <div class="tab-content">
                    <div class="tab-pane active" id="selectFile" role="tabpanel">
                        <div class="modal-header">
                            <div class="media-manager-filter w-100">
                                <div class="card-inner p-0 position-relative card-tools-toggle">
                                    <div class="card-title-group">
                                        <div class="card-tools">
                                            <div class="form-inline flex-nowrap gx-3">
                                                <div class="form-wrap w-200px">
                                                    <select class="form-select js-select2"
                                                            id="type-file-select" data-search="on"
                                                            data-placeholder="{{ __("messages.type-file") }}"
                                                            tabindex="-1" aria-hidden="true">
                                                        <option value="">@lang("messages.type-file")</option>
                                                        <option value="all" selected>@lang("messages.all-files")</option>
                                                        <option value="pdf">@lang("messages.pdf-file")</option>
                                                        <option value="docs">@lang("messages.docs-file")</option>
                                                        <option value="csv">@lang("messages.csv-file")</option>
                                                        <option value="xlsx">@lang("messages.xlsx-file")</option>
                                                        <option value="jpg">@lang("messages.jpg-file")</option>
                                                        <option value="jpeg">@lang("messages.jpeg-file")</option>
                                                        <option value="png">@lang("messages.png-file")</option>
                                                        <option value="gif">@lang("messages.gif-file")</option>
                                                        <option value="svg">@lang("messages.svg-file")</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-tools me-n1">
                                            <ul class="btn-toolbar gx-1">
                                                <li>
                                                    <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-search search-wrap" data-search="search">
                                        <div class="card-body px-0">
                                            <div class="search-content">
                                                <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                <input id="filterNameField" type="text" class="form-control border-transparent form-focus-none"
                                                       placeholder="Search by user or email">
                                                <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="content-files row g-gs">

                            </div>
                        </div>
                        <div class="modal-footer justify-content-between row-gap-2 bg-light">
                            <div class="col-lg-6 col-12 m-0">
                                <ul class="pagination justify-content-start">
                                    <!-- Items Pagination From JS -->
                                </ul>
                            </div>
                            <div class="col-lg-6 col-12 m-0">
                                <div class="form-btn-group justify-content-end row-gap-2 column-gap-2">
                                    <button id="btn-select-card" class="btn btn-primary">@lang("messages.select")</button>
                                    <button id="btn-clear-card" class="btn btn-secondary">@lang("messages.clear")</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="fileUpload" role="tabpanel">
                        <div class="modal-body">
                            <div class="upload-zone" id="upload-file-modal-media-manager">
                                <div class="dz-message" data-dz-message>
                                    <span class="dz-message-text">@lang("messages.drag-and-drop-file")</span>
                                    <span class="dz-message-or">@lang("messages.or")</span>
                                    <button type="button" class="btn btn-primary">@lang("messages.select")</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <div class="button-group">
                                <button id="btn-select-dropzone" class="btn btn-primary">@lang("messages.select")</button>
                                <button id="btn-clear-dropzone" class="btn btn-secondary">@lang("messages.clear")</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
