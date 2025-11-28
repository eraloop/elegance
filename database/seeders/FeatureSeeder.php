<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            ['name' => 'Hair Cut', 'icon' => 'assets/images/ticker-icon.svg'],
            ['name' => 'Hair Dryer', 'icon' => 'assets/images/ticker-icon.svg'],
            ['name' => 'Hair Style', 'icon' => 'assets/images/ticker-icon.svg'],
            ['name' => 'Hair Coloring', 'icon' => 'assets/images/ticker-icon.svg'],
            ['name' => 'Shaving', 'icon' => 'assets/images/ticker-icon.svg'],
            ['name' => 'Organic Facial', 'icon' => 'assets/images/ticker-icon.svg'],
            ['name' => 'Eyebrow Shaping', 'icon' => 'assets/images/ticker-icon.svg'],
            ['name' => 'Natural Color', 'icon' => 'assets/images/ticker-icon.svg'],
            ['name' => 'Eyelash Tinting', 'icon' => 'assets/images/ticker-icon.svg'],
            ['name' => 'Hair Highlighter', 'icon' => 'assets/images/ticker-icon.svg'],
        ];

        foreach ($features as $feature) {
            DB::table('features')->insert([
                'name' => $feature['name'],
                'icon' => $feature['icon'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
