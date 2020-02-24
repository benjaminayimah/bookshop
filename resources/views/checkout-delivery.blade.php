@extends('layouts.checkoutMaster')
@section('title')
    Checkout!
@endsection

@section('checkout-content')

    <div class="row d-flex chkout-cont-wrap">
        <div class="col-md-8 my-chk-8">
            <div class="chkout-main-col">
                <div class="chkout-head">
                    <div><h6 class="cart-hd">Personal / Delivery information</h6></div>
                </div>
                <div class="chkout-del-main">
                    @if ($address == null)
                        @include('includes.addressForm')
                        @else
                        <div class="delivery-add">
                            <div class="pull-left"><h6 class="cart-hd"> <span class="chkout-checked"><i class="zmdi zmdi-check"></i></span>Delivery Address</h6></div>
                            <div class="pull-right">
                                <div class="d-flex">
                                    <form method="post" action="{{ route('post.changeadd') }}">
                                        @csrf
                                        <button class="edit-add epp-dark-blue"><small><strong><i class="zmdi zmdi-edit"></i> Change delivery address</strong></small></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div style="padding: 15px 0">
                            <h6 class="text-uppercase no-margin" style="font-size: 14px; font-weight: 700; color: rgb(50,50,50)">{{ $address->name }}</h6>
                            <div class="add-details">
                                <span>{{ $address->address }},</span>
                                <span>{{ $address->apartment }},</span>
                                <span>{{ $address->city }},</span>
                                <span>{{ $address->country }}</span>
                                <div>
                                    <span>{{ $address->phone }},</span>
                                    @if ($address->alt_phone )
                                        <span>{{ $address->alt_phone }},</span>
                                    @endif
                                    <span>{{ $address->email }}</span>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>
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
                <a  href="{{ route('get.checkoutpayment') }}" class="btn no-border epp-dark-blue-bg next-btn">Next step</a>
            </div>
        </div>
    </div>
@endsection