<x-filament-panels::page>
    @livewireScripts
    @livewireStyles
    <wireui:scripts />
    @vite(['resources/css/custom.css', 'resources/css/app.css', 'resources/js/app.js'])
    <div class="border-b border-gray-200 dark:border-neutral-700">
        <nav class="flex space-x-1" aria-label="Tabs" role="tablist">
          <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-1 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500 active" id="tabs-with-icons-item-1" data-hs-tab="#tabs-with-icons-1" aria-controls="tabs-with-icons-1" role="tab">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
            </svg>
            Calendar
          </button>
          <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-5 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500" id="tabs-with-icons-item-2" data-hs-tab="#tabs-with-icons-2" aria-controls="tabs-with-icons-2" role="tab">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
            </svg>              
            Zoom Meeting
          </button>
          <button type="button" class="hs-tab-active:font-semibold hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 py-4 px-5 inline-flex items-center gap-x-2 border-b-2 border-transparent text-sm whitespace-nowrap text-gray-500 hover:text-blue-600 focus:outline-none focus:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-blue-500" id="tabs-with-icons-item-3" data-hs-tab="#tabs-with-icons-3" aria-controls="tabs-with-icons-3" role="tab">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
            </svg>              
            Appointments
          </button>
        </nav>
      </div>
      
      <div class="mt-3">
        <div id="tabs-with-icons-1" role="tabpanel" aria-labelledby="tabs-with-icons-item-1">
            <livewire:pages.appointment-page 
                {{-- :day-click-enabled="true" --}}
                :event-click-enabled="true"
                :drag-and-drop-enabled="true"
                before-calendar-view="components/before"
                drag-and-drop-classes="drag-border-color" 
            />
        </div>
        <div id="tabs-with-icons-2" class="hidden" role="tabpanel" aria-labelledby="tabs-with-icons-item-2">
            <livewire:pages.schedule-list />
        </div>
        <div id="tabs-with-icons-3" class="hidden" role="tabpanel" aria-labelledby="tabs-with-icons-item-3">
            <livewire:pages.appointment-list />
        </div>
    </div>
    <script>
      window.addEventListener('reload', event => {
          window.location.reload();
      })
    </script>
    <x-dialog z-index="z-50" blur="md" align="center" />
    @livewireCalendarScripts
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
