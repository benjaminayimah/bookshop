@extends('layouts.checkoutMaster')
@section('title')
    Checkout!
@endsection

@section('checkout-content')

    <div class="row d-flex chkout-cont-wrap">
        <div class="col-md-8 my-chk-8">
            @include('includes.checkoutLeft')
            <div class="chkout-main-col">
                <div class="chkout-head">
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
                </div>
                <div class="chkout-del-main">
                    <div>
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
                </div>
            </div>
        </div>
        <div class="col-md-4 my-chk-4">
            @include('includes.checkoutRight')
            <div class="next-button-holder">
                <form method="post" action="{{ route('post.sumitOrder') }}">
                    @csrf
                    <button type="submit" class="btn no-border epp-dark-blue-bg next-btn">Submit order</button>
                </form>
            </div>
        </div>
    </div>
@endsection