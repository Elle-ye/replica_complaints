<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="logout-url" content="{{ route('logout') }}">
    {{-- <meta name="metroui:theme" content="auto"> --}}

    <title>Admin Dashboard</title>


    {{-- @vite('resources/js/app.js') --}}


    {{-- Metro UI Stylesheets --}}
    <link rel="stylesheet" href="{{ asset('assets/css/metro.all.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    {{-- Custom Stylesheets --}}
    <link rel="stylesheet" href="{{ asset('assets/css/general/general.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/general/datatables.css') }}">

    @yield('styles')

</head>

<body class="body h-100">
    {{-- <div class="d-flex">
        <div> --}}
    <!-- Sidebar -->
    <div data-role="navview" data-expand-point="md">
        <div class="navview-pane">
            <!-- Toggle button -->
            <div class="logo-container">
                <button class="pull-button">
                    <span class="mif-menu"></span>
                </button>
            </div>

            <!-- Search box -->
            <div class="suggest-box">
                <input type="text" data-role="input" data-clear-button="false" data-search-button="true">
                <button class="holder">
                    <span class="mif-search"></span>
                </button>
            </div>

            <!-- Navigation menu -->
            <ul class="navview-menu">
                <li class="item-header">General</li>
                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                        <span class="icon"><span class="mif-home"></span></span>
                        <span class="caption">Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('new.ticket') ? 'active' : '' }}">
                    <a href="{{ route('new.ticket') }}">
                        <span class="icon"><span class="mif-home"></span></span>
                        <span class="caption">New Ticket</span>
                    </a>
                </li>
                {{-- <li class="{{ request()->routeIs('registered.users') ? 'active' : '' }}">
                    <a href="{{ route('registered.users') }}">
                        <span class="icon"><span class="mif-home"></span></span>
                        <span class="caption">Some Information</span>
                    </a>
                </li> --}}
                <li class="">
                    <a href="#" id="logout">
                        {{-- <span class="icon"><span class="mif-home"></span></span> --}}
                        <span class="caption">Logout</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" class="a">
                        <span class="icon"><span class="mif-cog"></span></span>
                        <span class="caption">Others</span>
                    </a>
                    <ul class="navview-menu" data-role="collapse">
                        <li><a href="{{ route('departments') }}"><span class="caption">Departments</span></a></li>
                        <li><a href="{{ route('branches') }}"><span class="caption">Branches</span></a></li>
                        <li><a href="#"><span class="caption">Security</span></a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="navview-content">
            <!-- Your page content goes here -->
            <div class="app-bar fg-white">
                <span class="app-bar-item">My Dashboard</span>
                <div class="app-bar-item ml-auto">
                    <input type="checkbox" data-role="theme-switcher"data-mode="button">
                    <span class="mif-user"></span> Admin
                </div>
            </div>

            <!-- Main Content -->
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
    </div>

    </div>

    {{-- <div class="w-xl">
            <div class="app-bar bg-dark fg-white">
                <a class="app-bar-item">My Dashboard</a>
                <div class="app-bar-item ml-auto">
                    <span class="mif-user"></span> Admin
                </div>
            </div>

            <!-- Main Content -->
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div> --}}

    </div>

    <div class="dialog" id="logoutDialog" data-role="dialog">
        <div class="dialog-title">Log Out?</div>
        <div class="dialog-content">Are you sure you want to log out?</div>
        <div class="dialog-actions">
            <button class="button js-dialog-close">Cancel</button>
            <button id="confirmLogout" class="button alert">Logout</button>
        </div>
    </div>
</body>
{{-- Scripts --}}
<script></script>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets/js/metro.all.js') }}"></script>
<script src="{{ asset('assets/js/self/general.js') }}"></script>

@yield('scripts')

</html>
