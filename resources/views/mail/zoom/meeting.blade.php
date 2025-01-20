<x-mail::message>
# We created a zoom meeting!

Your zoom meeting date is: {{ $date }}.

<x-mail::button :url="$meeting_url">
    Join
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
