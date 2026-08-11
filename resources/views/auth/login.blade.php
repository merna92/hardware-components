<x-layout.layout title="Sign In - Hardware Components">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center my-4">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <div class="card-body p-0">
                        <h3 class="fw-bold mb-1 text-center text-dark">{{ __('Welcome Back') }}</h3>
                        <p class="text-secondary text-center mb-4 fs-6">{{ __('Enter your credentials to access your account') }}</p>

                        @if ($errors->has('email'))
                            <div class="alert alert-danger py-2 px-3 fs-6 rounded-3 mb-4 border-0" role="alert">
                                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ $errors->first('email') }}
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label fw-medium text-dark small mb-1">{{ __('Email Address') }}</label>
                                <input type="email" name="email" id="email" class="form-control rounded-3 py-2 px-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="admin@example.com" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label fw-medium text-dark small mb-1">{{ __('Password') }}</label>
                                <input type="password" name="password" id="password" class="form-control rounded-3 py-2 px-3 @error('password') is-invalid @enderror" placeholder="{{ __('Enter password') }}" required>
                            </div>

                            <div class="mb-4 form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label text-secondary small" for="remember">{{ __('Remember me') }}</label>
                            </div>

                            <button type="submit" class="btn btn-danger w-100 py-2.5 fw-semibold mb-3 rounded-3 shadow-sm">{{ __('Sign In') }}</button>

                            <p class="text-center mb-0 text-secondary fs-6">
                                {{ __("Don't have an account?") }} 
                                <a href="{{ route('register') }}" class="fw-semibold text-danger text-decoration-none">{{ __('Create Account') }}</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.layout>
