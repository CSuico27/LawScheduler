<div class="flex justify-center items-center pt-28">
    <div class="bg-gray-100 max-w-[80%]">
        <livewire:client.components.calendar
            {{-- :day-click-enabled="true" --}}
            :event-click-enabled="true"
            :drag-and-drop-enabled="true"
            before-calendar-view="livewire/client/components/before"
            drag-and-drop-classes="drag-border-color" 
        />
    </div>
</div>