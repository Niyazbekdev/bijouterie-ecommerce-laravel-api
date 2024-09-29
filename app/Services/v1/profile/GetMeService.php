<?php

namespace App\Services\v1\profile;

use App\Services\v1\functions\GetRole;
use Illuminate\Http\JsonResponse;

class GetMeService
{
    public function execute(): JsonResponse
    {
        $user = auth()->user();

        $role = GetRole::name($user->role_id);

        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'role' => [
                'id' => $user->role_id,
                'name' => $role
            ]
        ];

        return response()->json([
            'data' => $data
        ]);
    }
}
