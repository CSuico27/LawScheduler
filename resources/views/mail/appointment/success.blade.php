<x-mail::message>
# Appointment Placed Successfully!

Thank you for your appointment. Your appoitnemnt number is: {{ $appointment->id }}.

<x-mail::button :url="$url">
    View Appointment
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
