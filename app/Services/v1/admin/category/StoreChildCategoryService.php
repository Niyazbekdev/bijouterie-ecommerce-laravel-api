<?php

namespace App\Services\v1\admin\category;

class StoreChildCategoryService
{
    public function execute(array $data, object $category): bool
    {
        $icon = null;

        if (isset($data['icon'])) {
            $data['icon']->store('icons', 'public');
            $icon = $data['icon']->hashName();
        }

        $category->children()->create([
            'name' => $data['name'],
            'icon' => $icon,
        ]);

        return true;
    }
}
