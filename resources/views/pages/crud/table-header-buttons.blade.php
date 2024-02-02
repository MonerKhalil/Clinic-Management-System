@if(userHasPermission("create_{$fields['config']['table']}")
    || userHasPermission("print_{$fields['config']['table']}")
    || userHasPermission("import_{$fields['config']['table']}")
    || userHasPermission("all_{$fields['config']['table']}"))

    @if(userHasPermission("print_{$fields['config']['table']}"))
        <!-- Export Forms -->
        <form id="Excel_Export" method="get"
              action="{{route($route['export.xlsx'])}}">
            @csrf
            @foreach(filterDataRequest() as $Index=>$FilterItem)
                @if(!is_null($FilterItem))
                    <input type="hidden" name="filter[{{ $Index }}]" value="{{ $FilterItem }}"/>
                @endif
            @endforeach
        </form>
        <form id="Excel_Export-Empty" method="get"
              action="{{route($route['export.xlsx'])}}">
            @csrf
            @foreach(filterDataRequest() as $Index=>$FilterItem)
                @if(!is_null($FilterItem))
                    <input type="hidden" name="filter[{{ $Index }}]" value="{{ $FilterItem }}"/>
                @endif
            @endforeach
            <input name="export_empty" type="hidden" value="exportData" hidden>
        </form>
        <form id="PDF_Export" method="get"
              action="{{route($route['export.pdf'])}}">
            @csrf
            @foreach(filterDataRequest() as $Index=>$FilterItem)
                @if(!is_null($FilterItem))
                    <input type="hidden" name="filter[{{ $Index }}]" value="{{ $FilterItem }}"/>
                @endif
            @endforeach
        </form>
    @endif

    <!-- Buttons CRUD -->
    <div class="nk-block">
        <div class="nk-block-head">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                   data-target="pageMenu">
                    <em class="icon ni ni-more-v"></em>
                </a>
                <div class="toggle-expand-content"
                     data-content="pageMenu">
                    <ul class="nk-block-tools g-3 justify-content-end">
                        <li>
                            <a href="{{route($route['index'])}}"
                               class="btn btn-white btn-outline-light">
                                <em class="icon ni ni-filter-alt"></em>
                                <span>{{__("messages.Reset Filter")}}</span>
                            </a>
                        </li>
                        @if(userHasPermission("print_{$fields['config']['table']}"))
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-white btn-outline-light"
                                       data-bs-toggle="dropdown">
                                        <em class="icon ni ni-download-cloud"></em>
                                        <span>{{ __("messages.Export") }}</span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li>
                                                <a href="#" class="AnchorSubmit"
                                                   data-formID="Excel_Export">
                                                    <span>{{ __("messages.As Excel") }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="AnchorSubmit"
                                                   data-formID="PDF_Export">
                                                    <span>{{ __("messages.As PDF") }}</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="AnchorSubmit"
                                                   data-formID="Excel_Export-Empty">
                                                    <span>{{ __("messages.As Empty Excel") }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @endif
                        @if(!(isset($hiddenElement) && in_array("addNewRecord", $hiddenElement) && in_array("ImportByExcel", $hiddenElement)))
                            @if(userHasPermission("create_{$fields['config']['table']}") ||
                            userHasPermission("import_{$fields['config']['table']}") || userHasPermission("all_{$fields['config']['table']}"))
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-primary"
                                           data-bs-toggle="dropdown">
                                            <em class="icon ni ni-plus"></em>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <ul class="link-list-opt no-bdr">
                                                @if(!(isset($hiddenElement) && in_array("addNewRecord", $hiddenElement)))
                                                    @if(userHasPermission("create_{$fields['config']['table']}")
                                                        || userHasPermission("all_{$fields['config']['table']}"))
                                                        <li>
                                                            <a href="{{ route($route['create']) }}">
                                                                <span>{{__("messages.Add Data")}}</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endif
                                                @if(!(isset($hiddenElement) && in_array("ImportByExcel", $hiddenElement)))
                                                    @if(userHasPermission("import_{$fields['config']['table']}")
                                                        || userHasPermission("all_{$fields['config']['table']}"))
                                                        <li>
                                                            <a href="#" data-bs-toggle="modal"
                                                               class="buttonClearPopup"
                                                               data-bs-target="#import-new-model">
                                                                <span>{{__("messages.Import Data")}}</span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
