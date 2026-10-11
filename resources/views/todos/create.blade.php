@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="h4">Create TODO</h1>
            <form method="POST" action="{{ route('todos.store') }}">
                @csrf
                @include('todos.form', ['todo' => null])
                <button class="btn btn-primary">Create</button>
                <a href="{{ route('todos.index') }}" class="btn btn-link">Cancel</a>
            </form>
        </div>
    </div>
@endsection
