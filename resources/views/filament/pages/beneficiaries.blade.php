<x-filament-panels::page>
    @livewireScripts
    <wireui:scripts />
    @vite(['resources/css/custom.css', 'resources/css/app.css'])

    <livewire:pages.beneficiary-page />
    
    <x-dialog z-index="z-50" blur="md" align="center" />
</x-filament-panels::page>
