<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Services\AuthService;
use App\Support\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(private AuthService $auth) {}

    public function register(RegisterRequest $request)
    {
        $user = $this->auth->register($request->validated());
        $token = $this->auth->issueApiToken($user, 'api-client');

        return ApiResponse::success(['user' => new UserResource($user), 'token' => $token], 'Registered successfully.', 201);
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = $this->auth->attemptLogin($request->string('email')->toString(), $request->string('password')->toString());
            $token = $this->auth->issueApiToken($user, 'api-client');
            auth()->logout();

            return ApiResponse::success(['user' => new UserResource($user), 'token' => $token], 'Login successful.');
        } catch (ValidationException $e) {
            return ApiResponse::error('Invalid credentials or inactive account.', 422, $e->errors());
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();

        return ApiResponse::success(null, 'Logout successful.', 204);
    }

    public function me(Request $request)
    {
        return ApiResponse::success(new UserResource($request->user()), 'Authenticated user.');
    }
}
