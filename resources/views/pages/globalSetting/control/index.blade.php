@php
    $dataPass = [
        "IsHaveLanguage" => false ,
         "titlePage" => __("messages.controlSetting") ,
        "descriptionPage" => "Basic info, like your name and address, that you use on Nio Platform." ,
        "routeEdit" => route("setting.control.edit"),
    ] ;
@endphp
@include("pages.globalSetting.index" , [ "dataPass" => ($dataPass ?? null) ])
