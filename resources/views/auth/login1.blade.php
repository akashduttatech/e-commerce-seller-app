<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400i,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&amp;display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/assets/images/favicon.png') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/nice-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/slick.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/assets/css/main-color.css') }}">

</head>

<body class="biolife-body">

    <!-- Preloader -->
    {{-- <div id="biof-loading">
        <div class="biof-loading-center">
            <div class="biof-loading-center-absolute">
                <div class="dot dot-one"></div>
                <div class="dot dot-two"></div>
                <div class="dot dot-three"></div>
            </div>
        </div>
    </div> --}}

    <!-- HEADER -->
    {{-- @include('layouts.header') --}}
    <!-- HEADER -->

    <!--Hero Section-->
    {{-- <div class="hero-section hero-background">
        <h1 class="page-title">Organic Fruits</h1>
    </div> --}}

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="{{ url('/') }}" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Login</span></li>
            </ul>
        </nav>
    </div>

    <!-- Page Contain -->
    <div class="page-contain login-page">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">

                <div class="row">

                    <!--Form Sign In-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="signin-container">
                            <form action="{{ route('login') }}" name="frm-login" method="post">
                                @csrf
                                <p class="form-row">
                                    <label for="fid-name">Email Address:<span class="requite">*</span></label>
                                    <input type="text" id="fid-name" name="email" value="{{ old('email') }}"
                                        class="txt-input">
                                        @error('email')
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @enderror
                                </p>
                                <p class="form-row">
                                    <label for="fid-pass">Password:<span class="requite">*</span></label>
                                    <input type="password" id="fid-pass" name="password" value=""
                                        class="txt-input">
                                        @error('password')
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @enderror
                                </p>
                                <p class="form-row wrap-btn">
                                    <button class="btn btn-submit btn-bold" type="submit">sign in</button>
                                    <a href="#" class="link-to-help">Forgot your password</a>
                                </p>
                            </form>
                        </div>
                    </div>

                    <!--Go to Register form-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="register-in-container">
                            <div class="intro">
                                <h4 class="box-title">New Customer?</h4>
                                <p class="sub-title">Create an account with us and you’ll be able to:</p>
                                <ul class="lis">
                                    <li>Check out faster</li>
                                    <li>Save multiple shipping anddesses</li>
                                    <li>Access your order history</li>
                                    <li>Track new orders</li>
                                    <li>Save items to your Wishlist</li>
                                </ul>
                                <a href="{{ url('register') }}" class="btn btn-bold">Create an account</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- Page Contain -->


    <!-- FOOTER -->
    @include('layouts.footer')
    <!-- FOOTER -->


    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <script src="{{ asset('assets/frontend/assets/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/js/biolife.framework.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/js/functions.js') }}"></script>
</body>

</html>
