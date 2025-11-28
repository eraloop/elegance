<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\CompanyInfo::create([
            'name' => 'Elegance',
            'email' => 'info@elegancebeauty.com',
            'phone' => '(+237) 674 443 177',
            'address' => 'Elegance, Ub Junction, Buea, Cameroon',
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'twitter' => 'https://twitter.com',
            'linkedin' => 'https://linkedin.com',
            'about_us' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy',
            'about_title' => 'About Elegance',
            'about_subtitle' => 'Luxury Salon Where You Will Feel Unique',
            'about_image' => 'assets/images/about-img-1.jpg',
            'about_image_2' => 'assets/images/about-img-2.jpg',
            'founded_year' => '1998',
            'about_points' => [
                'The hair cutting and styling with 10 years of experience.',
                'Update the latest technology and tendency in the world.',
                'Using the best products from the top providers.'
            ],
            'working_hours' => "Mon-Fri: 10:00 AM - 9:00 PM \nSaturday: 10:00 AM - 7:00 PM \nSunday: 10:00 PM - 7:00 PM",
            'video_url' => 'https://www.youtube.com/watch?v=2JNMGesMC2Y',
            'video_image' => 'assets/images/video-image.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
