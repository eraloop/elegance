<?php

namespace App\Livewire\Web;

use Livewire\Component;

class Testimonials extends Component
{
    public function render()
    {
        $testimonials = \App\Models\Testimonial::where('status', 'visible')->get();
        return view('livewire.web.testimonials', [
            'testimonials' => $testimonials
        ]);
    }
}
