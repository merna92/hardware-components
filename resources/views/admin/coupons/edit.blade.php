<x-layout title="Edit Coupon">
    <div class="admin-page">
        <div class="container">
            <div class="admin-breadcrumb">Home / Admin / Coupons / Edit</div>

            <div class="admin-title-row">
                <h2>Edit Coupon</h2>
            </div>

            <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST" class="admin-form">
                @csrf
                @method('PATCH')
                @include('admin.coupons.form')

                <button class="btn btn-dark mt-4 px-4" type="submit">Update Coupon</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-dark mt-4 px-4">Cancel</a>
            </form>
        </div>
    </div>
</x-layout>
