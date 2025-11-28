<?php

namespace App\Livewire\Web;

use Livewire\Component;

class Booking extends Component
{
    public $step = 1;
    public $service_id;
    public $date;
    public $time;
    public $name;
    public $email;
    public $phone;
    public $notes;

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }

    public function validateStep()
    {
        if ($this->step == 1) {
            $this->validate([
                'service_id' => 'required|exists:services,id',
            ]);
        } elseif ($this->step == 2) {
            $this->validate([
                'date' => 'required|date|after_or_equal:today',
                'time' => 'required',
            ]);
        } elseif ($this->step == 3) {
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'required|string|max:20',
            ]);
        }
    }

    public function submit()
    {
        $this->validateStep();

        try {
            $service = \App\Models\Service::find($this->service_id);

            $appointment = \App\Models\Appointment::create([
                'service_id' => $this->service_id,
                'customer_name' => $this->name,
                'customer_email' => $this->email,
                'customer_phone' => $this->phone,
                'appointment_date' => $this->date,
                'appointment_time' => $this->time,
                'notes' => $this->notes,
                'price' => $service->price_min ?? 0,
                'status' => 'pending',
            ]);

            \Illuminate\Support\Facades\Log::info('Appointment created successfully', [
                'appointment_id' => $appointment->id,
                'customer_name' => $this->name,
                'service' => $service->name
            ]);

            try {
                \Illuminate\Support\Facades\Mail::to(config('mail.from.address'))->send(new \App\Mail\AppointmentRequested([
                    'service_name' => $service->name,
                    'date' => $this->date,
                    'time' => $this->time,
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'notes' => $this->notes,
                ]));

                \Illuminate\Support\Facades\Log::info('Appointment email sent successfully', [
                    'appointment_id' => $appointment->id
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Appointment email failed: ' . $e->getMessage(), [
                    'appointment_id' => $appointment->id
                ]);
            }

            $this->step++;

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Appointment creation failed: ' . $e->getMessage(), [
                'customer_name' => $this->name,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            session()->flash('error', 'Failed to create appointment. Please try again.');
            throw $e;
        }
    }

    public function render()
    {
        $services = \App\Models\Service::where('is_active', true)->get();
        $company_info = \App\Models\CompanyInfo::first();
        return view('livewire.web.booking', [
            'services' => $services,
            'company_info' => $company_info
        ]);
    }
}
