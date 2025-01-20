<x-filament-panels::page>
    @livewireScripts
    <wireui:scripts />
    @vite(['resources/css/custom.css', 'resources/css/app.css'])
    <livewire:pages.appointment-page 
        {{-- :day-click-enabled="true" --}}
        :event-click-enabled="true"
        :drag-and-drop-enabled="true"
        before-calendar-view="components/before"
        drag-and-drop-classes="drag-border-color"
    />
    <x-dialog z-index="z-50" blur="md" align="center" />
    @livewireCalendarScripts
</x-filament-panels::page>
