<x-layout.layout title="Sign In - Hardware Components">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center my-4">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <div class="card-body p-0">
                        
                        <!-- Header -->
                        <h3 class="fw-bold mb-1 text-center text-dark">Welcome Back</h3>
                        <p class="text-secondary text-center mb-4 fs-6">Enter your credentials to access your account</p>

                        {{-- Main Authentication Error Alert --}}
                        @if ($errors->has('email') && !$errors->has('password'))
                            <div class="alert alert-danger py-2.5 px-3 fs-6 rounded-3 mb-4 border-0 shadow-xs d-flex align-items-center gap-2" style="background-color: #fdf2f2; color: #dc3545;" role="alert">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                <span>{{ $errors->first('email') }}</span>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST" novalidate>
                            @csrf

                            {{-- Email Address --}}
                            <div class="mb-3.5">
                                <label for="email" class="form-label fw-medium text-dark small mb-1">Email Address</label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       class="form-control rounded-3 py-2.5 px-3 @error('email') is-invalid @enderror" 
                                       value="{{ old('email') }}" 
                                       placeholder="name@example.com" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback small">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password Input with Show/Hide Toggle --}}
                            <div class="mb-3.5">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label for="password" class="form-label fw-medium text-dark small mb-0">Password</label>
                                    <a href="#" class="text-decoration-none small text-secondary hover-link">Forgot password?</a>
                                </div>
                                <div class="input-group">
                                    <input type="password" 
                                           name="password" 
                                           id="password" 
                                           class="form-control rounded-start-3 py-2.5 px-3 @error('password') is-invalid @enderror" 
                                           placeholder="Enter password" 
                                           required>
                                    <button class="btn btn-outline-secondary rounded-end-3 px-3 border-start-0" type="button" id="togglePasswordBtn">
                                        <i class="bi bi-eye-slash" id="toggleIcon"></i>
                                    </button>
                                </div>
                                
                                {{-- Password Helper Text --}}
                                <div class="form-text text-muted small mt-1" style="font-size: 0.78rem;">
                                    Must be at least 8 characters with letters, numbers & symbols.
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Remember Me --}}
                            <div class="mb-4 form-check">
                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label text-secondary small" for="remember">Remember me on this device</label>
                            </div>

                            {{-- Submit Button (Theme Red) --}}
                            <button type="submit" class="btn btn-danger w-100 py-2.5 fw-semibold mb-3 rounded-3 hover-red-btn shadow-sm">Sign In</button>

                            {{-- Link to Register --}}
                            <p class="text-center mb-0 text-secondary fs-6">
                                Don't have an account? 
                                <a href="{{ route('register') }}" class="fw-semibold text-danger text-decoration-none hover-link">Create Account</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Show/Hide Password Script & SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('togglePasswordBtn')?.addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
            }
        });

        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false,
                confirmButtonColor: '#dc3545'
            });
        @endif
    </script>

    <style>
        .hover-link:hover { color: #dc3545 !important; }
        .hover-red-btn { transition: background-color 0.2s ease; }
        .hover-red-btn:hover { background-color: #e62e04 !important; }
        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.15);
        }
    </style>
</x-layout.layout>