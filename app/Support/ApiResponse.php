<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success(mixed $data = null, string $message = 'Success', int $status = 200, array $extra = []): JsonResponse
    {
        return response()->json(array_merge(['success' => true, 'message' => $message, 'data' => $data], $extra), $status);
    }

    public static function error(string $message, int $status, array $errors = []): JsonResponse
    {
        $payload = ['success' => false, 'message' => $message];
        if ($errors) {
            $payload['errors'] = $errors;
        }

        return response()->json($payload, $status);
    }
}
