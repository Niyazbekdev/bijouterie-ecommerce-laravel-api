<?php

namespace App\Services\v1\admin\brend;

use App\Models\Brand;

class StoreBrendService
{
    public function execute(array $data): bool
    {
        Brand::firstOrCreate([
            'name' => $data['name'],
        ]);

        return true;
    }
}
