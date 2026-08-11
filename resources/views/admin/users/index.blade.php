<x-layout title="Users">
    <div class="admin-page">
        <div class="container">
            <div class="admin-breadcrumb">Home / Admin / Users</div>

            <div class="admin-title-row">
                <h2>Users Management</h2>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark px-4">Dashboard</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="admin-panel p-0">
                <div class="table-responsive">
                    <table class="table admin-table align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number ?? '-' }}</td>
                                    <td><span class="badge text-bg-light">{{ $user->role_type }}</span></td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-dark btn-sm">Edit</a>
                                        <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4">{{ $users->links() }}</div>
        </div>
    </div>
</x-layout>
