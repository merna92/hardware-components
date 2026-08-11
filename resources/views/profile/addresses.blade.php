<x-layout.layout title="Address Book - Exclusive">
    <div class="container py-5">
        <div class="row g-4">

            <!-- Left Sidebar -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h6 class="fw-bold mb-3 text-dark">Manage My Account</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-4 fs-6">
                        <li><a href="{{ route('profile') }}" class="text-decoration-none text-secondary hover-red">My Profile</a></li>
                        <li><a href="{{ route('addresses.index') }}" class="text-decoration-none fw-semibold text-danger">Address Book</a></li>
                        <li><a href="{{ route('payments.index') }}" class="text-decoration-none text-secondary hover-red">My Payment Options</a></li>
                    </ul>

                    <h6 class="fw-bold mb-3 text-dark">My Orders</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-4 fs-6">
                        <li><a href="{{ route('orders.index') }}" class="text-decoration-none text-secondary hover-red">My Orders History</a></li>
                        <li><a href="{{ route('returns.index') }}" class="text-decoration-none text-secondary hover-red">My Returns</a></li>
                        <li><a href="{{ route('cancellations.index') }}" class="text-decoration-none text-secondary hover-red">My Cancellations</a></li>
                    </ul>

                    <h6 class="fw-bold mb-3 text-dark">My WishList</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-4 fs-6">
                        <li><a href="{{ route('wishlist.index') }}" class="text-decoration-none text-secondary hover-red">Wishlist Items</a></li>
                    </ul>

                    <hr class="my-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger p-0 text-decoration-none fw-semibold">
                            <i class="bi bi-box-arrow-left me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">

                    @if (session('success'))
                        <div class="alert alert-success border-0 mb-4 rounded-3">{{ session('success') }}</div>
                    @endif

                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                        <div>
                            <h4 class="fw-bold text-danger mb-1">Address Book</h4>
                            <p class="text-muted small mb-0">Manage your saved delivery addresses for faster checkout.</p>
                        </div>
                        <button class="btn btn-danger rounded-pill px-4 fw-semibold" data-bs-toggle="collapse" data-bs-target="#addAddressForm">
                            <i class="bi bi-plus-lg me-1"></i> Add New Address
                        </button>
                    </div>

                    <!-- Add Address Form (collapsed) -->
                    <div class="collapse mb-4" id="addAddressForm">
                        <form action="{{ route('addresses.store') }}" method="POST" class="p-4 border rounded-4 bg-light">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Title (e.g. Home, Office)</label>
                                    <input type="text" name="title" class="form-control bg-white" placeholder="Home" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">City</label>
                                    <input type="text" name="city" class="form-control bg-white" placeholder="Cairo" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Phone</label>
                                    <input type="text" name="phone" class="form-control bg-white" placeholder="01012345678" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-semibold">Address Details</label>
                                    <input type="text" name="details" class="form-control bg-white" placeholder="Building 12, Street 5" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-danger mt-3 px-4 rounded-3 fw-semibold">Save Address</button>
                        </form>
                    </div>

                    <!-- Address List -->
                    @if($addresses->isEmpty())
                        <div class="text-center py-5">
                            <i class="bi bi-geo-alt fs-1 text-muted opacity-50"></i>
                            <h5 class="fw-bold text-dark mt-3">No Saved Addresses</h5>
                            <p class="text-muted small">You haven't added any shipping addresses yet. Click "Add New Address" above to save one!</p>
                        </div>
                    @else
                        <div class="row g-3">
                            @foreach($addresses as $address)
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-4 bg-white position-relative shadow-xs">
                                        <h6 class="fw-bold text-danger mb-1">{{ $address->title }}</h6>
                                        <p class="mb-1 text-dark fs-6">{{ $address->details }}</p>
                                        <small class="text-muted d-block">{{ $address->city }} • {{ $address->phone }}</small>
                                        <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" class="mt-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <style>.hover-red:hover { color: #db4444 !important; }</style>
</x-layout.layout>
