<?php

namespace App\Livewire\Admin\Appointments;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class ManageAppointments extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';
    public $isOpen = false;
    public $selectedAppointment;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $query = Appointment::with('service')->latest();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('customer_name', 'like', '%' . $this->search . '%')
                    ->orWhere('customer_email', 'like', '%' . $this->search . '%')
                    ->orWhere('customer_phone', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        return view('livewire.admin.appointments.manage-appointments', [
            'appointments' => $query->paginate(10)
        ]);
    }

    public function viewDetails($id)
    {
        $this->selectedAppointment = Appointment::with('service')->findOrFail($id);
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->selectedAppointment = null;
    }

    public function isValidTransition($newStatus)
    {
        if (!$this->selectedAppointment) {
            return false;
        }

        $currentStatus = $this->selectedAppointment->status;

        // If same status, it's technically "valid" but not useful
        if ($currentStatus === $newStatus) {
            return false;
        }

        // Define invalid transitions
        $invalidTransitions = [
            'completed' => ['canceled', 'pending'],
            'canceled' => ['completed'],
        ];

        // Check if this transition is invalid
        if (
            isset($invalidTransitions[$currentStatus]) &&
            in_array($newStatus, $invalidTransitions[$currentStatus])
        ) {
            return false;
        }

        return true;
    }

    public function updateStatus($status)
    {
        if ($this->selectedAppointment) {
            // Validate status transition
            $currentStatus = $this->selectedAppointment->status;

            // Define invalid transitions
            $invalidTransitions = [
                'completed' => ['canceled', 'pending'],  // Can't go from completed to canceled/pending
                'canceled' => ['completed'],              // Can't go from canceled to completed
            ];

            // Check if this transition is invalid
            if (
                isset($invalidTransitions[$currentStatus]) &&
                in_array($status, $invalidTransitions[$currentStatus])
            ) {
                session()->flash('error', 'Invalid status transition: Cannot change from ' . ucfirst($currentStatus) . ' to ' . ucfirst($status) . '.');
                return;
            }

            // Update the status
            $this->selectedAppointment->update(['status' => $status]);

            // Send email notifications and log to contacts
            if ($this->selectedAppointment->customer_email) {
                try {
                    $emailSent = false;
                    $emailType = '';

                    switch ($status) {
                        case 'confirmed':
                            \Mail::to($this->selectedAppointment->customer_email)
                                ->send(new \App\Mail\AppointmentConfirmed($this->selectedAppointment));
                            $emailSent = true;
                            $emailType = 'Appointment Confirmation';
                            break;

                        case 'completed':
                            \Mail::to($this->selectedAppointment->customer_email)
                                ->send(new \App\Mail\AppointmentCompleted($this->selectedAppointment));
                            $emailSent = true;
                            $emailType = 'Appointment Completion & Review Request';
                            break;

                        case 'canceled':
                            \Mail::to($this->selectedAppointment->customer_email)
                                ->send(new \App\Mail\AppointmentCanceled($this->selectedAppointment));
                            $emailSent = true;
                            $emailType = 'Appointment Cancellation';
                            break;
                    }

                    // Log email to contacts
                    if ($emailSent) {
                        \App\Models\Contact::create([
                            'name' => $this->selectedAppointment->customer_name,
                            'email' => $this->selectedAppointment->customer_email,
                            'phone' => $this->selectedAppointment->customer_phone ?? '',
                            'subject' => $emailType . ' - Appointment ID #' . $this->selectedAppointment->id,
                            'message' => 'Automated email sent: ' . $emailType . ' for appointment on ' .
                                $this->selectedAppointment->appointment_date . ' at ' .
                                $this->selectedAppointment->appointment_time,
                            'is_read' => true, // Mark as read since it's system-generated
                        ]);
                    }

                    session()->flash('success', 'Appointment status updated to ' . ucfirst($status) . ' and email sent to customer.');
                } catch (\Exception $e) {
                    \Log::error('Failed to send appointment email: ' . $e->getMessage());
                    session()->flash('warning', 'Appointment status updated to ' . ucfirst($status) . ' but email failed to send.');
                }
            } else {
                session()->flash('success', 'Appointment status updated to ' . ucfirst($status) . ' (No email address provided).');
            }

            $this->selectedAppointment->refresh();
        }
    }
}
