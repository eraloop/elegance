<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            ServiceSeeder::class,
            TestimonialSeeder::class,
            FAQSeeder::class,
            CompanyInfoSeeder::class,
            HeroSeeder::class,
            FeatureSeeder::class,
            WhyChooseUsSeeder::class,
            FunFactSeeder::class,
            GalleryImageSeeder::class,
            TeamSeeder::class,
            BrandSeeder::class,
            GoalSeeder::class,
            AppointmentSeeder::class,
            ContactSeeder::class,
            ProductSeeder::class,
        ]);

    }
}
