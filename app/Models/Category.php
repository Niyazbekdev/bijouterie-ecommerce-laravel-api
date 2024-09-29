<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name', 'icon', 'parent_id'
    ];

    protected $casts = [
        'parent_id'  => 'integer'
    ];

    public array $translatable = ['name'];

    public function iconUrl(): Attribute
    {
        return new Attribute(
            get: fn ($value, $attributes) => config('app.url') . '/storage/icons/' . $attributes['icon'],
            set: null
        );
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
}
