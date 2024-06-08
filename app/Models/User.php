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

    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'email',
        'phone'
    ];

    protected $hidden = [
        'is_admin'
    ];

    protected function casts(): array
    {
        return [
            'is_admin' => 'boolean',
            'email_verified_at' => 'datetime',
            'last_online' => 'datetime',
        ];
    }

    public function login(): HasOne
    {
        return $this->hasOne(PersonalData::class);
    }

    public function card(): HasMany
    {
        return $this->hasMany(Card::class);
    }

    public function freelancer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function purchaser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Document(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
