<x-layout.layout title="404 Not Found - Exclusive">
    <div class="container py-5 text-center my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <h1 class="display-1 fw-bold text-danger mb-4" style="font-size: 8rem;">404</h1>
                <h2 class="fw-bold text-dark mb-3">404 Not Found</h2>
                <p class="text-muted mb-5">Your visited page not found. You may go home page.</p>
                <a href="{{ route('home') }}" class="btn btn-danger px-5 py-3 rounded-3 fw-semibold">Back to home page</a>
            </div>
        </div>
    </div>
</x-layout.layout>
