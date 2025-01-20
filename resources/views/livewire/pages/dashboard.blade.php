<div>
    <div class="grid grid-cols-3 gap-4">
        <div class="flex flex-col bg-white shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:border-t-blue-500 dark:shadow-neutral-700/70">
            <div class="p-4 md:p-5">
                <h3 class="text-sm font-medium text-gray-500 dark:text-neutral-400">
                    All Clients
                </h3>
                <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">
                {{$clientsCount}} Clients
                </p>
                <div class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 decoration-2 hover:text-blue-700 focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-600 dark:focus:text-blue-600" href="#">
                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        {{ $clientsAddedThisMonth }}
                    </span>
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">
                        In this Month
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:border-t-blue-500 dark:shadow-neutral-700/70">
            <div class="p-4 md:p-5">
                <h3 class="text-sm font-medium text-gray-500 dark:text-neutral-400">
                    All Zoom Meetings
                </h3>
                <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">
                {{ $allZoomMeetingsCount }} Meetings
                </p>
                <div class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 decoration-2 hover:text-blue-700 focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-600 dark:focus:text-blue-600" href="#">
                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        {{ $zoomMeetingsAddedThisMonth }}
                    </span>
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">
                        In this Month
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:border-t-blue-500 dark:shadow-neutral-700/70">
            <div class="p-4 md:p-5">
                <h3 class="text-sm font-medium text-gray-500 dark:text-neutral-400">
                    All Appointments
                </h3>
                <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">
                {{ $allAppointmentsCount }} Appointments
                </p>
                <div class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 decoration-2 hover:text-blue-700 focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-600 dark:focus:text-blue-600" href="#">
                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        {{ $appointmentsAddedThisMonth }}
                    </span>
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">
                        In this Month
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4 mt-3">
        <div class="flex flex-col bg-white shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:border-t-blue-500 dark:shadow-neutral-700/70">
            <div class="p-4 md:p-5">
                <h3 class="text-sm font-medium text-gray-500 dark:text-neutral-400">
                    All Cases
                </h3>
                <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">
                {{ $allCases }} Cases
                </p>
                <div class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 decoration-2 hover:text-blue-700 focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-600 dark:focus:text-blue-600" href="#">
                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        {{ $casesAddedThisMonth }}
                    </span>
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">
                        In this Month
                    </p>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:border-t-blue-500 dark:shadow-neutral-700/70">
            <div class="p-4 md:p-5">
                <h3 class="text-sm font-medium text-gray-500 dark:text-neutral-400">
                    New Appointments
                </h3>
                <p class="mt-2 text-2xl font-bold text-gray-800 dark:text-white">
                6 Appointments
                </p>
                <div class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 decoration-2 hover:text-blue-700 focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-600 dark:focus:text-blue-600" href="#">
                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        10
                    </span>
                    <p class="text-sm font-medium text-gray-500 dark:text-neutral-400">
                        In this Month
                    </p>
                </div>
            </div>
        </div>
    </div>
   
    <div class="grid grid-cols-3 gap-4 mt-10">
        <!-- Timeline -->
        <div>
            <div class="w-full mb-2 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-100 text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-400 dark:bg-blue-800/30">
                <img src="{{ asset('/images/zoom-logo.webp') }}" alt="zoom" class="w-8 h-8">
                Upcoming Zoom Meetings
            </div>
            @if ($upcomingZoomMeetings)
                @foreach($upcomingZoomMeetings as $date => $meetings)
                    <!-- Heading -->
                    <div class="ps-2 my-2 first:mt-0">
                        <h3 class="text-xs font-medium uppercase text-gray-500 dark:text-neutral-400">
                            {{ \Carbon\Carbon::parse($date)->format('j M, Y') }}
                        </h3>
                    </div>
                    <!-- End Heading -->
                    @foreach($meetings as $meeting)
                        <!-- Item -->
                        <div class="flex gap-x-3 relative group rounded-lg hover:bg-gray-100 dark:hover:bg-white/10">
                            <a class="absolute inset-0 z-[1]" href="#" onclick="$openModal('meetingFullDetails')" wire:click="getMeetingFullDetails({{ $meeting->id }})"></a>
                            
                            <!-- Icon -->
                            <div class="relative last:after:hidden after:absolute after:top-0 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700 dark:group-hover:after:bg-neutral-600">
                                <div class="relative z-10 size-7 flex justify-center items-center">
                                    <div class="size-2 rounded-full bg-white border-2 border-gray-300 group-hover:border-gray-600 dark:bg-neutral-800 dark:border-neutral-600 dark:group-hover:border-neutral-600"></div>
                                </div>
                            </div>
                            <!-- End Icon -->
            
                            <!-- Right Content -->
                            <div class="grow p-2 pb-8">
                                <h3 class="flex gap-x-1.5 font-semibold text-gray-800 dark:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>                                  
                                    {{ $meeting->title }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                                    {{ $meeting->description }}
                                </p>
                                <button type="button" class="mt-1 -ms-1 p-1 relative z-10 inline-flex items-center gap-x-2 text-xs rounded-lg border border-transparent text-gray-500 hover:bg-white hover:shadow-sm disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-800">
                                    @foreach ($meeting->participantsDetails as $participant)
                                        <img class="shrink-0 size-4 rounded-full" src="{{ $participant->profile_picture }}" alt="Avatar">
                                        {{ $participant->name }}
                                    @endforeach
                                </button>
                            </div>
                            <!-- End Right Content -->
                        </div>
                        <!-- End Item -->
                    @endforeach
                @endforeach
            @else
                <div class="w-full h-auto flex justify-center items-center py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    <p class="font-medium text-sm">
                        No Upcoming Zoom Meeting.
                    </p>
                </div>
            @endif  
        </div>        
        <!-- End Timeline -->



        {{-- TIME LINE 2 --}}
        <!-- Timeline -->
        <div>
            <div class="w-full mb-2 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-teal-100 text-teal-800 disabled:opacity-50 disabled:pointer-events-none dark:text-teal-500 dark:bg-teal-800/30">
                Upcoming Appointments
            </div>
            @if ($upcomingAppointments)
                @foreach($upcomingAppointments as $date => $appointments)
                    <!-- Heading -->
                    <div class="ps-2 my-2 first:mt-0">
                        <h3 class="text-xs font-medium uppercase text-gray-500 dark:text-neutral-400">
                            {{ \Carbon\Carbon::parse($date)->format('j M, Y') }}
                        </h3>
                    </div>
                    <!-- End Heading -->
                    @foreach($appointments as $appointment)
                        <!-- Item -->
                        <div class="flex gap-x-3 relative group rounded-lg hover:bg-gray-100 dark:hover:bg-white/10">
                            <a class="absolute inset-0 z-[1]" href="#" onclick="$openModal('meetingFullDetails')" wire:click="getMeetingFullDetails({{ $appointment->id }})"></a>
                            
                            <!-- Icon -->
                            <div class="relative last:after:hidden after:absolute after:top-0 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700 dark:group-hover:after:bg-neutral-600">
                                <div class="relative z-10 size-7 flex justify-center items-center">
                                    <div class="size-2 rounded-full bg-white border-2 border-gray-300 group-hover:border-gray-600 dark:bg-neutral-800 dark:border-neutral-600 dark:group-hover:border-neutral-600"></div>
                                </div>
                            </div>
                            <!-- End Icon -->
            
                            <!-- Right Content -->
                            <div class="grow p-2 pb-8">
                                <h3 class="flex gap-x-1.5 font-semibold text-gray-800 dark:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>                                 
                                    {{ $appointment->title }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                                    {{ $appointment->description }}
                                </p>
                                <button type="button" class="mt-1 -ms-1 p-1 relative z-10 inline-flex items-center gap-x-2 text-xs rounded-lg border border-transparent text-gray-500 hover:bg-white hover:shadow-sm disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-800">
                                    @foreach ($appointment->participantsDetails as $participant)
                                        <img class="shrink-0 size-4 rounded-full" src="{{ $participant->profile_picture }}" alt="Avatar">
                                        {{ $participant->name }}
                                    @endforeach
                                </button>
                                <button type="button" class="mt-1 -ms-1 p-1 relative z-10 inline-flex items-center gap-x-2 text-xs rounded-lg border border-transparent text-gray-500 hover:bg-white hover:shadow-sm disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($appointment->appointmentDetails->time)->format('h:i A') }}
                                </button>
                            </div>
                            <!-- End Right Content -->
                        </div>
                        <!-- End Item -->
                    @endforeach
                @endforeach
            @else
                <div class="w-full h-auto flex justify-center items-center py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    <p class="font-medium text-sm">
                        No Upcoming Appointments    .
                    </p>
                </div>
            @endif  
        </div>
        <!-- End Timeline -->


        {{-- TIME LINE 3 --}}

         <!-- Timeline -->
         <div>
            <div class="w-full mb-2 py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-yellow-100 text-yellow-800 disabled:opacity-50 disabled:pointer-events-none dark:text-yellow-500 dark:bg-yellow-800/30">
                Upcoming Hearings
            </div>
            @if ($upcomingHearings)
                @foreach($upcomingHearings as $date => $hearings)
                    <!-- Heading -->
                    <div class="ps-2 my-2 first:mt-0">
                        <h3 class="text-xs font-medium uppercase text-gray-500 dark:text-neutral-400">
                            {{ \Carbon\Carbon::parse($date)->format('j M, Y') }}
                        </h3>
                    </div>
                    <!-- End Heading -->
                    @foreach($hearings as $hearing)
                        <!-- Item -->
                        <div class="flex gap-x-3">
                            <!-- Icon -->
                            <div class="relative last:after:hidden after:absolute after:top-7 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700">
                                <div class="relative z-10 size-7 flex justify-center items-center">
                                    <img class="shrink-0 size-7 rounded-full" src="{{ $hearing->user->profile_picture }}" alt="Avatar">
                                </div>
                            </div>
                            <!-- End Icon -->

                            <!-- Right Content -->
                            <div class="grow pt-0.5 pb-8">
                                <h3 class="flex gap-x-1.5 font-semibold text-gray-800 dark:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                                    </svg>
                                    
                                    {{ $hearing->case_no }}
                                    <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">{{ $hearing->caseStage->name }}</span>
                                </h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                                    {{ $hearing->act }}
                                </p>
                                
                                <div class="dashed-container-no-padding mt-1">
                                    <div class="flex justify-between">
                                        <div class="w-1/2">
                                            <h3 class="text-sm font-bold">Petitioner</h3>
                                            <button type="button" class="mt-1 -ms-1 p-1 inline-flex items-center gap-x-2 text-xs rounded-lg border border-transparent text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                                <img class="shrink-0 size-4 rounded-full" src="{{ $hearing->user->profile_picture }}" alt="Avatar">
                                                {{ $hearing->user->name }}
                                            </button>
                                        </div>
                                        <div class="w-1/2">
                                            <h3 class="text-sm font-bold">Respondents</h3>
                                            <div class="mt-1">
                                                @foreach (json_decode($hearing->respondents) as $respondent)
                                                    <button type="button" class="-ms-1 p-1 inline-flex items-center gap-x-2 text-xs rounded-lg border border-transparent text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                        </svg>
                                                          
                                                        {{ $respondent }}
                                                    </button>
                                                @endforeach
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="border-t border-gray-300 border-dashed">
                                        <div class="py-1 flex items-center gap-2">
                                            <h3 class="font-semibold">{{ $hearing->caseType->name }} : </h3>
                                            <span class="text-sm italic">
                                                {{ $hearing->caseSubType->name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Right Content -->
                        </div>
                        <!-- End Item -->
                    @endforeach
                @endforeach
            @else
                <div class="w-full h-auto flex justify-center items-center py-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    <p class="font-medium text-sm">
                        No Upcoming Hearings.
                    </p>
                </div>
            @endif  
        </div>
        <!-- End Timeline -->
    </div>

    {{-- SHOW FULL DETAILS --}}
    <x-modal blur name="meetingFullDetails" align="center" max-width="xl">
        {{-- @dump($zoomMeetingFullDetails) --}}
        @if ($zoomMeetingFullDetails)
            @foreach ($zoomMeetingFullDetails as $detail)
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
                                            {{-- @dump($detail->participantsDetails) --}}
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
                                    <x-button flat label="Close" x-on:click="close" wire:click="resetDetails" />
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
                            </div> 
                        </div>
                        <x-slot name="footer">
                            <div class="flex justify-end gap-x-4">
                                <div class="flex">
                                    <x-button flat label="Close" x-on:click="close" wire:click="resetDetails" />
                                </div>
                            </div>
                        </x-slot>
                    </x-card>
                @endif
            @endforeach
        @endif
        
    </x-modal>
</div>
