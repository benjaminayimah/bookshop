@extends('layouts.master')
@section('title')
    Shopping Cart
@endsection

@section('body')
    <!--main-section-->
    <style>
        .qunty-post{ text-align: center}
        .qunty-counter{
            padding: 5px 8px;
            height: 40px;
            font-weight: 600;
            color: #2643e9;
        }
    </style>
    <script src="{{ URL::to('js/my-cart-js.js') }}"></script>
    <main>
        <section>
            <div class="container">
                <div class="cart-main-holder">

                    @if(count($carts) > 0 )
                        <div class="cart-wrap">
                            <div id="cart_alert"></div>
                            <div class="cart-hd-hold pull-left"><h6 class="cart-hd">Your Cart</h6> <span class="total-cart-count"><span class="ttl-count">{{ $carts->count() }}</span> Item(s)</span>
                            </div>
                            <div class="cart-total-hold pull-right"><small>Total</small><span class="ghc">GH₵</span><span id="cart_total_val" class="text-bold"></span></div>
                            <div class="table-responsive">
                                <table id="cart_table" class="table align-items-center table-flush">
                                    <tbody>

                                    @foreach($carts as $cart)
                                        <?php
                                        $rate = $cart->discount;
                                        $percent = $rate/100;
                                        $discount_price = $percent * $cart->price;
                                        $total = $cart->price - $discount_price;
                                        $total_price = $total;
                                        ?>
                                        <tr id="authcart_row_{{ $cart->id }}">
                                            <td scope="row" aria-multiselectable="true">
                                                <div class="td-col-1">
                                                    <div>
                                                        <img src="{{ route('get.bookImgs', [ 'filename' => $cart->image]) }}" alt="" />
                                                    </div>
                                                    <div class="cart-it-desc">
                                                        <span class="cart-chkout-it-desc">{{ $cart->title }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td scope="row" aria-multiselectable="true">
                                                <div class="">
                                                    <form id="qnty_form1{{ $cart->id }}" method="post" data-id="{{ $cart->id }}" data-toggle="qnt_{{ $cart->id }}"  class="qnt-holder" action="{{ route('post.cartQtty') }}">
                                                        @csrf
                                                        <label for="qnt1_{{ $cart->id }}">Quantity</label>
                                                        <a href="javascript: void (0)" class="qunty-counter qnty-minus" data-input="qnt_{{ $cart->id }}"><i class="zmdi zmdi-minus"></i></a>
                                                        <input value="{{ $cart->quantity }}" id="qnt_{{ $cart->id }}" name="quantityInput" class="qunty-post form-control" type="text">
                                                        <a href="javascript: void (0)" class="qunty-counter qnty-add" data-input="qnt_{{ $cart->id }}"><i class="zmdi zmdi-plus"></i></a>
                                                        <input name="dataID" value="{{ $cart->id }}" type="hidden">
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="pr-0" scope="row" aria-multiselectable="true">
                                                <div class="sub-tl-holder">
                                                    <div class="load-hold" id="load_{{ $cart->id }}"></div>

                                                    <div class="sub-tl-2">
                                                        <button type="button" data-dismiss="alert" class="remvFromCart" data-load="load_{{ $cart->id }}" data-toggle="authcart_row_{{ $cart->id }}" data-id="{{ $cart->id }}" aria-label="Close">
                                                            <i class="zmdi zmdi-close"></i>
                                                        </button>
                                                    </div>
                                                    <div class="sub-tl-1">
                                                        <span class="ghc">GH₵</span>
                                                        <div id="cartVal_{{ $cart->id }}"><?php echo number_format($total_price * $cart->quantity, 2) ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row" style="padding-top:20px">
                                <div class="col-md-6 cnt-shop-hold"><a href="{{ route('welcome') }}" class="cnt-shop epp-blue"><i class="zmdi zmdi-long-arrow-left"></i> Continue shopping</a></div>
                                <div class="col-md-6" style="text-align:right">
                                    <form method="post" id="clear_cart_form" action="{{ route('post.clearcart') }}">
                                        @csrf
                                    </form>
                                    <button class="btn btn clear-btn clear-cart" type="button">Clear cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="cart-wrap" style="margin-top: 15px">
                            @guest()
                                <div class="row">
                                    <div class="col-md-6">
                                            <div id="cart_login_hold">
                                                <h6 class="epp-dark-blue"><strong>Sign in</strong></h6>
                                                <p style="font-size: 14px"><i class="zmdi zmdi-info text-info"></i> If you have sign-in details, please sign-in to continue. Otherwise <a href="{{ route('register') }}">create a new account</a>, or skip the sign-in process and checkout.</p>
                                                <form method="post" action="{{ route('loginuser') }}">
                                                    @csrf
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="email">Email</label>
                                                            <input type="email" class="form-control" id="email" value="{{ old('email') }}" name="email" placeholder="Email">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="password">Password</label>
                                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="custom-control custom-control-alternative custom-checkbox" style="padding-left: 28px">
                                                            <input name="type" value="_cart" type="hidden">
                                                            <input class="custom-control-input" name="rememberMe" id="myCheckLogin" type="checkbox">
                                                            <label class="custom-control-label" for="myCheckLogin">
                                                                Remember me
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn clear-btn cart-login-btn">Sign in</button>
                                                </form>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="">
                                            <h6 class="text-dark"><strong>Why do i need to Sign-in?</strong></h6>
                                            <p style="font-size: 14px"></p>
                                        </div>
                                    </div>
                                </div>
                            @endguest
                            <form method="post" action="{{ route('post.initorder') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6" style="text-align:right">
                                        <button type="submit" style="line-height: 27px" class="btn no-border epp-dark-blue-bg">Proceed to checkout</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @else
                        <div class="alert alert-info  fade show" role="alert">
                            <span class="alert-inner--icon"><i class="ni ni-bell-55"></i></span>
                            <span class="alert-inner--text"><strong>Info!</strong> No item in your cart!</span>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
    <!-- -->
@endsection