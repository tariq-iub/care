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
    <link rel="stylesheet" href="{{ asset('assets/welcome/css/bootstrap.min.css') }}">
    <!-- REVOLUTION STYLE SHEETS -->
    <link rel="stylesheet" href="{{ asset('assets/welcome/revolution/css/settings.html') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('assets/welcome/css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/welcome/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/welcome/css/responsive.css') }}">

    <!-- Stacking CSS -->
    @stack("css")

</head>
<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
            <div class="loader">
            </div>
        </div>
    </div>

    <header id="header" class="main-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img class="logo" src="{{ asset('assets/images/logo-full.png') }}" alt="image">
                            <img class="logo-two" src="{{ asset('assets/images/logo-full2.png') }}" alt="image">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
{{--                            <ul class="navbar-nav ml-auto">--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="#home">Home</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="#demos">Demos</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="https://templates.iqonic.design/server360/documentation/index.html">Documentation</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="#features">Features</a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
                        </div>
                    </nav>
                </div>
                <div class="col-lg-4 text-right">
                    <div class="btn-purchase">
                        @auth
                            <a href="{{ route('/dashboard') }}" class="button white-btn shadow">
                                {{ __('Dashboard') }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="button white-btn shadow">
                                {{ __('Login') }}
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

{{--    <div id="app">--}}
{{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
{{--            <div class="container">--}}
{{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
{{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                    <span class="navbar-toggler-icon"></span>--}}
{{--                </button>--}}

{{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--                    <!-- Left Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav me-auto">--}}

{{--                    </ul>--}}

{{--                    <!-- Right Side Of Navbar -->--}}
{{--                    <ul class="navbar-nav ms-auto">--}}
{{--                        <!-- Authentication Links -->--}}
{{--                        @guest--}}
{{--                            @if (Route::has('login'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}

{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @else--}}
{{--                            <li class="nav-item dropdown">--}}
{{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                    {{ Auth::user()->name }}--}}
{{--                                </a>--}}

{{--                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
{{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                       onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                        {{ __('Logout') }}--}}
{{--                                    </a>--}}

{{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                        @csrf--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        @endguest--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </nav>--}}

{{--        <main class="py-4">--}}
{{--            @yield('content')--}}
{{--        </main>--}}
{{--    </div>--}}

    <!-- JavaScript -->
    <script src="{{ asset('assets/welcome/js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper  -->
    <script src="{{ asset('assets/welcome/js/popper.min.js') }}"></script>
    <!--  bootstrap -->
    <script src="{{ asset('assets/welcome/js/bootstrap.min.js') }}"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('assets/welcome/js/owl.carousel.min.js') }}"></script>
    <!-- Wow JavaScript -->
    <script src="{{ asset('assets/welcome/js/wow.min.js') }}"></script>
    <!-- Retina JavaScript -->
    <script src="{{ asset('assets/welcome/js/retina.min.js') }}"></script>

    <!-- REVOLUTION JS FILES -->
    <script>
        function setREVStartSize(t) {
            try {
                var h, e = document.getElementById(t.c).parentNode.offsetWidth;
                if (e = 0 === e || isNaN(e) ? window.innerWidth : e, t.tabw = void 0 === t.tabw ? 0 : parseInt(t.tabw), t.thumbw = void 0 === t.thumbw ? 0 : parseInt(t.thumbw), t.tabh = void 0 === t.tabh ? 0 : parseInt(t.tabh), t.thumbh = void 0 === t.thumbh ? 0 : parseInt(t.thumbh), t.tabhide = void 0 === t.tabhide ? 0 : parseInt(t.tabhide), t.thumbhide = void 0 === t.thumbhide ? 0 : parseInt(t.thumbhide), t.mh = void 0 === t.mh || "" == t.mh || "auto" === t.mh ? 0 : parseInt(t.mh, 0), "fullscreen" === t.layout || "fullscreen" === t.l) h = Math.max(t.mh, window.innerHeight);
                else {
                    for (var i in t.gw = Array.isArray(t.gw) ? t.gw : [t.gw], t.rl) void 0 !== t.gw[i] && 0 !== t.gw[i] || (t.gw[i] = t.gw[i - 1]);
                    for (var i in t.gh = void 0 === t.el || "" === t.el || Array.isArray(t.el) && 0 == t.el.length ? t.gh : t.el, t.gh = Array.isArray(t.gh) ? t.gh : [t.gh], t.rl) void 0 !== t.gh[i] && 0 !== t.gh[i] || (t.gh[i] = t.gh[i - 1]);
                    var r, a = new Array(t.rl.length),
                        n = 0;
                    for (var i in t.tabw = t.tabhide >= e ? 0 : t.tabw, t.thumbw = t.thumbhide >= e ? 0 : t.thumbw, t.tabh = t.tabhide >= e ? 0 : t.tabh, t.thumbh = t.thumbhide >= e ? 0 : t.thumbh, t.rl) a[i] = t.rl[i] < window.innerWidth ? 0 : t.rl[i];
                    for (var i in r = a[0], a) r > a[i] && 0 < a[i] && (r = a[i], n = i);
                    var d = e > t.gw[n] + t.tabw + t.thumbw ? 1 : (e - (t.tabw + t.thumbw)) / t.gw[n];
                    h = t.gh[n] * d + (t.tabh + t.thumbh)
                }
                void 0 === window.rs_init_css && (window.rs_init_css = document.head.appendChild(document.createElement("style"))), document.getElementById(t.c).height = h, window.rs_init_css.innerHTML += "#" + t.c + "_wrapper { height: " + h + "px }"
            } catch (t) {
                console.log("Failure at Presize of Slider:" + t)
            }
        }
    </script>
    <script src="{{ asset('assets/welcome/js/grouploop-1.0.0.min.js') }}"></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('assets/welcome/js/custom.js') }}"></script>
    <script async src="https://socialproof.zaperp.com/pixel/4PUCCDUMZU814VI4L1L4P2V5XP9K4MPU"></script>
    <script async src="https://prod.iqonic.design/yunohost/admin" data-hs-background="#ff7750"></script>

    <!-- Stacking JavaScript -->
    @stack('scripts')

</body>
</html>
