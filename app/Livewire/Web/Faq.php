<?php

namespace App\Livewire\Web;

use Livewire\Component;

class Faq extends Component
{
    public function render()
    {
        $faqs = \App\Models\FAQ::where('status', 'visible')->orderBy('order')->get();
        return view('livewire.web.faq', [
            'faqs' => $faqs
        ]);
    }
}
