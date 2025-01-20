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
        <button type="button" onclick="$openModal('newMeetingModal')" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
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
                        wire:model="meetingParticipant"
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
    {{-- SHOW FULL DETAILS --}}
    <x-modal blur name="showFullDetailsCalendar" align="center" max-width="xl">
        @if ($meetingFullDetails)
            @foreach ($meetingFullDetails as $detail)
                <x-card title="Meeting Details">
                    <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
                        <div class="col-span-1 sm:col-span-2">
                            <div class="grid grid-cols-1 gap-4">
                                <div class="flex items-center gap-2">
                                    <img src="{{ asset('/images/zoom-logo.webp') }}" alt="zoom" class="w-10 h-10">
                                    <p class="text-2xl font-bold">{{$detail->zoomMeet->topic}}</p>
                                    <span class="inline-flex items-center justify-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">{{$detail->zoomMeet->meeting_id}}</span>
                                </div>
                            </div>
                            <div class="mt-5">
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-blue-600 text-blue-600 dark:text-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($detail->zoomMeet->start_time)->format('F j, Y') }}
                                </span>
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-blue-600 text-blue-600 dark:text-blue-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>                                      
                                    {{ $detail->zoomMeet->duration }}min
                                </span>
                                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-gray-500 text-gray-500 dark:text-neutral-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                                                           
                                    {{ $detail->zoomMeet->password }}
                                </span>
                            </div>
                        </div>
                        <hr>
                        <div class="col-span-1 sm:col-span-2">
                            <div class="grid grid-cols-1 gap-3">
                                <div class="w-full rounded-md dashed-container">
                                    <p class="text-base font-semibold">Participants</p>
                                    <div class="flex gap-2 my-3">
                                        @if ($detail->participantsDetails)
                                            @foreach($detail->participantsDetails as $participant)
                                                <img src="{{ asset($participant->profile_picture) }}" alt="profile" class="w-10 h-10">
                                                <div class="flex flex-col justify-center">
                                                    <p class="font-semibold text-sm">{{$participant->name}}</p>
                                                    <p class="-mt-1 font-light text-xs">{{$participant->email}}</p>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="my-3">
                                        <p class="text-base font-semibold mb-3">Agenda</p>
                                        <p>
                                            {{$detail->zoomMeet->agenda}}
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="my-3">
                                        <p class="text-base font-semibold mb-3">Join Url</p>
                                        <div class="w-full inline-flex gap-x-2">
                                            <input id="hs-clipboard-modal" type="text" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm placeholder:text-gray-400 focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder:text-neutral-500 dark:focus:ring-neutral-600" value="{{$detail->zoomMeet->join_url}}">
                                        
                                            <div class="hs-tooltip inline-block">
                                                <button type="button" id="clipboard-btn" class="js-clipboard-example hs-tooltip-toggle size-[46px] group inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800" data-clipboard-target="#hs-clipboard-modal" data-clipboard-action="copy">
                                                    <svg id="icon-default" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                                                    </svg>
                                                    <svg id="icon-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#287bff" class="size-4 hidden">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>                                                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <x-slot name="footer">
                        <div class="flex justify-end gap-x-4">
                            <div class="flex">
                                <x-button flat label="Close" x-on:click="close" />
                                {{-- <x-button primary label="Save"/> --}}
                            </div>
                        </div>
                    </x-slot>
                </x-card>
            @endforeach
        @endif
    </x-modal>


    
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
        window.addEventListener('showFullDetails', event => {
            $openModal('showFullDetailsCalendar');
        })
        window.addEventListener('reload', event => {
            window.location.reload();
        })
    </script>
</div>