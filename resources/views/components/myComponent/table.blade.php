<div class="card-inner-group CustomTable">
    <!-- Header Card Table -->
    <div class="card-inner position-relative card-tools-toggle">
        <!-- Tools Table -->
        <div class="card-title-group">
            <!-- Bulk Action Table -->
            @if(isset($HeaderTable) && isset($HeaderTable["BulkActions"]) && count($HeaderTable["BulkActions"]) > 0)
                <div class="card-tools">
                    <div class="form-inline flex-nowrap gx-3 BulkAction">
                        <div class="form-wrap w-150px">
                            <select class="form-select js-select2 BulkAction__Select"
                                    data-search="off" data-placeholder="{{ __("messages.Bulk Action") }}">
                                <option value="">{{ __("messages.Bulk Action") }}</option>
                                @foreach($HeaderTable["BulkActions"] as $BulkItem)
                                    <option value="{{ $BulkItem["ActionRoute"] }},{{ $BulkItem["MethodRoute"] }}">
                                        {{ $BulkItem["Label"] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="btn-wrap BulkAction__Buttons">
                            <span class="d-none d-md-block"><button
                                    class="btn btn-dim btn-outline-light disabled">{{ __("messages.Apply") }}</button></span>
                            <span class="d-md-none"><button class="btn btn-dim btn-outline-light btn-icon disabled"><em
                                        class="icon ni ni-arrow-right"></em></button></span>
                        </div>
                    </div>
                </div>
            @endif
        <!-- Tools Icon -->
            @if(isset($HeaderTable) && (isset($HeaderTable["UseSearchFront"]) || isset($HeaderTable["FilterData"])
                || isset($HeaderTable["ShowRowsInfo"]) || isset($HeaderTable["ACS_OrderRowsInfo"]) || isset($HeaderTable["DECS_OrderRowsInfo"])))
                <div class="card-tools me-n1">
                    <ul class="btn-toolbar gx-1">
                    @if(isset($HeaderTable["UseSearchFront"]) && $HeaderTable["UseSearchFront"] === "true")
                        <!-- icon For Open Search Fields -->
                            <li>
                                <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search">
                                    <em class="icon ni ni-search"></em>
                                </a>
                            </li>
                            <li class="btn-toolbar-sep"></li>
                    @endif
                    <!-- Group Icon -->
                        <li>
                            <div class="toggle-wrap">
                                <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools">
                                    <em class="icon ni ni-menu-right"></em>
                                </a>
                                <div class="toggle-content" data-content="cardTools">
                                    <ul class="btn-toolbar gx-1">
                                        <!-- Group Icon -->
                                        <li class="toggle-close">
                                            <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools">
                                                <em class="icon ni ni-arrow-left"></em>
                                            </a>
                                        </li>
                                    @if(isset($HeaderTable["FilterData"]) && count($HeaderTable["FilterData"]) === 2)
                                        <!-- Icon Filter -->
                                            <li>
                                                <a href="#" class="btn btn-trigger btn-icon"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#{{ $HeaderTable["FilterData"]["ModalName"] }}">
                                                    @if($HeaderTable["FilterData"]["IsFilteredNow"] === "true")
                                                        <div class="dot dot-primary"></div>
                                                    @endif
                                                    <em class="icon ni ni-filter-alt"></em>
                                                </a>
                                            </li>
                                    @endif
                                    @if(isset($HeaderTable["ShowRowsInfo"]) || isset($HeaderTable["ACS_OrderRowsInfo"]) || isset($HeaderTable["DECS_OrderRowsInfo"]))
                                        <!-- Order Rows Table -->
                                            <li>
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                                       data-bs-toggle="dropdown">
                                                        <em class="icon ni ni-setting"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                        @if(isset($HeaderTable["ShowRowsInfo"]) && count($HeaderTable["ShowRowsInfo"]) > 0)
                                                            <ul class="link-check">
                                                                <li>
                                                                    <span>Show</span>
                                                                </li>
                                                                @foreach($HeaderTable["ShowRowsInfo"] as $InfoButton)
                                                                    <li class="{{ (isset($InfoButton["IsActive"]) && $InfoButton["IsActive"] === "true") ? "active" : "" }}">
                                                                        <a href="#"
                                                                           class="ButtonOptionInput"
                                                                           data-inputID="{{ $InfoButton["inputID"] }}"
                                                                           data-inputValue="{{ $InfoButton["inputValue"] }}"
                                                                           data-isSubmit="{{ $InfoButton["isSubmit"] }}"
                                                                           data-formID="{{ $InfoButton["formID"] }}">
                                                                            {{ $InfoButton["Label"] }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                        @if(isset($HeaderTable["ACS_OrderRowsInfo"]) || isset($HeaderTable["DECS_OrderRowsInfo"]))
                                                            <ul class="link-check">
                                                                <li>
                                                                    <span>Order</span>
                                                                </li>
                                                                @if(isset($HeaderTable["ACS_OrderRowsInfo"]) && count($HeaderTable["ACS_OrderRowsInfo"]) > 0)
                                                                    <li class="{{ (isset($HeaderTable["ACS_OrderRowsInfo"]["IsActive"]) && $HeaderTable["ACS_OrderRowsInfo"]["IsActive"] === "true") ? "active" : "" }}">
                                                                        <a href="#"
                                                                           class="ButtonOptionInput"
                                                                           data-inputID="{{ $HeaderTable["ACS_OrderRowsInfo"]["inputID"] }}"
                                                                           data-inputValue="{{ $HeaderTable["ACS_OrderRowsInfo"]["inputValue"] }}"
                                                                           data-isSubmit="{{ $HeaderTable["ACS_OrderRowsInfo"]["isSubmit"] }}"
                                                                           data-formID="{{ $HeaderTable["ACS_OrderRowsInfo"]["formID"] }}">
                                                                            ACS
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                @if(isset($HeaderTable["DECS_OrderRowsInfo"]) && count($HeaderTable["DECS_OrderRowsInfo"]) > 0)
                                                                    <li class="{{ (isset($HeaderTable["DECS_OrderRowsInfo"]["IsActive"]) && $HeaderTable["DECS_OrderRowsInfo"]["IsActive"] === "true") ? "active" : "" }}">
                                                                        <a href="#"
                                                                           class="ButtonOptionInput"
                                                                           data-inputID="{{ $HeaderTable["DECS_OrderRowsInfo"]["inputID"] }}"
                                                                           data-inputValue="{{ $HeaderTable["DECS_OrderRowsInfo"]["inputValue"] }}"
                                                                           data-isSubmit="{{ $HeaderTable["DECS_OrderRowsInfo"]["isSubmit"] }}"
                                                                           data-formID="{{ $HeaderTable["DECS_OrderRowsInfo"]["formID"] }}">
                                                                            DECS
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    @if(isset($HeaderTable) && isset($HeaderTable["UseSearchFront"]) && $HeaderTable["UseSearchFront"] === "true")
        <!-- Search Field For Search Front-End -->
            <div class="card-search search-wrap" data-search="search">
                <div class="card-body">
                    <div class="search-content">
                        <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em
                                class="icon ni ni-arrow-left"></em></a>
                        <input type="text" class="form-control border-transparent form-focus-none"
                               placeholder="{{__("messages.Search by name")}}">
                        <button type="button" class="search-submit btn btn-icon"><em class="icon ni ni-search"></em>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- Body Card Table -->
    <div class="card-inner p-0">
        <form class="BulkActionForm" action="#" method="post">
            <table class="datatable-custom nk-tb-list nk-tb-ulist" style="width : 100%">
                <thead>
                <tr class="nk-tb-item nk-tb-head">
                    <th class="nk-tb-col nk-tb-col-check">
                        <div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" class="custom-control-input" id="CheckboxHeaderTable">
                            <label class="custom-control-label" for="CheckboxHeaderTable"></label>
                        </div>
                    </th>
                    <th class="nk-tb-col">
                        <span class="sub-text">#</span>
                    </th>
                    <th class="nk-tb-col">
                        <span class="sub-text">1</span>
                    </th>
                    <th class="nk-tb-col">
                        <span class="sub-text">2</span>
                    </th>
                    <th class="nk-tb-col">
                        <span class="sub-text">3</span>
                    </th>
                    <th class="nk-tb-col">
                        <span class="sub-text">4</span>
                    </th>
                    <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                </tr>
                </thead>
                <tbody>
                <tr class="nk-tb-item">
                    <td class="nk-tb-col nk-tb-col-check">
                        <div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" class="custom-control-input" id="RowData_1">
                            <label class="custom-control-label" for="RowData_1"></label>
                        </div>
                    </td>
                    <td class="nk-tb-col">
                        <span>1</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>2</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>3</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>4</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>5</span>
                    </td>
                    <td class="nk-tb-col nk-tb-col-tools HeightElementLayer"
                        data-typeLayer="dropdown">
                        <ul class="nk-tb-actions gx-1">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                       data-bs-target=""
                                       data-bs-toggle="dropdown">
                                        <em class="icon ni ni-more-h"></em>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-pen"></em>
                                                    <span>1</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-pen"></em>
                                                    <span>2</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-pen"></em>
                                                    <span>3</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr class="nk-tb-item">
                    <td class="nk-tb-col nk-tb-col-check">
                        <div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" class="custom-control-input" id="RowData_2">
                            <label class="custom-control-label" for="RowData_2"></label>
                        </div>
                    </td>
                    <td class="nk-tb-col">
                        <span>2</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>2</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>3</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>4</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>5</span>
                    </td>
                    <td class="nk-tb-col nk-tb-col-tools HeightElementLayer"
                        data-typeLayer="dropdown">
                        <ul class="nk-tb-actions gx-2">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                       data-bs-target=""
                                       data-bs-toggle="dropdown">
                                        <em class="icon ni ni-more-h"></em>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-pen"></em>
                                                    <span>2</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-pen"></em>
                                                    <span>2</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-pen"></em>
                                                    <span>3</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr class="nk-tb-item">
                    <td class="nk-tb-col nk-tb-col-check">
                        <div class="custom-control custom-control-sm custom-checkbox notext">
                            <input type="checkbox" class="custom-control-input" id="RowData_4">
                            <label class="custom-control-label" for="RowData_4"></label>
                        </div>
                    </td>
                    <td class="nk-tb-col">
                        <span>4</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>2</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>3</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>4</span>
                    </td>
                    <td class="nk-tb-col">
                        <span>5</span>
                    </td>
                    <td class="nk-tb-col nk-tb-col-tools HeightElementLayer"
                        data-typeLayer="dropdown">
                        <ul class="nk-tb-actions gx-4">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                       data-bs-target=""
                                       data-bs-toggle="dropdown">
                                        <em class="icon ni ni-more-h"></em>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-pen"></em>
                                                    <span>4</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-pen"></em>
                                                    <span>2</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <em class="icon ni ni-pen"></em>
                                                    <span>3</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    <!-- Footer Card Table -->
    <div class="card-inner">
        <div class="nk-block-between-md g-3">
            @if(isset($data) && $data instanceof \Illuminate\Pagination\LengthAwarePaginator && $data->hasPages())
                @include('pages.crud.pagination-area')
            @endif
        </div>
    </div>
</div>


{{--

    @include("components.myComponent.table" , [
        "HeaderTable" => [
            "BulkActions" => [
                [ "Label" => "" , "ActionRoute" => "" , "MethodRoute" => "" ] ,
                [ "Label" => "" , "ActionRoute" => "" , "MethodRoute" => "" ]
            ] ,
            "UseSearchFront" => "true" ,
            "FilterData" => [ ModalName => "" , "IsFilteredNow" => "true"] ,
            "ShowRowsInfo" => [
                [ "inputID" => "" , "inputValue" => "" , "isSubmit" => "" , "formID" => "" , "Label" => "" , "IsActive" => "" ] ,
                [ "inputID" => "" , "inputValue" => "" , "isSubmit" => "" , "formID" => "" , "Label" => "" ] ,
                [ "inputID" => "" , "inputValue" => "" , "isSubmit" => "" , "formID" => "" , "Label" => "" ]
             ] ,
            "ACS_OrderRowsInfo" => [ "inputID" => "" , "inputValue" => "" , "isSubmit" => "" , "formID" => "" , "IsActive" => "" ] ,
            "DECS_OrderRowsInfo" => [ "inputID" => "" , "inputValue" => "" , "isSubmit" => "" , "formID" => "" , "IsActive" => "" ] ,
        ]
    ])

--}}
