<x-layout.layout :title="__('Activity Log') . ' - ' . __('Dashboard')">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h3 class="fw-bold text-dark mb-0">{{ __('Activity Log') }}</h3>
                <p class="text-muted mb-0">{{ __('Recent admin and account actions recorded by the system.') }}</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">{{ __('Dashboard') }}</a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
            @if($logs->isEmpty())
                <div class="alert alert-info mb-0">{{ __('No activity logged yet.') }}</div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>{{ __('Time') }}</th>
                                <th>{{ __('User') }}</th>
                                <th>{{ __('Action') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('IP') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td class="text-muted small">{{ $log->created_at?->format('Y-m-d H:i') }}</td>
                                    <td class="fw-semibold">{{ $log->user?->name ?? __('Guest') }}</td>
                                    <td>
                                        <span class="badge bg-dark px-3 py-2">{{ $log->action }}</span>
                                    </td>
                                    <td>{{ $log->description }}</td>
                                    <td class="text-muted small">{{ $log->ip_address ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $logs->links() }}</div>
            @endif
        </div>
    </div>
</x-layout.layout>
