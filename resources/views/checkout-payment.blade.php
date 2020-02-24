@extends('layouts.checkoutMaster')
@section('title')
    Checkout!
@endsection

@section('checkout-content')

    <div class="row d-flex chkout-cont-wrap">
        <div class="col-md-8 my-chk-8">
            <div class="chkout-main-col">
                <div class="chkout-head">
                    <div><h6 class="cart-hd">Payment method</h6></div>
                </div>
                <form method="post" id="post_payment_mode_frm" action="{{ route('post.payment') }}">
                    @csrf
                    <div class="chkout-del-main">
                        <div class="custom-control custom-radio mb-3">
                            <input name="paymentModeRadio" class="custom-control-input" value="1" id="customRadio2" @if($payment_mode == 1) checked @endif  type="radio">
                            <label class="custom-control-label" for="customRadio2">
                                <span>Pay on delivery/pickup</span>
                            </label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input name="paymentModeRadio" class="custom-control-input" value="2" id="customRadio1" @if($payment_mode == 2) checked @endif type="radio">
                            <label class="custom-control-label" for="customRadio1">
                                <span>Pay through Mobile Money</span>
                                <p>
                                <div>
                                    <small style="font-size: 14px">Please make a deposit to our MTN Mobile Money number 054 124 7250. Use your Order Number of <strong>{{ $address->order_id }}</strong> as your reference. Thank you.</small>
                                </div>
                                </p>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4 my-chk-4">
            <div class="chkout-main-col">
                <div class="chkout-head" style="padding-bottom: 10px">
                    <div><h6 class="cart-hd">Summary</h6></div>
                </div>
                <div class="chkout-content-right">
                    <div class="summary-ins"><span class="epp-dark-blue">The total cost consist of Tax, insurance and the delivery charge.</span></div>
                    <div class="chkout_sub_totl_row">
                        <div class="tot-col td-col-1">
                            <span class="cart-chkout-it-sub"><strong>Subtotal</strong></span>
                        </div>
                        <div class="tot-col chk-price-col">
                            <span class="cart-chkout-it-sub"><strong>GH₵ <span id="chkout_subtotal" class="cart-chkout-it-sub"></span></strong></span>
                        </div>
                    </div>
                    <div class="chkout_totl_row">
                        <div class="tot-col">
                            <span class="cart-chkout-it-desc">Total</span>
                        </div>
                        <div class="tot-col chk-price-col">
                            <span class="cart-chkout-it-desc">GH₵ <span id="chkout_grand_total" class="cart-chkout-it-desc"></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="next-button-holder">
                <a href="javascript: void (0)" id="chkout_pay_btn" class="btn no-border epp-dark-blue-bg next-btn">Next step</a>
            </div>
        </div>
    </div>
@endsection