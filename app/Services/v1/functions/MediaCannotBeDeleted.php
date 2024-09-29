<?php

namespace App\Services\v1\functions;

use Illuminate\Database\Eloquent\Model;

class MediaCannotBeDeleted
{
    public static function doesNotBelongToTheModel($mediaId, Model $model): self
    {
        $modelClass = $model::class;

        return new static("Media with id `{$mediaId}` cannot be deleted because it does not exist or does not belong to model {$modelClass} with id {$model->getKey()}");
    }
}
