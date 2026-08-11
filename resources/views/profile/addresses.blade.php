<x-layout.layout title="Address Book">
    <div class="container py-5">
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-5">
            
            <!-- Left Navigation Sidebar -->
            <div class="col-lg-3">
                <div class="pe-lg-3">
                    
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-dark">Manage My Account</h6>
                        <ul class="list-unstyled ps-3 mb-0 d-flex flex-column gap-2">
                            <li><a href="/profile" class="text-decoration-none text-secondary hover-link">My Profile</a></li>
                            <li><a href="/addresses" class="text-decoration-none fw-medium text-danger">Address Book</a></li>
                            <li><a href="/payments" class="text-decoration-none text-secondary hover-link">My Payment Options</a></li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-dark">My Orders</h6>
                        <ul class="list-unstyled ps-3 mb-0 d-flex flex-column gap-2">
                            <li><a href="/orders" class="text-decoration-none text-secondary hover-link">My Orders History</a></li>
                            <li><a href="/returns" class="text-decoration-none text-secondary hover-link">My Returns</a></li>
                            <li><a href="/cancellations" class="text-decoration-none text-secondary hover-link">My Cancellations</a></li>
                        </ul>
                    </div>

                    <div>
                        <a href="/wishlist" class="text-decoration-none fw-bold h6 d-block mb-0 text-dark hover-link">My WishList</a>
                    </div>
                           <!-- Section 4: Logout -->
                    <div class="mt-4 pt-3 border-top">
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="btn btn-link text-danger p-0 m-0 border-0 bg-transparent fw-bold h6 d-flex align-items-center gap-2 hover-link text-decoration-none">
                                <i class="bi bi-box-arrow-right fs-5"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
                     
            <!-- Right Address Book Main Card -->
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    
                    <!-- Header with Permanent Add Button on Top Right -->
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                        <div>
                            <h5 class="fw-bold mb-1 text-danger">Address Book</h5>
                            <small class="text-secondary">Manage your saved delivery addresses for faster checkout.</small>
                        </div>
                        <button class="btn btn-danger btn-sm px-3 py-2 rounded-2 shadow-sm d-flex align-items-center gap-2 hover-red-btn" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                            <i class="bi bi-plus-lg"></i> Add New Address
                        </button>
                    </div>

                    @if($addresses->isEmpty())
                        <!-- Empty State -->
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="bi bi-geo-alt display-1 text-secondary opacity-50"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">No Saved Addresses</h5>
                            <p class="text-secondary small mb-0">You haven't added any shipping addresses yet. Click "Add New Address" above to save one!</p>
                        </div>
                    @else
                        <!-- Saved Addresses Grid -->
                        <div class="row g-4">
                            @foreach($addresses as $address)
                                <div class="col-md-6">
                                    <div class="border rounded-4 p-4 bg-light shadow-sm position-relative h-100 d-flex flex-column justify-content-between">
                                        <div>
                                            <div class="d-flex align-items-center justify-content-between mb-3">
                                                <span class="badge bg-danger text-white px-3 py-1.5 rounded-pill fw-normal small">
                                                    <i class="bi bi-geo-alt-fill me-1"></i> {{ $address->title }}
                                                </span>
                                                
                                                <!-- Delete Button -->
                                                <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this address?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link p-0 text-secondary hover-link border-0" title="Delete Address">
                                                        <i class="bi bi-trash fs-6"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <h6 class="fw-bold text-dark mb-2">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                                            
                                            <p class="text-dark small fw-medium mb-1">
                                                <i class="bi bi-building me-1 text-danger"></i> {{ $address->city }}
                                            </p>

                                            <p class="text-secondary small mb-2">
                                                <i class="bi bi-geo-alt me-1 text-danger"></i> {{ $address->details }}
                                            </p>

                                            <p class="text-secondary small mb-0">
                                                <i class="bi bi-telephone me-1 text-danger"></i> {{ $address->phone }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

    <!-- Modal for Adding New Address -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-bottom pb-3">
                    <h5 class="modal-title fw-bold text-dark" id="addAddressModalLabel">
                        <i class="bi bi-geo-alt-fill text-danger me-2"></i>Add New Address
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('addresses.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label small fw-medium text-dark">Address Title (e.g., Home, Work, Family)</label>
                            <input type="text" name="title" class="form-control rounded-2 py-2" placeholder="Home / Work" required>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-medium text-dark">City / Region</label>
                                <input type="text" name="city" class="form-control rounded-2 py-2" placeholder="Cairo" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-medium text-dark">Phone Number</label>
                                <input type="text" name="phone" class="form-control rounded-2 py-2" value="{{ auth()->user()->phone ?? '' }}" placeholder="01xxxxxxxxx" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-medium text-dark">Full Detailed Address</label>
                            <textarea name="details" class="form-control rounded-2" rows="3" placeholder="Street, Building No., Floor, Apartment..." required></textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-light rounded-2 px-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger rounded-2 px-4 hover-red-btn">Save Address</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
    <style>
        .hover-link:hover { color: #dc3545 !important; }
        .hover-red-btn { transition: background-color 0.2s ease; }
        .hover-red-btn:hover { background-color: #e62e04 !important; }
    </style>
</x-layout.layout>