<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification">
    <div class="modal-dialog modal-dialog-centered modal-" role="document">
        <div class="modal-content animate-zoom">
            <div class="modal-header" style="border-bottom: none">
                <h6 class="cart-modal-title text-darker"><strong>Your shopping cart is ready!</strong></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="zmdi zmdi-close"></i>
                </button>
            </div>
            <div class="modal-body" style="padding: 0 24px">
                <div class="py-3 text-center" id="cart_modal_content"></div>
            </div>
            <div class="modal-footer" style="display: table; clear: both; width: 100%; border-top: none">
                <button type="button" class="btn cart-modal-btn clear-btn pull-left" data-dismiss="modal"><i class="zmdi zmdi-long-arrow-return"></i> Continue shopping</button>
                <a href="{{ route('get.cart') }}" class="btn pull-right cart-modal-btn cart-modal-btn1">Proceed to checkout</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="wish_list_modal" tabindex="-1" role="dialog" aria-labelledby="modal-notification">
    <div class="modal-dialog modal-dialog-centered modal-" role="document">
        <div class="modal-content animate-zoom">
            <div class="modal-header" style="border-bottom: none">
                <h6 class="cart-modal-title text-darker"><strong>Success!</strong></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="zmdi zmdi-close"></i>
                </button>
            </div>
            <div class="modal-body" style="padding: 0 24px">
                <div class="py-3 text-center" id="wish_list_mo_cont"></div>
            </div>
            <div class="modal-footer" style="display: table; clear: both; width: 100%; border-top: none">
                <a href="{{ route('get.customerAccWishlist') }}" class="btn pull-right cart-modal-btn cart-modal-btn1">View wish list</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="error_modal" tabindex="-1" role="dialog" aria-labelledby="modal-notification">
    <div class="modal-dialog modal-dialog-centered modal-" role="document">
        <div class="modal-content animate-zoom">
            <div class="modal-header" style="border-bottom: none">
                <h6 class="cart-modal-title text-danger"><strong>Error!</strong></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="zmdi zmdi-close"></i>
                </button>
            </div>
            <div class="modal-body" style="padding: 0 24px">
                <div class="py-3 text-center" id="error_modal_content"></div>
            </div>
            <div class="modal-footer" style="display: table; clear: both; width: 100%; border-top: none">
                <button type="button" class="btn cart-modal-btn clear-btn pull-left" data-dismiss="modal"><i class="zmdi zmdi-long-arrow-return"></i> Close</button>
                <a href="{{ route('login') }}" class="btn pull-right cart-modal-btn cart-modal-btn1">Login</a>
            </div>
        </div>
    </div>
</div>