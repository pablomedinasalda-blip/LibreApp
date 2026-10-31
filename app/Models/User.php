<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Relación: un usuario puede tener muchos préstamos.
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Campos que se pueden guardar mediante asignación masiva.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'documento',
        'telefono',
    ];

    /**
     * Campos ocultos al serializar el usuario.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversiones de atributos.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
