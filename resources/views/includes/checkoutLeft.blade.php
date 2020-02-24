<div class="chkout-main-col">
    <div class="chkout-head">
        <div class="pull-left"><h6 class="cart-hd">Orders({{count($orders)}})</h6></div>
        <div class="pull-right">
            <div class="d-flex"><a href="{{ route('get.cart') }}" class="epp-dark-blue"><small><strong><i class="zmdi zmdi-edit"></i> Edit order</strong></small></a></div>
        </div>
    </div>
    <div class="chkout-content-main table-responsive">
        <table id="checkout_table" class="table align-items-center no-margin table-flush">
            <tbody>
            @foreach($orders as $order)
                <?php
                $rate = $order->discount;
                $percent = $rate/100;
                $discount_price = $percent * $order->price;
                $total = $order->price - $discount_price;
                ?>
                <tr>
                    <td>
                        <div class="td-col-1">
                            <div>
                                <img src="{{ route('get.bookImgs', [ 'filename' => $order->image]) }}" alt="" />
                            </div>
                            <div class="cart-it-desc">
                                <span class="cart-chkout-it-desc">{{ $order->item_title }}</span>
                                <p>
                                    <span class="cart-chkout-it-sub">Category: {{ $order->category }}</span>
                                </p>
                                <span class="cart-chkout-it-sub">Quantity: x{{ $order->quantity }} @if($order->discount > 0) @ <strong>{{ $order->discount }}% Discount</strong> @endif</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="chk-price-col">
                            <span class="chk-price-1 epp-dark-blue"><strong><span>GH₵ </span><span>{{ Number_format($total * $order->quantity, 2) }}</span></strong></span>
                            <p>
                                <span class="chk-price-2"><small>{{ Number_format($total, 2) }} per each</small></span>
                            </p>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="chkout-footer">
        <a href="javascript:void (0)" data-toggle="cart_enter_coupon" class="epp-dark-blue coupon-toggler">
            <h6 class="epp-dark-blue"><small><strong>Have discount coupon? Click here to enter it.</strong></small></h6>
        </a>
        <div id="cart_enter_coupon">
            <div class="form-group">
                <div class="input-group">
                    <input class="form-control" name="discountCoupon" placeholder="Discount coupon code" type="text">
                </div>
            </div>
        </div>
    </div>
</div>