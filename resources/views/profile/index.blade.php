<x-layout.layout title="My Account">
    <div class="container py-5">
        
        <!-- Success / Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-5">
            
            <!-- Left Minimal Navigation Sidebar -->
            <div class="col-lg-3">
                <div class="pe-lg-3">
                    
                    <!-- Section 1: Manage My Account -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-dark">Manage My Account</h6>
                        <ul class="list-unstyled ps-3 mb-0 d-flex flex-column gap-2">
                            <li>
                                <a href="/profile" class="text-decoration-none fw-medium text-danger">My Profile</a>
                            </li>
                            <li>
                                <a href="/addresses" class="text-decoration-none text-secondary hover-link">Address Book</a>
                            </li>
                            <li>
                                <a href="/payments" class="text-decoration-none text-secondary hover-link">My Payment Options</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Section 2: My Orders -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-dark">My Orders</h6>
                        <ul class="list-unstyled ps-3 mb-0 d-flex flex-column gap-2">
                            <li>
                                <a href="/orders" class="text-decoration-none text-secondary hover-link">My Orders History</a>
                            </li>
                            <li>
                                <a href="/returns" class="text-decoration-none text-secondary hover-link">My Returns</a>
                            </li>
                            <li>
                                <a href="/cancellations" class="text-decoration-none text-secondary hover-link">My Cancellations</a>                            </li>
                        </ul>
                    </div>

                    <!-- Section 3: My WishList -->
                    <div>
                        <a href="/wishlist" class="text-decoration-none fw-bold h6 d-block mb-0 text-dark hover-link">My WishList</a>
                    </div>
                                    <!-- Logout Button -->
                <div class="mt-4 pt-3 border-top">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();" class="text-decoration-none fw-bold text-danger d-flex align-items-center gap-2 hover-link">
                        <i class="bi bi-box-arrow-right fs-5"></i> Logout
                    </a>
                </div>
                </div>
            </div>

            <!-- Right Main Form Card -->
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    
                    <!-- Hidden Avatar Form -->
                    <form id="avatarForm" action="{{ route('profile.avatar.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="avatarInput" name="avatar" class="d-none" accept="image/*">
                    </form>

                    <!-- Avatar Upload Header Box -->
                    <div class="d-flex align-items-center gap-4 mb-4 pb-4 border-bottom">
                        <div class="position-relative cursor-pointer" onclick="document.getElementById('avatarInput').click();">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                                     alt="Profile Avatar" 
                                     class="rounded-circle object-fit-cover shadow-sm border" 
                                     style="width: 80px; height: 80px; border-color: #e2e8f0 !important;">
                                <span class="badge rounded-circle position-absolute bottom-0 end-0 p-2 shadow-sm text-white bg-danger">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                </span>
                            @else
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle fw-bold fs-2 shadow-sm border bg-light text-secondary" 
                                     style="width: 80px; height: 80px; border-color: #e2e8f0 !important;">
                                    <i class="bi bi-person-fill fs-2"></i>
                                </div>
                                <span class="badge rounded-circle position-absolute bottom-0 end-0 p-2 shadow-sm text-white bg-danger">
                                    <i class="bi bi-plus-lg fw-bold fs-7"></i>
                                </span>
                            @endif
                        </div>

                        <div>
                            <h5 class="fw-bold mb-1 text-danger">Edit Your Profile</h5>
                            <button type="button" class="btn btn-link p-0 text-decoration-none fs-7 fw-medium text-secondary" onclick="document.getElementById('avatarInput').click();">
                                <i class="bi bi-camera me-1"></i> {{ auth()->user()->avatar ? 'Change Profile Photo' : 'Upload Profile Photo' }}
                            </button>
                        </div>
                    </div>

                    <!-- Main Form Details & Password -->
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        
                        <!-- Basic Info Section -->
                        <div class="row g-4 mb-4">
                            <!-- First Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-medium small mb-2 text-dark">First Name</label>
                                <input type="text" name="first_name" class="form-control border-0 py-2.5 px-3 rounded-2 custom-input" value="{{ auth()->user()->first_name ?? '' }}" placeholder="First Name" required>
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-medium small mb-2 text-dark">Last Name</label>
                                <input type="text" name="last_name" class="form-control border-0 py-2.5 px-3 rounded-2 custom-input" value="{{ auth()->user()->last_name ?? '' }}" placeholder="Last Name">
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label fw-medium small mb-2 text-dark">Email</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" readonly>
                            </div>

                            <!-- Address / Phone -->
                            <div class="col-md-6">
                                <label class="form-label fw-medium small mb-2 text-dark">Address / Phone</label>
                                <input type="text" name="phone" class="form-control border-0 py-2.5 px-3 rounded-2 custom-input" value="{{ auth()->user()->phone ?? '' }}" placeholder="Phone or Address">
                            </div>
                        </div>

                        <!-- Password Changes Section -->
                        <div class="mt-4 pt-2">
                            <h6 class="fw-semibold mb-3 text-dark">Password Changes</h6>
                            
                            <div class="d-flex flex-column gap-3 mb-4">
                                <input type="password" name="current_password" class="form-control border-0 py-2.5 px-3 rounded-2 custom-input" placeholder="Current Password">
                                <input type="password" name="new_password" class="form-control border-0 py-2.5 px-3 rounded-2 custom-input" placeholder="New Password">
                                <input type="password" name="new_password_confirmation" class="form-control border-0 py-2.5 px-3 rounded-2 custom-input" placeholder="Confirm New Password">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex align-items-center justify-content-end gap-3 mt-4 pt-3">
                            <button type="reset" class="btn btn-link text-decoration-none fw-medium text-dark px-3 py-2">
                                Cancel
                            </button>
                            <button type="submit" class="btn text-white px-4 py-2.5 rounded-2 fw-medium shadow-sm bg-danger border-0 hover-red-btn">
                                Save Changes
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <style>
        .cursor-pointer {
            cursor: pointer;
        }
        .custom-input {
            background-color: #f5f5f5 !important;
            color: #333333 !important;
            font-size: 0.925rem;
        }
        .custom-input:focus {
            box-shadow: 0 0 0 2px #cbd5e1;
            background-color: #ffffff !important;
        }
        .hover-link:hover {
            color: #dc3545 !important;
        }
        .hover-red-btn {
            transition: background-color 0.2s ease;
        }
        .hover-red-btn:hover {
            background-color: #e62e04 !important;
        }
        .fs-7 {
            font-size: 0.825rem;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const avatarInput = document.getElementById('avatarInput');
            if (avatarInput) {
                avatarInput.addEventListener('change', function () {
                    if (this.files && this.files[0]) {
                        document.getElementById('avatarForm').submit();
                    }
                });
            }
        });
    </script>
</x-layout.layout>