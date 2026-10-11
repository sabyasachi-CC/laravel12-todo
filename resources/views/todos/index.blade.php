@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-1">My TODOs</h1>
            <p class="text-muted mb-0">Manage your tasks.</p>
        </div>
        <a href="{{ route('todos.create') }}" class="btn btn-primary">New TODO</a>
    </div>

    <form class="card card-body mb-3">
        <div class="row g-2">
            <div class="col-md-5">
                <input name="search" value="{{ request('search') }}" class="form-control" placeholder="Search title">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">All status</option>
                    <option value="1" @selected(request('status') === '1')>Active</option>
                    <option value="0" @selected(request('status') === '0')>Inactive</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary w-100">Filter</button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($todos as $todo)
                        <tr>
                            <td>
                                <a href="{{ route('todos.show', $todo) }}">{{ $todo->title }}</a>
                                <div class="small text-muted">{{ Str::limit($todo->description, 80) }}</div>
                            </td>
                            <td>
                                <span class="badge text-bg-{{ $todo->status ? 'success' : 'secondary' }}">
                                    {{ $todo->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ $todo->created_at->format('d M Y') }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('todos.edit', $todo) }}">Edit</a>
                                <form class="d-inline" method="POST" action="{{ route('todos.destroy', $todo) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this TODO?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No TODOs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $todos->links() }}</div>
    </div>
@endsection
