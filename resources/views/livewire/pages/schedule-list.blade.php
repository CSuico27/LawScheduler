<div class="w-full h-full">
    <div class="container dashed-container flex flex-col-reverse md:flex-row md:flex">
        <div class="w-full flex md:justify-start md:mt-0 items-center justify-center mt-3 ">
            {{-- <button type="button" wire:loading.attr="disabled" wire:loading.class="!cursor-wait" wire:click="initialData" onclick="$openModal('newClientModal')" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55">
                <x-icon name="user-add" class="w-5 h-5" />
                New Client
            </button> --}}
        </div>

        <div class="container md:justify-start justify-center">
            <form class="w-full">   
                <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" wire:model.live="searchTerm" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required />
                    {{-- <button wire:click.defer="searchBeneficiary" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button> --}}
                </div>
            </form>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-2 text-blue-950">
                        Meeting Id
                    </th>
                    <th scope="col" class="px-4 py-2 text-blue-950">
                        Topic
                    </th>
                    <th scope="col" class="px-4 py-2 text-blue-950">
                        Start Date
                    </th>
                    <th scope="col" class="px-4 py-2 text-blue-950">
                        Participant
                    </th>
                    <th scope="col" class="px-4 py-2 text-blue-950">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($scheduleList->isEmpty())
                    <tr>
                        <td colspan="6">
                            <div class="flex justify-center items-center text-center gap-2 py-10 w-full">
                                <x-icon name="information-circle" class="w-5 h-5" /><h1>No schedule found.</h1>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach ($scheduleList as $schedule)
                        @if ($schedule->zoomMeet)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-4 py-2">
                                    {{ $schedule->zoomMeet->meeting_id }}
                                </td>
                                <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="hs-tooltip inline-block">
                                        <a onclick="$openModal('showFullDetails')" wire:click="getSelectedMeetingId({{ $schedule->id }})"  class="hs-tooltip-toggle underline cursor-pointer hover:text-blue-600">
                                            {{ $schedule->zoomMeet->topic }}
                                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                                                Full Details
                                            </span>
                                        </a>
                                    </div>
                                </th>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($schedule->zoomMeet->start_time)->format('F j, Y') }}
                                </td>
                                <td class="px-4 py-2">
                                    @foreach($schedule->participantsDetails as $participant)
                                        <div class="flex items-center gap-2">
                                            <img src="{{ asset($participant->profile_picture) }}" alt="{{ $participant->profile_picture }}" class="w-8 h-8">
                                            {{ $participant->name }}
                                        </div>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2 flex gap-4">
                                    <a href="{{ $schedule->zoomMeet->join_url }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" target="_blank">
                                        Join
                                    </a>
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="$openModal('editMeetingModal')" wire:click="getSelectedMeetingId({{ $schedule->id }})">Edit</a>
                                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" wire:click="deleteConfirmation({{ $schedule->id }}, '{{  $schedule->title }}')">Delete</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>            
        </table>        
        <div class="w-full flex justify-end items-end py-5 px-2">
            {{ $scheduleList->links() }}
        </div>
    </div>  

    {{-- SHOW FULL DETAILS --}}
    <x-modal blur name="showFullDetails" align="center" max-width="xl">
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
                                    {{ \Carbon\Carbon::createFromTimestamp($detail->zoomMeet->start_time)->format('F j, Y') }}
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
</div>
