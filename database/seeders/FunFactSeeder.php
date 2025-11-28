<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FunFactSeeder extends Seeder
{
    public function run(): void
    {
        $facts = [
            [
                'label' => 'Years of Experience',
                'count' => '19',
                'icon' => 'assets/images/counter-1.svg',
            ],
            [
                'label' => 'Company Clients',
                'count' => '200',
                'icon' => 'assets/images/counter-2.svg',
            ],
            [
                'label' => 'Staff Members',
                'count' => '29',
                'icon' => 'assets/images/counter-3.svg',
            ],
        ];

        foreach ($facts as $fact) {
            DB::table('fun_facts')->insert([
                'label' => $fact['label'],
                'count' => $fact['count'],
                'icon' => $fact['icon'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
