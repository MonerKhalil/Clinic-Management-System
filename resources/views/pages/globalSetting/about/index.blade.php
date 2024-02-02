@php
    $dataPass = [
        "IsHaveLanguage" => true ,
        "titlePage" => __("messages.aboutSetting") ,
        "descriptionPage" => "Basic info, like your name and address, that you use on Nio Platform.",
        "routeEdit" => route("setting.edit"),
    ] ;
@endphp
@include("pages.globalSetting.index" , [ "dataPass" => ($dataPass ?? null) ])
