<x-layout.layout :title="__('Reviews Management') . ' - ' . __('Dashboard')">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark mb-0">{{ __('Reviews Management') }}</h3>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">{{ __('Dashboard') }}</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 mb-4">{{ session('success') }}</div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Product') }}</th>
                                <th>{{ __('Rating') }}</th>
                                <th>{{ __('Comment') }}</th>
                                <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            <tr>
                                <td class="fw-semibold">{{ $review->user?->name ?? __('Guest') }}</td>
                                <td>{{ $review->product?->product_name ?? __('Deleted Product') }}</td>
                                <td>
                                    <div class="text-warning fs-5 lh-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                    </div>
                                </td>
                                <td class="text-muted">{{ \Illuminate\Support\Str::limit($review->comment, 70) ?: __('No comment') }}</td>
                                <td>
                                    <form action="{{ route('admin.reviews.delete', $review) }}" method="POST" class="d-inline" data-confirm="{{ __('Delete review?') }}" data-confirm-text="{{ __('This review will be removed from the product page.') }}" data-confirm-button="{{ __('Yes, delete') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">{{ __('Delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">{{ $reviews->links() }}</div>
        </div>
    </div>
</x-layout.layout>
