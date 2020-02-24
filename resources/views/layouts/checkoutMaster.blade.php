<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,600" rel="stylesheet" type="text/css">

    <link href="{{ URL::to('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendor/material-design-iconic-font/css/material-design-iconic-font.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendor/material-design-iconic-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ URL::to('/css/argon.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ URL::to('/css/main-style.css') }}" rel="stylesheet">
    <script src="{{ URL::to('/vendor/jquery/jquery.min.js') }}"></script>
</head>
<body>

<!-- alerts-->
@include('includes.alerts')
<style>
    .chk-checked{ background-color: rgb(0, 230, 0);}
    #chk_top_hold{ display: table; clear: both; width: 100%}
</style>

<section>
    <div style="height: 250px; background-color: rgb(0,0,88)"></div>
    <section class="chkout-section-main">
        <div class=" chkout-container">
            <div id="chk_top_hold">
                <a class="go-home pull-left" href="{{ route('get.cart') }}"><i class="zmdi zmdi-long-arrow-left"></i> Go back to cart</a>
                @if (Route::is('get.checkoutdelivery'))
                    <a class="go-home pull-right" href="{{ route('get.checkout') }}"><i class="zmdi zmdi-long-arrow-left"></i> Previous step</a>
                    @elseif (Route::is('get.checkoutpayment'))
                    <a class="go-home pull-right" href="{{ route('get.checkoutdelivery') }}"><i class="zmdi zmdi-long-arrow-left"></i> Previous step</a>
                    @elseif(Route::is('get.checkoutconfirm'))
                    <a class="go-home pull-right" href="{{ route('get.checkoutpayment') }}"><i class="zmdi zmdi-long-arrow-left"></i> Previous step</a>
                @endif
            </div>
            <div class="my-nav-hold">
                <div class="my-nav row d-flex">
                    <div class="col-md-3 chk-md-3 {{ Route::is('get.checkout') ? 'col-active' : '' }}">
                            @if ($checkOd == 1)
                                <span class="nav-indicator chk-checked"><i class="zmdi zmdi-check"></i></span>
                            @else
                                <span class="nav-indicator {{ Route::is('get.checkout') ? 'nav-active' : '' }}">1</span>
                            @endif

                        <span>Order details</span>
                    </div>
                    <div class="col-md-3 chk-md-3 {{ Route::is('get.checkoutdelivery') ? 'col-active' : '' }}">
                            @if(Route::is('get.checkoutdelivery'))
                                <span class="nav-indicator nav-active">2</span>
                            @elseif ($address != null)
                                <span class="nav-indicator chk-checked"><i class="zmdi zmdi-check"></i></span>
                            @else
                                <span class="nav-indicator">2</span>
                            @endif
                        <span>Personal/Delivery details</span>
                    </div>
                    <div class="col-md-3 chk-md-3 {{ Route::is('get.checkoutpayment') ? 'col-active' : '' }}">
                            @if(Route::is('get.checkoutpayment'))
                                <span class="nav-indicator nav-active">3</span>
                            @elseif ($payment_mode != 0)
                                <span class="nav-indicator chk-checked"><i class="zmdi zmdi-check"></i></span>
                            @else
                                <span class="nav-indicator">3</span>
                            @endif
                        <span>Payment</span>
                    </div>
                    <div class="col-md-3 chk-md-3 {{ Route::is('get.checkoutconfirm') ? 'col-active' : '' }}">
                           <span class="nav-indicator {{ Route::is('get.checkoutconfirm') ? 'nav-active' : '' }}">4</span>
                        <span>Confirm & Submit</span>
                    </div>
                </div>
            </div>

            @yield('checkout-content')

            <h2 style="background-image: url('img/header_bgr_diag.png'); height:15px"></h2>
            <div class="chkout-main-footer">
                <div class="row">
                    <div class="col-md-4">
                        <div class="chkout-footer-head">
                            <i class="zmdi zmdi-shield-check"></i>
                        </div>
                        <h6 class="cart-hd">Secured checkout</h6>
                        <div class="chkout-footer-content">
                                <span class="cart-chkout-it-sub">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                                </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="chkout-footer-head">
                            <i class="zmdi zmdi-lock-outline"></i>
                        </div>
                        <h6 class="cart-hd">Your information is secured</h6>
                        <div class="chkout-footer-content">
                                <span class="cart-chkout-it-sub">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                                </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="chkout-footer-head">
                            <i class="zmdi zmdi-headset-mic"></i>
                        </div>
                        <h6 class="cart-hd">24/7 Support</h6>
                        <div class="chkout-footer-content">
                                <span class="cart-chkout-it-sub">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<script src="{{ URL::to('js/main.js') }}"></script>
<script src="{{ URL::to('js/my-checkout-js.js') }}"></script>
<script src="{{ URL::to('js/my-js.js') }}"></script>
<script src="{{ URL::to('/vendor/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::to('/js/argon.js') }}"></script>
<script src="{{ URL::to('/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
</body>
</html>
