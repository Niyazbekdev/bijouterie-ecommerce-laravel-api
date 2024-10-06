<?php

namespace App\Services\v1\admin\brand;

use App\Models\Brand;

class StoreBrandService
{
    public function execute(array $data): bool
    {
        Brand::firstOrCreate([
            'name' => $data['name'],
        ]);

        return true;
    }
}
