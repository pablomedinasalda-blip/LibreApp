<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'isbn',
        'description',
        'year',
        'copies_total',
        'copies_available',
        'cover_image',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'year' => 'integer',
        'copies_total' => 'integer',
        'copies_available' => 'integer',
    ];

    // Un libro pertenece a una categoría
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Un libro pertenece a un autor
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    // Un libro puede tener muchos préstamos
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
