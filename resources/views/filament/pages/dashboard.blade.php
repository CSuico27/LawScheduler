<x-filament-panels::page>
    @livewireScripts
    @livewireStyles
    <wireui:scripts />
    @vite(['resources/css/custom.css', 'resources/css/app.css', 'resources/js/app.js'])

    <livewire:pages.dashboard />
    
    <x-dialog z-index="z-50" blur="md" align="center" />
    <script>
        window.addEventListener('reload', event => {
            window.location.reload();
        })
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var clipboard = new ClipboardJS('.js-clipboard-example');
        var clipboardBtn = document.getElementById('clipboard-btn');
    
        clipboard.on('success', function(e) {
            var iconDefault = document.getElementById('icon-default');
            var iconSuccess = document.getElementById('icon-success');
            
            if (iconDefault && iconSuccess) {
                iconDefault.classList.add('hidden');
                iconSuccess.classList.remove('hidden');
    
                setTimeout(function() {
                    iconDefault.classList.remove('hidden');
                    iconSuccess.classList.add('hidden');
                }, 2000); // Reset icon after 2 seconds
            }
        });
    
        clipboard.on('error', function(e) {
            console.error('Failed to copy text', e);
        });
    });
    </script>
</x-filament-panels::page>
