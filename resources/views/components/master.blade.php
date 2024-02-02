<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
@include('layouts.partials._meta')
@include('layouts.headers.head')
@push('css')
    <!-- Internal Data table css -->
        <link href="{{URL::asset('plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
        <link href="{{URL::asset('plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
        <link href="{{URL::asset('plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
        <link href="{{URL::asset('plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    @endpush
    @stack('css')

</head>

<body class="main-body app sidebar-mini">
<!-- Loader -->
<div id="global-loader">
    <img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
</div>


<!-- /Loader -->
@include('layouts.sidebars.main-sidebar')
<!-- main-content -->
<div class="main-content app-content">
@include('layouts.headers.main-header')


<!-- container -->
    <div class="container-fluid mt-7">
        @include('layouts.sidebars.sidebar')
        <div class="col-12 mt-2">
            @include('alerts.success')
            @include('alerts.errors')
            @include('alerts.error')
        </div>
        {{$slot}}
        @include('layouts.footers.main-footer')
    </div>
@include('layouts.footers.footer-scripts')


@push('js')
    <!-- Internal Data tables -->
        <script src="{{URL::asset('plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/jquery.dataTables.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/jszip.min.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/pdfmake.min.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/vfs_fonts.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/buttons.html5.min.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/buttons.print.min.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/buttons.colVis.min.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{URL::asset('plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
        <!--Internal  Datatable js -->
        <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endpush
@stack('scripts')
</body>
</html>
