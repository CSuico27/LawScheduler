<x-mail::message>
# We make you an Zoom Meeting!

Please confirm by clicking the button below.

### Zoom Details:
- **Date:** {{ $date }}

### If you accepted it will send Zoom Meeting Link immediately.

<x-mail::button :url="$url_accept">
    Accept Meeting
</x-mail::button>

<x-mail::button :url="$url_reject">
    Reject Meeting
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
