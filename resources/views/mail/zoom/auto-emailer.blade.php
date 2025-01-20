<x-mail::message>
# Zoom Meeting Reminder

This is a friendly reminder about your upcoming zoom meeting. Please review the details below:

### Upcoming Meeting Details:
- **Meeting ID:** {{ $meeting_id }}
- **Topic:** {{ $topic }}
- **Date:** {{ $start_time }}

We look forward to seeing you. If you have any questions, please contact us in advance.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
