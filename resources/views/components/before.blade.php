<div class="container dashed-container">
    <div class="container">
        <div class="container">
            <button wire:click="goToPreviousMonth" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-3">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                </svg>
                <span class="sr-only">Icon description</span>
            </button>
            <h1 class="header-text">{{ $endsAt->format('F, Y') }}</h1>
            <button wire:click="goToNextMonth" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-3">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
                <span class="sr-only">Icon description</span>
            </button>
            <button wire:click="goToCurrentMonth" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-1">Current Month</button>
        </div>
    </div>
    <div class="w-full flex justify-end items-center">
        <button type="button" wire:loading.attr="disabled" wire:loading.class="!cursor-wait" onclick="$openModal('cardModal')" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            New Appointment
        </button>
    </div>

    <x-modal.card title="Add New Appointment" blur wire:model.defer="cardModal" align="center">
        <form >
            <div class="grid grid-cols-12 sm:grid-cols-1 gap-4">
                <div class="col-span-1 sm:col-span-2">
                    <x-input label="Title" placeholder="Appointment Title" wire:model="title" />
                </div>
                <div class="col-span-1 sm:col-span-2">
                    <x-textarea label="Description" placeholder="write appointment desctiption" wire:model="description" />
                </div>
                <div class="col-span-1 sm:col-span-2">
                    <x-datetime-picker
                        label="Appointment Date"
                        placeholder="Appointment Date"
                        wire:model.defer="date"
                        without-time="true"
                        without-tips="true"
                        parse-format="YYYY-MM-DD"
                        display-format="YYYY-MM-DD"
                    />
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" wire:click="newEvent" />
                    </div>
                </div>
            </x-slot>
        </form>
    </x-modal.card>

    <x-modal.card title="Edit Appointment" blur wire:model.defer="editModal" align="center">
        <form >
            <div class="grid grid-cols-12 sm:grid-cols-1 gap-4">
                <div class="col-span-1 sm:col-span-2">
                    <x-input label="Title" placeholder="Appointment Title" wire:model="title" />
                </div>
                <div class="col-span-1 sm:col-span-2">
                    <x-textarea label="Description" placeholder="write appointment desctiption" wire:model="description" />
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-between gap-x-4">
                    <x-button flat negative label="Delete" wire:click="deleteConfirmation({{ $eventID }}, '{{ $title }}')" />
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" wire:click="editEvent({{ $eventID }})" />
                    </div>
                </div>
            </x-slot>
        </form>
    </x-modal.card>
    
    <script>
        window.addEventListener('editEvent', event => {
            $openModal('editModal');
        })
        window.addEventListener('reload', event => {
            window.location.reload();
        })
    </script>
</div>