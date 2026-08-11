<x-layout title="Create Coupon">
    <div class="admin-page">
        <div class="container">
            <div class="admin-breadcrumb">Home / Admin / Coupons / Create</div>

            <div class="admin-title-row">
                <h2>Create Coupon</h2>
            </div>

            <form action="{{ route('admin.coupons.store') }}" method="POST" class="admin-form">
                @csrf
                @include('admin.coupons.form')

                <button class="btn btn-dark mt-4 px-4" type="submit">Save Coupon</button>
                <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-dark mt-4 px-4">Cancel</a>
            </form>
        </div>
    </div>
</x-layout>
