<x-mail::message>
# You booked your appointment succesfully!

Thank you for your appointment. Your appoitnemnt number is: {{ $id }}.

### Appointment Details:
- **Date:** {{ $date }}
- **Time:** {{ $time }}

### Requirements for the appointment:
@foreach (explode(',', $requirements) as $requirement)
- {{ trim($requirement) }}
@endforeach

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
