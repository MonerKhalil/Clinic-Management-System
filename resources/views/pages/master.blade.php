<!DOCTYPE html>
@if(lang(app()->getLocale())->isRTL)
    <html lang="ar" dir="rtl">
@else
    <html lang="en" dir="ltr">
@endif
    <head>
        <title>{{ isset($title) ? $title :  __('messages.home-page') }}</title>
        @include("layouts.head.meta")
        @include('layouts.head.stylePackages')
    </head>

    <body>
        <!-- Start Loader Page -->
        @include("components.loader.preLoader")
        <!-- End Loader Page -->

        <!-- Start Loader Page -->
        @include("components.loader.formLoader")
        <!-- End Loader Page -->

        <div id="Wrapper">
            <div class="fetch-data-language"
                  data-file-lang="Main"
                  data-file-primary="true"
                  data-file-content="{{ getLangFile("Main") }}"
            ></div>
            @yield("MainContent")
        </div>
        {{-- Scripts --}}
        @include("layouts.footers.footer-scripts")
    </body>
</html>
