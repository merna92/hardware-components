<x-layout.layout title="My Payment Options">
    <div class="container py-5">
        
        <!-- Success Alert -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4 border-0 shadow-sm" role="alert" style="background-color: #fdf2f2; color: #dc3545;">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Validation Errors Alert -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4 border-0 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Validation Error!</strong>
                <ul class="mb-0 mt-1 ps-3 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
                            <li><a href="/addresses" class="text-decoration-none text-secondary hover-link">Address Book</a></li>
                            <li><a href="/payments" class="text-decoration-none fw-medium text-danger">My Payment Options</a></li>
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

            <!-- Right Main Payment Options Card -->
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    
                    <!-- Header -->
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
                        <div>
                            <h5 class="fw-bold mb-1 text-danger">My Payment Options</h5>
                            <small class="text-secondary">Manage your wallet balances and save your verified payment accounts.</small>
                        </div>
                    </div>

                    <!-- Store Wallet Balance Card (Red & Black Theme) -->
                    <div class="rounded-4 p-4 mb-4 shadow-sm text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%); border-left: 5px solid #dc3545;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-wallet2 fs-4 text-danger"></i>
                                <span class="fw-bold fs-6 text-white">Store Wallet Balance</span>
                            </div>
                            <span class="badge bg-danger text-white px-3 py-1.5 rounded-pill fw-normal small">Active Balance</span>
                        </div>

                        <div class="d-flex align-items-baseline gap-2 my-2">
                            <h2 class="fw-bold mb-0 text-white">${{ number_format(auth()->user()->wallet_balance ?? 0, 2) }}</h2>
                            <span class="text-secondary small">USD / EGP</span>
                        </div>
                        
                        <p class="small text-secondary mb-0">
                            <i class="bi bi-info-circle me-1 text-danger"></i> Refunds from cancelled orders or returns are automatically credited here for instant checkout.
                        </p>
                    </div>

                    <!-- Payment Gateways Grid Section -->
                    <div class="mb-5">
                        <h6 class="fw-bold text-dark mb-1"><i class="bi bi-shield-check me-2 text-danger"></i>Add Verified Payment Option</h6>
                        <p class="text-secondary small mb-3">Select your payment method below to configure account security rules:</p>
                        
                        <div class="row row-cols-2 row-cols-md-4 g-3">
                            
                            <!-- InstaPay -->
                            <div class="col">
                                <div class="border rounded-4 p-3 text-center bg-light shadow-xs hover-gateway-card cursor-pointer d-flex flex-column align-items-center justify-content-center h-100" onclick="openPaymentModal('InstaPay', 'InstaPay Mobile (01xxxxxxxx) or IPA (name@instapay)', '01012345678 or handle@instapay', 'text', 30)">
                                    <div class="bg-white rounded-3 p-2 mb-2 d-flex align-items-center justify-content-center shadow-xs border" style="width: 60px; height: 60px;">
                                        <img src="https://www.gig.com.eg/storage/optionbuilder/uploads/952805-14-2024_0115pminstapay.png" alt="InstaPay" class="img-fluid object-fit-contain" style="max-height: 40px;">
                                    </div>
                                    <h6 class="fw-bold text-dark mb-0 small">InstaPay</h6>
                                    <small class="text-muted opacity-75 fs-7">Instant Transfer</small>
                                </div>
                            </div>

                            <!-- Vodafone Cash -->
                            <div class="col">
                                <div class="border rounded-4 p-3 text-center bg-light shadow-xs hover-gateway-card cursor-pointer d-flex flex-column align-items-center justify-content-center h-100" onclick="openPaymentModal('Vodafone Cash', 'Vodafone Wallet Mobile Number (Starts with 010)', '010XXXXXXXX', 'tel', 11)">
                                    <div class="bg-white rounded-3 p-2 mb-2 d-flex align-items-center justify-content-center shadow-xs border" style="width: 60px; height: 60px;">
                                        <img src="https://www.gig.com.eg/storage/optionbuilder/uploads/563005-14-2024_0214pmvcash.png" alt="Vodafone Cash" class="img-fluid object-fit-contain" style="max-height: 40px;">
                                    </div>
                                    <h6 class="fw-bold text-dark mb-0 small">Vodafone Cash</h6>
                                    <small class="text-muted opacity-75 fs-7">Starts with 010</small>
                                </div>
                            </div>

                            <!-- Etisalat Cash -->
                            <div class="col">
                                <div class="border rounded-4 p-3 text-center bg-light shadow-xs hover-gateway-card cursor-pointer d-flex flex-column align-items-center justify-content-center h-100" onclick="openPaymentModal('Etisalat Cash', 'Etisalat Wallet Mobile Number (Starts with 011)', '011XXXXXXXX', 'tel', 11)">
                                    <div class="bg-white rounded-3 p-2 mb-2 d-flex align-items-center justify-content-center shadow-xs border" style="width: 60px; height: 60px;">
                                        <img src="https://play-lh.googleusercontent.com/Twn63nfbcn43il9CV3GN9v-KT97bau109IZcTMtWAwZvSIlaOhEQ2QwQlYpC-xBima3seBu4mzS3osJehFjH=w240-h480-rw" alt="Etisalat Cash" class="img-fluid object-fit-contain rounded-2" style="max-height: 40px;">
                                    </div>
                                    <h6 class="fw-bold text-dark mb-0 small">Etisalat Cash</h6>
                                    <small class="text-muted opacity-75 fs-7">Starts with 011</small>
                                </div>
                            </div>

                            <!-- Orange Cash -->
                            <div class="col">
                                <div class="border rounded-4 p-3 text-center bg-light shadow-xs hover-gateway-card cursor-pointer d-flex flex-column align-items-center justify-content-center h-100" onclick="openPaymentModal('Orange Cash', 'Orange Wallet Mobile Number (Starts with 012)', '012XXXXXXXX', 'tel', 11)">
                                    <div class="bg-white rounded-3 p-2 mb-2 d-flex align-items-center justify-content-center shadow-xs border" style="width: 60px; height: 60px;">
                                        <img src="https://images.seeklogo.com/logo-png/44/1/orange-money-logo-png_seeklogo-440383.png" alt="Orange Cash" class="img-fluid object-fit-contain" style="max-height: 40px;">
                                    </div>
                                    <h6 class="fw-bold text-dark mb-0 small">Orange Cash</h6>
                                    <small class="text-muted opacity-75 fs-7">Starts with 012</small>
                                </div>
                            </div>

                            <!-- Fawry -->
                            <div class="col">
                                <div class="border rounded-4 p-3 text-center bg-light shadow-xs hover-gateway-card cursor-pointer d-flex flex-column align-items-center justify-content-center h-100" onclick="openPaymentModal('Fawry', 'Fawry Code / Mobile Number (9 to 12 Digits)', '987654321', 'number', 12)">
                                    <div class="bg-white rounded-3 p-2 mb-2 d-flex align-items-center justify-content-center shadow-xs border" style="width: 60px; height: 60px;">
                                        <img src="https://www.gig.com.eg/storage/optionbuilder/uploads/474005-14-2024_0123pmmy%20fawry.png" alt="Fawry Pay" class="img-fluid object-fit-contain" style="max-height: 40px;">
                                    </div>
                                    <h6 class="fw-bold text-dark mb-0 small">Fawry Pay</h6>
                                    <small class="text-muted opacity-75 fs-7">Fawry Code</small>
                                </div>
                            </div>

                            <!-- PayPal -->
                            <div class="col">
                                <div class="border rounded-4 p-3 text-center bg-light shadow-xs hover-gateway-card cursor-pointer d-flex flex-column align-items-center justify-content-center h-100" onclick="openPaymentModal('PayPal', 'Verified PayPal Email Address', 'user@example.com', 'email', 50)">
                                    <div class="bg-white rounded-3 p-2 mb-2 d-flex align-items-center justify-content-center shadow-xs border" style="width: 60px; height: 60px;">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.076 21.337L8.57 11.838H12.637C15.82 11.838 17.5 10.222 18.067 7.025C18.423 5.016 17.653 3.633 15.485 3.633H6.841L3.5 21.337H7.076Z" fill="#003087"/>
                                            <path d="M9.82 17.026L10.82 10.687H14.183C16.82 10.687 18.21 9.352 18.678 6.705C19.08 4.43 18.26 3 15.84 3H8.341L5 21.337H8.82L9.82 17.026Z" fill="#0079C1"/>
                                        </svg>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-0 small">PayPal</h6>
                                    <small class="text-muted opacity-75 fs-7">Global Email</small>
                                </div>
                            </div>

                            <!-- Credit / Debit Cards -->
                            <div class="col">
                                <div class="border rounded-4 p-3 text-center bg-light shadow-xs hover-gateway-card cursor-pointer d-flex flex-column align-items-center justify-content-center h-100" onclick="openPaymentModal('Bank Card', 'Card Number (Exact 16 Digits)', '4242424242424242', 'tel', 16)">
                                    <div class="bg-white rounded-3 p-2 mb-2 d-flex align-items-center justify-content-center shadow-xs border" style="width: 60px; height: 60px;">
                                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="2" y="5" width="20" height="14" rx="3" fill="#1A1F71"/>
                                            <circle cx="9" cy="12" r="3.5" fill="#EB001B"/>
                                            <circle cx="13.5" cy="12" r="3.5" fill="#F79E1B" fill-opacity="0.8"/>
                                        </svg>
                                    </div>
                                    <h6 class="fw-bold text-dark mb-0 small">Bank Card</h6>
                                    <small class="text-muted opacity-75 fs-7">Visa / Mastercard</small>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Saved Accounts Display -->
                    <div class="pt-3 border-top">
                        <h6 class="fw-bold text-dark mb-3"><i class="bi bi-card-checklist me-2 text-danger"></i>Saved Payment Accounts</h6>
                        
                        @if($methods->isEmpty())
                            <div class="p-4 text-center border border-dashed rounded-4 bg-light">
                                <p class="text-secondary small mb-0">No verified accounts saved yet. Click any icon above to configure your gateway.</p>
                            </div>
                        @else
                            <div class="row g-3">
                                @foreach($methods as $method)
                                    <div class="col-md-6">
                                        <div class="border rounded-4 p-3 bg-light shadow-xs d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="bg-white rounded-3 p-2 border shadow-xs d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                                    <i class="bi bi-shield-check text-danger fs-4"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold text-dark mb-0 small">{{ $method->type }}</h6>
                                                    <small class="text-secondary fs-7">{{ $method->account_details }}</small>
                                                </div>
                                            </div>

                                            <form action="{{ route('payments.destroy', $method->id) }}" method="POST" onsubmit="return confirm('Remove this account?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-secondary hover-link p-0 border-0" title="Delete">
                                                    <i class="bi bi-trash fs-6"></i>
                                                </button>
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
    </div>

    <!-- Dynamic Modal for Selected Gateway -->
    <div class="modal fade" id="dynamicPaymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-bottom pb-3">
                    <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2" id="modalGatewayTitle">
                        <i class="bi bi-shield-lock-fill text-danger"></i> <span id="gatewayNameText">Add Gateway</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('payments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" id="hiddenTypeInput">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-medium text-dark" id="accountLabelText">Account Identifier</label>
                            <input type="text" name="account_details" id="accountInput" class="form-control rounded-2 py-2" placeholder="" required>
                            <div class="form-text text-muted fs-7" id="validationHelpText"></div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="button" class="btn btn-light rounded-2 px-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger rounded-2 px-4 hover-red-btn">Save & Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openPaymentModal(gatewayName, labelText, placeholderText, inputType, maxLength) {
            document.getElementById('gatewayNameText').innerText = 'Add ' + gatewayName;
            document.getElementById('hiddenTypeInput').value = gatewayName;
            document.getElementById('accountLabelText').innerText = labelText;
            
            let input = document.getElementById('accountInput');
            input.placeholder = placeholderText;
            input.type = inputType || 'text';
            if (maxLength) {
                input.maxLength = maxLength;
            } else {
                input.removeAttribute('maxLength');
            }
            input.value = '';

            document.getElementById('validationHelpText').innerText = 'Strict validation rules enforced for ' + gatewayName;
            
            var modal = new bootstrap.Modal(document.getElementById('dynamicPaymentModal'));
            modal.show();
        }
    </script>

    <style>
        .hover-link:hover { color: #dc3545 !important; }
        .hover-red-btn { transition: background-color 0.2s ease; }
        .hover-red-btn:hover { background-color: #e62e04 !important; }
        .hover-gateway-card { transition: all 0.2s ease-in-out; }
        .hover-gateway-card:hover {
            border-color: #dc3545 !important;
            background-color: #fff8f8 !important;
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.1) !important;
        }
        .cursor-pointer { cursor: pointer; }
        .fs-7 { font-size: 0.8rem; }
    </style>
</x-layout.layout>