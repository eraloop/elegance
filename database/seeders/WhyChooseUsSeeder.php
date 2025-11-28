<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WhyChooseUsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Certified Stylists',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.',
                'icon' => 'assets/images/whyus-1.svg',
            ],
            [
                'title' => '100% Organic Cosmetics',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore.',
                'icon' => 'assets/images/whyus-2.svg',
            ],
        ];

        foreach ($items as $item) {
            DB::table('why_choose_us')->insert([
                'title' => $item['title'],
                'description' => $item['description'],
                'icon' => $item['icon'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
