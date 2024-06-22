<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_data',
        'purchaser'
    ];
    
    protected $hidden = [
        'is_official',
        'is_fulfilled',
        'flagged'
    ];
    
    protected function casts(): array
    {
        return [
            'is_official' => 'boolean',
            'is_fulfilled' => 'boolean',
        ];
    }

    protected $attributes = [
        'is_official' => 0,
        'is_fulfilled' => 0,
    ];

    public function task_data(): HasOne {
        return $this->hasOne(TaskData::class);
    }

    public function purchaser(): BelongsTo{
        return $this->belongsTo(Purchaser::class);
    }
    public function freelancer(): BelongsTo{
        return $this->belongsTo(Freelancer::class);
    }
}
