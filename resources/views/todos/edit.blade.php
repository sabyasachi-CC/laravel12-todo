@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="h4">Edit TODO</h1>
            <form method="POST" action="{{ route('todos.update', $todo) }}">
                @csrf
                @method('PUT')
                @include('todos.form', ['todo' => $todo])
                <button class="btn btn-primary">Save changes</button>
                <a href="{{ route('todos.index') }}" class="btn btn-link">Cancel</a>
            </form>
        </div>
    </div>
@endsection
