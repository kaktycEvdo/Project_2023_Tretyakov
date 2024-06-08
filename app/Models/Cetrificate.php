<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cetrificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'associated_company',
        'about'
    ];

    protected function casts(): array
    {
        return [
            'verified' => 'boolean',
        ];
    }

    protected $attributes = [
        'verified' => 0
    ];
}
