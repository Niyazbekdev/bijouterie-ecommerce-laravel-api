<?php

namespace App\Services\v1\admin\brend;

use App\Models\Brend;

class StoreBrendService
{
    public function execute(array $data): bool
    {
        Brend::firstOrCreate([
            'name' => $data['name'],
        ]);

        return true;
    }
}
