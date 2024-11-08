<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Status extends Model
{
    use HasTranslations;

    protected $fillable = ['name'];

    public array $translatable = ['name'];
}
