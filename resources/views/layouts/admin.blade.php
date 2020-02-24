<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Argon Dashboard') }}</title>
    <!-- Favicon -->
    <link href="{{ URL::to('/dash/img/brand/favicon.png') }}" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <!-- Icons -->
    <link href="{{ URL::to('/dash/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ URL::to('/dash/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ URL::to('/dash/css/argon.css?v=1.0.0') }}" rel="stylesheet">
    <link type="text/css" href="{{ URL::to('dash/css/dash-main.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ URL::to('/css/scroll.css') }}" rel="stylesheet">
    <script src="{{ URL::to('/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::to('dash/js/dash-main.js') }}"></script>
</head>
<body class="{{ $class ?? '' }}">
@auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: block;">
        @csrf
    </form>
    @include('includes.alerts')
    <!-- sidemenu-->
    @include('dashboard.includes.side-nav')
    <!--/side menu-->

<div class="main-content">
    @include('dashboard.includes.top-header')

    <div class="header gradient-hero pb-8 pt-5" style="padding-top: 72px !important;">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">@yield('pageTitle')</h6>
                        <nav class="d-none d-md-inline-block ml-md-4" aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                                @yield('titlemain')
                                <li class="breadcrumb-item active" aria-current="page">@yield('pageTitle')</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        @yield('new-btn')
                        <a href="#" class="btn btn-sm btn-neutral">Filters</a>
                    </div>
                </div>
                <!-- Card stats -->
                <!-- first card-->
                @yield('first-card')
                <!--/first card-->

            </div>
        </div>
    </div>

    <div class="container-fluid mt--7">
        <!-- second card-->
        @yield('second-card')
        <!--/second card-->
        <!-- third card-->
        @yield('third-card')
        <!--/third card-->
        @include('dashboard.includes.footer')
    </div>


</div>
    @push('js')
        <script src="{{ URL::to('dash/vendor/chart.js/dist/Chart.min.js') }}"></script>
        <script src="{{ URL::to('dash/vendor/chart.js/dist/Chart.extension.js') }}"></script>
    @endpush
    @include('dashboard.includes.book-preview')
    @include('includes.js-routes')
@endauth
<script src="{{ URL::to('/dash/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ URL::to('/dash/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ URL::to('/vendor/jquery-scroll-lock/jquery-scrollLock.min.js') }}"></script>
<script src="{{ URL::to('/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>

@stack('js')

<!-- Argon JS -->
<script src="{{ URL::to('/dash/js/argon.js?v=1.0.0') }}"></script>
</body>
</html>
