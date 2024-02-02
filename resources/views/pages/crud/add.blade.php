@php
    $TableName = $fields['config']['table'] ;
    $checkCanCreate = userHasPermission("create_".$TableName) || userHasPermission("all_".$TableName) ;
    $isHaveEditor = false ;
    $isHaveFile = false ;
@endphp

@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    <link rel="stylesheet" href='{{ asset('System/assets/css/trumbowyg-custom.css') }}'
          type="text/css"/>
@endsection

@section("CSSExtraPage")
    {{--  Extra Manual CSS  --}}
@endsection

@section("ContentPage")
    @if($checkCanCreate)
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
        <div class="nk-block nk-block-lg">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="preview-block">
                        <form id="crud_add" action="{{ route($route["store"]) }}" method="post"
                              class="form-validate" enctype="multipart/form-data">
                            @csrf
                            <span class="preview-title-lg overline-title">
                                {{__('messages.Add New Data')}}
                            </span>
                            <div class="row gy-4">
                                @foreach(ignoreFieldsCreate($fields) as $field => $type)
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            @php
                                                if (is_string($type)){
                                                    $type = explode('|' , $type);
                                                    $tempType = $type[0];
                                                    unset($type[0]);
                                                    $validation = isset($type[1]) ? implode(" ",$type) : '';
                                                    $type = $tempType;
                                                }else{
                                                    $validation = '';
                                                }
                                            @endphp
                                            @if(!is_array($type) || !isset($type['table']))
                                                <label class="form-label" for="{{$field}}_Add">
                                                    {{__("messages.$field")}}
                                                    @if(checkIfValidationRequired($validation,$type))
                                                        <span class="text-danger">*</span>
                                                    @endif
                                                </label>
                                            @endif
                                            @if($type == 'editor')
                                                @php
                                                    $isHaveEditor = true ;
                                                @endphp
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control trumbowygEditor"
                                                              name="{{$field}}" {!! $validation !!}
                                                              id="{{$field}}_Add">{{checkIfFiledHasFilter($field)}}</textarea>
                                                    @if(Errors($field))
                                                        <label id="{{ $field }}-error" class="invalid"
                                                               for="{{ $field }}">
                                                            {{ Errors($field) }}
                                                        </label>
                                                    @endif
                                                </div>
                                            @elseif (is_array($type) && isset($type['relation']))
                                                <div class="form-control-wrap">
                                                    <select id="{{$field}}_Add" name="{{$field}}"
                                                            {{ isset($type['relation']['validation']) ? $type['relation']['validation'] : '' }}
                                                            {{checkIfFiledHasFilter($field) != '' ? 'selected' : ''}}
                                                            class="form-select js-select2">
                                                        <option value="">{{__('messages.chose_option')}}</option>
                                                        @foreach(fetchModel($type['relation']['model']) as $item)
                                                            <option value="{{ $item->{$type['relation']['key']} }}">
                                                                {{ $item->{$type['relation']['value']} }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if(Errors($field))
                                                        <label id="{{ $field }}-error" class="invalid"
                                                               for="{{ $field }}">
                                                            {{ Errors($field) }}
                                                        </label>
                                                    @endif
                                                </div>
                                            @elseif (is_array($type) && isset($type['select']))
                                                <div class="form-control-wrap">
                                                    <select id="{{$field}}_Add" name="{{$field}}"
                                                            {{$type[0] ?? ''}}
                                                            {{checkIfFiledHasFilter($field) != '' ? 'selected' : ''}}
                                                            class="form-select js-select2">
                                                        <option value="">{{__('messages.chose_option')}}</option>
                                                        @foreach($type['select'] as $item)
                                                            <option value="{{$item}}">
                                                                {{__('messages.'.$item)}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if(Errors($field))
                                                        <label id="{{ $field }}-error" class="invalid"
                                                               for="{{ $field }}">
                                                            {{ Errors($field) }}
                                                        </label>
                                                    @endif
                                                </div>
                                            @elseif(!is_array($type))
                                                @if($type=='image')
                                                    @php
                                                        $isHaveFile = true ;
                                                    @endphp
                                                    <div class="form-control-wrap">
                                                        <div class="form-file">
                                                            <input type="file" class="checkSizeImage form-file-input"
                                                                   name="{{$field}}" title=""
                                                                   {!! $validation !!} value="{{checkIfFiledHasFilter($field)}}"
                                                                   accept="image/png,image/gif,image/jpeg,image/svg,image/jpg"
                                                                   data-minSize="1" data-maxSize="256"
                                                                   data-root-type-file="image"
                                                                   id="{{$field}}_Add">
                                                            <label class="form-file-label"
                                                                   for="{{$field}}_Add">{{ __('messages.Choose image') }}</label>
                                                        </div>
                                                        @if(Errors($field))
                                                            <label id="{{ $field }}-error" class="invalid"
                                                                   for="{{ $field }}">
                                                                {{ Errors($field) }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                    <label for="{{$field}}_Add" class="form-note my-1">
                                                        <small>
                                                            {{__("messages.note_image")}}
                                                        </small>
                                                    </label>
                                                @else
                                                    @if($type == "password")
                                                        <div class="form-control-wrap">
                                                            <a href="#"
                                                               class="form-icon form-icon-right passcode-switch lg"
                                                               data-target="{{$field}}_Add">
                                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                            </a>
                                                            <input type="password" class="form-control form-control-lg"
                                                                   name="{{$field}}"
                                                                   {!! $validation !!} id="{{$field}}_Add"
                                                                   value="{{checkIfFiledHasFilter($field)}}">
                                                            @if(Errors($field))
                                                                <label id="{{ $field }}-error" class="invalid"
                                                                       for="{{ $field }}">
                                                                    {{ Errors($field) }}
                                                                </label>
                                                            @endif
                                                        </div>
                                                    @elseif ($type === "date")
                                                        <div class="form-control-wrap">
                                                            <input type="date" class="form-control date-picker"
                                                                   data-date-format="yyyy-mm-dd"
                                                                   {!! $validation !!} name="{{$field}}"
                                                                   readonly value="{{ checkIfFiledHasFilter($field) }}"
                                                                   id="{{$field}}_Add">
                                                            @if(Errors($field))
                                                                <label id="{{ $field }}-error" class="invalid"
                                                                       for="{{ $field }}">
                                                                    {{ Errors($field) }}
                                                                </label>
                                                            @endif
                                                        </div>
                                                    @elseif($type === "file")
                                                        @php
                                                            $isHaveFile = true ;
                                                        @endphp
                                                        <div class="form-control-wrap">
                                                            <div class="form-file">
                                                                <input type="file"
                                                                       class="checkSizeImage form-file-input"
                                                                       name="{{$field}}" title=""
                                                                       {!! $validation !!} value="{{checkIfFiledHasFilter($field)}}"
                                                                       accept=".pdf , pdf"
                                                                       data-minSize="1" data-maxSize="10000"
                                                                       data-root-type-file="file"
                                                                       id="{{$field}}_Add">
                                                                <label class="form-file-label"
                                                                       for="{{$field}}_Add">{{ __('messages.Choose file') }}</label>
                                                            </div>
                                                            @if(Errors($field))
                                                                <label id="{{ $field }}-error" class="invalid"
                                                                       for="{{ $field }}">
                                                                    {{ Errors($field) }}
                                                                </label>
                                                            @endif
                                                        </div>
                                                        <label for="{{$field}}_Add" class="form-note my-1">
                                                            <small>
                                                                {{__("messages.note_pdf")}}
                                                            </small>
                                                        </label>
                                                    @else
                                                        <div class="form-control-wrap">
                                                            <input type="{{$type}}" class="form-control"
                                                                   {!! $validation !!} name="{{$field}}"
                                                                   value="{{checkIfFiledHasFilter($field)}}"
                                                                   id="{{$field}}_Add">
                                                            @if(Errors($field))
                                                                <label id="{{ $field }}-error" class="invalid"
                                                                       for="{{ $field }}">
                                                                    {{ Errors($field) }}
                                                                </label>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                @yield("fields-extra-section")
                            </div>
                            <hr class="preview-hr">
                            <div class="row gy-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit"
                                                class="btn btn-lg btn-primary">{{__("messages.Add Information")}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include("components.errors.404")
    @endif
@endsection

@section("ModalPopup")
    {{--  Modal Additinal  --}}
    @include("components.myComponent.modal-media-manager")
@endsection

@section("extraScriptsPage")
    @if($isHaveEditor)
        {{--  trumbowyg library  --}}
        <script src="{{ asset("System/assets/plugins/trumbowyg/dist/trumbowyg.min.js") }}" type="text/javascript"></script>
        @if(lang(app()->getLocale())->isRTL)
            <script src="{{ asset("System/assets/plugins/trumbowyg/dist/langs/ar.min.js") }}"
                    type="text/javascript"></script>
        @endif
        <script src="{{ asset("System/assets/js_2/tools/customTrumbowygUpload.js") }}" type="text/javascript"></script>
    @endif
    @if($isHaveFile)
        {{--  Media Manager Component  --}}
        <script src="{{ asset("System/assets/js_2/pages/media-manager.js") }}" type="text/javascript"></script>
    @endif
    @yield("script-extra-section")
@endsection
