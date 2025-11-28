<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Hero::create([
            'title' => 'Welcome to Elegance',
            'subtitle' => 'Discover You Unique & New Style',
            'description' => 'We believe that your hair is an expression of your personality. Our skilled stylists are here to help you unleash your true style potential.',
            'image' => 'assets/images/hero-img.jpg',
            'button_text' => 'Book Now',
            'button_link' => route('web.booking'),
            'secondary_button_text' => 'Contact Now',
            'secondary_button_link' => route('web.contact'),
            'is_active' => true,
        ]);
    }
}
