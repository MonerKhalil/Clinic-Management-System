@php
    $checkCanCreate = userHasPermission("create_{$fields['config']['table']}");
    $checkCanRead = userHasPermission("read_{$fields['config']['table']}");
    $checkCanUpdate = userHasPermission("update_{$fields['config']['table']}");
    $checkCanForceDelete = userHasPermission("force_delete_{$fields['config']['table']}");
    $checkCanDelete = userHasPermission("delete_{$fields['config']['table']}");
    $checkCanPrint = userHasPermission("print_{$fields['config']['table']}") ;
    $checkCanImport = userHasPermission("import_{$fields['config']['table']}");
@endphp

@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    {{--  Put Extra CSS Library In Here  --}}
@endsection

@section("CSSExtraPage")
    {{--  Extra Manual CSS  --}}
@endsection

@section("ContentPage")
    @if($checkCanRead) <!-- For Permission  -->
        @if(isset($dataShow)) <!-- For Enter Table From Notification  -->
            @include("components.myComponent.breadcrumb" , [
                "TitleBreadcrumb" => __($fields['config']['table']) ,
                "DescriptionBreadcrumb" => "" ,
                "Pages" => [
                    [ "Route" => "#" , "Title" => "Dashboard" ] ,
                    [ "Title" => __($fields['config']['table']) ]
                ]
            ])
        @else <!-- For Normal View Table  -->
            @include("components.myComponent.breadcrumb" , [
                "TitleBreadcrumb" => __($fields['config']['table']) ,
                "DescriptionBreadcrumb" => "" ,
                "Pages" => [
                    [ "Route" => "#" , "Title" => "Dashboard" ] ,
                    [ "Title" => __($fields['config']['table']) ]
                ]
            ])
            @include("alerts.success")
            @include("alerts.errors")
            <!-- Start Button Table Head  -->
                @if($checkCanCreate || $checkCanPrint || $checkCanImport)
                    <!-- Start Form Export File -->
                        @if($checkCanPrint)
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
                    <!-- End Form Export File -->
                    <!-- Start Buttons CRUD -->
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


                                            <!-- Put All Button CRUD -->


                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- End Buttons CRUD -->
                @endif
            <!-- End Button Table Head  -->
            <!-- Start Table Data  -->
                <div class="nk-block">
                    <div class="card card-stretch">
                        <div class="card-inner-group CustomTable dt-hiddenButton dt-hiddenFilter dt-hiddenInfo">
                            <!-- Header Card Table -->
                            <div class="card-inner position-relative card-tools-toggle"> <!-- Tools Table -->
                                <!-- Forms Sorted -->
                                <form id="sortedDataForm" action="#" method="get">
                                    @csrf
                                    @foreach(filterDataRequest() as $Index=>$FilterItem)
                                        @if(!is_null($FilterItem))
                                            <input type="hidden" name="filter[{{ $Index }}]" value="{{ $FilterItem }}"/>
                                        @endif
                                    @endforeach
                                    <input id="ShowRows" name="countItems" type="hidden" value="{{ getRequest("countItems") }}">
                                    <input id="ShowOrder" name="order" type="hidden" value="{{ getRequest("order") }}">
                                </form>
                                <div class="card-title-group">
                                    <!-- Bulk Action Table -->
                                    <div class="card-tools">
                                        <div class="form-inline flex-nowrap gx-3 BulkAction">
                                            <div class="form-wrap w-150px">
                                                <select class="form-select js-select2 BulkAction__Select"
                                                        data-search="off" data-placeholder="Bulk Action">
                                                    <option value="">Bulk Action</option>
                                                    <!-- Start Write Here Option -->
                                                        <option value=""></option>
                                                    <!-- End Write Here Option -->
                                                </select>
                                            </div>
                                            <div class="btn-wrap BulkAction__Buttons">
                                                <span class="d-none d-md-block"><button class="btn btn-dim btn-outline-light disabled">Apply</button></span>
                                                <span class="d-md-none"><button class="btn btn-dim btn-outline-light btn-icon disabled"><em class="icon ni ni-arrow-right"></em></button></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tools Icon -->
                                    <div class="card-tools me-n1">
                                        <ul class="btn-toolbar gx-1">
                                            <!-- icon For Open Search Fields -->
                                            <li>
                                                <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search">
                                                    <em class="icon ni ni-search"></em>
                                                </a>
                                            </li>
                                            <li class="btn-toolbar-sep"></li>
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
                                                                <a href="#" class="btn btn-icon btn-trigger toggle" data-target="cardTools"><em class="icon ni ni-arrow-left"></em></a>
                                                            </li>
                                                            <!-- Icon Filter -->
                                                            <li>
                                                                <a href="#" class="btn btn-trigger btn-icon"
                                                                   data-bs-toggle="modal" data-bs-target="#filter-modal">
                                                                    @if(filterDataRequest())
                                                                        <div class="dot dot-primary"></div>
                                                                    @endif
                                                                    <em class="icon ni ni-filter-alt"></em>
                                                                </a>
                                                            </li>
                                                            <!-- Order Rows Table -->
                                                            <li>
                                                                <div class="dropdown">
                                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                                        <em class="icon ni ni-setting"></em>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                        <ul class="link-check">
                                                                            <li><span>Show</span></li>
                                                                            <li class="{{ (getRequest("countItems") === "10") ? "active" : ((getRequest("countItems")) ? "" : "active") }}">
                                                                                <a href="#"
                                                                                   class="ButtonOptionInput"
                                                                                   data-inputID="ShowRows"
                                                                                   data-inputValue="10"
                                                                                   data-isSubmit="true"
                                                                                   data-formID="sortedDataForm">10</a>
                                                                            </li>
                                                                            <li class="{{ (getRequest("countItems") === "20") ? "active" : "" }}">
                                                                                <a href="#"
                                                                                   class="ButtonOptionInput"
                                                                                   data-inputID="ShowRows"
                                                                                   data-inputValue="20"
                                                                                   data-isSubmit="true"
                                                                                   data-formID="sortedDataForm">20</a>
                                                                            </li>
                                                                            <li class="{{ (getRequest("countItems") === "50") ? "active" : "" }}">
                                                                                <a href="#" class="ButtonOptionInput"
                                                                                   data-inputID="ShowRows"
                                                                                   data-inputValue="50"
                                                                                   data-isSubmit="true"
                                                                                   data-formID="sortedDataForm">50</a>
                                                                            </li>
                                                                            <li class="{{ (getRequest("countItems") === "all") ? "active" : "" }}">
                                                                                <a href="#" class="ButtonOptionInput"
                                                                                   data-inputID="ShowRows"
                                                                                   data-inputValue="all"
                                                                                   data-isSubmit="true"
                                                                                   data-formID="sortedDataForm">All</a>
                                                                            </li>
                                                                        </ul>
                                                                        <ul class="link-check">
                                                                            <li>
                                                                                <span>Order</span>
                                                                            </li>
                                                                            <li class="{{ (getRequest("order") === "desc") ? "active" : "" }}">
                                                                                <a href="#" class="ButtonOptionInput"
                                                                                   data-inputID="ShowOrder"
                                                                                   data-inputValue="desc"
                                                                                   data-isSubmit="true"
                                                                                   data-formID="sortedDataForm">DESC</a>
                                                                            </li>
                                                                            <li class="{{ (getRequest("order") !== "desc") ? "active" : "" }}">
                                                                                <a href="#" class="ButtonOptionInput"
                                                                                   data-inputID="ShowOrder"
                                                                                   data-inputValue="asc"
                                                                                   data-isSubmit="true"
                                                                                   data-formID="sortedDataForm">ASC</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Search Field For Search Front-End -->
                                <div class="card-search search-wrap" data-search="search">
                                    <div class="card-body">
                                        <div class="search-content">
                                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                            <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search by name">
                                            <button type="button" class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Body Card Table -->
                            <div class="card-inner p-0">
                                <form class="BulkActionForm" action="#" method="#">
                                    @csrf
                                    <table class="datatable-standard nk-tb-list nk-tb-ulist"
                                           style="width:100%"
                                           data-auto-responsive="true">
                                        <thead>
                                            <tr class="nk-tb-item nk-tb-head">
                                                <th class="nk-tb-col nk-tb-col-check">
                                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                                        <input type="checkbox" class="custom-control-input" id="CheckboxHeaderTable">
                                                        <label class="custom-control-label" for="CheckboxHeaderTable"></label>
                                                    </div>
                                                </th> <!-- Checkbox Header Table -->
                                                <th class="nk-tb-col">
                                                    <span class="sub-text">#</span>
                                                </th> <!-- (#) Header Table -->
                                                <!-- Start Head Column -->
                                                    <th class="nk-tb-col">
                                                    <span class="sub-text">
                                                            {{--   Text   --}}
                                                    </span>
                                                </th>
                                                <!-- End Head Column -->
                                                <th class="nk-tb-col">
                                                    <span>{{__('edited_by')}}</span>
                                                </th>
                                                <th class="nk-tb-col nk-tb-col-tools text-end"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $key => $item)
                                                <tr class="nk-tb-item">
                                                    <td class="nk-tb-col nk-tb-col-check">
                                                        <div class="custom-control custom-control-sm custom-checkbox notext">
                                                            <input type="checkbox" class="custom-control-input" value="{{ $item["id"] }}"
                                                                   name="ids[]" id="RowData{{ $item["id"] }}">
                                                            <label class="custom-control-label" for="RowData{{ $item["id"] }}"></label>
                                                        </div>
                                                    </td> <!-- CheckBox Row -->
                                                    <td class="nk-tb-col">
                                                        <span>{{$loop->iteration}}</span>
                                                    </td> <!-- Counter Row -->
                                                    <!-- Start Column Here -->
                                                        <td class="nk-tb-col">
                                                        {{--


                                                        1) Image :

                                                           if ($type === 'image') {
                                                                <td class="nk-tb-col">
                                                                    @if (!is_null($item->$field))
                                                                        <a class="btn btn-round btn-icon btn-sm btn-info btn-dim popup-image"
                                                                           href="{{ pathStorage(checkObjectInstanceofTranslation($item,$field)) }}">
                                                                            <span class="px-1">
                                                                                {{ __("messages.open_image") }}
                                                                            </span>
                                                                        </a>
                                                                    @else
                                                                        <span class="badge badge-dim bg-danger p-1">
                                                                            <em class="icon ni ni-alert-circle"></em>
                                                                            <span>{{ __("messages.no_image") }}</span>
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                            }

                                                        2) File :

                                                            if($type === 'file') {
                                                                <td class="nk-tb-col">
                                                                    @if (!is_null($item->$field))
                                                                        <a href="{{ route("download.file") }}?path={{ checkObjectInstanceofTranslation($item,$field) }}"
                                                                           target="_blank"
                                                                           class="btn btn-round btn-icon btn-sm btn-primary btn-dim">
                                                                            <em class="icon ni ni-download"></em>
                                                                        </a>
                                                                    @else
                                                                        <span class="badge badge-dim bg-danger p-1">
                                                                            <em class="icon ni ni-alert-circle"></em>
                                                                            <span>{{ __("messages.no_file") }}</span>
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                            }

                                                        3) badge as Active :

                                                            if($field == 'is_active') {
                                                                <td class="nk-tb-col">
                                                                    <span class="badge badge-dot {{ ($item->{$field})? "bg-success" : "bg-danger" }}">
                                                                        {{ ($item->{$field})? __("messages.active") : __("messages.deActivate") }}
                                                                    </span>
                                                                </td>
                                                            }

                                                        4) Normal Data :

                                                            if (!is_null($item->$field)) {
                                                                    <a class="btn btn-round btn-icon btn-sm btn-info btn-dim popup-image"
                                                                       href="{{ pathStorage(checkObjectInstanceofTranslation($item,$field)) }}">
                                                                        <span class="px-1">
                                                                            {{ __("messages.open_image") }}
                                                                        </span>
                                                                    </a>
                                                                @else
                                                                    <span class="badge badge-dim bg-danger p-1">
                                                                        <em class="icon ni ni-alert-circle"></em>
                                                                        <span>{{ __("messages.no_image") }}</span>
                                                                    </span>
                                                            }


                                                        4) For Editor , note , content , etc... :

                                                            if ($type == 'editor') {
                                                                <td class="nk-tb-col">
                                                                    <a href="#" class="btn btn-round btn-icon btn-sm btn-info btn-dim"
                                                                       data-bs-target="#show-text-modal"
                                                                       data-bs-toggle="modal"
                                                                       data-header-modal="{{ __($field) }}"
                                                                       data-body-modal="{{ checkObjectInstanceofTranslation($item,$field) }}">
                                                                        <span class="px-2">{{ __($field) }}</span>
                                                                    </a>
                                                                </td>
                                                            }




                                                          --}}
                                                    </td>
                                                    <!-- End Column Here -->
                                                    <!-- Start Options Here -->
                                                        <td class="nk-tb-col nk-tb-col-tools">
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
                                                                            <!-- Start Option Here -->
                                                                                <li>
                                                                                    <a href="#">
                                                                                        <em class="icon ni ni-pen"></em>
                                                                                        <span>Option</span>
                                                                                    </a>
                                                                                </li>
                                                                            <!-- End Option Here -->
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                    <!-- End Options Here -->
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                            <!-- Footer Card Table -->
                            @if($data instanceof \Illuminate\Pagination\LengthAwarePaginator && $data->hasPages())
                                <div class="card-inner">
                                    <div class="nk-block-between-md g-3">
                                        @include('pages.crud.pagination-area')
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            <!-- End Table Data  -->
        @endif
    @else
        @include("components.errors.404")
    @endif
@endsection

@section("ModalPopup")
    @if($checkCanRead)
        {{--   Get Modal From @include('pages.crud.table-modal') and put modal want here   --}}
    @endif
@endsection

@section("extraScriptsPage")
    @if($checkCanRead)
        {{--  dataTable library  --}}
        <script src="{{ asset("System/assets/js_2/library/fixColumnDatatable.min.js") }}" type="text/javascript"></script>
        <script src="{{ asset("System/assets/js_2/library/datatable-btns.js") }}" type="text/javascript"></script>
        {{--  trumbowyg library  --}}
        <script src="{{ asset("System/assets/plugins/trumbowyg/dist/trumbowyg.min.js") }}"
                type="text/javascript"></script>
        @if(lang(app()->getLocale())->isRTL)
            <script src="{{ asset("System/assets/plugins/trumbowyg/dist/langs/ar.min.js") }}"
                    type="text/javascript"></script>
        @endif
        {{--  Put Extra JS In Here  --}}
    @endif
@endsection
