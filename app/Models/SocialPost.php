<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'facebook_content',
        'instagram_content',
        'whatsapp_content',
        'image_path',
        'platforms',
        'status',
        'posted_at',
    ];

    protected $casts = [
        'platforms' => 'array',
        'posted_at' => 'datetime',
    ];
}
