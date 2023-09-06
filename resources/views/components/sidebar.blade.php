@php
    $menus = config('menu.menus');
@endphp

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand text-center">
            <div class="d-flex align-items-center justify-content-center my-2">
                <img src="{{ asset('img/logo.png') }}" alt="app-logo" width="50px" height="50px">
                <div class="text-left">
                    <h5 class="mb-0 ml-2 text-primary">POS</h5>
                    <h6 class="mb-0 ml-2">MA NU Sunan Giri</h6>
                </div>
            </div>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <img src="{{ asset('img/logo.png') }}" alt="app-logo" width="60%">
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="{{ Request::segment(1) == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-gauge">
                    </i> <span class="ml-2">Dashboard</span>
                </a>
            </li>
            @foreach ($menus as $menu)
                @if (count($menu['sub_menus']) > 0)
                    {{-- @can($menu['permission']) --}}
                    <li class="nav-item dropdown {{ Request::segment(1) == $menu['route_prefix'] ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown"><i class="{{ $menu['icon'] }}"></i><span
                                class="ml-2">{{ $menu['name'] }}</span></a>
                        <ul class="dropdown-menu">
                            @foreach ($menu['sub_menus'] as $submenu)
                                {{-- @can($submenu['permission']) --}}
                                    <li class="{{ Request::segment(2) == $submenu['route_prefix'] ? 'active' : '' }}">
                                        <a class="nav-link"
                                            href="{{ $submenu['route_name'] ? route($submenu['route_name']) : route('dashboard.index') }}"><i
                                                class="fas fa-circle-dot mr-2"></i><span>{{ $submenu['name'] }}</span></a>
                                    </li>
                                {{-- @endcan --}}
                            @endforeach
                        </ul>
                    </li>
                    {{-- @endcan --}}
                @else
                    {{-- @can($menu['permission']) --}}
                    <li
                        class="{{ Request::segment(1) == $menu['route_prefix'] || Request::segment(2) == $menu['route_prefix'] ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ $menu['route_name'] ? route($menu['route_name']) : route('dashboard.index') }}"><i
                                class="{{ $menu['icon'] }}">
                            </i> <span class="ml-2">{{ $menu['name'] }}</span>
                        </a>
                    </li>
                    {{-- @endcan --}}
                @endif
            @endforeach
        </ul>
    </aside>
</div>
