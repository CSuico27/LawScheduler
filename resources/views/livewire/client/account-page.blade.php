<div class="w-full h-svh pt-32 flex flex-col items-center">
    <div class="flex">
        <div class="flex bg-gray-200 hover:bg-gray-200 rounded-lg transition p-1 dark:bg-neutral-700 dark:hover:bg-neutral-600">
            <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white active" id="segment-item-1" aria-selected="true" data-hs-tab="#segment-1" aria-controls="segment-1" role="tab">
                    Details
                </button>
                <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-2" aria-selected="false" data-hs-tab="#segment-4" aria-controls="segment-4" role="tab">
                    Zoom Meetings
                </button>
                <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-2" aria-selected="false" data-hs-tab="#segment-2" aria-controls="segment-2" role="tab">
                    Appointments
                </button>
                <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-gray-700 hs-tab-active:dark:bg-neutral-800 hs-tab-active:dark:text-neutral-400 dark:hs-tab-active:bg-gray-800 py-3 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-lg hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:text-white dark:focus:text-white" id="segment-item-3" aria-selected="false" data-hs-tab="#segment-3" aria-controls="segment-3" role="tab">
                    Cases
                </button>
            </nav>
        </div>
    </div>
      
    <div class="mt-5 w-full h-auto flex flex-col justify-center items-center">
        <div id="segment-1" role="tabpanel" aria-labelledby="segment-item-1" class="w-[50%] h-96 rounded-lg">
            @foreach ($accountDetails as $detail)
                <div class="bg-gray-200 w-full h-auto rounded-3xl overflow-hidden">
                    <div class="w-full h-auto relative pb-10">
                        <img src="{{ asset('/images/profile-bg.jpg')}}" alt="" class="w-full h-60 object-fill object-top">
                        <div class="w-auto h-40 absolute z-10 top-40 left-5 flex">
                            <div class="w-40 h-40 rounded-full border-4">
                                <img src="{{ $detail->profile_picture }}" alt="" class="w-full h-auto object-fill object-center">
                            </div>
                            <div class="w-auto  h-40 flex flex-col justify-end">
                                <h1 class="font-bold text-3xl">{{ $detail->name }}</h1>
                                <h3 class="text-base uppercase"> {{ $detail->info->barangay }}, {{ $detail->info->municipality }}, {{ $detail->info->province }}, {{ $detail->info->state }} </h3>
                            </div>
                        </div>
                        <div class="mt-24 px-10">
                            <div class="py-3 flex items-center text-sm text-gray-800 after:flex-1 after:border-t after:border-gray-500 after:ms-6 dark:text-white dark:after:border-neutral-600">Contact Details</div>
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#287bff" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                                    </svg>  
                                    <p>{{ $detail->email }}</p>                                    
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#287bff" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                    </svg>                                        
                                    <p>{{ $detail->email }}</p>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div id="segment-2" class="hidden w-[50%] h-96 rounded-lg" role="tabpanel" aria-labelledby="segment-item-2">
            @if ($selectedClientFullDetails)
                @if (count($selectedClientFullDetails['appointments']) > 0)
                    <div class="w-full h-auto flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 p-5">
                        <div class="py-3 flex items-center text-sm text-gray-800 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-neutral-600">Upcoming Appoitnments</div>
                        @foreach ($selectedClientFullDetails['appointments'] as $appointment)
                            @if (\Carbon\Carbon::parse($appointment->date)->startOfDay()->gte(\Carbon\Carbon::now()->startOfDay()))
                                <div class="w-full h-auto rounded-lg shadow-md flex items-center p-2 gap-3 border mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#287bff" class="size-10">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                    </svg>
                                    <div class="border border-dashed w-full h-auto rounded-lg px-5 py-3">
                                        <h3 class="font-semibold text-base">
                                            {{ $appointment->title }}
                                        </h3>
                                        <p class="text-xs italic text-blue-500">{{$appointment->description}}</p>
                                    </div>
                                    <div class="ml-auto w-fit">
                                        <span class="mt-2 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#287bff" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                            
                                            {{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}
                                        </span>
                                        <span class="mt-2 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#287bff" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                              
                                            
                                            {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                        </span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="py-3 flex items-center text-sm text-gray-800 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-neutral-600 mt-5">Appointments History</div>
                        @foreach ($selectedClientFullDetails['appointments'] as $appointment)
                            @if(\Carbon\Carbon::parse($appointment->date)->startOfDay()->lt(\Carbon\Carbon::now()->startOfDay()))
                                    <div class="w-full h-auto rounded-lg shadow-md flex items-center p-2 gap-3 border mt-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#287bff" class="size-10">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                        </svg>
                                        <div class="border border-dashed w-full h-auto rounded-lg px-5 py-3">
                                            <h3 class="font-semibold text-base">
                                                {{ $appointment->title }}
                                            </h3>
                                            <p class="text-xs italic text-blue-500">{{$appointment->description}}</p>
                                        </div>
                                        <div class="ml-auto w-fit">
                                            <span class="mt-2 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#287bff" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                </svg>
                                                
                                                {{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}
                                            </span>
                                            <span class="mt-2 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#287bff" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                
                                                {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="flex justify-center items-center bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 p-10">
                        <x-icon name="information-circle" class="w-5 h-5" />
                        <h1>No Appointnemnts found.</h1>
                    </div>
                @endif
            @endif
        </div>
        <div id="segment-3" class="hidden w-[50%] h-96 rounded-lg" role="tabpanel" aria-labelledby="segment-item-3">
            @if ($selectedClientFullDetails)
                @if (count($selectedClientFullDetails['cases']) > 0)
                    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 p-10">
                        @foreach ($selectedClientFullDetails['cases'] as $case)
                            <div class="grow pt-0.5 pb-8">
                                <div class="dashed-container-no-padding mt-1">
                                    <div class="border-b border-gray-300 border-dashed py-3 mb-2">
                                        <h3 class="flex gap-x-1.5 font-semibold text-gray-800 dark:text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                                            </svg>
                                            
                                            {{ $case['nps_docket_no'] }}
                                            <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">{{ $case['case_stage']['name'] }}</span>
                                        </h3>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="w-1/2 flex flex-col">
                                            <h3 class="text-sm font-bold">Complainant/s</h3>
                                            @if (isset($case['complainantDetails']))
                                                @foreach ($case['complainantDetails'] as $complainant)
                                                    <button type="button" class="mt-1 -ms-1 p-1 inline-flex items-center gap-x-2 text-xs rounded-lg border border-transparent text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                                        <img class="shrink-0 size-5.5 rounded-full" src="{{ $complainant['profile_picture'] }}" alt="Avatar">
                                                        {{ $complainant['name'] }}   
                                                    </button>
                                                @endforeach 
                                            @endif
                                        </div>
                                        <div class="w-1/2">
                                            <h3 class="text-sm font-bold">Respondent/s</h3>
                                            <div class="mt-1 flex flex-col">
                                                @foreach (json_decode($case['respondents']) as $respondent)
                                                    <button type="button" class="-ms-1 p-1 inline-flex items-center gap-x-2 text-xs rounded-lg border border-transparent text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                                        <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                            </svg>                                                  
                                                            <span class="font-medium text-gray-900">{{ $respondent->name }}</span>
                                                        </div>  
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-t border-gray-300 border-dashed">
                                        <div class="py-1 flex gap-2">
                                            <h3 class="font-semibold">Law/s Violated : </h3>
                                            <div class="flex flex-col">
                                                @if (isset($case['lawsViolated']))
                                                    @foreach ($case['lawsViolated'] as $law)
                                                        <p class="text-sm italic">
                                                            {{ $law['name'] }}
                                                        </p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex justify-center items-center bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 p-10">
                        <x-icon name="information-circle" class="w-5 h-5" />
                        <h1>No Cases found.</h1>
                    </div>
                @endif
            @endif
        </div>
        <div id="segment-4" class="hidden w-[50%] h-96 rounded-lg" role="tabpanel" aria-labelledby="segment-item-4">
            @if ($selectedClientFullDetails)
                @if (count($selectedClientFullDetails['zoom_meetings']) > 0)
                    <div class="w-full h-auto flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 p-5">
                        <div class="py-3 flex items-center text-sm text-gray-800 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-neutral-600">Upcoming Meetings</div>
                        @foreach ($selectedClientFullDetails['zoom_meetings'] as $meeting)
                            @if (\Carbon\Carbon::parse($meeting->start_time)->startOfDay()->gte(\Carbon\Carbon::now()->startOfDay()))
                                <div class="w-full h-auto rounded-lg shadow-md flex items-center p-2 gap-3 border mt-2">
                                    <img src="{{ asset('/images/zoom-logo.webp') }}" alt="zoom" class="w-8 h-8">
                                    <div class="border border-dashed w-full h-auto rounded-lg px-5 py-3">
                                        <h3 class="font-semibold text-base">
                                            {{ $meeting->topic }}
                                        </h3>
                                        <p class="text-xs italic text-blue-500">{{$meeting->agenda}}</p>
                                        <span class="mt-2 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#287bff" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                            
                                            {{ \Carbon\Carbon::parse($meeting->start_time)->format('F j, Y') }}
                                        </span>
                                    </div>
                                    <div class="ml-auto w-fit">
                                        @if (\Carbon\Carbon::parse($meeting->start_time)->isSameDay(\Carbon\Carbon::now()))
                                            <button type="button" class="relative w-32 py-3 px-4 inline-flex items-center justify-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                                Join Now
                                                <span class="flex absolute top-0 end-0 size-3 -mt-1.5 -me-1.5">
                                                    <span class="animate-ping absolute inline-flex size-full rounded-full bg-red-400 opacity-75 dark:bg-red-600"></span>
                                                    <span class="relative inline-flex rounded-full size-3 bg-red-500"></span>
                                                </span>
                                            </button>
                                        @else
                                            <button type="button" disabled class="relative w-32 py-3 px-4 inline-flex items-center justify-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                                Join Now
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="py-3 flex items-center text-sm text-gray-800 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-neutral-600 mt-5">Appointments History</div>
                        @foreach ($selectedClientFullDetails['zoom_meetings'] as $meeting)
                            @if(\Carbon\Carbon::parse($meeting->start_time)->startOfDay()->lt(\Carbon\Carbon::now()->startOfDay()))
                                    <div class="w-full h-auto rounded-lg shadow-md flex items-center p-2 gap-3 border mt-2">
                                        <img src="{{ asset('/images/zoom-logo.webp') }}" alt="zoom" class="w-8 h-8">
                                        <div class="border border-dashed w-full h-auto rounded-lg px-5 py-3">
                                            <h3 class="font-semibold text-base">
                                                {{ $meeting->topic }}
                                            </h3>
                                            <p class="text-xs italic text-blue-500">{{$meeting->agenda}}</p>
                                            <span class="mt-2 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#287bff" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                </svg>
                                                
                                                {{ \Carbon\Carbon::parse($meeting->start_time)->format('F j, Y') }}
                                            </span>
                                        </div>
                                        <div class="ml-auto w-fit">
                                            <button type="button" disabled class="relative w-80 py-3 px-4 inline-flex items-center justify-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                                Meeting Not Available
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="flex justify-center items-center bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 p-10">
                        <x-icon name="information-circle" class="w-5 h-5" />
                        <h1>No Zoom Meetings found.</h1>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
