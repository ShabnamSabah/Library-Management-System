<!DOCTYPE html>

<html lang="en">

<head>
    <style>

    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, maximum-scale=1, user-scalable=0" />

    <title>{{ isset($data['page_title']) ? $data['page_title'] :  'Library Management System' }}</title> 
    
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->full() }}" />
    <meta property="og:title" content="{{ isset($data['page_title']) ? $data['page_title'] :  'Library Management System' }}" />
    <meta property="og:image" content="{{ isset($data['page_image']) ? asset($data['page_image']) : asset('frontend_assets/images/share_logo.jpg') }}" />
    <meta property="og:description" content="{{ isset($data['page_description']) ? $data['page_description'] :  'Library Management System' }}" />
    <meta property="og:image:alt" content="GDBA Library" />
    <meta property="fb:app_id" content="xxxxxxxxxxx" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
    <meta name="author" content="hrsoftbd" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@gdbalibrary" />
    <meta name="twitter:creator" content="@gdbalibrary" />
    <meta name="twitter:url" content="{{ url()->full() }}" />
    <meta name="twitter:title" content="{{ isset($data['page_title']) ? $data['page_title'] :  'Library Management System' }}" />
    <meta name="twitter:description" content="{{ isset($data['page_title']) ? $data['page_title'] :  'Library Management System' }}" />
    <meta name="twitter:image" content="{{ asset('frontend_assets/images/share_logo.jpg') }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend_assets/images/favicon.ico') }}">

    <meta prperty="title" content="{{ isset($data['page_title']) ? $data['page_title'] :  'Library Management System' }}" />
    <meta name="robots" content="all" />
    <meta name="googlebot" content="all" />
    <meta name="googlebot-news" content="all" />
    <meta http-equiv="developer" content="Powered by : HRSOFT BD Web address : http://www.hrsoftbd.com Address : P-7, Nurjahan Road, Mohammadpur, Dhaka (Corporate Office). 48, Kazi Nazrul Islam Avenue, Karwan Bazar, Dhaka-1215, Bangladesh (Registered Office)" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="keywords" content="GDBA, Gazipur District Bar, Gazipur District Bar Association, Bar, Lawyer, Gazipur Lawyer Association, Lawyer Association Gazipur, Lawyer Association, Gazipur, Bangladesh, Advocate, GDBA Gazipur, Judge Court, Gazipur judge court" />
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css start -->
    <link rel="stylesheet" href="{{ asset('backend_assets/vendors/core/core.css') }}">
    <!-- core:css end -->
    <!--icon start-->
    <link rel="stylesheet" href="{{ asset('backend_assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('backend_assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!--icon end-->


    <!--  data table ck editor start-->
    <link rel="stylesheet" href="{{ asset('backend_assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!--  data table end-->
    <!--date picker start -->
    <link rel="stylesheet" href="{{ asset('backend_assets/vendors/flatpickr/flatpickr.min.css') }}">
    <!--date picker end-->
    <link rel="stylesheet" href="{{ asset('backend_assets/vendors/select2/select2.min.css') }}">
    @stack('css')

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('backend_assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('backend_assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend_assets/css/style.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('backend_assets/css/cause_list.css') }}">  --}}
</head>

<body class="sidebar-dark ">
    <script src="{{ asset('assets/js/loader.js') }}"></script>

    <div class="main-wrapper">
        @include('backend.admin.includes.sidebar')
        <div class="page-wrapper">
            @include('backend.admin.includes.header')
            @yield('content')
            @include('backend.admin.includes.footer')
        </div>

    </div>


    <!-- core:js -->
    <script src="{{ asset('backend_assets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('backend_assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('backend_assets/js/bootstrap-maxlength.js') }}"></script>


    <!--icon start-->
    <script src="{{ asset('backend_assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend_assets/js/template.js') }}"></script>
    <!--icon end-->

    <!-- date picker start -->
    <script src="{{ asset('backend_assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('backend_assets/js/flatpickr.js') }}"></script>
    <!-- date picker end-->
    <!--data table start -->
    <script src="{{ asset('backend_assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend_assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('backend_assets/js/data-table.js') }}"></script>
    <!--data table end -->
    {{-- select 2  --}}
    <script src="{{ asset('backend_assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend_assets/js/select2.js') }}"></script>
    @stack('js')



</body>

</html>
