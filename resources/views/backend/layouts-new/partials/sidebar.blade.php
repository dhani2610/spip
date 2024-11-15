<style>
    /* .layout-wrapper:not(.layout-horizontal) .bg-menu-theme .menu-inner .menu-item .menu-link {
        color: white
    } */

    .active-title {
        color: #white !important;
    }
/* 
    .bg-menu-theme .menu-inner>.menu-item.active>.menu-link {
        color: red ! important;
        background-color: white !important;
        font-weight: 800
    } */

    /* .bg-menu-theme {
        background: rgb(6, 193, 247);
        background: linear-gradient(90deg, rgba(6, 193, 247, 1) 41%, rgba(6, 193, 247, 1) 85%);
    }

    .menu-inner {
        background: rgb(6, 193, 247);
        background: linear-gradient(90deg, rgba(6, 193, 247, 1) 41%, rgba(6, 193, 247, 1) 85%);
    } */
</style>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme"
    style="    border-right: 3px solid rgb(114 113 113 / 52%);">
    <div class="app-brand demo mb-3">
        <a href="#" class="app-brand-link">
            {{-- <span class="app-brand-logo demo">

      </span> --}}
            <img src="{{ asset('assets/img/logos/logo.png') }}" style="max-width: 40%">
            <span class=" demo fw-bold ms-2" style="color: white">Dashboard</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    @php
        $usr = Auth::guard('admin')->user();
        if ($usr != null) {
            $userRole = Auth::guard('admin')->user()->getRoleNames()->first(); // Get the first role name
        }

    @endphp

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @php
            $arr_side = [
                'Sarana',
                'Prasarana',
                'Instalasi',
                'Peralatan',
            ]
        @endphp

        @foreach ($arr_side as $item)    
            <li class="menu-item mb-2">
                <a href="{{ route('spip') }}?type={{ $item }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="{{ $item }}">{{ $item }}</div>
                </a>
            </li>
        @endforeach

            @if ($usr->can('admin.view') || $usr->can('role.view'))
                <li
                    class="menu-item {{ Request::routeIs('admin/admins') || Request::routeIs('admin/roles') ? 'open' : '' }}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-layout"></i>
                        <div data-i18n="Layouts">Management Users</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ Request::routeIs('admin/admins') ? 'active' : '' }}">
                            <a href="{{ route('admin.admins.index') }}" class="menu-link">
                                <div data-i18n="Without menu"
                                    style="color : {{ Request::routeIs('admin/admins') ? '#f8dc5f' : '' }}">Users
                                </div>
                            </a>
                        </li>

                    </ul>
                </li>
            @endif


            @if ($usr != null)
                <form id="admin-logout-form" action="{{ route('admin.logout.submit') }}" method="POST"
                    style="display: none;">
                    @csrf
                </form>
                <li class="menu-item" style="    position: fixed;bottom: 1%">
                    <a href="#" class="menu-link"
                        onclick="event.preventDefault();
                        document.getElementById('admin-logout-form').submit();">
                        <i class="menu-icon tf-icons bx bx-power-off"></i>
                        <div data-i18n="Dashboards">Log Out</div>
                    </a>
                </li>
            @else
                <li class="menu-item" style="    position: fixed;bottom: 1%">
                    <a href="{{ url('admin/login') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-power-off"></i>
                        <div data-i18n="Dashboards">Login</div>
                    </a>
                </li>
            @endif


    </ul>
</aside>
