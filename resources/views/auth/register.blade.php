<x-layout.layout title="Create an Account - Exclusive">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white text-center">
                    <h2 class="fw-bold text-dark mb-1">{{ __('Create an Account') }}</h2>
                    <p class="text-muted small mb-4">{{ __('Enter your details to register as a new member') }}</p>

                    @if($errors->any())
                        <div class="alert alert-danger border-0 rounded-3 text-start mb-4">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST" class="text-start">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">{{ __('Full Name') }}</label>
                            <input type="text" name="name" class="form-control rounded-3 py-2 px-3" placeholder="{{ __('Full Name') }}" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">{{ __('Email Address') }}</label>
                            <input type="email" name="email" class="form-control rounded-3 py-2 px-3" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">{{ __('Phone Number') }}</label>
                            <input type="text" name="phone" class="form-control rounded-3 py-2 px-3" placeholder="{{ __('Phone Number') }}" value="{{ old('phone') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-dark">{{ __('Password') }}</label>
                            <div class="input-group">
                                <input type="password" name="password" id="reg_password" class="form-control rounded-start-3 py-2 px-3 border-end-0" placeholder="{{ __('Enter password') }}" required>
                                <button class="btn btn-outline-secondary rounded-end-3 border-start-0 bg-white" type="button" onclick="togglePass('reg_password', this)">
                                    <i class="bi bi-eye-slash text-muted"></i>
                                </button>
                            </div>
                            <small class="text-muted d-block mt-1 fs-7">{{ __('Must be at least 8 characters with letters, numbers & symbols (e.g. @, #, ?).') }}</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-semibold text-dark">{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="reg_password_confirmation" class="form-control rounded-start-3 py-2 px-3 border-end-0" placeholder="{{ __('Re-enter password') }}" required>
                                <button class="btn btn-outline-secondary rounded-end-3 border-start-0 bg-white" type="button" onclick="togglePass('reg_password_confirmation', this)">
                                    <i class="bi bi-eye-slash text-muted"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 rounded-3 py-3 fw-bold mb-3">{{ __('Register Now') }}</button>

                        <div class="text-center text-muted small">
                            {{ __('Already have an account?') }} <a href="{{ route('login') }}" class="text-danger fw-semibold text-decoration-none">{{ __('Log in') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePass(id, btn) {
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        }
    </script>
</x-layout.layout>
