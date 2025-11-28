@component('mail::message')
# Appointment Confirmed

Hello **{{ $appointment->customer_name }}**,

Great news! Your appointment has been confirmed.

## Appointment Details

- **Service:** {{ $appointment->service->name ?? 'N/A' }}
- **Date:** {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y') }}
- **Time:** {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
@if($appointment->duration)
    - **Duration:** {{ $appointment->duration }} minutes
@endif
- **Price:** ${{ number_format($appointment->price, 2) }}

@if($appointment->notes)
    **Special Notes:**
    {{ $appointment->notes }}
@endif

We look forward to seeing you!

@component('mail::button', ['url' => route('web.booking')])
View Our Services
@endcomponent

Thanks,<br>
**{{ config('app.name') }}**

---
*If you need to reschedule or cancel, please contact us as soon as possible.*
@endcomponent