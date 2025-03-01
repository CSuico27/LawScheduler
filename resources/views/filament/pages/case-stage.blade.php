<x-filament-panels::page>
    @livewireScripts
    @livewireStyles
    <wireui:scripts />
    @vite(['resources/css/custom.css', 'resources/css/app.css', 'resources/js/app.js'])
    
    <livewire:pages.case-stage-page />

    <script>
        window.addEventListener('reload', event => {
            window.location.reload();
        })
        
    </script>
    <x-dialog z-index="z-50" blur="md" align="center" />
    @livewireCalendarScripts
</x-filament-panels::page>
