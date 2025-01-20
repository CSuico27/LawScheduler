<x-mail::message>
# Case Reminder

This is a friendly reminder about your upcoming case. Please review the details below:

### Upcoming Case Details:
- **NPS Docket No:** {{ $nps_docket_no }}
- **Date:** {{ $date }}
- **Case Stage:** {{ $case_stage }}

We look forward to seeing you. If you have any questions, please contact us in advance.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
