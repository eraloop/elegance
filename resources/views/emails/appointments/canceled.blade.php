@component('mail::message')
# Appointment Canceled

Hello **{{ $appointment->customer_name }}**,

We're writing to confirm that your appointment has been canceled.

## Canceled Appointment Details

- **Service:** {{ $appointment->service->name ?? 'N/A' }}
- **Date:** {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y') }}
- **Time:** {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}

We're sorry we won't be seeing you this time. If this was unexpected or you'd like to reschedule, please don't hesitate
to reach out.

@component('mail::button', ['url' => route('web.booking')])
Book a New Appointment
@endcomponent

## Need Help?

If you have any questions or concerns, please contact us:

@component('mail::panel')
**Contact Information**
📧 {{ config('mail.from.address') }}
📞 Contact us through our website
@endcomponent

Thanks,<br>
**{{ config('app.name') }}**

---
*We hope to serve you in the future!*
@endcomponent