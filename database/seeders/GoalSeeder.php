<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoalSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Goal::create([
            'title' => 'Our Mission',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
            'image' => 'assets/images/our-mission.jpg',
            'icon' => 'assets/images/icon-mission.svg',
            'type' => 'mission',
            'is_active' => true,
        ]);

        \App\Models\Goal::create([
            'title' => 'Our Vision',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
            'image' => 'assets/images/our-vision.jpg',
            'icon' => 'assets/images/icon-vision.svg',
            'type' => 'vision',
            'is_active' => true,
        ]);

        \App\Models\Goal::create([
            'title' => 'Our Approach',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
            'image' => 'assets/images/our-approach.jpg',
            'icon' => 'assets/images/icon-approach.svg',
            'type' => 'approach',
            'is_active' => true,
        ]);
    }
}
