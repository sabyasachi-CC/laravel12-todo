@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-3">All TODOs</h1>

    <div class="card">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($todos as $todo)
                        <tr>
                            <td>{{ $todo->title }}</td>
                            <td>{{ $todo->user?->full_name }}</td>
                            <td>{{ $todo->status ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $todo->created_at->format('d M Y') }}</td>
                            <td class="text-end">
                                <form method="POST" action="{{ route('admin.todos.destroy', $todo) }}">
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
                            <td colspan="5" class="text-center">No TODOs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $todos->links() }}</div>
    </div>
@endsection
