<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

@include('layouts.dashboard.head')
<link rel="stylesheet" type="text/css" href="{{ asset('asset/css-ltr/pages/authentication.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="blank-page">

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">

                @yield('content')
                @isset($slot)
                    {{ $slot }}
                @endisset
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>

    @include('layouts.dashboard.script')

</body>

</html>
