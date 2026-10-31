<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Loan extends Model
{
    protected $fillable = [
        'book_id',
        'user_id',
        'status',
        'loan_date',
        'due_date',
        'return_date',
        'notes',
    ];

    protected $casts = [
        'loan_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    // Un préstamo pertenece a un libro
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    // Un préstamo pertenece a un usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
