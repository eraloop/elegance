<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Testimonial::create([
            'customer_name' => 'Emma Johnson',
            'customer_photo' => 'assets/images/author-1.jpg',
            'rating' => 5,
            'title' => 'Great Service',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'status' => 'visible',
            'position' => 'Client',
        ]);

        \App\Models\Testimonial::create([
            'customer_name' => 'Olivia Davis',
            'customer_photo' => 'assets/images/author-2.jpg',
            'rating' => 5,
            'title' => 'Amazing Experience',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'status' => 'visible',
            'position' => 'Client',
        ]);
    }
}
