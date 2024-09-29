<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Discount extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name', 'product_id', 'percent', 'sum', 'from_date', 'to_date'
    ];

    protected $casts = [
        'product_id' => 'integer',
        'percent' => 'integer',
        'sum' => 'integer',
    ];

    public array $translatable = ['name'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
