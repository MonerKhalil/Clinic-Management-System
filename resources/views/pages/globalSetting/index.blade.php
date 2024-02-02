@php
    $IsTextModalExist = false ;
@endphp

@extends("pages.globalSetting.globalPagesSetting" , [
    "dataPass" => $dataPass
])

@section("LibraryCSS-Setting")
    {{-- CSS-Setting Extra --}}
@endsection

@section("ManualCSS-Setting")
    {{-- Manual CSS Extra --}}
@endsection

@section("ContentSideSetting")
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">{{ $dataPass["titlePage"] }}</h4>
                    <div class="nk-block-des">
                        <p>{{ $dataPass["descriptionPage"] }}</p>
                    </div>
                </div>
                <div class="nk-block-head-content align-self-start d-lg-none">
                    <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                </div>
            </div>
        </div>
        <div class="nk-block text-end" id="ToolsPage">
            <a href="#"
               data-bs-toggle="modal" data-bs-target="#company-edit"
               class="btn btn-white btn-outline-light">
                <em class="icon ni ni-edit"></em>
                <span>{{__("messages.Update Data")}}</span>
            </a>
        </div>
        <div class="nk-block" id="infoSetting">
            <div class="nk-data data-list">
                <div class="data-head">
                    <h6 class="overline-title">@lang("messages.basicInfo")</h6>
                </div>
                @foreach($settings as $setting)
                    @php
                        $valueSetting = translationSetting($setting,$setting->is_translation);
                    @endphp
                    <div class="data-item">
                        <div id="{{ $setting["key"] }}" class="data-col">
                            <span class="data-label">{{ "messages.".$setting["key"] }}</span>
                            @if($valueSetting)
                                @if($setting["type"] == "text" || $setting["type"] == "number" || $setting["type"] == "email")
                                    <span class="data-value px-2">{{ $valueSetting }}</span>
                                @elseif($setting["type"] == "password")
                                    <span class="data-value px-2">*****</span>
                                @elseif($setting["type"] == "date")
                                    <span class="data-value px-2">{{ \Carbon\Carbon::parse($valueSetting)->format('d-m-Y , h:m:s') }}</span>
                                @elseif($setting["type"] == "image")
                                    <span class="data-value px-2">
                                        <a class="btn btn-round btn-icon btn-sm btn-info btn-dim popup-image"
                                           href="{{ pathStorage($valueSetting) }}">
                                            <span class="px-1">
                                                {{ __("messages.open_image") }}
                                            </span>
                                        </a>
                                    </span>
                                @elseif($setting["type"] == "file")
                                    <span class="data-value px-2">
                                        <a href="{{ route("download.file") }}?path={{ $valueSetting }}"
                                           target="_blank" class="btn btn-round btn-icon btn-sm btn-primary btn-dim">
                                            <em class="icon ni ni-download"></em>
                                        </a>
                                    </span>
                                @elseif($setting["type"] == "url")
                                    <span class="data-value px-2">
                                        <a href="{{ $valueSetting }}"
                                           target="_blank" class="btn btn-round btn-icon btn-sm btn-primary btn-dim">
                                            <em class="icon ni ni-link"></em>
                                        </a>
                                    </span>
                                @elseif($setting["type"] == "editor")
                                    @php
                                        $IsTextModalExist = true ;
                                    @endphp
                                    <span class="data-value px-2">
                                         <a href="#" class="btn btn-round btn-icon btn-sm btn-info btn-dim"
                                            data-bs-target="#show-text-modal"
                                            data-bs-toggle="modal"
                                            data-header-modal="{{ __("messages.".$setting["key"]) }}"
                                            data-body-modal="{{ $valueSetting }}">
                                            <span class="px-2">{{ __("messages.show") }}</span>
                                        </a>
                                    </span>
                                @endif
                            @else
                                <span class="data-value px-2">-</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section("PopupModalSetting")
    <div class="modal fade" role="dialog" id="company-edit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang("messages.updateCompanySetting")</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <form id="updateSettingData"
                      class="form-validate"
                      enctype="multipart/form-data"
                      action="{{$dataPass["routeEdit"]}}"
                      autocomplete="off"
                      method="post">
                    <div class="modal-body">
                        @csrf
                        @method("put")
                        <input type="hidden" name="local_id"
                               id="langSettingCompany" required
                               value="{{ defaultLang()->id }}">
                        @foreach($settings as $setting)
                            @php
                                $valueSetting = translationSetting($setting,$setting->is_translation);
                            @endphp
                            <div class="form-group">
                                <label class="form-label" for="{{$setting["key"]}}_Update">
                                    @if($setting["is_required"])
                                        <span class="text-danger">*</span>
                                    @endif
                                    {{__("messages.".$setting["key"])}}
                                    @if($setting["is_translation"])
                                        <small class="text-soft">
                                            {{ __("messages.language linked") }}
                                        </small>
                                    @endif
                                </label>
                                @if($setting["type"] == "text" || $setting["type"] == "number"
                                    || $setting["type"] == "email" || $setting["type"] == "url")
                                    <div class="form-control-wrap">
                                        <input type="{{ $setting["type"] }}" class="form-control"
                                               placeholder="{{ __('messages.'.$setting["key"]) }}"
                                               name="{{ $setting["key"] }}" {{ $setting["is_required"] ? "required" : ""}}
                                               value="{{ $valueSetting }}" id="{{$setting["key"]}}_Update">
                                    </div>
                                @elseif($setting["type"] == "password")
                                    <div class="form-control-wrap">
                                        <a href="#" class="form-icon form-icon-right passcode-switch lg"
                                           data-target="{{$setting["key"]}}_Update">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input type="{{ $setting["type"] }}" class="form-control"
                                               {{ $setting["is_required"] ? "required" : "" }}
                                               name="{{ $setting["key"] }}" id="{{$setting["key"]}}_Update"
                                               value="{{ $valueSetting }}"
                                               placeholder="{{ __('messages.Enter_your_password') }}">
                                    </div>
                                @elseif($setting["type"] == "date")
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-left">
                                            <em class="icon ni ni-calendar"></em>
                                        </div>
                                        <input name="{{ $setting["key"] }}" type="{{ $setting["type"] }}"
                                               {{ $setting["is_required"] ? "required" : "" }}
                                               id="{{$setting["key"]}}_Update"
                                               class="form-control date-picker"
                                               data-date-format="yyyy-mm-dd"
                                               placeholder="{{ __('messages.'.$setting["key"]) }}"
                                               value="{{ $valueSetting }}" readonly >
                                    </div>
                                @elseif($setting["type"] == "image")
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="file"
                                                   class="checkSizeImage form-file-input"
                                                   accept="image/png,image/gif,image/jpeg,image/svg,image/jpg"
                                                   data-minSize="1" data-maxSize="256"
                                                   data-root-type-file="image" title=""
                                                   id="{{$setting["key"]}}_Update"
                                                   {{ $setting["is_required"] ? "required" : "" }}
                                                   name="{{ $setting["key"] }}">
                                            <label class="form-file-label"
                                                   for="{{$setting["key"]}}_Update">
                                                @if($valueSetting)
                                                    {{ $valueSetting }}
                                                @else
                                                    @lang("messages.Choose image")
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                @elseif($setting["type"] == "file")
                                    <div class="form-control-wrap">
                                        <div class="form-file">
                                            <input type="{{ $setting["type"] }}"
                                                   class="checkSizeImage form-file-input"
                                                   accept=".xlsx , xlsx , .pdf , pdf"
                                                   data-minSize="1" data-maxSize="10000"
                                                   data-root-type-file="file" title=""
                                                   id="{{$setting["key"]}}_Update"
                                                   {{ $setting["is_required"] ? "required" : "" }}
                                                   name="{{ $setting["key"] }}">
                                            <label class="form-file-label"
                                                   for="{{$setting["key"]}}_Update">
                                                @if($valueSetting)
                                                    {{ $valueSetting }}
                                                @else
                                                    @lang("messages.Choose file")
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                @elseif($setting["type"] == "editor")
                                    <div class="form-control-wrap">
                                        <textarea class="form-control trumbowygEditor"
                                                  name="{{ $setting["key"] }}"
                                                  {{ $setting["is_required"] ? "required" : ""}}
                                                  placeholder="{{ __('messages.'.$setting["key"]) }}"
                                                  id="{{$setting["key"]}}_Update">{!! $valueSetting !!}</textarea>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer bg-light">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                @lang("messages.updateData")
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
@endsection

@section("ScriptSetting")
    {{-- Script Setting --}}
@endsection





































{{--@extends('layouts.master')--}}
{{--@section('content')--}}
{{--    <div class="mt-7">--}}
{{--        @component('components.breadcrumb')--}}
{{--            <span class="text-muted mt-1 tx-13 mr-2 mb-0">--}}
{{--                {{ __('messages.settings') }}--}}
{{--            </span>--}}
{{--        @endcomponent--}}
{{--    </div>--}}
{{--    <!-- row -->--}}
{{--    <div class="row">--}}
{{--        <div class="col-md-12 mb-30">--}}
{{--            <div class="card card-statistics h-100">--}}
{{--                <div class="card-body" style="padding-top: 40px;">--}}
{{--                    <form enctype="multipart/form-data" method="post"--}}
{{--                          class="needs-validation"--}}
{{--                          action="{{route('setting.store')}}">--}}
{{--                        <div class="my-2">--}}
{{--                            @include('alerts.success')--}}
{{--                            @include('alerts.errors')--}}
{{--                            @include('alerts.error')--}}
{{--                        </div>--}}
{{--                        @csrf--}}
{{--                        <div class="row">--}}
{{--                                        LANG             --}}
{{--                            <div class="col-lg-6 form-group">--}}
{{--                                <label for="lang"--}}
{{--                                       class="control-label mb-10">{{__("messages.lang")}}--}}
{{--                                    <span--}}
{{--                                        class="text-danger">*</span>--}}
{{--                                </label>--}}
{{--                                <select class="form-control relation-item" name="local_id"--}}
{{--                                        required>--}}
{{--                                    <option value="">{{__('messages.chose_option')}}</option>--}}
{{--                                    @foreach(allLanguges() as $item)--}}
{{--                                        <option value="{{ $item->id}}">--}}
{{--                                            {{ $item->code }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            @foreach($settings as $setting)--}}
{{--                                @php--}}
{{--                                    $valueSetting = translationSetting($setting,$setting->is_translation);--}}
{{--                                @endphp--}}
{{--                                @if($setting->type == "image")--}}
{{--                                    <div class="col-lg-6 form-group">--}}
{{--                                        <label class="control-label mb-10">--}}
{{--                                            {{__('messages.'.$setting->key)}}--}}
{{--                                            @if($setting->is_required)--}}
{{--                                                <span--}}
{{--                                                    class="text-danger">*</span>--}}
{{--                                            @endif--}}
{{--                                        </label>--}}
{{--                                        <div class="input-group mb-3">--}}
{{--                                            <div class="custom-file">--}}
{{--                                                <input id="{{$setting->key}}"--}}
{{--                                                       accept="image/*" type="file"--}}
{{--                                                       name="{{$setting->key}}"--}}
{{--                                                       data-show-caption="false"--}}
{{--                                                       placeholder="{{__('messages.'.$setting->key)}}"--}}
{{--                                                       data-show-upload="false" data-fouc--}}
{{--                                                       class="InputFileBS custom-file-input"--}}
{{--                                                    {{$setting->is_required ? "required" : ""}}--}}
{{--                                                >--}}
{{--                                                <label class="custom-file-label" for="{{$setting->key}}">--}}
{{--                                                    @lang("messages.chooseFile")--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="mb-3">--}}
{{--                                            @if(is_null($valueSetting))--}}
{{--                                                <img style="width: 100px" height="100px"--}}
{{--                                                     src="{{asset("assets/img/default.jpg")}}" alt="">--}}
{{--                                            @else--}}
{{--                                                <img style="width: 100px" height="100px"--}}
{{--                                                     src="{{pathStorage($valueSetting)}}"--}}
{{--                                                     alt="">--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @elseif($setting->type == "password")--}}
{{--                                    <div class="col-lg-6 form-group">--}}
{{--                                        <label for="{{$setting->key}}"--}}
{{--                                               class="control-label mb-10">--}}
{{--                                            {{ __('messages.'.$setting->key) }}--}}
{{--                                            @if($setting->is_required)--}}
{{--                                                <span--}}
{{--                                                    class="text-danger">*</span>--}}
{{--                                            @endif--}}
{{--                                        </label>--}}
{{--                                        <input id="{{$setting->key}}" name="{{$setting->key}}"--}}
{{--                                               value="{{ $valueSetting }}" type="password" {{$setting->is_required ? "required" : ""}}--}}
{{--                                               class="form-control" placeholder="{{ __('messages.'.$setting->key) }}">--}}
{{--                                    </div>--}}
{{--                                @elseif($setting->type == "date")--}}
{{--                                    <div class="col-lg-6 form-group">--}}
{{--                                        <label for="{{$setting->key}}"--}}
{{--                                               class="control-label mb-10">--}}
{{--                                            {{ __('messages.'.$setting->key) }}--}}
{{--                                            @if($setting->is_required)--}}
{{--                                                <span--}}
{{--                                                    class="text-danger">*</span>--}}
{{--                                            @endif--}}
{{--                                        </label>--}}
{{--                                        <input id="{{$setting->key}}" name="{{$setting->key}}"--}}
{{--                                               value="{{ $valueSetting }}" type="date" {{$setting->is_required ? "required" : ""}}--}}
{{--                                               class="form-control" placeholder="{{ __('messages.'.$setting->key) }}">--}}
{{--                                    </div>--}}
{{--                                @elseif($setting->type == "file")--}}
{{--                                    <div class="col-lg-6 form-group">--}}
{{--                                        <label class="control-label mb-10">--}}
{{--                                            {{__('messages.'.$setting->key)}}--}}
{{--                                            @if($setting->is_required)--}}
{{--                                                <span--}}
{{--                                                    class="text-danger">*</span>--}}
{{--                                            @endif--}}
{{--                                        </label>--}}
{{--                                        <div class="input-group mb-3">--}}
{{--                                            <div class="custom-file">--}}
{{--                                                <input id="{{$setting->key}}"--}}
{{--                                                       accept="image/*" type="file"--}}
{{--                                                       name="{{$setting->key}}"--}}
{{--                                                       data-show-caption="false"--}}
{{--                                                       placeholder="{{__('messages.'.$setting->key)}}"--}}
{{--                                                       data-show-upload="false" data-fouc--}}
{{--                                                       class="InputFileBS custom-file-input"--}}
{{--                                                    {{$setting->is_required ? "required" : ""}}--}}
{{--                                                >--}}
{{--                                                <label class="custom-file-label" for="{{$setting->key}}">--}}
{{--                                                    @lang("messages.chooseFile")--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="mb-3">--}}
{{--                                            @if(is_null($valueSetting))--}}
{{--                                                <img style="width: 100px" height="100px"--}}
{{--                                                     src="{{asset("assets/img/default.jpg")}}" alt="">--}}
{{--                                            @else--}}
{{--                                                <form></form>--}}
{{--                                                <form id="download{{ $setting->key }}" name="download{{ $setting->key }}" method="get"--}}
{{--                                                      action="{{ route("download.file") }}">--}}
{{--                                                    <input type="hidden" name="path" value="{{ $valueSetting }}"--}}
{{--                                                           form="download{{ $setting->key }}">--}}
{{--                                                    <button type="submit" form="download{{ $setting->key }}">download</button>--}}
{{--                                                </form>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @elseif($setting->type == "number")--}}
{{--                                    <div class="col-lg-6 form-group">--}}
{{--                                        <label for="{{$setting->key}}"--}}
{{--                                               class="control-label mb-10">--}}
{{--                                            {{ __('messages.'.$setting->key) }}--}}
{{--                                            @if($setting->is_required)--}}
{{--                                                <span--}}
{{--                                                    class="text-danger">*</span>--}}
{{--                                            @endif--}}
{{--                                        </label>--}}
{{--                                        <input id="{{$setting->key}}" name="{{$setting->key}}"--}}
{{--                                               value="{{ $valueSetting }}" type="number" {{$setting->is_required ? "required" : ""}}--}}
{{--                                               class="form-control" placeholder="{{ __('messages.'.$setting->key) }}">--}}
{{--                                    </div>--}}
{{--                                @elseif($setting->type == "url")--}}
{{--                                    <div class="col-lg-6 form-group">--}}
{{--                                        <label for="{{$setting->key}}"--}}
{{--                                               class="control-label mb-10">--}}
{{--                                            {{ __('messages.'.$setting->key) }}--}}
{{--                                            @if($setting->is_required)--}}
{{--                                                <span--}}
{{--                                                    class="text-danger">*</span>--}}
{{--                                            @endif--}}
{{--                                        </label>--}}
{{--                                        <input id="{{$setting->key}}" name="{{$setting->key}}"--}}
{{--                                               value="{{ $valueSetting }}" type="url" {{$setting->is_required ? "required" : ""}}--}}
{{--                                               class="form-control" placeholder="{{ __('messages.'.$setting->key) }}">--}}
{{--                                    </div>--}}
{{--                                @elseif($setting->type == "email")--}}
{{--                                    <div class="col-lg-6 form-group">--}}
{{--                                        <label for="{{$setting->key}}"--}}
{{--                                               class="control-label mb-10">--}}
{{--                                            {{ __('messages.'.$setting->key) }}--}}
{{--                                            @if($setting->is_required)--}}
{{--                                                <span--}}
{{--                                                    class="text-danger">*</span>--}}
{{--                                            @endif--}}
{{--                                        </label>--}}
{{--                                        <input id="{{$setting->key}}" name="{{$setting->key}}"--}}
{{--                                               value="{{ $valueSetting }}" type="email" {{$setting->is_required ? "required" : ""}}--}}
{{--                                               class="form-control" placeholder="{{ __('messages.'.$setting->key) }}">--}}
{{--                                    </div>--}}
{{--                                @elseif($setting->type == "editor")--}}
{{--                                    <div class="col-12 form-group">--}}
{{--                                        <label class="control-label mb-10" for="{{$setting->key}}">--}}
{{--                                            {{ __('messages.'.$setting->key) }}--}}
{{--                                            @if($setting->is_required)--}}
{{--                                                <span--}}
{{--                                                    class="text-danger">*</span>--}}
{{--                                            @endif--}}
{{--                                        </label>--}}
{{--                                        <textarea name="{{$setting->key}}" id="{{$setting->key}}"--}}
{{--                                                  class="form-control editor required" rows="4" {{$setting->is_required ? "required" : ""}} >--}}
{{--                                            {{ $valueSetting }}--}}
{{--                                        </textarea>--}}
{{--                                    </div>--}}
{{--                                @else--}}
{{--                                    <div class="col-lg-6 form-group">--}}
{{--                                        <label for="{{$setting->key}}"--}}
{{--                                               class="control-label mb-10">--}}
{{--                                            {{ __('messages.'.$setting->key) }}--}}
{{--                                            @if($setting->is_required)--}}
{{--                                                <span--}}
{{--                                                    class="text-danger">*</span>--}}
{{--                                            @endif--}}
{{--                                        </label>--}}
{{--                                        <input id="{{$setting->key}}" name="{{$setting->key}}"--}}
{{--                                               value="{{ $valueSetting }}" type="text" {{$setting->is_required ? "required" : ""}}--}}
{{--                                               class="form-control" placeholder="{{ __('messages.'.$setting->key) }}">--}}
{{--                                    </div>--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </div>--}}
{{--                        <hr>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-12">--}}
{{--                                <button class="btn btn-success nextBtn btn-lg pull-right" type="submit">--}}
{{--                                    {{ __('app.Update') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <!-- row closed -->--}}
{{--@endsection--}}
{{--@section('js')--}}
{{--    <script src="{{asset('assets/custom/script.js')}}"></script>s--}}
{{--    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}" defer></script>--}}
{{--@endsection--}}
