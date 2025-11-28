<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Brand::create([
            'name' => 'Brand 1',
            'image' => 'assets/images/brand-1.png',
            'is_active' => true,
        ]);

        \App\Models\Brand::create([
            'name' => 'Brand 2',
            'image' => 'assets/images/brand-2.png',
            'is_active' => true,
        ]);

        \App\Models\Brand::create([
            'name' => 'Brand 3',
            'image' => 'assets/images/brand-3.png',
            'is_active' => true,
        ]);

        \App\Models\Brand::create([
            'name' => 'Brand 4',
            'image' => 'assets/images/brand-4.png',
            'is_active' => true,
        ]);
    }
}
