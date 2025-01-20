<x-filament-panels::page>
    @livewireScripts
    @livewireStyles
    <wireui:scripts />
    @vite(['resources/css/custom.css', 'resources/css/app.css'])

    <livewire:pages.court-type-page />
    
    <x-dialog z-index="z-50" blur="md" align="center" />
    <script>
        window.addEventListener('reload', event => {
            window.location.reload();
        })
    </script>
</x-filament-panels::page>
