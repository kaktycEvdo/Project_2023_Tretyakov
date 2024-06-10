<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'email';
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'email',
        'phone'
    ];
    
    protected $hidden = [
        'flagged'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_online' => 'datetime',
        ];
    }

    public function login(): BelongsTo
    {
        return $this->BelongsTo(PersonalData::class, 'login');
    }

    public function card(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function document(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
