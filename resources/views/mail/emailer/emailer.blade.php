<x-mail::message>
# Appointment Reminder

This is a friendly reminder about your upcoming appointment. Please review the details below:

### Appointment Details:
- **Title:** {{ $title }}
- **Date:** {{ $date }}
- **Time:** {{ $time }}

We look forward to seeing you. If you have any questions or need to reschedule, please contact us in advance.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
