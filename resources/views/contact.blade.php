<x-layout.layout title="Contact Us - Hardware Components">
    <main class="container my-5 py-4">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 rounded-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-danger text-white rounded-circle p-2 me-3"><i class="bi bi-telephone fs-4"></i></div>
                        <div>
                            <h5 class="fw-bold mb-0">Call To Us</h5>
                            <small class="text-muted">We are available 24/7, 7 days a week.</small>
                        </div>
                    </div>
                    <p class="text-secondary mb-4">Phone: +8801611112222</p>
                    <hr>
                    <div class="d-flex align-items-center mb-3 mt-4">
                        <div class="bg-danger text-white rounded-circle p-2 me-3"><i class="bi bi-envelope fs-4"></i></div>
                        <div>
                            <h5 class="fw-bold mb-0">Write To US</h5>
                            <small class="text-muted">Fill out our form and we will contact you within 24 hours.</small>
                        </div>
                    </div>
                    <p class="text-secondary mb-0">Emails: customer@exclusive.com</p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 rounded-4">
                    <h3 class="fw-bold mb-4">Send Us A Message</h3>
                    <form action="#" method="POST">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <input type="text" class="form-control bg-light" placeholder="Your Name *" required>
                            </div>
                            <div class="col-md-4">
                                <input type="email" class="form-control bg-light" placeholder="Your Email *" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control bg-light" placeholder="Your Phone *" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control bg-light" rows="5" placeholder="Your Message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-3 fw-semibold">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-layout.layout>
