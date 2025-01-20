<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        @wireUiScripts
        @vite(['resources/css/custom.css', 'resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-[#f1f4f6]">
        <x-notifications />
        @livewire('partials.navbar')
        <main>
            {{ $slot }}
        </main>
        @livewire('partials.footer')
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
              var clipboard = new ClipboardJS('.js-clipboard-example');
          
              clipboard.on('success', function(e) {
                  var btn = e.trigger;
                  var successIcon = btn.querySelector('.js-clipboard-success');
                  var defaultIcon = btn.querySelector('.js-clipboard-default');
                  var tooltipText = btn.querySelector('.js-clipboard-success-text');
                  
                  // Show the success icon and tooltip
                  successIcon.classList.remove('hidden');
                  defaultIcon.classList.add('hidden');
                  tooltipText.textContent = 'Copied!';
                  
                  // Revert back to the default state after a short delay
                  setTimeout(function() {
                      successIcon.classList.add('hidden');
                      defaultIcon.classList.remove('hidden');
                      tooltipText.textContent = 'Copy';
                  }, 2000);
                  
                  e.clearSelection();
              });
          
              clipboard.on('error', function(e) {
                  var btn = e.trigger;
                  var tooltipText = btn.querySelector('.js-clipboard-success-text');
                  
                  tooltipText.textContent = 'Failed to copy!';
                  
                  // Revert back to the default state after a short delay
                  setTimeout(function() {
                      tooltipText.textContent = 'Copy';
                  }, 2000);
              });
          });
          </script>
              <script src="{{ asset('lodash-min.js') }}"></script>
              <script src="{{ asset('dropzone-min.js') }}"></script>
          
        {{-- <script src="https://cdn.jsdelivr.net/npm/preline@2.0.2/dist/preline.min.js"></script> --}}
    </body>
</html>
