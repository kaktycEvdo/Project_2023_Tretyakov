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
        'flagged'
    ];

    public function task(): BelongsTo{
        return $this->belongsTo(Task::class);
    }

    public function feedbacks(): BelongsTo{
        return $this->belongsTo(Feedback::class);
    }
}
