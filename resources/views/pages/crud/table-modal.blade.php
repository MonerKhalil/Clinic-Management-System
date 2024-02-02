@php
    $checkCanForceDelete = userHasPermission("force_delete_{$fields['config']['table']}") || userHasPermission("all_{$fields['config']['table']}");
    $checkCanDelete = userHasPermission("delete_{$fields['config']['table']}") || userHasPermission("all_{$fields['config']['table']}");
    $checkCanImportExcel = userHasPermission("import_{$fields['config']['table']}") || userHasPermission("all_{$fields['config']['table']}") ;
    $IsTextModalExist = false ;
    if(isset($dataShow)) {
        foreach(ignoreFieldsShow($fields) as $field => $type) {
             if (is_string($type)) {
                $type = explode('|' , $type);
                $tempType = $type[0];
                unset($type[0]);
                $validation = isset($type[1]) ? implode(" ",$type) : '';
                $type = $tempType;
            } else {
                $validation = '';
            }
             if($type == 'editor') {
                $IsTextModalExist = true ;
                break ;
            }
        }
    } else {
        foreach ($data as $key => $item) {
            foreach(ignoreFieldsShow($fields) as $field => $type) {
                 if (is_string($type)) {
                    $type = explode('|' , $type);
                    $tempType = $type[0];
                    unset($type[0]);
                    $validation = isset($type[1]) ? implode(" ",$type) : '';
                    $type = $tempType;
                } else {
                    $validation = '';
                }
                 if($type == 'editor') {
                    $IsTextModalExist = true ;
                    break ;
                }
            }
        }
    }
@endphp

@if(!isset($dataShow))
    @if(!(isset($hiddenElement) && in_array("ImportByExcel", $hiddenElement)))
        @if($checkCanImportExcel)
            <div class="modal fade" id="import-new-model">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('messages.importModel') }}</h5>
                            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <em class="icon ni ni-cross"></em>
                            </a>
                        </div>
                        <form action="{{route($route['import'])}}" method='post'
                              enctype="multipart/form-data"
                              class="form-validate">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="form-label">Excel File</label>
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file" class="checkSizeImage form-file-input"
                                                   accept=".xlsx , xlsx" title=""
                                                   data-root-type-file="file"
                                                   data-minSize="1" data-maxSize="10000"
                                                   id="ExcelFile" name="file" required>
                                            <label class="form-file-label" for="ExcelFile">@lang("messages.Choose file")</label>
                                        </div>
                                        @if(Errors("file"))
                                            <label id="file-error" class="invalid" for="ExcelFile">
                                                {{ Errors("file") }}
                                            </label>
                                        @endif
                                    </div>
                                    <label for="customFile" class="text-soft my-1">
                                        <small>
                                            @lang("messages.note_excel")
                                        </small>
                                    </label>
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Upload File</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endif

@if($IsTextModalExist)
    <div class="modal fade" id="show-text-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{-- {{ __($field) }} --}}
                    </h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    {{-- {{ $item->{$field} }} --}}
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-secondary text-uppercase"
                       data-bs-dismiss="modal">{{ __("messages.ok") }}</a>
                </div>
            </div>
        </div>
    </div>
@endif

@if($checkCanDelete)
    <div class="modal fade" id="show-delete-modal">
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
                        <form action="" method="post">
                            @csrf
                            @method('delete')
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
@endif

@if($checkCanForceDelete)
    <div class="modal fade" id="show-forceDelete-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-lg text-center">
                    <div class="nk-modal">
                        <em class="nk-modal-icon icon icon-circle icon-circle-xxl ni ni-cross bg-danger"></em>
                        <h4 class="nk-modal-title">
                            {{ __('DeleteInfo_Force') }} : Sure About That!
                        </h4>
                        <div class="nk-modal-text">
                            <p class="lead">
                                {{__('messages.areYouSure')}}
                            </p>
                        </div>
                        <form action="" method="post">
                            @csrf
                            @method('delete')
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
@endif

@if(!isset($dataShow))
    <div class="modal fade" id="filter-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__("messages.Filter Data")}}</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <form id="FilterForm"
                      class="form-validate"
                      action="#" method="get">
                    <div class="modal-body">
                        <div class="VisibilityOption form-group"
                             data-ElementsTargetName="DateFilter"
                             @if(checkIfFiledHasFilter('year'))
                             data-VisibilityDefault="1"
                             @elseif(checkIfFiledHasFilter('start_date') || checkIfFiledHasFilter('end_date'))
                             data-VisibilityDefault="2"
                            @endif>
                            <label class="form-label" for="ChooseConstant_Filter">
                                {{__("messages.choose_constant_filter")}}
                            </label>
                            <select id="ChooseConstant_Filter" class="form-select js-select2"
                                    data-placeholder="{{__('messages.filterBy')}}">
                                <option value="">{{__('messages.filterBy')}}</option>
                                <option value="1" {{ checkIfFiledHasFilter('year') ? "selected" : "" }} >
                                    {{__('messages.filterByYear')}}
                                </option>
                                <option value="2" {{ (checkIfFiledHasFilter('start_date') || checkIfFiledHasFilter('end_date')) ? "selected" : "" }}>
                                    {{__('messages.filterByDate')}}
                                </option>
                            </select>
                        </div>
                        <div class="VisibilityTarget form-group"
                             data-TargetName="DateFilter"
                             data-TargetValue="1">
                            <label class="form-label" for="YearConstant_Filter">
                                {{__("messages.year_constant_filter")}}
                            </label>
                            <input name="year" type="number"
                                   placeholder="{{__('messages.year_constant_filter')}}"
                                   value="{{checkIfFiledHasFilter('year')}}"
                                   class="form-control" id="YearConstant_Filter">
                        </div>
                        <div class="VisibilityTarget form-group"
                             data-TargetName="DateFilter"
                             data-TargetValue="2">
                            <label class="form-label" for="StartDateConstant_Filter">
                                {{__("messages.start_date_constant_filter")}}
                            </label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left">
                                    <em class="icon ni ni-calendar"></em>
                                </div>
                                <input name="start_date" type="date" readonly
                                       data-date-format="yyyy-mm-dd"
                                       placeholder="{{__('messages.start_date_constant_filter')}}"
                                       value="{{checkIfFiledHasFilter('start_date')}}" data-DateName="startDateFilter"
                                       class="form-control date-picker startDateCustom" id="StartDateConstant_Filter">
                            </div>
                        </div>
                        <div class="VisibilityTarget form-group"
                             data-TargetName="DateFilter"
                             data-TargetValue="2">
                            <label class="form-label" for="EndDateConstant_Filter">
                                {{__("messages.end_date_constant_filter")}}
                            </label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left">
                                    <em class="icon ni ni-calendar"></em>
                                </div>
                                <input name="end_date" type="date" readonly
                                       data-date-format="yyyy-mm-dd"
                                       placeholder="{{__('messages.end_date_constant_filter')}}"
                                       value="{{checkIfFiledHasFilter('end_date')}}"
                                       data-DateName="startDateFilter"
                                       class="form-control date-picker endDateCustom" id="EndDateConstant_Filter">
                            </div>
                        </div>
                        @foreach(ignoreFromSearch($fields) as $field => $type)
                            @php
                                if (is_string($type)){
                                    $type = explode('|' , $type);
                                    $validation = $type[1] ?? '';
                                    $type = $type[0];
                                }else{
                                    $validation = '';
                                }
                            @endphp
                            <div class="form-group">
                                @if($type !== 'file' && $type !== 'image')
                                    <label class="form-label" for="{{$field}}_Filter">
                                        {{__("messages.$field")}}
                                    </label>
                                @endif
                                @if($type !== 'file' && !is_array($type) && $type !=='image' && $field!=='is_active')
                                    @if($type === "editor")
                                        <div class="form-control-wrap">
                                        <textarea class="form-control trumbowygEditor"
                                                  name="filter[{{$field}}]"
                                                  id="{{$field}}_Filter">{{checkIfFiledHasFilter($field)}}</textarea>
                                        </div>
                                    @else
                                        <div class="form-control-wrap">
                                            <input type="text" name="filter[{{$field}}]"
                                                   placeholder="{{__("messages.$field")}}"
                                                   value="{{checkIfFiledHasFilter($field)}}"
                                                   class="form-control" id="{{$field}}_Filter">
                                        </div>
                                    @endif
                                @elseif (is_array($type) && isset($type['relation']))
                                    <div class="form-control-wrap">
                                        <select id="{{$field}}_Filter" name="filter[{{$field}}]"
                                                class="form-select js-select2">
                                            <option value=""></option>
                                            @foreach(fetchModel($type['relation']['model']) as $item)
                                                <option {{checkIfFiledHasFilter($field,$item->{$type['relation']['key']}) ? 'selected' : ''}}
                                                        value="{{ $item->{$type['relation']['key']} }}">
                                                    {{ $item->{$type['relation']['value']} }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @elseif(is_array($type) && isset($type['select']))
                                    <div class="form-control-wrap">
                                        <select id="{{$field}}_Filter" name="filter[{{$field}}]"
                                                class="form-select js-select2">
                                            <option value=""></option>
                                            @foreach($type['select'] as $item)
                                                <option {{checkIfFiledHasFilter($field,$item) ? 'selected' : ''}}
                                                        value="{{ $item }}">
                                                    {{ __("messages.$item") }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer bg-light">
                        <div class="form-group">
                            <button type="submit" formaction="{{route($route['index'])}}"
                                    class="btn btn-primary">{{__("messages.Filter Data")}}</button>
                            <button type="button" class="btn btn-secondary RestFormButton">{{__("messages.Clear Filter")}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
