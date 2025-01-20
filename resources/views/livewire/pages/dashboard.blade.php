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
                            <a class="absolute inset-0 z-[1]" href="#"></a>
                            
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
                            <a class="absolute inset-0 z-[1]" href="#"></a>
                            
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
</div>
