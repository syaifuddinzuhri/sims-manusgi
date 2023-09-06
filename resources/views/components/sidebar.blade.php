@php
    $menus = config('menu.menus');
@endphp

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand text-center">
            <img src="{{ asset('img/logo.png') }}" alt="siloam-logo" width="50%">
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <img src="{{ asset('img/logo.png') }}" alt="siloam-logo" width="80%">
        </div>
        <ul class="sidebar-menu mt-4">
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
                                @can($submenu['permission'])
                                    <li class="{{ Request::segment(2) == $submenu['route_prefix'] ? 'active' : '' }}">
                                        <a class="nav-link"
                                            href="{{ $submenu['route_name'] ? route($submenu['route_name']) : route('dashboard.index') }}"><i
                                                class="fas fa-circle-dot mr-2"></i><span>{{ $submenu['name'] }}</span></a>
                                    </li>
                                @endcan
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
