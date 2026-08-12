<x-layout.layout :title="__('Checkout') . ' - ' . __('Dashboard')">
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-muted">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" class="text-decoration-none text-muted">{{ __('Cart') }}</a></li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">{{ __('Checkout') }}</li>
            </ol>
        </nav>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="row g-4">
                <!-- Billing Details -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                        <h4 class="fw-bold text-dark mb-4">{{ __('Billing Details') }}</h4>

                        @if($errors->any())
                            <div class="alert alert-danger border-0 rounded-3 mb-4">{{ $errors->first() }}</div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">{{ __('First Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" class="form-control bg-light border-0 py-2" value="{{ old('first_name', $user->first_name ?? '') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">{{ __('Last Name') }}</label>
                                <input type="text" name="last_name" class="form-control bg-light border-0 py-2" value="{{ old('last_name', $user->last_name ?? '') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">{{ __('Street Address') }} <span class="text-danger">*</span></label>
                                <input type="text" name="address" class="form-control bg-light border-0 py-2" placeholder="{{ __('House number and street name') }}" value="{{ old('address') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">{{ __('City') }} <span class="text-danger">*</span></label>
                                <input type="text" name="city" class="form-control bg-light border-0 py-2" value="{{ old('city') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-semibold">{{ __('Phone Number') }} <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control bg-light border-0 py-2" value="{{ old('phone', $user->phone ?? $user->phone_number ?? '') }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control bg-light border-0 py-2" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-semibold">{{ __('Order Notes (Optional)') }}</label>
                                <textarea name="notes" class="form-control bg-light border-0 py-2" rows="3" placeholder="{{ __('Any special delivery instructions...') }}">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <div id="paymentDetailsLeft" class="mt-4 pt-4 border-top d-none">
                            <h5 class="fw-bold text-dark mb-3">{{ __('Payment Details') }}</h5>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold" id="paymentDetailsLabelLeft">{{ __('Payment Details') }}</label>
                                <input type="text" name="payment_details" id="payment_details_left" class="form-control bg-light border-0 py-2" placeholder="">
                            </div>
                            <small class="text-muted d-block" id="paymentDetailsHintLeft"></small>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <h5 class="fw-bold text-dark mb-4">{{ __('Your Order') }}</h5>

                        <div class="d-flex flex-column gap-3 pb-3 mb-3 border-bottom">
                            @foreach($cartItems as $item)
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ $item->product->image_url ?? asset('images/placeholder.png') }}" class="rounded bg-light p-1" style="width: 45px; height: 45px; object-fit: contain;" alt="">
                                        <div>
                                            <small class="fw-semibold text-dark d-block text-truncate" style="max-width: 180px;">{{ $item->product->product_name }}</small>
                                            <small class="text-muted">x{{ $item->quantity }}</small>
                                        </div>
                                    </div>
                                    <span class="fw-bold text-dark">${{ number_format($item->unit_price * $item->quantity, 2) }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted">{{ __('Subtotal') }}:</span>
                            <span class="fw-bold">${{ number_format($totals['subtotal'], 2) }}</span>
                        </div>
                        @if($totals['discount'] > 0)
                            <div class="d-flex justify-content-between py-2 text-success">
                                <span>{{ __('Discount') }}:</span>
                                <span class="fw-bold">-${{ number_format($totals['discount'], 2) }}</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between py-2">
                            <span class="text-muted">{{ __('Tax (14%)') }}:</span>
                            <span class="fw-bold">${{ number_format($totals['tax'], 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between py-2 border-top mt-2 pt-3">
                            <span class="fw-bold text-dark fs-5">{{ __('Total') }}:</span>
                            <span class="fw-bold text-danger fs-4">${{ number_format($totals['total'], 2) }}</span>
                        </div>

                        <div class="mt-4">
                            <label class="form-label fw-bold mb-3">{{ __('Choose Payment Method') }}</label>
                            <input type="hidden" name="payment_method" id="payment_method" value="cash_on_delivery">
                            <div class="d-grid gap-3">
                                <label class="payment-option-card active" data-method="cash_on_delivery">
                                    <i class="bi bi-cash-stack fs-3 text-danger"></i>
                                    <div>
                                        <div class="fw-bold">{{ __('Cash on Delivery') }}</div>
                                        <small class="text-muted">{{ __('Pay when your order arrives') }}</small>
                                    </div>
                                </label>
                                <label class="payment-option-card" data-method="bank_transfer">
                                    <i class="bi bi-bank fs-3 text-primary"></i>
                                    <div>
                                        <div class="fw-bold">{{ __('Bank Transfer') }}</div>
                                        <small class="text-muted">{{ __('Transfer to our bank account') }}</small>
                                    </div>
                                </label>
                                <label class="payment-option-card" data-method="wallet">
                                    <i class="bi bi-wallet2 fs-3 text-success"></i>
                                    <div>
                                        <div class="fw-bold">{{ __('Wallet') }}</div>
                                        <small class="text-muted">{{ __('Use saved wallet balance') }}</small>
                                    </div>
                                </label>
                                <label class="payment-option-card" data-method="instapay">
                                    <i class="bi bi-lightning-charge-fill fs-3" style="color: #6B3FA0;"></i>
                                    <div>
                                        <div class="fw-bold">InstaPay</div>
                                        <small class="text-muted">{{ __('Instant Transfer') }}</small>
                                    </div>
                                </label>
                                <label class="payment-option-card" data-method="vodafone_cash">
                                    <i class="bi bi-phone-fill fs-3" style="color: #E60000;"></i>
                                    <div>
                                        <div class="fw-bold">Vodafone Cash</div>
                                        <small class="text-muted">{{ __('Starts with 010') }}</small>
                                    </div>
                                </label>
                                <label class="payment-option-card" data-method="etisalat_cash">
                                    <i class="bi bi-phone-fill fs-3" style="color: #00953B;"></i>
                                    <div>
                                        <div class="fw-bold">Etisalat Cash</div>
                                        <small class="text-muted">{{ __('Starts with 011') }}</small>
                                    </div>
                                </label>
                                <label class="payment-option-card" data-method="orange_cash">
                                    <i class="bi bi-phone-fill fs-3" style="color: #FF6600;"></i>
                                    <div>
                                        <div class="fw-bold">Orange Cash</div>
                                        <small class="text-muted">{{ __('Starts with 012') }}</small>
                                    </div>
                                </label>
                                <label class="payment-option-card" data-method="fawry_pay">
                                    <i class="bi bi-upc-scan fs-3 text-warning"></i>
                                    <div>
                                        <div class="fw-bold">Fawry Pay</div>
                                        <small class="text-muted">{{ __('Fawry Code') }}</small>
                                    </div>
                                </label>
                                <label class="payment-option-card" data-method="paypal">
                                    <i class="bi bi-paypal fs-3" style="color: #003087;"></i>
                                    <div>
                                        <div class="fw-bold">PayPal</div>
                                        <small class="text-muted">{{ __('Global Email') }}</small>
                                    </div>
                                </label>
                                <label class="payment-option-card" data-method="bank_card">
                                    <i class="bi bi-credit-card-fill fs-3" style="color: #1A1F71;"></i>
                                    <div>
                                        <div class="fw-bold">Bank Card</div>
                                        <small class="text-muted">{{ __('Visa / Mastercard') }}</small>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 rounded-3 py-3 fw-bold fs-6">{{ __('Place Order') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <style>
        .payment-option-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border: 1px solid #dee2e6;
            border-radius: 14px;
            background: #fff;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .payment-option-card:hover,
        .payment-option-card.active {
            border-color: #db4444;
            box-shadow: 0 8px 20px rgba(219, 68, 68, 0.08);
            transform: translateY(-1px);
        }
    </style>
    <script>
        (function () {
            const cards = document.querySelectorAll('.payment-option-card');
            const input = document.getElementById('payment_method');
            const detailsWrap = document.getElementById('paymentDetailsLeft');
            const detailsInput = document.getElementById('payment_details_left');
            const detailsLabel = document.getElementById('paymentDetailsLabelLeft');
            const detailsHint = document.getElementById('paymentDetailsHintLeft');

            const paymentMeta = {
                cash_on_delivery: {
                    show: false,
                },
                bank_transfer: {
                    show: true,
                    label: @json(__('Bank Account Number')),
                    placeholder: @json(__('Enter your bank account number')),
                    hint: @json(__('We will use this to confirm your transfer.')),
                },
                wallet: {
                    show: true,
                    label: @json(__('Wallet Number or Email')),
                    placeholder: @json(__('Enter your wallet number or email')),
                    hint: @json(__('Use the verified wallet that will be charged.')),
                },
                instapay: {
                    show: true,
                    label: @json(__('InstaPay Account')),
                    placeholder: @json(__('Enter your InstaPay account')),
                    hint: @json(__('Use your InstaPay ID for instant transfer.')),
                },
                vodafone_cash: {
                    show: true,
                    label: @json(__('Vodafone Cash Number')),
                    placeholder: @json(__('Enter your Vodafone Cash number')),
                    hint: @json(__('The number should start with 010.')),
                },
                etisalat_cash: {
                    show: true,
                    label: @json(__('Etisalat Cash Number')),
                    placeholder: @json(__('Enter your Etisalat Cash number')),
                    hint: @json(__('The number should start with 011.')),
                },
                orange_cash: {
                    show: true,
                    label: @json(__('Orange Cash Number')),
                    placeholder: @json(__('Enter your Orange Cash number')),
                    hint: @json(__('The number should start with 012.')),
                },
                fawry_pay: {
                    show: true,
                    label: @json(__('Fawry Code')),
                    placeholder: @json(__('Enter your Fawry code')),
                    hint: @json(__('Use the payment code generated by Fawry.')),
                },
                paypal: {
                    show: true,
                    label: @json(__('PayPal Email')),
                    placeholder: @json(__('Enter your PayPal email')),
                    hint: @json(__('Use the verified PayPal email.')),
                },
                bank_card: {
                    show: true,
                    label: @json(__('Card Number')),
                    placeholder: @json(__('Enter your Visa or Mastercard number')),
                    hint: @json(__('The card must be active and valid.')),
                },
            };

            const syncDetails = () => {
                const meta = paymentMeta[input.value] || paymentMeta.cash_on_delivery;
                if (meta.show) {
                    detailsWrap.classList.remove('d-none');
                    detailsLabel.textContent = meta.label;
                    detailsInput.placeholder = meta.placeholder;
                    detailsHint.textContent = meta.hint;
                    detailsInput.required = true;
                } else {
                    detailsWrap.classList.add('d-none');
                    detailsInput.value = '';
                    detailsInput.required = false;
                }
            };

            cards.forEach((card) => {
                card.addEventListener('click', () => {
                    const method = card.dataset.method;
                    input.value = method;
                    cards.forEach((item) => item.classList.toggle('active', item.dataset.method === method));
                    syncDetails();
                });
            });
            syncDetails();
        })();
    </script>
</x-layout.layout>
