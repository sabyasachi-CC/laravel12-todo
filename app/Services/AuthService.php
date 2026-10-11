<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function register(array $data): User
    {
        return DB::transaction(fn () => User::create([...$data, 'type' => 'user', 'status' => true]));
    }

    public function attemptLogin(string $email, string $password, bool $remember = false): User
    {
        $user = User::where('email', $email)->first();
        if (! $user || ! $user->isActive() || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages(['email' => 'Invalid credentials or inactive account.']);
        }
        
        Auth::login($user, $remember);
        request()->session()->regenerate();

        return $user;
    }

    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    public function issueApiToken(User $user, string $deviceName = 'api-client'): string
    {
        $user->tokens()->delete();

        return $user->createToken($deviceName)->plainTextToken;
    }
}
