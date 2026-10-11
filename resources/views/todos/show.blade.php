@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h1 class="h4">{{ $todo->title }}</h1>
                <span class="badge text-bg-{{ $todo->status ? 'success' : 'secondary' }}">
                    {{ $todo->status ? 'Active' : 'Inactive' }}
                </span>
            </div>
            <hr>
            <p style="white-space: pre-wrap">{{ $todo->description ?: 'No description.' }}</p>
            <a href="{{ route('todos.edit', $todo) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('todos.index') }}" class="btn btn-link">Back</a>
        </div>
    </div>
@endsection
