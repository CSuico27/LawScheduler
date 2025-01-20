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
        <div class="inline-flex">
            <button type="button" class="relative py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-s-md border bg-[#4285F4] text-white focus:outline-none disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                Add New Appointment
            </button>
            <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                <button id="hs-split-dropup" type="button" class="hs-dropdown-toggle relative -ms-[.3125rem] py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-e-md border bg-[#4285F4] text-white focus:outline-none disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:hover:text-white dark:focus:bg-neutral-700 dark:focus:text-white" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                    <span class="sr-only">Toggle Dropdown</span>
                    <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m18 15-6-6-6 6"></path>
                    </svg>
                </button>
            
                <div class="hs-dropdown-menu w-72 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden z-10 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-split-dropup">
                    <button type="button" onclick="$openModal('newMeetingModal')" class="w-full py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-blue-600 hover:bg-blue-100 focus:outline-none focus:bg-blue-100 hover:text-blue-800 focus:outline-none focus:bg-blue-100 focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:bg-blue-800/30 dark:hover:text-blue-400 dark:focus:bg-blue-800/30 dark:focus:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg> 
                        New Meeting
                    </button>
                    <button type="button" onclick="$openModal('cardModal')" class="w-full py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-blue-600 hover:bg-blue-100 focus:outline-none focus:bg-blue-100 hover:text-blue-800 focus:outline-none focus:bg-blue-100 focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:bg-blue-800/30 dark:hover:text-blue-400 dark:focus:bg-blue-800/30 dark:focus:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        New Appointment
                    </button>
                    {{-- <button type="button" onclick="$openModal('newMeetingModal')" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>               
                        Create Meeting
                    </button>
                    <button type="button" wire:loading.attr="disabled" wire:loading.class="!cursor-wait" onclick="$openModal('cardModal')" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        New Appointment
                    </button> --}}
                </div>
            </div>
        </div>
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
                @if ($detail->zoomMeet)
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
                @else
                    <x-card title="Meeting Details">
                        <div class="grid grid-cols-1 sm:grid-cols-1 gap-4">
                            <div class="col-span-1 sm:col-span-2">
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="flex items-center gap-2">
                                        <div class="bg-blue-800 p-3 rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                                            </svg>
                                        </div>
                                        <p class="text-2xl font-bold">{{$detail->appointmentDetails->title}}</p>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-blue-600 text-blue-600 dark:text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($detail->date)->format('F j, Y') }}
                                    </span>
                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-blue-600 text-blue-600 dark:text-blue-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>                                      
                                        {{ \Carbon\Carbon::parse($detail->appointmentDetails->time)->format('h:i A') }}
                                    </span>
                                    <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium border border-gray-500 text-gray-500 dark:text-neutral-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        <div class="flex flex-col">
                                            @if ($detail->participantsDetails)
                                                @foreach ($detail->participantsDetails as $participant)
                                                    <span class="font-semibold">{{ $participant->name }}</span>
                                                    <span class="italic text-xs text-blue-400">{{ $participant->email }}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </span>
                                </div>

                                <div class="mt-5 border border-dashed border-gray-800 rounded-xl">
                                    <div class="grid grid-cols-2 w-full h-auto m-3">
                                       <div class="flex items-center gap-3">
                                            <span>Payment Method: </span>
                                            @if ($detail->appointmentDetails->orders)
                                                @if ($detail->appointmentDetails->orders->payment_method == 'Cash')
                                                    <div>
                                                        <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full dark:bg-blue-500/10 dark:text-blue-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                                            </svg> 
                                                        Cash
                                                        </span>
                                                    </div>
                                                @else
                                                    <div>
                                                        <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                                        </svg>
                                                              
                                                        Stripe
                                                        </span>
                                                    </div>
                                                @endif
                                            @endif
                                       </div>
                                       <div class="flex items-center gap-3">
                                            <span>Payment Status: </span>
                                            @if ($detail->appointmentDetails->orders)
                                                @if ($detail->appointmentDetails->orders->payment_status == 'Paid')
                                                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-green-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                                        <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                                                        <path d="m9 12 2 2 4-4"></path>
                                                        </svg>
                                                        {{ $detail->appointmentDetails->orders->payment_status }}
                                                    </span>
                                                @else
                                                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>                                          
                                                        {{ $detail->appointmentDetails->orders->payment_status }}
                                                    </span>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-3 mt-2">
                                            <span>Request Status: </span>
                                            @if ($detail->appointmentDetails->orders)
                                                @if ($detail->appointmentDetails->orders->status == 'Claimed')
                                                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs capitalize font-medium bg-green-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                                        <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                                                        <path d="m9 12 2 2 4-4"></path>
                                                        </svg>
                                                        {{ $detail->appointmentDetails->orders->status }}
                                                    </span>
                                                @else
                                                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs capitalize font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>                                          
                                                        {{ $detail->appointmentDetails->orders->status }}
                                                    </span>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex gap-3 m-3 border-t border-dashed border-gray-500">
                                        <span class="mt-2">Request/s: </span>
                                        @if ($detail->appointmentDetails->orders->services)
                                            <div class="flex flex-col">
                                                @foreach($detail->appointmentDetails->orders->services as $service)
                                                    <span class="inline-flex w-fit items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-white mt-2">{{ $service->name }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex gap-3 m-3 border-t border-dashed border-gray-500">
                                        <div class="mt-6 text-sm font-medium">
                                            @if ($detail->appointmentDetails->orders)
                                                Total Price: <span class="font-bold text-green-500">{{ Number::currency($detail->appointmentDetails->orders->grand_total, 'PHP') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <x-slot name="footer">
                            <div class="flex justify-end gap-x-4">
                                <div class="flex">
                                    <x-button flat label="Close" x-on:click="close"/>
                                    {{-- <x-button primary label="Save"/> --}}
                                </div>
                            </div>
                        </x-slot>
                    </x-card>
                @endif
            @endforeach
        @endif
    </x-modal>

    <x-modal title="Add New Appointment" blur wire:model.defer="cardModal" align="center" persistent max-width="5xl">
        <x-card title="Add New Appointment">
            <form >
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <div class="col-span-1 sm:col-span-2">
                            <x-select
                                label="Client"
                                wire:model="client"
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
                        <div class="col-span-1 sm:col-span-2 mt-4">
                            <x-input label="Title" placeholder="Appointment Title" wire:model="title" />
                        </div>
                        <div class="col-span-1 sm:col-span-2 mt-4">
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
                        <div class="col-span-1 sm:col-span-2 mt-4">
                            <x-time-picker
                                label="Time"
                                placeholder="12:00 AM"
                                wire:model.defer="time"
                                format="24"
                            />
                        </div>
                        <div class="col-span-1 sm:col-span-2 mt-4">
                            <x-textarea label="Description" placeholder="write appointment desctiption" wire:model="description" />
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="col-span-1 sm:col-span-2">
                            <div id="hs-wrapper-for-copy-one" class="space-y-3">
                                <p class="-mb-2 text-sm font-medium">Service/s <span class="text-xs italic text-green-500">(Must be added in client list)</span></p>
                                @foreach ($services as $index => $service)
                                    <div id="copy-markup-item-one-{{ $service }}" class="space-y-3">
                                        <div class="flex space-x-3">
                                            <x-select
                                                wire:model.blur="services.{{ $index }}"
                                                placeholder="Ex: Consulation / Opinion Charge: Written (per hour/session)"
                                                :async-data="route('api.services')"
                                                option-label="name"
                                                option-value="id"
                                            />
                                            <!-- Only show delete button for inputs other than the first one -->
                                            @if ($index > 0)
                                                <button type="button" wire:click="removeService({{ $index }})" class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M19 13H5"></path>
                                                    </svg>
                                                    Delete
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <p class="mt-3 text-end">
                                <button type="button" wire:click="addService" class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5v14"></path>
                                </svg>
                                Add Another Service
                                </button>
                            </p>
                        </div>
                        <div class="col-span-1 sm:col-span-2">
                            <x-select
                                label="Payment Status"
                                placeholder="Select one status"
                                :options="['Paid', 'Unpaid']"
                                wire:model.defer="payment_status"
                            />
                        </div>

                        <div class="mt-6 text-sm font-medium">
                            Total Price: <span class="font-bold text-green-500">{{ number_format($this->totalPrice, 2) }}</span>
                        </div>
                        {{-- <div class="col-span-1 sm:col-span-2">
                            <ul class="grid w-full gap-6 md:grid-cols-2">
                                <li>
                                    <input wire:model="payment_method" class="hidden peer" id="hosting-small" required="" type="radio" value="cash" />
                                    <label class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-small">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">
                                                Cash
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                        </svg>
                                          
                                    </label>
                                </li>
                                <li>
                                    <input wire:model="payment_method" class="hidden peer" id="hosting-big" type="radio" value="stripe">
                                    <label class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-big">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">
                                                Stripe
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                                        </svg> 
                                    </label>
                                    </input>
                                </li>
                            </ul>
                        </div> --}}
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
        </x-card>
    </x-modal>

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