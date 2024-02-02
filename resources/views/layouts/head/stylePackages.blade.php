{{-- Favicon --}}
<link rel="icon" href="{{asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
{{-- Normalize Website --}}
<link rel="stylesheet" href='{{asset('System/assets/css/Normalize.css')}}' type="text/css" />
{{-- Libraries Extra --}}
@yield('CSSLibrary_Extra')
{{-- Main CSS System --}}
@if(lang(app()->getLocale())->isRTL)
    <link rel="stylesheet" href='{{asset('System/assets/css/dashlite.rtl.css')}}' type="text/css" />
@else
    <link rel="stylesheet" href='{{asset('System/assets/css/dashlite.css')}}' type="text/css" />
@endif
<link rel="stylesheet" href='{{asset('System/assets/css/theme.css')}}' type="text/css" />
<link rel="stylesheet" href='{{asset('System/assets/css/custom.css')}}' type="text/css" />
{{-- CSS Extra--}}
@yield('CSS_Extra')
