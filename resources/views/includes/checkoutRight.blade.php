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
        <div class="table-responsive">
            <table id="charges_table" class="table align-items-center no-margin table-flush">
                <tbody>
                @foreach($charges as $charge)
                    <tr id="charges_row">
                        <td>
                            <div class="td-col-1"><span class="cart-chkout-it-sub">{{ $charge->name }}</span></div>
                        </td>
                        <td>
                            @if ($charge->value == 0)
                                <div class="chk-price-col"><span class="cart-chkout-it-sub"><span class="cart-chkout-it-sub"></span><span class="cart-chkout-it-sub">FREE</span></span></div>
                            @else
                                <div class="chk-price-col"><span class="cart-chkout-it-sub">GH₵ <span class="cart-chkout-it-sub">{{ Number_format($charge->value, 2) }}</span></span></div>
                            @endif

                        </td>
                    </tr>
                @endforeach
                @if($coupon != null)
                    <tr id="charges_row">
                        <td>
                            <div class="td-col-1"><span class="cart-chkout-it-sub">Coupon discount</span></div>
                        </td>
                        <td>
                            <div class="chk-price-col"><span class="cart-chkout-it-sub">GH₵ <span class="cart-chkout-it-sub">{{ Number_format($coupon, 2) }}</span></span></div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
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