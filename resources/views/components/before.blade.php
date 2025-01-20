<div class="container dashed-container md:flex block">
    <div class="container">
        <div class="container md:justify-start justify-center">
            <button wire:click="goToPreviousMonth" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-3">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                </svg>
                <span class="sr-only">Icon description</span>
            </button>
            <h1 class="header-text md:text-[24px] text-base">{{ $endsAt->format('F, Y') }}</h1>
            <button wire:click="goToNextMonth" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-3">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
                <span class="sr-only">Icon description</span>
            </button>
            <button wire:click="goToCurrentMonth" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ml-1">Current Month</button>
        </div>
    </div>
    <div class="w-full flex md:justify-end md:mt-0 items-center justify-center mt-3 gap-2">
        
        
        <button type="button" onclick="$openModal('newMeetingModal')" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:bg-blue-100 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:bg-blue-800/30 dark:hover:text-blue-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
            </svg>              
            Create Meeting
        </button>
        <button type="button" wire:loading.attr="disabled" wire:loading.class="!cursor-wait" onclick="$openModal('cardModal')" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            New Appointment
        </button>
    </div>

    <x-modal.card title="New Meeting" blur wire:model.defer="newMeetingModal" align="center" max-width="md">
        <form >
            <div class="grid grid-cols-12 sm:grid-cols-1 gap-4">
                <div class="col-span-1 sm:col-span-2 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mt-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                    </svg>
                    <div class="w-full">
                        <x-input label="Subject" placeholder="Ex: Meeting with client" wire:model="meetingTopic" />
                    </div>
                </div>
                <div class="col-span-1 sm:col-span-2 flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mt-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>                      
                    <x-select
                        label="Participant"
                        wire:model.blur="meetingParticipant"
                        placeholder="Ex: Dela Cruz, Juan"
                        :async-data="route('api.user.participant')"
                        :template="[
                            'name'   => 'user-option',
                            'config' => [
                                'src' => 'profile_picture'
                            ]
                        ]"
                        option-label="name"
                        option-value="id"
                        option-description="email"
                    />
                </div>
                <div class="col-span-1 sm:col-span-2 flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mt-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                    </svg>
                      
                    <x-datetime-picker
                        label="Appointment Date"
                        placeholder="Appointment Date"
                        wire:model="meetingStartDate"
                        without-time="false"
                        parse-format="YYYY-MM-DD"
                        display-format="YYYY-MM-DD"
                    />
                    
                </div>
                <div class="col-span-1 sm:col-span-2 flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mt-5 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <div class="flex gap-3">
                        <x-time-picker
                            label="From"
                            placeholder="12:00 AM"
                            interval="60"
                            wire:model.defer="meetingDurationFrom"
                        />
                        <x-time-picker
                            label="To"
                            placeholder="12:00 AM"
                            interval="60"
                            wire:model.defer="meetingDurationTo"
                        />
                    </div>
                    
                </div>
                <div class="col-span-1 sm:col-span-2 flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 -mt-10 mr-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <div class="w-full">
                        <x-textarea label="Details" placeholder="Write a meeting details" wire:model="meetingDescription" />
                    </div>
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" wire:click="createMeeting" />
                    </div>
                </div>
            </x-slot>
        </form>
    </x-modal.card>

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
                    <x-input label="Title" placeholder="Appointment Title" wire:model="editTitle" />
                </div>
                <div class="col-span-1 sm:col-span-2">
                    <x-textarea label="Description" placeholder="write appointment desctiption" wire:model="editDescription" />
                </div>
                <div class="col-span-1 sm:col-span-2">
                    <x-toggle lg wire:model="isActive" left-label="Is Active" />
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-between gap-x-4">
                    <x-button flat negative label="Delete" wire:click="deleteConfirmation({{ $eventID }}, '{{ $editTitle }}')" />
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