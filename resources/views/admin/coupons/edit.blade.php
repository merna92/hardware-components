<x-layout.layout title="Edit Coupon - Admin">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <h4 class="fw-bold mb-4">Edit Coupon #{{ $coupon->id }}</h4>

                    @if($errors->any())
                        <div class="alert alert-danger mb-4">{{ $errors->first() }}</div>
                    @endif

                    <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        @include('admin.coupons.form')

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
                            <button type="submit" class="btn btn-danger px-4 fw-semibold">Update Coupon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout.layout>
