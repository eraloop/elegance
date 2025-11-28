<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunFact extends Model
{
    protected $fillable = [
        'label',
        'count',
        'icon',
        'is_active',
    ];
}
