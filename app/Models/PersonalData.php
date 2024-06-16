<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PersonalData extends Model
{
    use HasFactory;

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
