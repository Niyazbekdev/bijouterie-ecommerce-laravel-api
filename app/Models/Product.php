<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'brend_id', 'category_id', 'sold', 'discount_price'
    ];

    public array $translatable = [
        'name', 'description',
    ];

    protected $casts = [
        'price' => 'integer',
        'quantity' => 'integer',
        'brend_id' => 'integer',
        'category_id' => 'integer',
        'sold' => 'integer',
        'discount_price' => 'integer'
    ];

    public function brend(): BelongsTo
    {
        return $this->belongsTo(Brend::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class)->withPivot('quantity');
    }

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
