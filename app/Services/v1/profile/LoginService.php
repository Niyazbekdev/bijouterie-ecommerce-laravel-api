<?php

namespace App\Services\v1\profile;

use App\Models\User;
use App\Services\v1\functions\RespondToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginService
{
        public function execute(array $data, $role_id): JsonResponse
    {
        $login = $data['email'] ?? $data['phone'];

        $user = User::where('role_id', $role_id)
            ->where(function ($query) use ($login) {
                $query->where('email', $login)
                    ->orWhere('phone', $login);
            })
            ->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'auth' => ['The provided credentials are incorrect.'],
            ]);
        }

        return RespondToken::getToken($user, $role_id);
    }
}
