<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PersonalData extends Model
{
    use HasFactory;

    protected $primaryKey = 'login';
    protected $keyType = 'string';

    protected $fillable = [
        'login',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'is_admin',
        'flagged'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    protected $attributes = [
        'is_admin' => 0
    ];
}
