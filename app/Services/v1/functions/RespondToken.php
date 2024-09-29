<?php

namespace App\Services\v1\functions;

use Illuminate\Http\JsonResponse;

class RespondToken
{
    public static function getToken($user, $role_id): JsonResponse
    {
        $ability = GetRole::name($role_id);

        $token = $user->createToken('authToken', [$ability])->plainTextToken;

        return response()->json([
            'data' => [
                'role' => $ability,
                'token' => $token,
            ]
        ]);
    }
}
