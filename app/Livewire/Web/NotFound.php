<?php

namespace App\Livewire\Web;

use Livewire\Component;

class NotFound extends Component
{
    public function render()
    {
        $company_info = \App\Models\CompanyInfo::first();
        return view('livewire.web.not-found', [
            'company_info' => $company_info
        ]);
    }
}
