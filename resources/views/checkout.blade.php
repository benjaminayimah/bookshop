@extends('layouts.checkoutMaster')
@section('title')
    Checkout!
@endsection

@section('checkout-content')

    <div class="row d-flex chkout-cont-wrap">
        <div class="col-md-8 my-chk-8">
            @include('includes.checkoutLeft')
        </div>
        <div class="col-md-4 my-chk-4">
            <!-- checkout right content -->
            @include('includes.checkoutRight')
            <div class="next-button-holder">
                <a  href="{{ route('get.checkoutdelivery') }}" class="btn no-border epp-dark-blue-bg next-btn">Next step</a>
            </div>
        </div>
    </div>

@endsection