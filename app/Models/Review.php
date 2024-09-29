<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'rating', 'comment', 'is_anonym', 'answer'
    ];

    protected $casts = [
        'is_anonym' => 'boolean',
        'user_id' => 'integer',
        'product_id' => 'integer',
        'rating' => 'integer',
    ];
}
