@php
    $checkCanUpdate = userHasPermission("update_{$fields['config']['table']}") || userHasPermission("all_{$fields['config']['table']}");
    $isHaveEditor = false ;
    $isHaveFile = false ;
@endphp

@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    <link rel="stylesheet" href='{{ asset('System/assets/css/trumbowyg-custom.css') }}'
          type="text/css"/>
@endsection

@section("CSSExtraPage")

@endsection

@section("ContentPage")
    @if($checkCanUpdate)
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
                        <form id="crud_update" action="{{ route($route['update'], $data->id) }}" method="post"
                              class="form-validate" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('put')
                            @if(isObjTrans($data))
                                <div class="card-title-group">
                                    <span
                                        class="preview-title-lg overline-title pb-0">{{__("messages.Edit Data")}}</span>
                                    <div class="form-wrap w-100px">
                                        <select class="SelectLanguageUpdate form-select js-select2"
                                                data-search="on" data-json="{{ $data }}" id="langCrud"
                                                data-form-id="crud_update" name="local_id"
                                                data-json-key-def='{ "TransKey" : "translation" }'
                                                data-placeholder="Language Select">
                                            @foreach(allLanguges() as $item)
                                                <option value="{{ $item->id }}" {{ ($item->id == defaultLang()->id) ? "selected" : "" }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <span class="preview-title-lg overline-title">{{__("messages.Edit Data")}}</span>
                            @endif
                            <hr class="preview-hr">
                            <div class="row gy-4">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label" for="role_Update">
                                            <span class="text-danger">*</span>
                                            {{__("messages.role")}}
                                        </label>
                                        <div class="form-control-wrap">
                                            <select name="role" id="role_Update"
                                                    required class="form-select js-select2">
                                                <option value="">{{__('messages.chose_option')}}</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->name}}" {{ $data->role == $role->name ? "selected" : ""}}>
                                                        {{$role->display_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if(Errors("role"))
                                                <label id="role-error" class="invalid"
                                                       for="role">
                                                    {{ Errors("role") }}
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @foreach(ignoreFieldsUpdate($fields) as $field => $type)
                                    @php
                                        if (is_string($type)) {
                                            $type = explode('|' , $type);
                                            $tempType = $type[0];
                                            unset($type[0]);
                                            $validation = isset($type[1]) ? implode(" ",$type) : '';
                                            $type = $tempType;
                                        }else{
                                            $validation = '';
                                        }
                                    @endphp
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" for="{{$field}}_Update">
                                                @if(checkIfValidationRequired($validation,$type))
                                                    <span class="text-danger">*</span>
                                                @endif
                                                {{__("messages.$field")}}
                                                @if(isObjTrans($data))
                                                    @foreach($data->attributesTranslations() as $langItem)
                                                        @if($langItem == $field)
                                                            <small class="text-soft">
                                                                {{ __("messages.language linked") }}
                                                            </small>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </label>
                                            @if($type !== 'file')
                                                @if ($type == 'editor')
                                                    @php
                                                        $isHaveEditor = true ;
                                                    @endphp
                                                    <div class="form-control-wrap">
                                                        <textarea class="form-control trumbowygEditor"
                                                                  name="{{$field}}" {!! $validation !!}
                                                                  id="{{$field}}_Update">{{checkObjectInstanceofTranslation($data,$field)}}</textarea>
                                                        @if(Errors($field))
                                                            <label id="{{ $field }}-error" class="invalid"
                                                                   for="{{ $field }}">
                                                                {{ Errors($field) }}
                                                            </label>
                                                        @endif
                                                    </div>
                                                @elseif (is_array($type) && isset($type['relation']))
                                                    <div class="form-control-wrap">
                                                        <select name="{{$field}}" id="{{$field}}_Update"
                                                                {{ $type['relation']['validation'] ?? '' }}
                                                                class="form-select js-select2">
                                                            <option value="">{{__('messages.chose_option')}}</option>
                                                            @foreach(fetchModel($type['relation']['model']) as $item)
                                                                @php
                                                                    $valueRelation = checkObjectInstanceofTranslation($item,$type['relation']['key']);
                                                                    $isSelected = checkObjectInstanceofTranslation($data->{$type['relation']['relationFunc']},$type['relation']['key']) == $valueRelation
                                                                    ? "selected" : "";
                                                                @endphp
                                                                <option
                                                                    value="{{ $valueRelation }}" {{ $isSelected }}>
                                                                    {{ checkObjectInstanceofTranslation($item,$type['relation']['value']) }}
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
                                                        <select name="{{$field}}" {{$type[0] ?? ''}}
                                                        id="{{$field}}_Update" class="form-select js-select2">
                                                            <option value="">{{__('messages.chose_option')}}</option>
                                                            @foreach($type['select'] as $item)
                                                                <option value="{{$item}}"
                                                                    {{$item == $data->{$field} ? 'selected' : ''}}>
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
                                                                <input type="file"
                                                                       class="checkSizeImage form-file-input"
                                                                       accept="image/png,image/gif,image/jpeg,image/svg,image/jpg"
                                                                       data-minSize="1" title=""
                                                                       data-maxSize="256"
                                                                       name="{{$field}}" id="{{$field}}_Update"
                                                                       {{-- {!! $validation !!} --}}
                                                                       value="">
                                                                <label class="form-file-label" for="{{$field}}_Update">
                                                                    {{ __("messages.there_image_exist") }}
                                                                </label>
                                                            </div>
                                                            @if(Errors($field))
                                                                <label id="{{ $field }}-error" class="invalid"
                                                                       for="{{ $field }}">
                                                                    {{ Errors($field) }}
                                                                </label>
                                                            @endif
                                                        </div>
                                                        <label for="{{$field}}_Update" class="form-note my-1">
                                                            <small>
                                                                {{__("messages.note_image")}}
                                                            </small>
                                                        </label>
                                                    @elseif($type=='date')
                                                        <div class="form-control-wrap">
                                                            <input type="date" class="form-control date-picker"
                                                                   data-date-format="yyyy-mm-dd"
                                                                   {!! $validation !!} name="{{$field}}"
                                                                   readonly value="{{ $data->{$field} }}"
                                                                   id="{{$field}}_Update">
                                                            @if(Errors($field))
                                                                <label id="{{ $field }}-error" class="invalid"
                                                                       for="{{ $field }}">
                                                                    {{ Errors($field) }}
                                                                </label>
                                                            @endif
                                                        </div>
                                                    @elseif($type == "password")
                                                        <div class="form-control-wrap">
                                                            <a href="#"
                                                               class="form-icon form-icon-right passcode-switch lg"
                                                               data-target="{{$field}}_Update">
                                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                                            </a>
                                                            <input type="password" class="form-control form-control-lg"
                                                                   name="{{$field}}"
                                                                   {!! $validation !!} id="{{$field}}_Update"
                                                                   value="{{checkIfFiledHasFilter($field)}}">
                                                            @if(Errors($field))
                                                                <label id="{{ $field }}-error" class="invalid"
                                                                       for="{{ $field }}">
                                                                    {{ Errors($field) }}
                                                                </label>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="form-control-wrap">
                                                            <input type="{{$type}}" class="form-control"
                                                                   {!! $validation !!} name="{{$field}}"
                                                                   value="{{checkObjectInstanceofTranslation($data,$field)}}"
                                                                   id="{{$field}}_Update">
                                                            @if(Errors($field))
                                                                <label id="{{ $field }}-error" class="invalid"
                                                                       for="{{ $field }}">
                                                                    {{ Errors($field) }}
                                                                </label>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endif
                                            @elseif ($type === 'file')
                                                @php
                                                    $isHaveFile = true ;
                                                @endphp
                                                <div class="form-control-wrap">
                                                    <div class="form-file">
                                                        <input type="file" class="checkSizeImage form-file-input"
                                                               accept=".pdf , pdf" data-minSize="1"
                                                               data-maxSize="10000" name="{{$field}}"
                                                               id="{{$field}}_Update"
                                                               value="{{ $data->{$field} ?? "" }}">
                                                        <label class="form-file-label"
                                                               for="{{$field}}_Update">{{ __('messages.Choose file') }}</label>
                                                    </div>
                                                    @if(Errors($field))
                                                        <label id="{{ $field }}-error" class="invalid"
                                                               for="{{ $field }}">
                                                            {{ Errors($field) }}
                                                        </label>
                                                    @endif
                                                </div>
                                                <label for="{{$field}}_Update" class="form-note my-1">
                                                    <small>
                                                        {{ __("messages.note_pdf") }}
                                                    </small>
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr class="preview-hr">
                            <div class="row gy-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit"
                                                class="btn btn-lg btn-primary">{{__("messages.Update Information")}}</button>
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
    @endif
    @if($isHaveFile)
        {{--  Media Manager Component  --}}
        <script src="{{ asset("System/assets/js/custom/pages/media-manager.js") }}" type="text/javascript"></script>
    @endif
@endsection
