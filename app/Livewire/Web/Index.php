<?php

namespace App\Livewire\Web;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $hero = \App\Models\Hero::where('is_active', true)->first();
        $features = \App\Models\Feature::where('is_active', true)->get();
        $why_choose_us = \App\Models\WhyChooseUs::where('is_active', true)->get();
        $fun_facts = \App\Models\FunFact::where('is_active', true)->get();
        $gallery_images = \App\Models\GalleryImage::where('is_active', true)->get();
        $featured_services = \App\Models\Service::where('is_featured', true)->where('is_active', true)->get();
        $pricing_services = \App\Models\Service::where('is_active', true)->get();
        $testimonials = \App\Models\Testimonial::where('status', 'visible')->get();
        $company_info = \App\Models\CompanyInfo::first();
        $services = \App\Models\Service::where('is_active', true)->get(); // For gifts&promotions component

        return view('livewire.web.index', [
            'hero' => $hero,
            'features' => $features,
            'why_choose_us' => $why_choose_us,
            'fun_facts' => $fun_facts,
            'gallery_images' => $gallery_images,
            'featured_services' => $featured_services,
            'pricing_services' => $pricing_services,
            'testimonials' => $testimonials,
            'company_info' => $company_info,
            'services' => $services
        ]);
    }
}
