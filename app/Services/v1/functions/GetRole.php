<?php

namespace App\Services\v1\functions;

use App\Enums\RoleEnum;

class GetRole
{
    public static function name($role_id): string
    {
        return match ($role_id) {
            1 => RoleEnum::admin->name,
            2 => RoleEnum::customer->name
        };
    }
}
