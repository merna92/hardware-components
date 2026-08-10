<x-layout title="404 Not Found">
    <div class="error-page">
        <div class="container">
            <div class="admin-breadcrumb">Home / 404 Error</div>

            <div class="error-content">
                <h1>404 Not Found</h1>
                <p>Your visited page not found. You may go home page.</p>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-dark px-4">Back to home page</a>
            </div>
        </div>
    </div>
</x-layout>
