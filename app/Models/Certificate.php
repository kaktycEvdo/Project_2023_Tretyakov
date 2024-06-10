<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'associated_company',
        'about'
    ];

    protected $hidden = [
        'user',
        'verified'
    ];

    protected function casts(): array
    {
        return [
            'verified' => 'boolean',
        ];
    }

    protected $attributes = [
        'verified' => 0
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
