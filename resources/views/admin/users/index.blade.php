@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">User Management</h1>

    <form class="card card-body mb-3">
        <div class="row g-2">
            <div class="col-md-6">
                <input name="search" value="{{ request('search') }}" class="form-control" placeholder="Name or email">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="1" @selected(request('status') === '1')>Active</option>
                    <option value="0" @selected(request('status') === '0')>Inactive</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary">Filter</button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->full_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->type) }}</td>
                            <td>
                                <span class="badge text-bg-{{ $user->status ? 'success' : 'secondary' }}">
                                    {{ $user->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.users.edit', $user) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $users->links() }}</div>
    </div>

    <div class="mt-3">
        <a href="{{ route('admin.todos.index') }}" class="btn btn-outline-dark">Manage TODOs</a>
    </div>
@endsection
