<x-layout.layout title="My Profile - Exclusive">
    <div class="container py-5">
        <div class="row g-4">
            
            <!-- Left Sidebar -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h6 class="fw-bold mb-3 text-dark">{{ __('Manage My Account') }}</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-4 fs-6">
                        <li><a href="{{ route('profile') }}" class="text-decoration-none fw-semibold text-danger">{{ __('My Profile') }}</a></li>
                        <li><a href="{{ route('addresses.index') }}" class="text-decoration-none text-secondary hover-red">{{ __('Address Book') }}</a></li>
                        <li><a href="{{ route('payments.index') }}" class="text-decoration-none text-secondary hover-red">{{ __('My Payment Options') }}</a></li>
                    </ul>

                    <h6 class="fw-bold mb-3 text-dark">{{ __('My Orders') }}</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-4 fs-6">
                        <li><a href="{{ route('orders.index') }}" class="text-decoration-none text-secondary hover-red">{{ __('My Orders History') }}</a></li>
                        <li><a href="{{ route('cancellations.index') }}" class="text-decoration-none text-secondary hover-red">{{ __('My Cancellations') }}</a></li>
                    </ul>

                    <h6 class="fw-bold mb-3 text-dark">{{ __('My Wishlist') }}</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-4 fs-6">
                        <li><a href="{{ route('wishlist.index') }}" class="text-decoration-none text-secondary hover-red">{{ __('Wishlist Items') }}</a></li>
                    </ul>

                    <hr class="my-3">

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger p-0 text-decoration-none fw-semibold">
                            <i class="bi bi-box-arrow-left me-1"></i> {{ __('Logout') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Content Form -->
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    
                    @if(session('success'))
                        <div class="alert alert-success border-0 mb-4 rounded-3">{{ session('success') }}</div>
                    @endif

                    <!-- Avatar Upload -->
                    <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                        <div class="position-relative">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="rounded-circle object-fit-cover border" style="width: 80px; height: 80px;" alt="{{ auth()->user()->name }}">
                            @else
                                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <i class="bi bi-person fs-1 text-muted"></i>
                                </div>
                            @endif
                            <label for="avatar_input" class="position-absolute bottom-0 end-0 bg-danger text-white rounded-circle d-flex align-items-center justify-content-center cursor-pointer shadow-sm" style="width: 26px; height: 26px;">
                                <i class="bi bi-plus fs-6"></i>
                            </label>
                        </div>
                        <div>
                            <h5 class="fw-bold text-danger mb-0">{{ __('Edit Your Profile') }}</h5>
                            <form action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data" id="avatar_form">
                                @csrf
                                <input type="file" name="avatar" id="avatar_input" accept="image/*" class="d-none" onchange="document.getElementById('avatar_form').submit()">
                                <small class="text-muted cursor-pointer" onclick="document.getElementById('avatar_input').click()"><i class="bi bi-camera me-1"></i> {{ __('Upload Profile Photo') }}</small>
                            </form>
                        </div>
                    </div>

                    <!-- Profile Info Form -->
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-dark">{{ __('First Name') }}</label>
                                <input type="text" name="first_name" class="form-control bg-light border-0 py-2 px-3" value="{{ old('first_name', auth()->user()->first_name ?? explode(' ', auth()->user()->name)[0] ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-dark">{{ __('Last Name') }}</label>
                                <input type="text" name="last_name" class="form-control bg-light border-0 py-2 px-3" value="{{ old('last_name', auth()->user()->last_name ?? explode(' ', auth()->user()->name)[1] ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-dark">{{ __('Email') }}</label>
                                <input type="email" name="email" class="form-control bg-light border-0 py-2 px-3" value="{{ old('email', auth()->user()->email) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold text-dark">{{ __('Address / Phone') }}</label>
                                <input type="text" name="phone" class="form-control bg-light border-0 py-2 px-3" value="{{ old('phone', auth()->user()->phone ?? auth()->user()->phone_number ?? '') }}">
                            </div>
                        </div>

                        <h6 class="fw-bold text-dark mb-3">{{ __('Password Changes') }}</h6>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <input type="password" name="current_password" class="form-control bg-light border-0 py-2 px-3" placeholder="{{ __('Current Password') }}">
                            </div>
                            <div class="col-12">
                                <input type="password" name="new_password" class="form-control bg-light border-0 py-2 px-3" placeholder="{{ __('New Password') }}">
                            </div>
                            <div class="col-12">
                                <input type="password" name="new_password_confirmation" class="form-control bg-light border-0 py-2 px-3" placeholder="{{ __('Confirm New Password') }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ url('/') }}" class="btn btn-link text-dark text-decoration-none">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-danger px-4 py-2 rounded-3 fw-semibold">{{ __('Save Changes') }}</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <style>
        .hover-red:hover { color: #db4444 !important; }
        .cursor-pointer { cursor: pointer; }
    </style>
</x-layout.layout>
