<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mahedi Kabir</title>
    <meta name="description" content="Hasan Mahedi (Kabir) is a TA at TTU. He was a journalist. He is also familiar with his voluntary activities and suggestions for higher studies."/>
    <meta name="keywords" content="texas tech university, mahedi kabir, hasan mahedi, texus tech hasan mehedi, texas tech university hasan mahedi, media"/>
    <meta name="author" content="Hasan Mahedi"/>
    <link rel="shortcut icon" href="{{asset("favicon.ico")}}">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="1 days">

    <link rel="stylesheet" href="{{asset("css/normalize.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/owl.carousel.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/magnific-popup.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/main.css")}}" type="text/css">
    <link rel="stylesheet" href="{{asset("css/custom.css")}}" type="text/css">
    <link rel="stylesheet" href="{{url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css")}}" type="text/css">

    <script src="{{asset("js/modernizr.custom.js")}}"></script>

    @yield('style')

</head>


<body class="page">

<div class="lm-animated-bg"></div>

<!-- Loading animation -->
<div class="preloader">
    <div class="preloader-animation">
        <div class="preloader-spinner">
        </div>
    </div>
</div>
<!-- /Loading animation -->

<!-- Scroll To Top Button -->
<div class="lmpixels-scroll-to-top"><i class="lnr lnr-chevron-up"></i></div>
<!-- /Scroll To Top Button -->

<div class="page-scroll">
    <div id="page_container" class="page-container bg-move-effect" data-animation="transition-flip-in-right">

        <!-- Header -->
        <header id="site_header" class="header">
            <div class="header-content clearfix">

                <!-- Text Logo -->
                <div class="text-logo">
                    <a href="{{route('index')}}">
                        <div class="logo-symbol"><img src="{{asset("logo.png")}}" alt=""></div>
                        <div class="logo-text">Hasan <span>Mahedi</span></div>
                    </a>
                </div>
                <!-- /Text Logo -->

                <!-- Navigation -->
                <div class="site-nav mobile-menu-hide">
                    <ul class="leven-classic-menu site-main-menu">
                        <li class="menu-item"><a href="{{route('index')}}">About Me</a></li>
                        <li class="menu-item"><a href="{{route('experiences')}}">Experiences</a></li>
                        <li class="menu-item"><a href="{{route('research')}}">Research</a></li>
                        <li class="menu-item>"><a href="{{route('blog')}}">Blog</a></li>
                    </ul>
                </div>
                <!-- Mobile Menu Toggle -->
                <a class="menu-toggle mobile-visible">
                    <i class="fa fa-bars"></i>
                </a>
                <!-- Mobile Menu Toggle -->
            </div>
        </header>

        @yield('content')

        <!-- Footer -->
        <footer class="site-footer clearfix">
            <div class="footer-copyrights">
                <p>&copy; <?php echo date("Y"); ?> All rights reserved. Hasan Mahedi</p>
            </div>
        </footer>
        <!-- /Footer -->

    </div>
</div>

<script src="{{asset("js/jquery-2.1.3.min.js")}}"></script>
<script src="{{asset("js/imagesloaded.pkgd.min.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>
<script src='{{asset("js/jquery.shuffle.min.js")}}'></script>
<script src="{{asset("js/masonry.pkgd.min.js")}}"></script>
<script src="{{asset("js/owl.carousel.min.js")}}"></script>
<script src="{{asset("js/jquery.magnific-popup.min.js")}}"></script>
<script src="{{asset("js/jquery.googlemap.js")}}"></script>
<script src="{{asset("js/validator.js")}}"></script>
<script src="{{asset("js/main.js")}}"></script>
<script defer src="{{url("https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194")}}"
        integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw=="
        data-cf-beacon='{"rayId":"6c2a6a1bdf084649","version":"2021.12.0","r":1,"token":"94b99c0576dc45bf9d669fb5e9256829","si":100}'
        crossorigin="anonymous"></script>
@yield('script')
</body>
</html>




