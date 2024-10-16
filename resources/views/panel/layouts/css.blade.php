<head>
    <base href="">
    <meta charset="utf-8" />
    <title>
        {{getSeting('title_' . app()->getLocale())}}
        {{isset($sub_title) ? ' | ' . @$sub_title : ''}}
    </title>
    <meta name="description" content="{{getSeting('describe_' . app()->getLocale())}}" />
    <meta name="keywords" content="{{getSeting('tags_' . app()->getLocale())}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="{{imageUrl(getSeting('logo'))}}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{asset('assets/panel/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet"
        type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('assets/panel/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('assets/panel/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    @if(app()->isLocale('ar'))
        <link href="{{asset('assets/panel/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    @else
        <link href="{{asset('assets/panel/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    @endif

    <link href="{{asset('assets/panel/css/custome.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{asset('assets/panel/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet"
        type="text/css" />

    @yield("css")

</head>
