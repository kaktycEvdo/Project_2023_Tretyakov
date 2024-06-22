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
        'text',
        'author',
        'recepient'
    ];
    
    protected $hidden = [
        'flagged'
    ];

    public function author(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function recepient(): HasOne{
        return $this->HasOne(User::class);
    }

    public function getTimeAttribute(): string{
        return date('d M Y, H:i:s', strtotime($this->created_at));
    }
}
