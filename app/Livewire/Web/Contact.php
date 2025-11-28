<?php

namespace App\Livewire\Web;

use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $msg; // 'message' is a reserved word in some contexts, but 'msg' matches the form input name in the template (though I'll change it to 'message' in DB)

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'subject' => 'nullable|string|max:255',
        'msg' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();

        \App\Models\Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->msg,
        ]);

        // Send email to admin
        try {
            \Illuminate\Support\Facades\Mail::to(config('mail.from.address'))->send(new \App\Mail\ContactFormSubmitted([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'subject' => $this->subject,
                'msg' => $this->msg,
            ]));
        } catch (\Exception $e) {
            // Log error or handle gracefully
            \Illuminate\Support\Facades\Log::error('Contact form email failed: ' . $e->getMessage());
        }

        session()->flash('message', 'Thank you for contacting us! We will get back to you soon.');
        $this->reset();
    }

    public function render()
    {
        $company_info = \App\Models\CompanyInfo::first();
        return view('livewire.web.contact', [
            'company_info' => $company_info
        ]);
    }
}
