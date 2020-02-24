<div class="chkout-main-col">
    <div class="chkout-head">
        <div class="pull-left"><h6 class="cart-hd">Orders({{count($orders)}})</h6></div>
        <div class="pull-right">
        @if ($orderStatus == 1)
            @if(count($orders) > 1)
                <div class="d-flex"><a href="javascript:void (0)" class="text-danger cus-cancel-order" data-target="ccl_all_ord_form" style="padding-top: 1px"><small><strong><i class="zmdi zmdi-delete"></i> Cancel all orders</strong></small></a></div>
                <form method="post" class="d-none" action="{{ route('post.cancelorder') }}" id="ccl_all_ord_form">
                    @csrf
                    <input type="hidden" name="inputID" value="{{ $id }}">
                    <input type="hidden" name="type" value="{{ csrf_token() }}">
                </form>
                @else
                    <span class="badge badge-pill badge-info">pending</span>
                @endif
        @elseif ($orderStatus == 2)
            <span class="badge badge-pill badge-primary">delivering</span>
        @elseif($orderStatus == 3)
            <span class="badge badge-pill badge-success"><i class="zmdi zmdi-check"></i> delivered</span>
        @elseif($orderStatus == 4)
            <span class="badge badge-pill badge-danger">canceled</span>
        @endif
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
                        @if ($orderStatus === '1')
                            <div style="text-align: right">
                            @if ($order->status === '1')
                                <a href="javascript:void (0)" class="text-danger cus-cancel-order" data-target="ccl_ord_form_{{ $order->id }}"><small><i class="zmdi zmdi-delete"></i> Cancel this order</small></a>
                            <form method="post" class="d-none" action="{{ route('post.cancelorder') }}" id="ccl_ord_form_{{ $order->id }}">
                                @csrf
                                <input type="hidden" name="inputID" value="{{ $order->id }}">
                                <input type="hidden" name="ordID" value="{{ $id }}">
                                <input type="hidden" name="type" value="0">
                            </form>
                                @elseif ($order->status === '4')
                                <span class="badge badge-pill badge-info">canceled</span>
                            @endif
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>