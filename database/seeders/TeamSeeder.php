<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Team::create([
            'name' => 'Emma Johnson',
            'position' => 'Founder',
            'image' => 'assets/images/team-1.jpg',
            'facebook' => '#',
            'instagram' => '#',
            'twitter' => '#',
            'is_active' => true,
        ]);

        \App\Models\Team::create([
            'name' => 'Arita Johnson',
            'position' => 'Blow Dry & Curl',
            'image' => 'assets/images/team-2.jpg',
            'facebook' => '#',
            'instagram' => '#',
            'twitter' => '#',
            'is_active' => true,
        ]);

        \App\Models\Team::create([
            'name' => 'John Doe',
            'position' => 'Hair Cut',
            'image' => 'assets/images/team-3.jpg',
            'facebook' => '#',
            'instagram' => '#',
            'twitter' => '#',
            'is_active' => true,
        ]);
    }
}
