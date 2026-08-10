<x-layout.layout title="Create an Account - Hardware Components">
    <div class="container py-5">
        <div class="row justify-content-center align-items-center my-4">
            <div class="col-12 col-md-8 col-lg-5">
                <!-- Card Container -->
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    
                    <!-- Header Title -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark mb-1">Create an Account</h2>
                        <p class="text-secondary small mb-0">Enter your details to register as a new member</p>
                    </div>

                    <!-- Registration Form Start -->
                    <form action="{{ route('register') }}" method="POST" novalidate>
                        @csrf

                        <!-- Full Name Input -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium text-dark small mb-1">Full Name</label>
                            <input type="text" name="name" id="name" class="form-control rounded-3 py-2.5 px-3 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. John Doe" required>
                            @error('name')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium text-dark small mb-1">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control rounded-3 py-2.5 px-3 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="e.g. name@example.com" required>
                            @error('email')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone Number Input -->
                        <div class="mb-3">
                            <label for="phone" class="form-label fw-medium text-dark small mb-1">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control rounded-3 py-2.5 px-3 @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="e.g. 01012345678" required>
                            @error('phone')
                                <div class="invalid-feedback small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Input -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-medium text-dark small mb-1">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control rounded-start-3 py-2.5 px-3 @error('password') is-invalid @enderror" placeholder="Enter password" required>
                                <button class="btn btn-outline-secondary rounded-end-3 px-3 border-start-0" type="button" onclick="togglePassword('password', this)">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                            <!-- Password Helper Text -->
                            <div class="form-text text-muted small mt-1" style="font-size: 0.78rem;">
                                Must be at least 8 characters with letters, numbers & symbols (e.g. @, #, ?).
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-medium text-dark small mb-1">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control rounded-start-3 py-2.5 px-3" placeholder="Re-enter password" required>
                                <button class="btn btn-outline-secondary rounded-end-3 px-3 border-start-0" type="button" onclick="togglePassword('password_confirmation', this)">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button (Theme Red) -->
                        <button type="submit" class="btn btn-danger w-100 py-2.5 fw-semibold mb-3 rounded-3 hover-red-btn shadow-sm">Register Now</button>

                        <!-- Sign In Redirection Link -->
                        <div class="text-center">
                            <span class="text-secondary small">Already have an account?</span>
                            <a href="{{ route('login') }}" class="text-danger fw-semibold small text-decoration-none ms-1 hover-link">Sign In</a>
                        </div>
                    </form>
                    <!-- Registration Form End -->

                </div>
            </div>
        </div>
    </div>

    <!-- Toggle Password Visibility Script -->
    <script>
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        
        if (input.type === "password") {
            input.type = "text";
            icon.className = "bi bi-eye";
        } else {
            input.type = "password";
            icon.className = "bi bi-eye-slash";
        }
    }
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