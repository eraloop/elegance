@component('mail::message')
# Thank You for Visiting Us!

Hello **{{ $appointment->customer_name }}**,

Thank you for choosing {{ config('app.name') }}! We hope you enjoyed your
**{{ $appointment->service->name ?? 'service' }}**.

## Your Visit

- **Date:** {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y') }}
- **Service:** {{ $appointment->service->name ?? 'N/A' }}

We'd love to hear about your experience! Your feedback helps us improve and serve you better.

@component('mail::button', ['url' => $reviewUrl])
Leave a Review
@endcomponent

### Share Your Experience

Your testimonial could help others discover our services. Click the button above to share your thoughts!

---

## Book Your Next Appointment

Ready for your next visit?

@component('mail::button', ['url' => route('web.booking')])
Book Now
@endcomponent

Thanks,<br>
**{{ config('app.name') }}**

---
*We appreciate your business and look forward to seeing you again!*
@endcomponent