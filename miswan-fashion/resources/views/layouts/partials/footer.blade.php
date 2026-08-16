<footer class="footer-area bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row">
            <!-- Col 1: About & Info -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-widget">
                    <img src="{{ asset($globalSetting->logo ?? 'assets/images/logo.png') }}" alt="{{ $globalSetting->site_name ?? 'Sija World' }}" style="max-height: 48px; width: auto;" class="mb-3">
                    <p class="text-muted" style="font-size: 14px; line-height: 1.6;">
                        Sija World is one of Bangladesh’s leading lifestyle & fashion brands, providing authentic products, exclusive fragrances, and trendiest fashion collections with fast nationwide delivery.
                    </p>
                    <ul class="list-unstyled text-muted" style="font-size: 14px;">
                        <li class="mb-2"><i class="fa fa-map-marker text-primary mr-2"></i> {{ $globalSetting->address ?? 'Dhaka, Bangladesh' }}</li>
                        <li class="mb-2"><i class="fa fa-phone text-primary mr-2"></i> {{ $globalSetting->phone ?? '+8801700000000' }}</li>
                        <li class="mb-2"><i class="fa fa-envelope text-primary mr-2"></i> {{ $globalSetting->email ?? 'support@sijaworld.com' }}</li>
                    </ul>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-widget">
                    <h5 class="text-white font-weight-bold mb-3 border-bottom pb-2" style="border-color: rgba(255,255,255,0.1) !important;">Quick Links</h5>
                    <ul class="list-unstyled" style="font-size: 14px; line-height: 2;">
                        <li><a href="{{ route('page.show', 'About-Us-2') }}" class="text-muted">About Us</a></li>
                        <li><a href="{{ route('page.show', 'Terms-&-Conditions-4') }}" class="text-muted">Terms & Conditions</a></li>
                        <li><a href="{{ route('page.show', 'Privacy-Policy-3') }}" class="text-muted">Privacy Policy</a></li>
                        <li><a href="{{ route('page.show', 'Refund-&-Return-Policy-5') }}" class="text-muted">Return Policy</a></li>
                        <li><a href="{{ route('contact') }}" class="text-muted">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <!-- Col 3: Customer Care -->
            <div class="col-lg-2 col-md-6 mb-4">
                <div class="footer-widget">
                    <h5 class="text-white font-weight-bold mb-3 border-bottom pb-2" style="border-color: rgba(255,255,255,0.1) !important;">Customer Care</h5>
                    <ul class="list-unstyled" style="font-size: 14px; line-height: 2;">
                        <li><a href="{{ route('track.order') }}" class="text-muted">Track Order</a></li>
                        <li><a href="{{ route('wishlist.index') }}" class="text-muted">My Wishlist</a></li>
                        <li><a href="{{ route('cart.index') }}" class="text-muted">Shopping Cart</a></li>
                        <li><a href="{{ route('checkout.index') }}" class="text-muted">Direct Checkout</a></li>
                    </ul>
                </div>
            </div>

            <!-- Col 4: Payment Gateways & Socials -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="footer-widget">
                    <h5 class="text-white font-weight-bold mb-3 border-bottom pb-2" style="border-color: rgba(255,255,255,0.1) !important;">We Accept</h5>
                    <p class="text-muted" style="font-size: 13px;">100% Safe & Secure Payment Channels and Cash on Delivery across Bangladesh.</p>


                    <div class="footer-social mt-3">
                        <span class="text-muted mr-2">Stay Connected:</span>
                        @if(!empty($globalSetting->facebook_url))
                            <a href="{{ $globalSetting->facebook_url }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle mr-1"><i class="fa fa-facebook"></i></a>
                        @endif
                        @if(!empty($globalSetting->youtube_url))
                            <a href="{{ $globalSetting->youtube_url }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle mr-1"><i class="fa fa-youtube"></i></a>
                        @endif
                        @if(!empty($globalSetting->instagram_url))
                            <a href="{{ $globalSetting->instagram_url }}" target="_blank" class="btn btn-sm btn-outline-light rounded-circle"><i class="fa fa-instagram"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="row pt-3 mt-3 border-top" style="border-color: rgba(255,255,255,0.1) !important;">
            <div class="col-md-6 text-center text-md-left">
                <p class="text-muted small m-0">&copy; {{ date('Y') }} {{ $globalSetting->site_name ?? 'Miswan Fashion' }}. All Rights Reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-right mt-2 mt-md-0">
                <p class="text-muted small m-0">Designed & Powered by Sija World Engineering Team</p>
            </div>
        </div>
    </div>
</footer>
