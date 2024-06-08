<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Purchaser extends Model
{
    use HasFactory;

    protected $fillable = [
        'about',
        'characteristics'
    ];

    public function email(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function task(): HasMany 
    {
        return $this->hasMany(Task::class);
    }

    public function official_task(): HasMany 
    {
        return $this->hasMany(Task::where('is_official', 1)->get());
    }
}
