<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="{{ url('/') }}" class="header-logo">
            <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid rounded-normal" alt="">
            <div class="logo-title font-size-21 font-weight-500">
                <span class="text-danger text-uppercase">CARE<span class="text-primary ml-1">360</span></span>
            </div>
        </a>
        <div class="iq-menu-bt-sidebar">
            <div class="iq-menu-bt align-self-center">
                <div class="wrapper-menu">
                    <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                    <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
            @foreach($menus as $menu)
                @if(count($menu->subMenus))
                @php
                    $subMenuSelected = false;
                    $subMenuSelected = Arr::first($menu->subMenus, function ($item, $key) {
                                            return Route::is($item->route);
                                        });
                @endphp
                <li class="{{ $subMenuSelected ? 'active active-menu' : '' }}">
                    <a href="#info{{ $menu->id }}" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false">
                        <span class="ripple rippleEffect"></span>
                        <i class="{{ $menu->icon }} iq-arrow-left"></i>
                        <span>{{ $menu->title }}</span>
                        <i class="ri-arrow-right-s-line iq-arrow-right"></i>
                    </a>
                    <ul id="info{{ $menu->id }}" class="iq-submenu collapse {{ $subMenuSelected ? 'show' : '' }}" data-parent="#iq-sidebar-toggle" style="">
                        @foreach($menu->subMenus as $item)
                        <li class="{{ Route::is($item->route) ? 'active' : '' }}">
                            <a href="{{ route($item->route) }}">
                                <i class="{{ $item->icon }}"></i>{{ $item->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @else
                <li class="{{ Route::is($menu->route) ? 'active' : '' }}">
                    @if(!is_null($menu->route))
                    <a href="{{ route($menu->route) }}" class="iq-waves-effect">
                        <i class="{{ $menu->icon }} iq-arrow-left"></i>
                        <span>{{ $menu->title }}</span>
                    </a>
                    @endif
                </li>
               @endif
            @endforeach
            </ul>
        </nav>
    </div>
</div>
