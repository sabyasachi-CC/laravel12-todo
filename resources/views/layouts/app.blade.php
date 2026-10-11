<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-light">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">TODO</a>
                <div class="d-flex align-items-center gap-2">
                    @auth
                        @if (auth()->user()->isAdmin())
                            <a class="btn btn-outline-light btn-sm" href="{{ route('admin.users.index') }}">Admin</a>
                        @endif
                        <a class="btn btn-outline-light btn-sm" href="{{ route('profile') }}">
                            {{ auth()->user()->full_name }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-light btn-sm">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="container py-4">
            <x-alerts />
            @yield('content')
        </main>
    </body>
</html>
