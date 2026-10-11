@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="h4">Profile</h1>
            <dl class="row mb-0">
                <dt class="col-sm-3">Name</dt>
                <dd class="col-sm-9">{{ $user->full_name }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $user->email }}</dd>

                <dt class="col-sm-3">Phone</dt>
                <dd class="col-sm-9">{{ $user->phone ?: 'â€”' }}</dd>

                <dt class="col-sm-3">Address</dt>
                <dd class="col-sm-9">{{ $user->address ?: 'â€”' }}</dd>

                <dt class="col-sm-3">Role</dt>
                <dd class="col-sm-9">{{ ucfirst($user->type) }}</dd>
            </dl>
        </div>
    </div>
@endsection
