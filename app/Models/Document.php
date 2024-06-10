<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'type'
    ];

    protected $hidden = [
        'user'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
