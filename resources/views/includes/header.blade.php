<header class="header-global">
        <div id="msg"></div>
    <nav id="navbar-main" style="display: block;border-bottom:1px solid rgb(244, 245, 247)" class="navbar no-padding my-bgcolor-white navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
        
       <div>

            <div class="container" id="main_nav_container" style="position:relative">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img id="myImage" alt="EPP Books" src="{{ URL::to('img/brand/epp-logo.jpg') }}">
            </a>
            
            <div class="menu-srch-wrap d-lg-none" style=" float:right ">
                
                <button class="mb-navTggler d-lg-none">
                    <span class="zmdi zmdi-menu"></span>
                </button>
            </div>

            <div id="nav_top" class="sign-up-div">
                    <div class="container" style="padding-top:6px; display: table; clear: both">
                        <ul class="topper pull-right navbar-nav-hover navbar-nav ">
                            @guest()
                                <li class="nav-item dropdown sign-up-li">
                                    <a href="javascript: void (0)" class="acct_dropdown" role="button" data-toggle="dropdown"><i class="zmdi zmdi-account-o"></i><span class="guest-sgn">Sign In</span><i class="zmdi zmdi-chevron-down"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right my-top-dropdown">
                                        <a class="dropdown-item sgn-in-dropdown" href="{{ route('login') }}"><i class="zmdi zmdi-sign-in"></i>Log In</a>
                                        <a class="dropdown-item sgn-in-dropdown" href="{{ route('register') }}"><i class="zmdi zmdi-account-o"></i>Create Account</a>
                                    </div>
                                </li>
                            @endguest
                            @auth()
                                    <li class="nav-item dropdown sign-up-li">
                                        <a href="javascript: void (0)" class="acct_dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="zmdi zmdi-account-o"></i>
                                            <span class="auth-name">{{ auth()->user()->name }}</span>
                                            <i class="zmdi zmdi-chevron-down"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right my-top-dropdown" >
                                            @if( Auth::user() && Auth::user()->users == '1')
                                            <a class="dropdown-item sgn-in-dropdown" href="{{ route('dashboard') }}"><i class="zmdi zmdi-view-dashboard"></i><span>{{ __('Dashboard') }}</span></a>
                                            @endif
                                            <a class="dropdown-item sgn-in-dropdown" href="{{ route('get.customerAccHome') }}"><i class="zmdi zmdi-account-o"></i><span>{{ __('Account') }}</span></a>
                                            <a class="dropdown-item sgn-in-dropdown" href="{{ route('get.customerAccOrders') }}"><i style="font-size: 14px" class="ni ni-bag-17"></i><span>{{ __('Orders') }}</span></a>
                                            <a class="dropdown-item sgn-in-dropdown" href="{{ route('get.customerAccWishlist') }}"><i class="zmdi zmdi-favorite-outline"></i><span>{{ __('Wish list') }}</span></a>
                                            <hr style="margin: 0" />
                                            <a href="javascript: void (0)" class="dropdown-item" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="zmdi zmdi-sign-in"></i>
                                                <span>{{ __('Logout') }}</span>
                                            </a>
                                        </div>
                                    </li>
                                @endauth
                                <li class="nav-item dropdown sign-up-li" id="help_li">
                                    <a href="javascript: void (0)" class="acct_dropdown" role="button" data-toggle="dropdown"><i class="zmdi zmdi-help-outline"></i><span class="guest-sgn">Help</span><i class="zmdi zmdi-chevron-down"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right my-top-dropdown">
                                        <a class="dropdown-item sgn-in-dropdown" href="{{ route('get.default') }}">Contact us</a>
                                        <a class="dropdown-item sgn-in-dropdown" href="{{ route('get.default') }}">Delivery time</a>
                                    </div>
                                </li>
                                
                                    
                                <li class="nav-item">
                                    <a class="cart-count-hold " href="{{ route('get.cart') }}" >
                                        <i style="font-size: 14px" class="ni ni-bag-17"></i>
                                        <i id="cart_count" class="cart-count ttl-count">
                                            {{ $count }}
                                        </i>

                                    </a>
                                </li>
                        </ul>
                    </div>
            </div>

                <div class="navbar-collapse collapse" id="navbar_global">
                    <div class="navbar-collapse-header">
                        <div class="row">
                            <div class="col-6 collapse-close">
                                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <ul class="navbar-nav align-items-lg-center ml-lg-auto" style="width:80%">
                        <li class="nav-item">
                            <form method="get" action="{{ route('get.searchparam') }}" class="search-main-form">
                                <div class="form-group no-margin">
                                    <div class="input-group no-margin my-srch-hold ">
                                        <div class="input-group-prepend">
                                            <button type="submit" class="input-group-text btn my-srch-clicker"><i class="zmdi zmdi-search"></i></button>
                                        </div>
                                        <input class="form-control my-srch-input" name="searchparam" data-label="search_label" data-target="search_table_body" autocomplete="off" placeholder="Search store..." type="text">
                                    </div>
                                </div>
                                <div class="search-pane">
                                    <div class="search-pane-head d-flex">
                                        <div class="srch-loader"></div><h6 id="search_label" class="mb-0">Search EPP online bookshop</h6>
                                        <a href="javascript: void (0)" class="srch-pane-close"><i class="zmdi zmdi-close"></i></a>
                                    </div>
                                    <div id="search_pane_main" class="search-pane-main table-responsive">
                                        <table id="search_table" class="table align-items-center no-margin table-flush" >
                                            <tbody id="search_table_body">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="search-pane-foot">
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
           <div class="container d-lg-none" style="padding-bottom:10px">
               <form method="get" class="my-srch-hold2 search-main-form" action="{{ route('get.searchparam') }}" >
                   <div class="no-margin">
                       <div class="input-group no-margin">
                           <div class="input-group-prepend clicker2-hold" style="height: 30px;">
                               <button type="submit" class="input-group-text my-srch-clicker2"><i class="zmdi zmdi-search"></i></button>
                           </div>
                           <input class="form-control my-srch-input2" name="searchparam" data-label="search_label2" data-target="search_table_body2" autocomplete="off" placeholder="Search store..." type="text">
                       </div>
                   </div>
                   <div class="search-pane">
                       <div class="search-pane-head d-flex">
                           <div class="srch-loader"></div><h6 id="search_label2" class="mb-0">Search EPP online bookshop</h6>
                           <a href="javascript: void (0)" class="srch-pane-close"><i class="zmdi zmdi-close"></i></a>
                       </div>
                       <div id="search_pane_main" class="search-pane-main table-responsive">
                           <table id="search_table" class="table align-items-center no-margin table-flush" >
                               <tbody id="search_table_body2">
                               </tbody>
                           </table>
                       </div>
                       <div class="search-pane-foot">
                       </div>
                   </div>
               </form>
           </div>
       </div>
    </nav>
</header>
