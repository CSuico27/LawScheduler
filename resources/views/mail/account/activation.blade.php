<x-mail::message>
# Account Activation

Dear {{ $client->name }},

An account has been created for you. Please click the button below to activate your account and set your password:

<x-mail::button :url="$url">
Activate Account
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
