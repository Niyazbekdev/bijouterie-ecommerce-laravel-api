<?php

namespace App\Services\v1\admin\category;

use App\Services\v1\functions\UpdateData;

class UpdateCategoryService
{
    public function execute(array $data, object $category): bool
    {
        $updateData = UpdateData::execute($data);

        if (! empty($updateData)) {
            $category->update($updateData);
        }

        return true;
    }
}
