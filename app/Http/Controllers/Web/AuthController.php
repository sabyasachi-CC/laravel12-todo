<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(private AuthService $auth) {}

    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $this->auth->attemptLogin($request->string('email')->toString(), $request->string('password')->toString(), $request->boolean('remember'));

        return redirect()->route('todos.index')->with('success', 'Welcome back.');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $user = $this->auth->register($request->validated());
        auth()->login($user);
        $request->session()->regenerate();

        return redirect()->route('todos.index')->with('success', 'Account created successfully.');
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->auth->logout();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
