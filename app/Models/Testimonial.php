<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_photo',
        'rating',
        'title',
        'content',
        'status',
        'position',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];
}
