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
                        Duration
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
                                    {{ $schedule->zoomMeet->topic }}
                                </th>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::createFromTimestamp($schedule->zoomMeet->start_time)->format('F j, Y') }}
                                </td>
                                <td class="px-4 py-2">
                                    {{ $schedule->zoomMeet->duration }}
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
</div>
