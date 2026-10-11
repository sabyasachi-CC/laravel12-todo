@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="h4">Edit User</h1>
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">First name</label>
                        <input name="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last name</label>
                        <input name="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" value="{{ old('email', $user->email) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input name="phone" value="{{ old('phone', $user->phone) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control">{{ old('address', $user->address) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select">
                            <option value="user" @selected($user->type === 'user')>User</option>
                            <option value="admin" @selected($user->type === 'admin')>Admin</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" @selected($user->status)>Active</option>
                            <option value="0" @selected(!$user->status)>Inactive</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-link">Cancel</a>
            </form>
        </div>
    </div>
@endsection
