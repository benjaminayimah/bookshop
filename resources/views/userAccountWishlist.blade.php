@extends('layouts.customerAccMaster')

@section('customerAccLeft')
    <div class="cus-acctright-list">
        <h5 class="customer-acc-h5">Wish List</h5>
        <div class="row my-cus-row">
            <div class="col-md-12">
                    @if (count($wishlist) > 0)
                        @foreach($wishlist as $wish)
                        <div class="cus-acc-details-holder">
                            <?php
                            $rate = $wish->discount;
                            $percent = $rate/100;
                            $discount_price = $percent * $wish->price;
                            $total = $wish->price - $discount_price;
                            ?>
                        <div class="row" style="padding: 15px 0">
                            <div class="col-md-2">
                                <div class="wish-img-hold">
                                    <img src="{{ route('get.bookImgs', [ 'filename' => $wish->image]) }}" alt="" />
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="cart-it-desc">
                                    <span class="cart-chkout-it-desc">{{ $wish->title }}</span>
                                    <p>
                                        <span class="cart-chkout-it-sub">Category: {{ $wish->category }}</span>
                                    </p>
                                    <span class="cart-chkout-it-sub">@if($wish->discount > 0) @ <strong>{{ $wish->discount }}% Discount</strong> @endif</span>
                                    @if ($wish->discount > 0)
                                        <div class="price-holder">GH₵ {{ number_format($total, 2) }}</div>
                                        <div class="price-canceled">GH₵ {{ number_format($wish->price, 2)}}</div>
                                    @else
                                        <div class="price-holder">GH₵ {{ number_format($wish->price, 2)}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <form onsubmit="return false;"  method="POST">
                                    @csrf
                                    <input type="hidden" id="itd_inp_{{ $wish->id }}" type="hidden" name="itemId" value="{{ $wish->item_id }}">
                                </form>
                                <div class="wish-btn-hold1">
                                    <a href="javascript:void (0)" class="btn wish-btn add-to-cart" data-load="itd-lazyload-{{ $wish->id }}" data-target="itd_inp_{{ $wish->id }}">Buy</a>
                                    <div class="itd-lazy-loader" id="itd-lazyload-{{ $wish->id }}" style="left: 15px !important;"></div>
                                </div>
                                <div class="wish-btn-hold2">
                                    <form id="remv_wishform_{{ $wish->id }}" method="post" action="{{ route('post.remvWishItem') }}">
                                        @csrf
                                        <input type="hidden" name="input" value="{{ $wish->id }}">
                                    </form>
                                    <a href="javascript:void (0)" class="btn wish-btn remv-wish" data-target="remv_wishform_{{ $wish->id }}"><i class="zmdi zmdi-delete"></i> Remove</a>
                                </div>
                            </div>
                        </div>
                        </div>
                        @endforeach
                    @else
                        <div class="cus-acc-details-holder">No item in your wish list!</div>
                    @endif
            </div>
        </div>
    </div>
@stop