<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    use HasFactory;

    protected $primaryKey = 'number';

    protected $fillable = [
        'number',
        'expiry',
        'sc'
    ];

    protected $hidden = [
        'user',
        'flagged'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
