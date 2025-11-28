<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                "name" => "Hair Care",
                "slug" => "hair-care",
                "description" => "All services related to hair treatments, styling, and haircuts.",
                "is_featured" => true,
                "is_active" => true,
                "seo_title" => "Hair Care Services",
                "seo_description" => "Explore our wide range of hair care services, from haircuts to treatments.",
                "sort_order" => 1
            ],
            [
                "name" => "Nail Care",
                "slug" => "nail-care",
                "description" => "Manicures, pedicures, and other nail treatments for a flawless look.",
                "is_featured" => false,
                "is_active" => true,
                "seo_title" => "Nail Care Services",
                "seo_description" => "Get pampered with our professional manicure and pedicure services.",
                "sort_order" => 2
            ],
            [
                "name" => "Makeup Services",
                "slug" => "makeup-services",
                "description" => "Professional makeup services for all occasions, including bridal and special events.",
                "is_featured" => true,
                "is_active" => true,
                "seo_title" => "Professional Makeup Services",
                "seo_description" => "Flawless makeup applications for weddings, parties, and more.",
                "sort_order" => 3
            ],
            [
                "name" => "Skin Care",
                "slug" => "skin-care",
                "description" => "Facial treatments, skincare routines, and body care services.",
                "is_featured" => false,
                "is_active" => true,
                "seo_title" => "Skin Care Treatments",
                "seo_description" => "Rejuvenate your skin with our professional skin care treatments.",
                "sort_order" => 4
            ],
            [
                "name" => "Bridal Services",
                "slug" => "bridal-services",
                "description" => "Specialized bridal beauty services for your special day.",
                "is_featured" => true,
                "is_active" => true,
                "seo_title" => "Bridal Beauty Services",
                "seo_description" => "Make your wedding day even more special with our bridal beauty services.",
                "sort_order" => 5
            ],
            [
                "name" => "Spa Treatments",
                "slug" => "spa-treatments",
                "description" => "Relax and unwind with our soothing spa treatments.",
                "is_featured" => false,
                "is_active" => true,
                "seo_title" => "Relaxing Spa Treatments",
                "seo_description" => "Indulge in our relaxing spa treatments designed to rejuvenate and refresh.",
                "sort_order" => 6
            ],
            [
                "name" => "Body Treatments",
                "slug" => "body-treatments",
                "description" => "Full-body services including exfoliation, wraps, and massages.",
                "is_featured" => false,
                "is_active" => true,
                "seo_title" => "Body Treatments",
                "seo_description" => "Pamper your body with our luxurious body treatments.",
                "sort_order" => 7
            ],
            [
                "name" => "Tattoo Services",
                "slug" => "tattoo-services",
                "description" => "Custom tattoos for all styles and preferences.",
                "is_featured" => false,
                "is_active" => true,
                "seo_title" => "Tattoo Services",
                "seo_description" => "Get your custom tattoo designed and inked by our expert artists.",
                "sort_order" => 8
            ],
            [
                "name" => "Hair Removal",
                "slug" => "hair-removal",
                "description" => "Various hair removal services including waxing and laser hair removal.",
                "is_featured" => false,
                "is_active" => true,
                "seo_title" => "Hair Removal Services",
                "seo_description" => "Choose from a variety of hair removal services for smooth, flawless skin.",
                "sort_order" => 9
            ],
            [
                "name" => "Men's Grooming",
                "slug" => "mens-grooming",
                "description" => "Grooming services specifically tailored for men, including haircuts and shaves.",
                "is_featured" => false,
                "is_active" => true,
                "seo_title" => "Men's Grooming Services",
                "seo_description" => "Professional grooming services for men, from haircuts to shaves.",
                "sort_order" => 10
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
