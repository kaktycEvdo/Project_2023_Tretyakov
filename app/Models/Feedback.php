<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Feedback extends Model
{
    public function task_data(): HasOne {
        return $this->hasOne(TaskData::class);
    }

    public function freelancer(): BelongsTo{
        return $this->belongsTo(Freelancer::class);
    }
}
