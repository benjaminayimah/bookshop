@extends('layouts.master')
@section('title')
    My Account
@endsection

@section('body')
    <!--main-section-->
    <style>
        .cus-acctleft-list{ padding: 20px 0;background-color: #fff; border-radius: 4px;
            border: 1px solid rgb(240, 241, 243); }
        .cus-acctright-list{ padding: 20px; background-color: #fff; border-radius: 4px;
            border: 1px solid rgb(240, 241, 243);}
        .customer-acc-h5{border-left: 3px solid ;padding-left: 10px; color:rgb(33, 37, 41);}
        .cus-acctleft-list ul{ padding: 0 0 15px 0; margin-bottom: 15px; border-bottom: 1px solid rgb(230, 231, 233)}
        .cus-acctleft-list ul li{ list-style-type: none}
        .cus-acctleft-list ul li a, .cus-acctleft-list a{ color: rgb(33, 37, 41); font-size: 15px; padding: 10px 20px; display: block}
        .cus-acctleft-list ul li a i, .cus-acctleft-list a i{ margin-right: 15px; font-size: 18px}
        .cus-acctleft-list a:hover { color: rgb(94, 114, 228);
            background-color: #f6f9fc;}
        .cus-link-active{ color: #2643e9 !important;
            background-color: #f6f9fc;}
        .my-cus-row{ padding: 20px 0}
        .cus-acc-details-holder{ padding: 15px; border: 1px solid rgb(244, 245, 247); border-radius: 4px; margin: 15px 0}
    </style>
    <main>
        <div class="container" style="padding-top: 30px">
            <div class="row">
                <div class="col-md-3">
                    <div class="cus-acctleft-list">
                        <ul>
                            <li><a class="{{ Route::is('get.customerAccHome') ? 'cus-link-active' : '' }}" href="{{ route('get.customerAccHome') }}"><i class="zmdi zmdi-account-o"></i><span>{{ __('My Account') }}</span></a></li>
                            <li><a class="{{ Route::is('get.customerAccOrders') ? 'cus-link-active' : '' }}" href="{{ route('get.customerAccOrders') }}"><i style="font-size: 14px" class="ni ni-bag-17"></i><span>{{ __('Orders') }}</span></a></li>
                            <li><a class="{{ Route::is('get.customerAccWishlist') ? 'cus-link-active' : '' }}" href="{{ route('get.customerAccWishlist') }}"><i class="zmdi zmdi-favorite-outline"></i><span>{{ __('Wish list') }}</span></a></li>
                        </ul>
                        <div>
                            <a href="javascript: void (0)" class="" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="zmdi zmdi-sign-in"></i>
                                <span>{{ __('Logout') }}</span>
                            </a>
                        </div>

                    </div>
                </div>
                <div class="col-md-9">
                    @yield('customerAccLeft')
                </div>
            </div>
            <section style="margin-top: 30px">
               <div class="cus-acctright-list">
                   <h5 class="customer-acc-h5">Recommended for you</h5>
               </div>
            </section>
        </div>
    </main>
    <!--/main-section-->
@endsection