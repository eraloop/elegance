<?php

namespace App\Livewire\Web;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $goals = \App\Models\Goal::where('is_active', true)->get();
        $teams = \App\Models\Team::where('is_active', true)->get();
        $brands = \App\Models\Brand::where('is_active', true)->get();
        $company_info = \App\Models\CompanyInfo::first();
        $fun_facts = \App\Models\FunFact::where('is_active', true)->get();

        return view('livewire.web.about', [
            'goals' => $goals,
            'teams' => $teams,
            'brands' => $brands,
            'company_info' => $company_info,
            'fun_facts' => $fun_facts
        ]);
    }
}
