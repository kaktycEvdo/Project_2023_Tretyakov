<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalData extends Model
{
    use HasFactory;

    protected $primaryKey = 'login';

    protected $fillable = [
        'login',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'is_admin'
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
