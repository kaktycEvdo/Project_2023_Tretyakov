<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Freelancer extends Model
{
    use HasFactory;

    protected $fillable = [
        'about',
        'characteristics'
    ];
    
    protected $hidden = [
        'flagged'
    ];

    public function email(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function official_task(): HasMany 
    {
        return $this->hasMany(Task::where('is_official', 1)->get());
    }

    public function feedback(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
}
