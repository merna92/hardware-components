<x-layout title="Edit User">
    <div class="admin-page">
        <div class="container">
            <div class="admin-breadcrumb">Home / Admin / Users / Edit</div>

            <div class="admin-title-row">
                <h2>Edit User</h2>
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="admin-form">
                @csrf
                @method('PATCH')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Display Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <select name="role_type" class="form-select" required>
                            @foreach(['Admin', 'Customer', 'Support_Agent'] as $role)
                                <option value="{{ $role }}" @selected(old('role_type', $user->role_type) == $role)>{{ $role }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button class="btn btn-dark mt-4 px-4" type="submit">Update User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark mt-4 px-4">Cancel</a>
            </form>
        </div>
    </div>
</x-layout>
