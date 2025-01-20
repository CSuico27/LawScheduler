<div>
    @livewireScripts
    @livewireStyles
    <wireui:scripts />
    @vite(['resources/css/custom.css', 'resources/css/app.css', 'resources/js/app.js'])
    <script>
        window.addEventListener('reload', event => {
            window.location.reload();
        })
    </script>
    <x-dialog z-index="z-50" blur="md" align="center" />
    @livewireCalendarScripts
</div>