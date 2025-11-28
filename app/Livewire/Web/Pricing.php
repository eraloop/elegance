<?php

namespace App\Livewire\Web;

use Livewire\Component;

class Pricing extends Component
{
    public function render()
    {
        $services = \App\Models\Service::where('is_active', true)->get();
        $testimonials = \App\Models\Testimonial::where('status', 'visible')->get();
        return view('livewire.web.pricing', [
            'services' => $services,
            'testimonials' => $testimonials
        ]);
    }
}
