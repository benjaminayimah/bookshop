@extends('layouts.customerAccMaster')

@section('customerAccLeft')
    <div class="cus-acctright-list">
        <h5 class="customer-acc-h5">User Account</h5>
        <div class="row my-cus-row">
            <div class="col-md-6">
                <div class="cus-acc-details-holder">
                    @if (isset($accDetails))
                        <div class="delivery-add">
                            <div class="pull-left"><h6 class="cart-hd"> <span class="chkout-checked bg-grey"><i class="zmdi zmdi-check"></i></span>Account Details</h6></div>
                            <div class="pull-right">
                                <div class="d-flex">
                                    <a href="{{ route('get.Editcustacct', ['key' => 'edit-account']) }}" class="edit-add epp-blue"><small><strong><i class="zmdi zmdi-edit"></i> Edit account</strong></small></a>
                                </div>
                            </div>
                        </div>
                        <div style="padding: 15px 0">
                            <h6 class="text-uppercase no-margin" style="font-size: 14px; font-weight: 700; color: rgb(50,50,50)">{{ $accDetails->name }}</h6>
                            <div class="add-details">
                                <p><span>{{ $accDetails->email }}</span></p>
                                <a href="{{ route('get.Editcustacct', ['key' => 'edit-pass']) }}" class="cnt-shop epp-blue">Change password</a>
                            </div>
                        </div>
                        @else
                        Not available!
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="cus-acc-details-holder">
                    @if (isset($address))
                        <div class="delivery-add">
                            <div class="pull-left"><h6 class="cart-hd"> <span class="chkout-checked bg-grey"><i class="zmdi zmdi-check"></i></span>Delivery Address</h6></div>
                            <div class="pull-right">
                                <div class="d-flex">
                                    <a href="{{ route('post.get.deliveryadd') }}" class="edit-add epp-blue"><small><strong><i class="zmdi zmdi-edit"></i> Edit address</strong></small></a>
                                </div>
                            </div>
                        </div>
                        <div style="padding: 15px 0">
                            <h6 class="my-darkgrey">Your shipping address is:</h6>
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
                    @else
                        <div class="delivery-add">
                            <div class="pull-left"><h6 class="cart-hd"> <span class="chkout-checked"><i class="zmdi zmdi-check"></i></span>Delivery Address</h6></div>
                            <div class="pull-right">
                                <div class="d-flex">
                                    <a href="{{ route('post.get.deliveryadd') }}" class="edit-add epp-blue"><small><strong><i class="zmdi zmdi-plus"></i> Add address</strong></small></a>
                                </div>
                            </div>
                        </div>
                        <div style="padding: 15px 0">
                            No address available!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop