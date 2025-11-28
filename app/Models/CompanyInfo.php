<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'about_us',
        'about_title',
        'about_subtitle',
        'about_image',
        'video_url',
        'video_image',
        'working_hours',
        'founded_year',
        'about_image_2',
        'about_points',
        'why_choose_us_title',
        'why_choose_us_subtitle',
        'video_file',
    ];

    protected $casts = [
        'about_points' => 'array',
    ];
}
