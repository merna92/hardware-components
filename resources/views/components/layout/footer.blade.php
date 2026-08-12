<footer class="custom-footer bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-md-3">
                <h5 class="fw-bold text-white mb-3 silica-brand-text-footer">{{ app()->getLocale() == 'ar' ? 'سيليكا' : 'SILICA' }}</h5>
                <p class="text-secondary fs-6">{{ __('High quality computer hardware components for your custom PC builds and gaming setup.') }}</p>
            </div>

            <div class="col-12 col-md-3">
                <h5 class="fw-bold text-white mb-3">{{ __('Support') }}</h5>
                <ul class="list-unstyled text-secondary fs-6">
                    <li class="mb-2"><i class="bi bi-geo-alt text-danger me-2"></i>{{ __('111 Cairo Tech Hub, Egypt') }}</li>
                    <li class="mb-2"><i class="bi bi-envelope text-danger me-2"></i>support@silica.com</li>
                    <li><i class="bi bi-telephone text-danger me-2"></i>+8801611112222</li>
                </ul>
            </div>

            <div class="col-12 col-md-3">
                <h5 class="fw-bold text-white mb-3">{{ __('Account') }}</h5>
                <ul class="list-unstyled d-flex flex-column gap-2 fs-6">
                    <li><a href="{{ route('profile') }}" class="text-secondary text-decoration-none hover-white">{{ __('My Account') }}</a></li>
                    <li><a href="{{ route('login') }}" class="text-secondary text-decoration-none hover-white">{{ __('Login / Register') }}</a></li>
                    <li><a href="{{ route('cart.index') }}" class="text-secondary text-decoration-none hover-white">{{ __('Cart') }}</a></li>
                    <li><a href="{{ route('wishlist.index') }}" class="text-secondary text-decoration-none hover-white">{{ __('Wishlist') }}</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="text-secondary text-decoration-none hover-white">{{ __('Catalog') }}</a></li>
                </ul>
            </div>

            <div class="col-12 col-md-3">
                <h5 class="fw-bold text-white mb-3">{{ __('Quick Links') }}</h5>
                <ul class="list-unstyled d-flex flex-column gap-2 fs-6 mb-4">
                    <li><a href="{{ route('contact') }}" class="text-secondary text-decoration-none hover-white">{{ __('Contact Us') }}</a></li>
                    <li><a href="{{ route('about') }}" class="text-secondary text-decoration-none hover-white">{{ __('About Us') }}</a></li>
                </ul>

                <div class="d-flex gap-3">
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>

        <div class="border-top border-secondary mt-5 pt-3 text-center text-secondary fs-7">
            <p class="mb-0">&copy; Copyright {{ date('Y') }} Hardware Components. {{ __('All rights reserved.') }}</p>
        </div>
    </div>
</footer>

<style>
    .hover-white:hover { color: white !important; }
    .silica-brand-text-footer {
        font-family: 'Orbitron', sans-serif;
        letter-spacing: 0;
    }
    [dir="rtl"] .silica-brand-text-footer {
        font-family: 'Orbitron', 'Cairo', sans-serif;
    }
</style>
