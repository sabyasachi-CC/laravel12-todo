@extends('layouts.guest')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h1 class="h3 mb-4">Sign in</h1>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        required
                        autofocus
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" required>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" value="1" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button class="btn btn-primary w-100">Login</button>
            </form>

            <p class="text-center mt-3 mb-0">
                No account? <a href="{{ route('register') }}">Register</a>
            </p>
        </div>
    </div>
@endsection
