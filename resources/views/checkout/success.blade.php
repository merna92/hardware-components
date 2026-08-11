<x-layout.layout title="Order Confirmed">
    <main class="container my-5 py-5">
        <section class="cart-total-box bg-white text-center mx-auto col-12 col-md-8 col-lg-6">
            <div class="text-success fs-1 mb-3"><i class="bi bi-check-circle-fill"></i></div>
            <h1 class="h2">Order Confirmed</h1>
            <p class="text-muted mb-2">Thank you for your order.</p>
            <p class="mb-4">Order #{{ $order->id }} · Total ${{ number_format((float) $order->final_amount, 2) }}</p>
            <a href="{{ route('cart.index') }}" class="btn btn-danger-custom">Return to Cart</a>
        </section>
    </main>
</x-layout.layout>
