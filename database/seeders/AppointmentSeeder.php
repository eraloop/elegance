<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Service;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $services = Service::all();

        if ($services->isEmpty()) {
            $this->command->warn('No services found. Please run ServiceSeeder first.');
            return;
        }

        $appointments = [
            [
                'service_id' => $services->random()->id,
                'customer_name' => 'Sarah Johnson',
                'customer_email' => 'sarah.j@example.com',
                'customer_phone' => '555-0101',
                'appointment_date' => now()->addDays(3),
                'appointment_time' => '10:00:00',
                'notes' => 'First time customer, prefers morning appointments',
                'status' => 'pending',
                'price' => 85.00,
            ],
            [
                'service_id' => $services->random()->id,
                'customer_name' => 'Michael Chen',
                'customer_email' => 'mchen@example.com',
                'customer_phone' => '555-0102',
                'appointment_date' => now()->addDays(5),
                'appointment_time' => '14:30:00',
                'notes' => 'Regular customer',
                'status' => 'confirmed',
                'price' => 120.00,
            ],
            [
                'service_id' => $services->random()->id,
                'customer_name' => 'Emily Rodriguez',
                'customer_email' => 'emily.r@example.com',
                'customer_phone' => '555-0103',
                'appointment_date' => now()->addDays(1),
                'appointment_time' => '16:00:00',
                'notes' => 'Allergic to certain products, please check',
                'status' => 'confirmed',
                'price' => 95.00,
            ],
            [
                'service_id' => $services->random()->id,
                'customer_name' => 'David Thompson',
                'customer_email' => 'dthompson@example.com',
                'customer_phone' => '555-0104',
                'appointment_date' => now()->subDays(2),
                'appointment_time' => '11:00:00',
                'notes' => 'Completed appointment',
                'status' => 'completed',
                'price' => 75.00,
            ],
            [
                'service_id' => $services->random()->id,
                'customer_name' => 'Lisa Anderson',
                'customer_email' => 'lisa.a@example.com',
                'customer_phone' => '555-0105',
                'appointment_date' => now()->subDays(5),
                'appointment_time' => '13:00:00',
                'notes' => 'Customer cancelled',
                'status' => 'canceled',
                'price' => 100.00,
            ],
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }

        $this->command->info('Appointments seeded successfully!');
    }
}
