<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendor/material-design-iconic-font/css/material-design-iconic-font.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendor/material-design-iconic-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ URL::to('/css/argon.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ URL::to('/css/main-style.css') }}" rel="stylesheet">
    <script src="{{ URL::to('/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::to('js/main.js') }}"></script>
    <script src="{{ URL::to('js/my-js.js') }}"></script>

</head>
<body>
@auth()
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
@endauth
@include('includes.header')
@include('includes.alerts')
@yield('body')

@include('includes.mb-sidemenu')
@include('includes.footer')

@include('includes.js-routes-user')
@include('includes.userModals')

<script src="{{ URL::to('/vendor/popper/popper.min.js') }}"></script>
<script src="{{ URL::to('/vendor/bootstrap/bootstrap.min.js') }}"></script>

<!-- Theme JS -->
<script src="{{ URL::to('/js/argon.js') }}"></script>
<!-- DatePicker JS -->
<script src="{{ URL::to('/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::to('vendor/headroom/headroom.min.js') }}"></script>


</body>
</html>
