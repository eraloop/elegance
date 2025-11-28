<?php

namespace App\Livewire\Web;

use Livewire\Component;

class ServiceDetail extends Component
{
    public $service;
    public $slug; // Added to hold the slug from the route

    public function mount($slug)
    {
        // The service fetching logic is moved to render,
        // but we still need to capture the slug from the route.
        $this->slug = $slug;
    }

    public function render()
    {
        $service = \App\Models\Service::where('slug', $this->slug)->firstOrFail();
        $categories = \App\Models\Category::where('is_active', true)->get();
        $faqs = \App\Models\Faq::where('status', 'visible')->get();
        $company_info = \App\Models\CompanyInfo::first();

        return view('livewire.web.service-detail', [
            'service' => $service,
            'categories' => $categories,
            'faqs' => $faqs,
            'company_info' => $company_info
        ]);
    }
}
