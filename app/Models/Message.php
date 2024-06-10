<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'text'
    ];
    
    protected $hidden = [
        'flagged'
    ];

    public function author(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function recipient(): HasOne{
        return $this->HasOne(User::class);
    }
}
