<x-layout.layout title="About Us - Hardware Components">
    <main class="container my-5 py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold text-dark mb-3">{{ __('Our Story') }}</h1>
                <p class="lead text-muted">{{ __('Silica is your premier e-commerce destination for high-performance computer hardware, custom PC builds, and component recommendations.') }}</p>
                <p class="text-secondary mb-4">{{ __('Founded by a dedicated team of engineers and enthusiasts, we bring you authentic PC components, comprehensive warranty coverage, and reliable express delivery across the nation.') }}</p>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="p-3 border rounded-3 bg-light text-center">
                            <h3 class="fw-bold text-danger mb-0">10.5k+</h3>
                            <small class="text-muted">{{ __('Sellers active on our site') }}</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 border rounded-3 bg-light text-center">
                            <h3 class="fw-bold text-danger mb-0">33k+</h3>
                            <small class="text-muted">{{ __('Monthly product sale') }}</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="p-5 bg-dark text-white rounded-4 text-center">
                    <i class="bi bi-cpu display-1 text-danger mb-3"></i>
                    <h3 class="fw-bold">{{ __('Exclusive Hardware') }}</h3>
                    <p class="text-secondary mb-0">{{ __('Top tier GPUs, CPUs, Motherboards, RAM & NVMe SSDs guaranteed 100% genuine.') }}</p>
                </div>
            </div>
        </div>
    </main>
</x-layout.layout>
