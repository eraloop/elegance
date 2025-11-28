<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'slug',
        'short_description',
        'description',
        'responsibilities',
        'gallery',
        'thumbnail',
        'price_min',
        'price_max',
        'duration',
        'preparation_tips',
        'is_featured',
        'is_popular',
        'is_active',
        'is_promotion',
        'is_gift',
        'seo_title',
        'seo_description',
    ];

    protected $casts = [
        'responsibilities' => 'array',
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_popular' => 'boolean',
        'is_active' => 'boolean',
        'is_promotion' => 'boolean',
        'is_gift' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function faqs()
    {
        return $this->hasMany(FAQ::class, "serviceId");
    }

}
