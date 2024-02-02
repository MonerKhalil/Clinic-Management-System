@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    {{--  Extra Library CSS  --}}
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
        <div class="nk-block nk-block-lg">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="preview-block">
                        <form id="crud_add" action="#" method="#"
                              class="form-validate" enctype="multipart/form-data">
                            @csrf
                            <span class="preview-title-lg overline-title">Add New Data</span>
                            <div class="row gy-4">
                                <!-- Start Fields Add-->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!--  Put All Fields For Create -->
                                        </div>
                                    </div>
                                <!-- End Fields Add-->
                            </div>
                            <hr class="preview-hr">
                            <div class="row gy-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-primary">Add Information</button>
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
