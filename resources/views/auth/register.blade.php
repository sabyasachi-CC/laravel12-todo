@extends('layouts.guest')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h1 class="h3 mb-4">Create account</h1>

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">First name</label>
                        <input name="first_name" value="{{ old('first_name') }}" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Last name</label>
                        <input name="last_name" value="{{ old('last_name') }}" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input name="phone" value="{{ old('phone') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm password</label>
                    <input name="password_confirmation" type="password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100">Register</button>
            </form>

            <p class="text-center mt-3 mb-0">
                Already registered? <a href="{{ route('login') }}">Login</a>
            </p>
        </div>
    </div>
@endsection
