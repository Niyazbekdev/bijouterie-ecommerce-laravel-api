<?php

namespace App\Services\v1\admin\category;

use App\Models\Category;

class StoreCategoryService
{
    public function execute(array $data): bool
    {
        $category = $this->createCategory($data);

        if (!empty($data['children'])) {
            $this->createChildCategories($data['children'], $category->id);
        }

        return true;
    }

    public function createCategory(array $data): Category
    {
        $icon = null;

        if (!empty($data['icon'])) {
            $this->storeIcon($data['icon']);
            $icon = $data['icon']->hashName();
        }

        return Category::create([
            'name' => $data['name'],
            'icon' => $icon,
        ]);
    }

    public function createChildCategories(array $children, int $parentId): void
    {
        $dataChild = [];
        foreach ($children as $child) {
            $icon = null;

            if (!empty($child['icon'])) {
                $this->storeIcon($child['icon']);
                $icon = $child['icon']->hashName();
            }

            $name = [
                'kaa' => strtolower($child['name']['kaa']),
                'ru' => strtolower($child['name']['ru']),
            ];

            $dataChild[] = [
                'parent_id' => $parentId,
                'name' => json_encode($name),
                'icon' => $icon,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Category::insert($dataChild);
    }

    protected function storeIcon($image): void
    {
        if ($image) {
            $image->store('icons', 'public');
        }
    }
}
