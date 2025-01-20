<x-mail::message>
# We booked you an appointment!

Please confirm by clicking the button below.

### Appointment Details:
- **Date:** {{ $date }}
- **Time:** {{ $time }}

### Requirements for the appointment:
@foreach (explode(',', $requirements) as $requirement)
- {{ trim($requirement) }}
@endforeach

<x-mail::button :url="$url_accept">
    Accept Appointment
</x-mail::button>

<x-mail::button :url="$url_reject">
    Reject Appointment
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
