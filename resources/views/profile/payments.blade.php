<x-layout.layout title="My Payment Options - Exclusive">
    <div class="container py-5">
        <div class="row g-4">

            <!-- Left Sidebar -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <h6 class="fw-bold mb-3 text-dark">Manage My Account</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2 mb-4 fs-6">
                        <li><a href="{{ route('profile') }}" class="text-decoration-none text-secondary hover-red">My Profile</a></li>
                        <li><a href="{{ route('addresses.index') }}" class="text-decoration-none text-secondary hover-red">Address Book</a></li>
                        <li><a href="{{ route('payments.index') }}" class="text-decoration-none fw-semibold text-danger">My Payment Options</a></li>
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

                    <h4 class="fw-bold text-danger mb-1">My Payment Options</h4>
                    <p class="text-muted small mb-4">Manage your wallet balances and save your verified payment accounts.</p>

                    <!-- Store Wallet Balance -->
                    <div class="bg-dark text-white rounded-4 p-4 mb-5 position-relative overflow-hidden">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-1 small text-white-50"><i class="bi bi-wallet2 me-1"></i> Store Wallet Balance</p>
                                <h2 class="fw-bold mb-1">$0.00 <small class="text-white-50 fs-6">USD / EGP</small></h2>
                                <p class="small text-white-50 mb-0"><i class="bi bi-info-circle me-1"></i> Refunds from cancelled orders or returns are automatically credited here for instant checkout.</p>
                            </div>
                            <span class="badge bg-success px-3 py-2 rounded-pill fw-semibold">Active Balance</span>
                        </div>
                    </div>

                    <!-- Add Verified Payment Option -->
                    <h5 class="fw-bold text-dark mb-1"><i class="bi bi-shield-check text-danger me-1"></i> Add Verified Payment Option</h5>
                    <p class="text-muted small mb-4">Select your payment method below to configure account security rules:</p>

                    <div class="row row-cols-2 row-cols-md-4 g-3 mb-5">
                        @php
                            $paymentTypes = [
                                ['type' => 'InstaPay', 'desc' => 'Instant Transfer', 'icon' => 'bi-lightning-charge-fill', 'color' => '#6B3FA0'],
                                ['type' => 'Vodafone Cash', 'desc' => 'Starts with 010', 'icon' => 'bi-phone-fill', 'color' => '#E60000'],
                                ['type' => 'Etisalat Cash', 'desc' => 'Starts with 011', 'icon' => 'bi-phone-fill', 'color' => '#00953B'],
                                ['type' => 'Orange Cash', 'desc' => 'Starts with 012', 'icon' => 'bi-phone-fill', 'color' => '#FF6600'],
                                ['type' => 'Fawry Pay', 'desc' => 'Fawry Code', 'icon' => 'bi-upc-scan', 'color' => '#FFC107'],
                                ['type' => 'PayPal', 'desc' => 'Global Email', 'icon' => 'bi-paypal', 'color' => '#003087'],
                                ['type' => 'Bank Card', 'desc' => 'Visa / Mastercard', 'icon' => 'bi-credit-card-fill', 'color' => '#1A1F71'],
                            ];
                        @endphp

                        @foreach($paymentTypes as $pt)
                            <div class="col">
                                <div class="border rounded-4 p-3 text-center h-100 bg-white payment-type-card" 
                                     style="cursor: pointer;" 
                                     onclick="selectPaymentType('{{ $pt['type'] }}', '{{ $pt['desc'] }}')">
                                    <div class="rounded-circle mx-auto d-flex align-items-center justify-content-center mb-2" 
                                         style="width: 50px; height: 50px; background-color: {{ $pt['color'] }}20;">
                                        <i class="bi {{ $pt['icon'] }} fs-4" style="color: {{ $pt['color'] }};"></i>
                                    </div>
                                    <h6 class="fw-bold text-dark small mb-0">{{ $pt['type'] }}</h6>
                                    <small class="text-muted" style="font-size: 0.75rem;">{{ $pt['desc'] }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Hidden form for adding payment -->
                    <div class="collapse mb-4" id="paymentFormCollapse">
                        <form action="{{ route('payments.store') }}" method="POST" class="p-4 border rounded-4 bg-light">
                            @csrf
                            <input type="hidden" name="type" id="selected_payment_type" value="">
                            <div class="mb-3">
                                <label class="form-label fw-semibold" id="payment_label">Account Details</label>
                                <input type="text" name="account_details" class="form-control bg-white" placeholder="Enter your account number or details" required>
                            </div>
                            <button type="submit" class="btn btn-danger px-4 rounded-3 fw-semibold">Save Payment Method</button>
                        </form>
                    </div>

                    <!-- Saved Payment Accounts -->
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-credit-card-2-back text-danger me-1"></i> Saved Payment Accounts</h5>

                    @if($methods->isEmpty())
                        <div class="bg-light rounded-4 p-4 text-center text-muted">
                            No verified accounts saved yet. Click any icon above to configure your gateway.
                        </div>
                    @else
                        <div class="row g-3">
                            @foreach($methods as $method)
                                <div class="col-md-6">
                                    <div class="p-3 border rounded-4 bg-white d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fw-bold text-dark mb-1">{{ $method->type }}</h6>
                                            <small class="text-muted">{{ $method->account_details }}</small>
                                        </div>
                                        <form action="{{ route('payments.destroy', $method->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill">Remove</button>
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

    <style>
        .hover-red:hover { color: #db4444 !important; }
        .payment-type-card { transition: all 0.2s ease; }
        .payment-type-card:hover { border-color: #db4444 !important; transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
    </style>

    <script>
        function selectPaymentType(type, desc) {
            document.getElementById('selected_payment_type').value = type;
            document.getElementById('payment_label').textContent = type + ' - ' + desc;
            var collapse = new bootstrap.Collapse(document.getElementById('paymentFormCollapse'), { show: true });
        }
    </script>
</x-layout.layout>
