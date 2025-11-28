<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleryImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            'assets/images/photo-1.jpg',
            'assets/images/photo-2.jpg',
            'assets/images/photo-3.jpg',
            'assets/images/photo-4.jpg',
            'assets/images/photo-5.jpg',
            'assets/images/photo-6.jpg',
        ];

        foreach ($images as $image) {
            DB::table('gallery_images')->insert([
                'title' => null,
                'image_path' => $image,
                'category' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
