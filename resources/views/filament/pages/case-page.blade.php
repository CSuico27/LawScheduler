<x-filament-panels::page>
    
    <wireui:scripts />
    @livewireScripts
    @livewireStyles
    @vite(['resources/css/custom.css', 'resources/css/app.css', 'resources/js/app.js'])
    
    <livewire:pages.case-page />

    <script>
        window.addEventListener('reload', event => {
            window.location.reload();
        })
        
    </script>
    <x-dialog z-index="z-50" blur="md" align="center" />
    @livewireCalendarScripts
    <script src="{{ asset('lodash-min.js') }}"></script>
    <script src="{{ asset('dropzone-min.js') }}"></script>
</x-filament-panels::page>
