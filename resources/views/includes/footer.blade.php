<style>
    .my-footer{ background-color: rgb(0, 0, 99); padding: 15px 0;}
    .footer-social i{ color: rgb(255, 255, 255); font-size: 20px}
    .footer-social a{ margin-right: 10px}
    .nav-footer li a{ color: rgb(255, 255, 255); font-size: 13px !important;}
    .quick-links ul{ padding: 0}
    .quick-links li{ list-style-type: none}
    .quick-links li a{ color: rgb(250, 251, 253); font-size: 13px}
    .quick-links li:hover a{ color: rgb(94, 114, 228);}
    .quick-links h6{ color: #ffffff; font-weight: 700}
</style>

<footer class="my-footer" >
    <div class="container">
        <div class="row  my-md">
            <div class="col-lg-3 quick-links">
                <h6>Get to Know Us</h6>
                <ul>
                    <li><a href="{{ route('get.default') }}">About Us</a></li>
                    <li><a href="{{ route('get.default') }}">Contact Us</a></li>
                    <li><a href="{{ route('get.default') }}">Careers</a></li>
                    <li><a href="{{ route('get.default') }}">Gallery</a></li>
                    <li><a href="{{ route('get.default') }}">Blog</a></li>
                </ul>
            </div>
            <div class="col-lg-3 quick-links">
                <h6>Other Useful Links</h6>
                <ul>
                    <li><a href="#">EPP Books Services Ltd.</a></li>
                    <li><a href="#">Legon City Mall</a></li>
                    <li><a href="#">Tesbury</a></li>
                    <li><a href="#">Zeeland Fun World</a></li>
                    <li><a href="#">Ghana Books online</a></li>
                </ul>
            </div>
            <div class="col-lg-3 quick-links">
                <h6>Let Us Help You</h6>
                <ul>
                    <li><a href="{{ route('get.customerAccHome') }}">Your Account</a></li>
                    <li><a href="{{ route('get.customerAccOrders') }}">Your Orders & Tracking</a></li>
                    <li><a href="{{ route('get.default') }}">Shipping & Delivery</a></li>
                    <li><a href="{{ route('get.default') }}">Returns & Replacement Policy</a></li>
                    <li><a href="{{ route('get.default') }}">Report Abuse</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h3 class="font-weight-bold text-white mb-2">EPP Books Services</h3>
            </div>
        </div>
        <hr style="margin-bottom: 15px">
        <div class="row align-items-center justify-content-md-between">
            <div class="col-md-6">
                <div class="footer-social">
                    <a target="_blank" href="#" data-toggle="tooltip" data-original-title="Like us">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                    <a target="_blank" href="#" data-toggle="tooltip" data-original-title="Follow us">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a target="_blank" href="#" data-toggle="tooltip" data-original-title="Follow us">
                        <i class="fa fa-instagram"></i>
                    </a>
                    <a target="_blank" href="#" data-toggle="tooltip" data-original-title="Follow us">
                        <i class="fa fa-youtube-play"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <ul class="nav nav-footer justify-content-end footer-bottom">
                    <li class="nav-item">
                        <a href="{{ route('get.default') }}" class="nav-link" target="_blank">Privacy</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('get.default') }}" class="nav-link" target="_blank">Terms</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('get.default') }}" class="nav-link" target="_blank">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('get.default') }}" class="nav-link" target="_blank">Help</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
