<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                "question" => "What services do you offer?",
                "answer" => "We offer a wide range of beauty and grooming services, including haircuts, styling, makeup, massages, skin care, and more.",
                "status" => "visible",
                "order" => 1
            ],
            [
                "question" => "How can I book an appointment?",
                "answer" => "You can book an appointment directly through our website or by calling our customer service team. We also offer walk-in services depending on availability.",
                "status" => "visible",
                "order" => 2
            ],
            [
                "question" => "Do you offer bridal packages?",
                "answer" => "Yes, we offer customized bridal packages that include makeup, hairstyling, and other services to ensure you're ready for your big day.",
                "status" => "visible",
                "order" => 3
            ],
            [
                "question" => "What are your business hours?",
                "answer" => "We are open Monday to Saturday from 9:00 AM to 6:00 PM. We are closed on Sundays.",
                "status" => "visible",
                "order" => 4
            ],
            [
                "question" => "Can I reschedule my appointment?",
                "answer" => "Yes, you can reschedule your appointment by contacting us at least 24 hours in advance to avoid any cancellation fees.",
                "status" => "visible",
                "order" => 5
            ],
            [
                "question" => "Do you offer gift cards?",
                "answer" => "Yes, we offer gift cards that can be used for any of our services. They are available for purchase at the salon or on our website.",
                "status" => "visible",
                "order" => 6
            ],
            [
                "question" => "Are your products cruelty-free?",
                "answer" => "Yes, all of our beauty products are cruelty-free, and we prioritize using products that are ethically sourced.",
                "status" => "visible",
                "order" => 7
            ],
            [
                "question" => "What forms of payment do you accept?",
                "answer" => "We accept various forms of payment, including credit/debit cards, cash, and mobile payment options such as Apple Pay and Google Pay.",
                "status" => "visible",
                "order" => 8
            ],
            [
                "question" => "Do you have parking available?",
                "answer" => "Yes, we have free parking available for our customers at the back of the building.",
                "status" => "visible",
                "order" => 9
            ],
            [
                "question" => "Can I bring my children to my appointment?",
                "answer" => "Yes, children are welcome, but please let us know in advance if you plan to bring them so we can accommodate you properly.",
                "status" => "visible",
                "order" => 10
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
