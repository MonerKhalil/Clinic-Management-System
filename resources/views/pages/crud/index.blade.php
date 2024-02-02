
{{--
    "hiddenElement" => String[] => ["addNewRecord" , "ImportByExcel","updateRecord"] ,
    "hiddenSection" => String[] => ["sectionBodyTable"] ,
--}}

@php
    $TableName = $fields['config']['table'] ;
    $checkCanRead = userHasPermission("read_".$TableName) || userHasPermission("all_".$TableName) ;
@endphp

@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    @if(!isset($dataShow))
        <link rel="stylesheet" href='{{ asset('System/assets/css/trumbowyg-custom.css') }}'
              type="text/css"/>
    @endif
@endsection

@section("CSSExtraPage")
    {{--  Extra Manual CSS  --}}
@endsection

@section("ContentPage")
    @if($checkCanRead) {{--  For Permission  --}}
        @if(isset($dataShow)) {{--  For Enter Table From Notification  --}}
            @include("components.myComponent.breadcrumb" , [
                "TitleBreadcrumb" => (isset($dataChange)) ? ($dataChange["title-table"] ?? __($fields['config']['table'])) : "" ,
                "DescriptionBreadcrumb" => "" ,
                "Pages" => [
                    [ "Route" => "#" , "Title" => "Dashboard" ] ,
                    [ "Title" => (isset($dataChange)) ? ($dataChange["title-table"] ?? __($fields['config']['table'])) : "" ]
                ]
            ])
            {{--  Table Data  --}}
            <div class="nk-block">
                <div class="card card-stretch">
                    <div class="card-inner-group CustomTable dt-hiddenButton dt-hiddenFilter dt-hiddenInfo">
                        <!-- Header Card Table -->
                        <div class="card-inner position-relative card-tools-toggle"> <!-- Tools Table -->
                            <div class="card-title-group">
                                <!-- Bulk Action Table -->
                                <div class="card-tools">
                                    <div class="form-inline flex-nowrap gx-3 BulkAction">
                                        <div class="form-wrap w-150px">
                                            @php
                                                $checkCanDelete = userHasPermission("delete_".$TableName) || userHasPermission("all_".$TableName);
                                                $checkCanActive = userHasPermission("active_".$TableName) || userHasPermission("all_".$TableName);
                                                $checkCanPrint = userHasPermission("print_".$TableName) || userHasPermission("all_".$TableName);
                                            @endphp
                                            <select class="form-select js-select2 BulkAction__Select"
                                                    data-search="off" data-placeholder="{{ __("messages.Bulk Action") }}">
                                                <option value="">{{ __("messages.Bulk Action") }}</option>
                                                @if($checkCanActive)
                                                    <option
                                                        value='{"processName":"changeForm","action":"{{ route($route['active.multi']) }}","method":"put","inputName":"type","inputValue":"1"}'>
                                                        {{ __("messages.Active") }}
                                                    </option>
                                                    <option
                                                        value='{"processName":"changeForm","action":"{{ route($route['active.multi']) }}","method":"put","inputName":"type","inputValue":"0"}'>
                                                        {{ __("messages.Not Active") }}
                                                    </option>
                                                @endif
                                                @if($checkCanDelete)
                                                    <option
                                                        value='{"processName":"changeForm","action":"{{ route($route['delete.multi']) }}","method":"delete"}'>{{ __("messages.Delete") }}
                                                    </option>
                                                @endif
                                                @yield("bulk-action-section")
                                                @if($checkCanPrint)
                                                    <option
                                                        value='{"processName":"processTable","method":"export","format":"excel"}'>
                                                        {{ __("messages.export excel") }}
                                                    </option>
                                                    <option
                                                        value='{"processName":"processTable","method":"export","format":"pdf"}'>
                                                        {{ __("messages.export pdf") }}
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="btn-wrap BulkAction__Buttons">
                                            <span class="d-none d-md-block">
                                                <button class="btn btn-dim btn-outline-light disabled">
                                                    {{ __("messages.Apply") }}
                                                </button>
                                            </span>
                                            <span class="d-md-none">
                                                <button class="btn btn-dim btn-outline-light btn-icon disabled">
                                                    <em class="icon ni ni-arrow-right"></em>
                                                </button>
                                            </span>
                                        </div>
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
                                        @include('pages.crud.table-header')
                                    </thead>
                                    <tbody>
                                        @include('pages.crud.table-body')
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else {{--  For Normal View Table  --}}
            @include("components.myComponent.breadcrumb" , [
                "TitleBreadcrumb" => (isset($dataChange)) ?  $dataChange["title-table"] : __("messages.".$fields['config']['table']) ,
                "DescriptionBreadcrumb" => "" ,
                "Pages" => [
                    [ "Route" => "#" , "Title" => "Dashboard" ] ,
                    [ "Title" => (isset($dataChange)) ? $dataChange["title-table"] : __("messages.".$fields['config']['table']) ]
                ]
            ])
            @include("alerts.success")
            @include("alerts.errors")
            @include('pages.crud.table-header-buttons')

            {{--  Table Data  --}}
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
                                            @php
                                                $checkCanDelete = userHasPermission("delete_".$TableName) || userHasPermission("all_".$TableName);
                                                $checkCanActive = userHasPermission("active_".$TableName) || userHasPermission("all_".$TableName);
                                                $checkCanPrint = userHasPermission("print_".$TableName) || userHasPermission("all_".$TableName);
                                            @endphp
                                            <select class="form-select js-select2 BulkAction__Select"
                                                    data-search="off" data-placeholder="{{ __("messages.Bulk Action") }}">
                                                <option value="">{{ __("messages.Bulk Action") }}</option>
                                                @if($checkCanActive)
                                                    <option
                                                        value='{"processName":"changeForm","action":"{{ route($route['active.multi']) }}","method":"put","inputName":"type","inputValue":"1"}'>
                                                        {{ __("messages.Active") }}
                                                    </option>
                                                    <option
                                                        value='{"processName":"changeForm","action":"{{ route($route['active.multi']) }}","method":"put","inputName":"type","inputValue":"0"}'>
                                                        {{ __("messages.Not Active") }}
                                                    </option>
                                                @endif
                                                @if($checkCanDelete)
                                                    <option
                                                        value='{"processName":"changeForm","action":"{{ route($route['delete.multi']) }}","method":"delete"}'>{{ __("messages.Delete") }}
                                                    </option>
                                                @endif
                                                @yield("bulk-action-section")
                                                @if($checkCanPrint)
                                                    <option
                                                        value='{"processName":"processTable","method":"export","format":"excel"}'>
                                                        {{ __("messages.export excel") }}
                                                    </option>
                                                    <option
                                                        value='{"processName":"processTable","method":"export","format":"pdf"}'>
                                                        {{ __("messages.export pdf") }}
                                                    </option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="btn-wrap BulkAction__Buttons">
                                            <span class="d-none d-md-block"><button
                                                    class="btn btn-dim btn-outline-light disabled">{{ __("messages.Apply") }}</button></span>
                                            <span class="d-md-none"><button
                                                    class="btn btn-dim btn-outline-light btn-icon disabled"><em
                                                        class="icon ni ni-arrow-right"></em></button></span>
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
                                                            <a href="#" class="btn btn-icon btn-trigger toggle"
                                                               data-target="cardTools"><em
                                                                    class="icon ni ni-arrow-left"></em></a>
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
                                                                <a href="#" class="btn btn-trigger btn-icon dropdown-toggle"
                                                                   data-bs-toggle="dropdown">
                                                                    <em class="icon ni ni-setting"></em>
                                                                </a>
                                                                <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end">
                                                                    <ul class="link-check">
                                                                        <li><span>{{__("messages.Show")}}</span></li>
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
                                                                               data-formID="sortedDataForm">{{__("messages.All")}}</a>
                                                                        </li>
                                                                    </ul>
                                                                    <ul class="link-check">
                                                                        <li>
                                                                            <span>{{__("messages.Order")}}</span>
                                                                        </li>
                                                                        <li class="{{ (getRequest("order") === "desc") ? "active" : "" }}">
                                                                            <a href="#" class="ButtonOptionInput"
                                                                               data-inputID="ShowOrder"
                                                                               data-inputValue="desc"
                                                                               data-isSubmit="true"
                                                                               data-formID="sortedDataForm">{{__("messages.DESC")}}</a>
                                                                        </li>
                                                                        <li class="{{ (getRequest("order") !== "desc") ? "active" : "" }}">
                                                                            <a href="#" class="ButtonOptionInput"
                                                                               data-inputID="ShowOrder"
                                                                               data-inputValue="asc"
                                                                               data-isSubmit="true"
                                                                               data-formID="sortedDataForm">{{__("messages.ASC")}}</a>
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
                                        <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em
                                                class="icon ni ni-arrow-left"></em></a>
                                        <input type="text" class="form-control border-transparent form-focus-none"
                                               placeholder="{{__("messages.Search by name")}}">
                                        <button type="button" class="search-submit btn btn-icon"><em
                                                class="icon ni ni-search"></em></button>
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
                                        @include('pages.crud.table-header')
                                    </thead>
                                    <tbody>
                                        @include('pages.crud.table-body')
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
        @endif
    @else
        @include("components.errors.404")
    @endif
@endsection

@section("ModalPopup")
    @if($checkCanRead)
        @include('pages.crud.table-modal')
        @yield("modal-section")
    @endif
@endsection

@section("extraScriptsPage")
    @if($checkCanRead)
        {{--  dataTable library  --}}
        <script src="{{ asset("System/assets/js_2/library/fixColumnDatatable.min.js") }}" type="text/javascript"></script>
        <script src="{{ asset("System/assets/js_2/library/datatable-btns.js") }}" type="text/javascript"></script>
        @if(!isset($dataShow))
            {{--  trumbowyg library  --}}
            <script src="{{ asset("System/assets/plugins/trumbowyg/dist/trumbowyg.min.js") }}"
                    type="text/javascript"></script>
            @if(lang(app()->getLocale())->isRTL)
                <script src="{{ asset("System/assets/plugins/trumbowyg/dist/langs/ar.min.js") }}"
                        type="text/javascript"></script>
            @endif
        @endif
    @endif
@endsection
