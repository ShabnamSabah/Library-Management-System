<!DOCTYPE html>

<html lang="en">


<head>
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

    <meta name="twitter:site" content="@lms" />

    <meta name="twitter:creator" content="@lms" />

    <meta name="twitter:url" content="{{ url()->full() }}" />

    <meta name="twitter:title" content="{{ isset($data['page_title']) ? $data['page_title'] :  'Library Management System' }}" />

    <meta name="twitter:description" content="{{ isset($data['page_title']) ? $data['page_title'] :  'Library Management System' }}" />

    <meta name="twitter:image" content="{{ asset('frontend_assets/images/share_logo.jpg') }}" />



    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend_assets/images/favicon.ico') }}">

    <meta prperty="title" content="{{ isset($data['page_title']) ? $data['page_title'] :  'Library Management System' }}" />



    <meta name="robots" content="all" />

    <meta name="googlebot" content="all" />

    <meta name="googlebot-news" content="all" />

    {{--  --}}

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->





    <meta name="keywords" content="Library" />



    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap"
        rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('backend_assets/vendors/core/core.css') }}">
    <!-- endinject -->



    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('backend_assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('backend_assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('backend_assets/css/style.min.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('backend_assets/images/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .passwordInputField {
            position: relative;
        }

        .showHidePassword {
            position: absolute;
            right: 10px;
            top: 38px;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4 pe-md-0">
                                    <div class="auth-side-wrapper">

                                    </div>
                                </div>
                                <div class="col-md-8 ps-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="" class="noble-ui-logo d-block mb-2"
                                        target="_blank">
                                        <img src="{{ asset('backend_assets/images/logo.png') }}"
                                            style="width: 130px;">
                                    </a>
                                        @if(session('error'))
                                            <div class="popupRightBottom text-danger timeout mt-1">
                                                {{ session('error') }}</div>
                                        @endif
                                        <form class="forms-sample" action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="userEmail" class="form-label">Email address</label>
                                                <input type="email" value="{{ old('email') }}" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="userEmail" placeholder="Email">
                                            </div>
                                            <div class="passwordInputField mb-2">
                                                <label for="userPassword" class="form-label">Password</label>
                                                <input type="password" value="" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="userPassword" autocomplete="current-password"
                                                    placeholder="Password">
                                                @error('password')
                                                    <span class='invalid-feedback' role='alert'>
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="showHidePassword">
                                                    <div onclick="show_password()"> <i class="fa-solid fa-eye"
                                                            id="icon"></i></div>
                                                </div>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input type="checkbox" name="checkbox"
                                                    class="form-check-input @error('checkbox') is-invalid @enderror"
                                                    id="authCheck">

                                                <label class="form-check-label" for="authCheck">
                                                    I am not a Robot
                                                </label>
                                            </div>
                                            <div>

                                                <input type="submit"
                                                    class="btn btn-primary text-white me-2 mb-2 mb-md-0"
                                                    value="Sign In">
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- core:js -->
    <script src="{{ asset('backend_assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->



    <!-- inject:js -->
    <script src="{{ asset('backend_assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend_assets/js/template.js') }}"></script>
    <!-- endinject -->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function show_password() {
            var input = document.getElementById('userPassword');
            let icon = document.getElementById('icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>


</html>
