<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        @vite(['resources/css/custom.css', 'resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <wireui:scripts />
    </head>
    <body class="bg-[#f1f4f6]">
        <x-notifications />
        @livewire('partials.navbar')
        <main>
            {{ $slot }}
        </main>
        @livewire('partials.footer')
        @livewireScripts
        {{-- <script src="https://cdn.jsdelivr.net/npm/preline@2.0.2/dist/preline.min.js"></script> --}}
    </body>
</html>
