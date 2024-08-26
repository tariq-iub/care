@include('layouts.partial.head')

<main class="main" id="top">
    <div class="content">
        @yield('content')
    </div>
</main>

<!-- ===============================================-->
<!--    JavaScripts-->
<!-- ===============================================-->
<script src="{{ asset('assets/vendors/popper/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendors/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/anchorjs/anchor.min.js') }}"></script>
<script src="{{ asset('assets/vendors/is/is.min.js') }}"></script>
<script src="{{ asset('assets/vendors/fontawesome/all.min.js') }}"></script>
<script src="{{ asset('assets/vendors/lodash/lodash.min.js') }}"></script>
<script src="{{ asset('assets/js/polyfill.min58be.js') }}?features=window.scroll"></script>
<script src="{{ asset('assets/vendors/list.js/list.min.js') }}"></script>
<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/vendors/dayjs/dayjs.min.js') }}"></script>
<script src="{{ asset('assets/vendors/choices/choices.min.js') }}"></script>
<script src="{{ asset('assets/vendors/dhtmlx-gantt/dhtmlxgantt.js') }}"></script>
<script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('assets/js/phoenix.js') }}"></script>
<script src="{{ asset('assets/vendors/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('assets/vendors/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
<script src="{{ asset('assets/vendors/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
      rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/css/line.css') }}">
<link href="{{ asset('assets/css/theme-rtl.min.css') }}" type="text/css" rel="stylesheet" id="style-rtl">
<link href="{{ asset('assets/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
<link href="{{ asset('assets/css/user-rtl.min.css') }}" type="text/css" rel="stylesheet" id="user-style-rtl">
<link href="{{ asset('assets/css/user.min.css') }}" type="text/css" rel="stylesheet" id="user-style-default">


<!-- Stacking JavaScript -->
@stack('scripts')

</body>
</html>
