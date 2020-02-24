<div class="my-alerts-holder">
    @if (session('status'))
        <div id="alert" class="alert my-alerts alert-success alert-dismissible fade show">
            <button type="button" class="close my-success-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="zmdi zmdi-close"></span>
            </button>
            {{ session('status') }}
        </div>
    @endif
    @if (session('status2'))
        <div class="alert my-alerts alert-danger alert-dismissible fade show">
            <button type="button" class="close my-danger-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="zmdi zmdi-close"></span>
            </button>
            {{ session('status2') }}
        </div>
    @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show my-alerts" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="close my-danger-close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="zmdi zmdi-close"></span>
                </button>
            </div>
        @endif
</div>

@if (session('orderStatus'))
    <div class="my-order-success-alert show fade alert">
        <button type="button" class="close my-order-alert-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size: 25px" class="zmdi zmdi-close"></span>
        </button>
        <div class="fade show animate-zoom shadow" style="max-width: 300px;padding:40px 20px; margin: 0 auto; background-color: #fff; border-radius: 5px">
            <div id="order_success_icon_holder"><div class="animate-rotate"><i class="zmdi zmdi-check"></i></div></div>
            <h5 class="text-darker text-center mt-3">Thank you!</h5>
            <h6 class="mt-0" style="color: rgb(120, 121, 123)">{{ session('orderStatus') }}</h6>
            <div class="text-center mb-5" id="order_success_inner">
                <span class="ord-n text-dark">Order No.</span>
                <span class="text-dark">{{ session('orderID') }}</span>
            </div>
            <div id="order_success_icon_footer" class="text-center">
                <p>
                    @if (session('user') != null)
                        <a href="{{ route('get.customerAccOrders') }}" class="btn blue-btn-round epp-blue-bg">View order <i class="zmdi zmdi-long-arrow-right"></i></a>
                    @endif
                </p>
                <button type="button" class="btn blue-btn-round epp-red-bg" data-dismiss="alert">Continue shopping</button>
            </div>
        </div>
    </div>
@endif

@if (session('accountCreated'))
    <div class="my-order-success-alert show fade alert">
        <button type="button" class="close my-order-alert-close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="font-size: 25px" class="zmdi zmdi-close"></span>
        </button>
        <div class="fade show animate-zoom shadow" style="max-width: 300px;padding:40px 20px; margin: 0 auto; background-color: #fff; border-radius: 5px">
            <div id="order_success_icon_holder"><div class="animate-rotate"><i class="zmdi zmdi-check"></i></div></div>
            <h5 class="text-darker mt-3">Success!</h5>
            <div class="text-center mb-3" id="order_success_inner" style="line-height: 18px">
                <span class="ord-n text-dark"><small>Hello, {{ session('name') }}, {{ session('accountCreated') }}</small></span>
            </div>
            <p>
            <form method="post" action="{{ route('loginuser') }}" id="onthefly_logForm">
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" id="email" value="{{ session('email') }}" name="email" placeholder="Email">
                </div>
                <div class="form-group mb-1">
                    <input type="text" class="form-control" id="password" name="password" value="{{ session('pass') }}" placeholder="Password">
                </div>
                <div class="mb-2" style="text-align: left;">
                    <i class="zmdi zmdi-info-outline text-info"></i><small class="text-dark"> Your password is <strong>{{ session('pass') }}</strong>, please change after Sign-in</small>
                </div>
                <div class="form-group d-none">
                    <div class="custom-control custom-control-alternative custom-checkbox" style="padding-left: 28px">
                        <input name="type" value="_cart" type="hidden">
                        <input class="custom-control-input" name="rememberMe" checked id="myCheckLogin" type="checkbox">
                    </div>
                </div>

                <button type="submit" class="btn blue-btn-round epp-blue-bg" style="width: 100%">Sign in</button>
            </form>
            </p>
            <div id="order_success_icon_footer">
                <p>
                    <button type="button" class="btn blue-btn-round epp-red-bg" style="width: 100%" data-dismiss="alert">Skip & continue <i class="zmdi zmdi-long-arrow-right"></i></button>
                </p>
            </div>
        </div>
    </div>
@endif
@if (session('newsletter_token') == '')
    <div class="my-order-success-alert show fade alert" style="padding-top: 15%; background-color: rgba(0,0,0, 0.7)">
        <div class="fade show shadow" style="max-width: 700px;margin: 0 auto; position: relative; background-color: #fff; border-radius: 5px">
            <button type="button" class="close newsletter-alert-close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size: 25px" class="zmdi zmdi-close"></span>
            </button>
            <div class="d-flex" style="">
                <div class="col-sm-6 no-padding newl-col-1">
                    <div>
                        <img style="width: 100%;border-top-left-radius: 5px; border-bottom-left-radius: 5px" src="{{ URL::to('img/newsletter-banner222.jpg') }}">
                    </div>
                </div>
                <div class="col-sm-6 no-padding newl-col-2">
                    <form method="post" class="" style="padding: 30px 15px" action="{{ route('post.newsletter') }}">
                        <h6 class="text-darker newslh">Subscribe to our newsletter</h6>
                        <div id="mob_nwsin" class="mb-3">Learn about new offers and get more deals by subscribing to our newsletter.</div>
                        @csrf
                        <div class="form-group no-margin" style="">
                            <div class="input-group mb-3" id="newsletter_input_group">
                                <input class="form-control newsletter-input" name="email" placeholder="Enter your email" style="border-radius: 30px">
                            </div>
                            <div class="form-group d-flex mb-0">
                                <button type="submit" class="btn blue-btn-round newsletter-sub epp-red-bg" data-toggle="newsletter_onfly_load">submit</button>
                                <div id="newsletter_onfly_load"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endif




