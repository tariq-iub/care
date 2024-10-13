@include('layouts.partial.admin_head')

<main class="main" id="top">
    @include('layouts.partial.sidebar')
    @include('layouts.partial.navbar')
    <div class="content">
        @yield('content')
        @include('layouts.partial.footer')
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
<script src="../assets/js/projectmanagement-dashboard.js"></script>

@if(Session::has('message'))
    <script>
        Swal.fire({
            title: 'Success',
            text: '{{ Session::get('message') }}',
            icon: 'success',
            confirmButtonText: 'OK',
            timer: 3000
        })
    </script>
@endif

@if(Session::has('error-message'))
    <script>
        Swal.fire({
            title: 'Error',
            text: '{{ Session::get('error-message') }}',
            icon: 'error',
            confirmButtonText: 'OK',
            timer: 3000
        })
    </script>
@endif

<!-- Stacking JavaScript -->
@stack('scripts')

</body>
</html>
