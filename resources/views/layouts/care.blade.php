<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Care - @yield('title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <!-- Stacking CSS -->
    @stack("css")

</head>

<body>
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->

<!-- Wrapper Start -->
<div class="wrapper">
    <!-- Sidebar  -->
    @include('include.sidebar')

    <!-- TOP Nav Bar -->
    @include('include.topbar')


    <!-- Page Content  -->
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

</div>
<!-- Wrapper END -->
<!-- Footer -->
@include('include.footer')

<!-- JavaScript -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!-- Appear JavaScript -->
<script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
<!-- Countdown JavaScript -->
<script src="{{ asset('assets/js/countdown.min.js') }}"></script>
<!-- Counterup JavaScript -->
<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
<!-- Wow JavaScript -->
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<!-- Apexcharts JavaScript -->
<script src="{{ asset('assets/js/apexcharts.js') }}"></script>
<!-- Slick JavaScript -->
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<!-- Select2 JavaScript -->
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<!-- Owl Carousel JavaScript -->
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<!-- Magnific Popup JavaScript -->
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Smooth Scrollbar JavaScript -->
<script src="{{ asset('assets/js/smooth-scrollbar.js') }}"></script>
<!-- lottie JavaScript -->
<script src="{{ asset('assets/js/lottie.js') }}"></script>
<!-- am core JavaScript -->
<script src="{{ asset('assets/js/core.js') }}"></script>
<!-- am charts JavaScript -->
<script src="{{ asset('assets/js/charts.js') }}"></script>
<!-- am animated JavaScript -->
<script src="{{ asset('assets/js/animated.js') }}"></script>
<!-- am kelly JavaScript -->
<script src="{{ asset('assets/js/kelly.js') }}"></script>
<!-- am maps JavaScript -->
<script src="{{ asset('assets/js/maps.js') }}"></script>
<!-- am worldLow JavaScript -->
<script src="{{ asset('assets/js/worldLow.js') }}"></script>
<!-- Raphael-min JavaScript -->
<script src="{{ asset('assets/js/raphael-min.js') }}"></script>
<!-- Morris JavaScript -->
<script src="{{ asset('assets/js/morris.js') }}"></script>
<!-- Morris min JavaScript -->
<script src="{{ asset('assets/js/morris.min.js') }}"></script>
<!-- Flatpicker Js -->
<script src="{{ asset('assets/js/flatpickr.js') }}"></script>
<!-- Style Customizer -->
<script src="{{ asset('assets/js/style-customizer.js') }}"></script>
<!-- Chart Custom JavaScript -->
<script src="{{ asset('assets/js/chart-custom.js') }}"></script>
<!-- Custom JavaScript -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<!-- Stacking JavaScript -->
@stack('scripts')

</body>
</html>
