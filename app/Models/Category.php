<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    // Una categoría puede tener muchos libros
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
