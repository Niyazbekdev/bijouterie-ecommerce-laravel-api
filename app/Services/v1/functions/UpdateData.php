<?php

namespace App\Services\v1\functions;

class UpdateData
{
    public static function execute(array $data): array
    {
        return array_filter($data, function ($value) {
            return !empty($value);
        });
    }
}
