<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskData extends Model
{
    use HasFactory;

    protected $fillable = [
        'deadline',
        'payment_method',
        'reward',
        'text',
    ];

    protected $hidden = [
        'is_fulfilled',
        'flagged'
    ];

    protected function casts(): array
    {
        return [
            'is_fulfilled' => 'boolean',
        ];
    }

    protected $attributes = [
        'is_fulfilled' => 0
    ];

    public function task(): BelongsTo{
        return $this->belongsTo(Task::class);
    }

    public function feedback(): BelongsTo{
        return $this->belongsTo(Feedback::class);
    }
}
