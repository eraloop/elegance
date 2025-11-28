<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [
            [
                'name' => 'Jennifer Martinez',
                'email' => 'jennifer.m@example.com',
                'phone' => '555-0201',
                'subject' => 'Question about services',
                'message' => 'Hi, I would like to know more about your hair coloring services. Do you use organic products?',
                'is_read' => false,
            ],
            [
                'name' => 'Robert Lee',
                'email' => 'robert.lee@example.com',
                'phone' => '555-0202',
                'subject' => 'Booking inquiry',
                'message' => 'I am interested in booking a haircut for next week. What are your available time slots?',
                'is_read' => true,
            ],
            [
                'name' => 'Amanda White',
                'email' => 'amanda.w@example.com',
                'phone' => '555-0203',
                'subject' => 'Feedback',
                'message' => 'I had an amazing experience at your salon last week! The staff was very professional and friendly. Thank you!',
                'is_read' => true,
            ],
            [
                'name' => 'Kevin Brown',
                'email' => 'kevin.b@example.com',
                'phone' => '555-0204',
                'subject' => 'Gift card inquiry',
                'message' => 'Do you offer gift cards? I would like to purchase one for my wife\'s birthday.',
                'is_read' => false,
            ],
            [
                'name' => 'Michelle Davis',
                'email' => 'michelle.d@example.com',
                'phone' => '555-0205',
                'subject' => 'Special event booking',
                'message' => 'I am getting married in 3 months and would like to book hair and makeup services for my bridal party of 6 people. Can you accommodate this?',
                'is_read' => false,
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }

        $this->command->info('Contacts seeded successfully!');
    }
}
