@php
    $checkCanUpdate = userHasPermission("update_{$fields['config']['table']}") || userHasPermission("all_{$fields['config']['table']}");
@endphp

@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    {{--  Extra Library CSS  --}}
@endsection

@section("CSSExtraPage")
    {{--  Extra Manual CSS  --}}
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
        <div class="nk-block nk-block-lg">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="preview-block">
                        <form id="crud_update" action="#" method="post"
                              class="form-validate" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('put')
                            @if(isObjTrans($data)) {{-- Data What is get from back-end --}}
                                <div class="card-title-group">
                                    <span class="preview-title-lg overline-title pb-0">Edit Data</span>
                                    <div class="form-wrap w-100px">
                                        <select class="SelectLanguageUpdate form-select js-select2"
                                                data-json="{{ $data->translation }}" data-search="on" {{defaultLang()->id}}
                                                data-attributes-lang="{{ implode(",", $data->attributesTranslations()) }}"
                                                data-placeholder="Lang" name="local_id">
                                            <option value="">Language Select</option>
                                            @foreach(allLanguges() as $item)
                                                <option value="{{ $item->id }}" {{ ($item->id == defaultLang()->id) ? "selected" : "" }}>
                                                    {{ $item->code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <span class="preview-title-lg overline-title">Edit Data</span>
                            @endif
                            <hr class="preview-hr">
                            <div class="row gy-4">
                                <!-- Start Fields Edit-->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!--  Put All Fields For Edit -->
                                        </div>
                                    </div>
                                <!-- End Fields Edit-->
                            </div>
                            <hr class="preview-hr">
                            <div class="row gy-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Update Information</button>
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
    {{--  Modal Popups  --}}
@endsection

@section("extraScriptsPage")
    {{--  Put Extra JS In Here  --}}
@endsection
