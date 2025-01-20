<div class="w-full h-full">
    <div class="container dashed-container flex flex-col-reverse md:flex-row md:flex">
        <div class="w-full flex md:justify-start md:mt-0 items-center justify-center mt-3 ">
            {{-- <button type="button" wire:loading.attr="disabled" wire:loading.class="!cursor-wait" onclick="$openModal('newCaseModal')" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                </svg>
                  
                Create New Case
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
                        Client & Case Detail
                    </th>
                    <th scope="col" class="px-4 py-2 text-blue-950">
                        Witness/es
                    </th>
                    <th scope="col" class="px-4 py-2 text-blue-950">
                        Complainant/s vs Respondent/s
                    </th>
                    <th scope="col" class="px-4 py-2 text-blue-950">
                        Date Received
                    </th>
                    <th scope="col" class="px-4 py-2 text-blue-950">
                        Status
                    </th>
                    <th scope="col" class="px-4 py-2 text-blue-950">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($caseList->isEmpty())
                    <tr>
                        <td colspan="6">
                            <div class="flex justify-center items-center text-center gap-2 py-10 w-full">
                                <x-icon name="information-circle" class="w-5 h-5" /><h1>No archived cases found.</h1>
                            </div>
                        </td>
                    </tr>
                @else
                    @if ($caseList)
                        @foreach ($caseList as $case)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex flex-col">
                                        <div class="hs-tooltip inline-block"> 
                                            <a class="hs-tooltip-toggle underline cursor-pointer hover:text-blue-600">
                                                <div class="flex flex-col gap-1">
                                                    @if ($case->complainantDetails)
                                                        @foreach ($case->complainantDetails as $complainant)
                                                            <div class="flex items-center gap-1">
                                                                <img src="{{ asset($complainant->profile_picture) }}" alt="{{ $complainant->name }}" class="w-8 h-8">
                                                                {{ $complainant->name }}
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                                                    Full Case Details
                                                </span>
                                            </a>
                                        </div>
                                        <div>
                                            <span class="text-gray-500 font-normal">NPS No:</span> {{ $case->nps_docket_no }}
                                        </div>
                                        <div class="flex gap-2">
                                            <span class="text-gray-500 font-normal">Case:</span> 
                                            @if ($case->lawsViolated)
                                                <div>
                                                    @foreach ($case->lawsViolated as $lawViolated)
                                                        <div class="flex flex-col gap-1">
                                                            {{ $lawViolated->name }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif 
                                        </div>
                                    </div>
                                </td>
                                <td scope="row" class="px-4 py-2 h-auto" >
                                    @foreach (json_decode($case->witnesses) as $witness)
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>                                                  
                                                <span class="font-medium text-gray-900">{{ $witness->name }}</span>-
                                                <span class="font-xs text-xs text-blue-500 italic">({{ $witness->sex }}</span>, 
                                                <span class="font-xs text-xs text-blue-500 italic">{{ $witness->age }}</span>, 
                                                <span class="font-xs text-xs text-blue-500 italic">{{ $witness->address }})</span>
                                            </div>
                                    @endforeach
                                </td>
                                <td class="px-4 py-2">
                                    <div>
                                        <div class="flex flex-col gap-1">
                                            @if ($case->complainantDetails)
                                                @foreach ($case->complainantDetails as $complainant)
                                                    <div class="flex items-center gap-1">
                                                        <img src="{{ asset($complainant->profile_picture) }}" alt="{{ $complainant->name }}" class="w-5 h-5">
                                                        <span class="font-medium text-gray-900">{{ $complainant->name }}</span>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="py-1 flex items-center text-sm text-gray-800 before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:before:border-neutral-600 dark:after:border-neutral-600">VS</div>
                                        @foreach (json_decode($case->respondents) as $respondent)
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>                                                  
                                                <span class="font-medium text-gray-900">{{ $respondent->name }}</span> - 
                                                <span class="font-xs text-xs text-blue-500 italic">({{ $respondent->sex }}</span>,
                                                <span class="font-xs text-xs text-blue-500 italic">{{ $respondent->age }}</span>,
                                                <span class="font-xs text-xs text-blue-500 italic">{{ $respondent->address }})</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($case->date_received)->format('F j, Y') }}
                                </td>
                                <td class="px-4 py-2">
                                    <div class="hs-tooltip inline-block">
                                        <a class="hs-tooltip-toggle underline cursor-pointer hover:text-blue-600">
                                            <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                @if ($case->caseStage)
                                                    {{ $case->caseStage->name }}
                                                @endif
                                            </span>
                                        </a>
                                        <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-50 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                                            Change Status
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex justify-center gap-5">
                                        {{-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="$openModal('editInvoice')">Edit</a>
                                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a> --}}
                                        <div class="hs-dropdown relative inline-flex">
                                            <button id="hs-dropdown-custom-icon-trigger" type="button" class="hs-dropdown-toggle flex justify-center items-center size-9 text-sm font-semibold rounded-lg border  text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none  disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                <svg class="flex-none size-4 text-gray-600 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>
                                            </button>
                                            
                                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-1 space-y-0.5 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 z-10" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-custom-icon-trigger">
                                                <a onclick="$openModal('editCaseModal')" wire:click="getSelectedCaseId({{ $case->id }})" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                        </svg> 
                                                    </span>
                                                    Edit
                                                </a>
                                                <a wire:click="unarchivedCase({{ $case->id }})" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                                    </svg>                                                      
                                                    Unarchived
                                                </a>
                                                <div class="border-t border-gray-700">
                                                    <a wire:click="deleteConfirmation({{ $case->id }}, '{{  $case->nps_docket_no }}')" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-red-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>                                                      
                                                        </span>
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </td>
                            </tr> 
                        @endforeach
                    @endif
                @endif
            </tbody>            
        </table>        
        <div class="w-full flex justify-end items-end py-5 px-2">
            {{ $caseList->links() }}
        </div>
    </div>  
    
    {{-- NEW CASE MODAL --}}
    {{-- <x-modal.card title="New Case" name="newCaseModal" blur wire:model.defer="newCaseModal" align="center" max-width="6xl">
        <form >
            <div class="grid grid-cols-12 sm:grid-cols-1 gap-4">
                <div class="max-h-[600px] w-full overflow-y-auto
                [&::-webkit-scrollbar]:w-2
                [&::-webkit-scrollbar-track]:rounded-full
                [&::-webkit-scrollbar-track]:bg-gray-100
                [&::-webkit-scrollbar-thumb]:rounded-full
                [&::-webkit-scrollbar-thumb]:bg-gray-300
                dark:[&::-webkit-scrollbar-track]:bg-neutral-700
                dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                    <div class="w-full rounded-md px-10">
                        <div class="col-span-1 sm:col-span-2 my-3">
                            <div class="grid grid-cols-2">
                                <div class="pr-5 flex flex-col gap-3">
                                    <x-datetime-picker
                                        label="Date Received"
                                        placeholder="Ex: 23-07-2024"
                                        display-format="DD-MM-YYYY"
                                        wire:model.blur="dateReceived"
                                        without-time
                                    />
                                    <x-time-picker
                                        label="Time Received"
                                        placeholder="12:00 AM"
                                        wire:model.defer="timeReceived"
                                    />
                                    <x-input label="Receiving Staff" placeholder="Ex: RTC - Branch III" wire:model="receivingStaff" />
                                    <x-select
                                        label="Case Stage"
                                        wire:model.blur="caseStage"
                                        placeholder="Ex: On-Trial"
                                        :async-data="route('api.case.stage')"
                                        option-label="name"
                                        option-value="id"
                                    />
                                </div>
                                <div class="flex flex-col gap-3">
                                    <x-input label="NPS DOCKET NO." placeholder="Ex: 237-22C-1333" wire:model="NPSDocketNumber" />
                                    <x-input label="Assigned To" placeholder="Ex: RTC - Branch III" wire:model="assignTo" />
                                    <x-datetime-picker
                                        label="Date Assigned"
                                        placeholder="Ex: 23-07-2024"
                                        display-format="DD-MM-YYYY"
                                        wire:model.blur="dateAssigned"
                                        without-time
                                    />
                                    <x-select
                                        wire:ignore
                                        label="Priority Level"
                                        placeholder="Ex: High"
                                        wire:model.blur="priorityLevel"
                                        :options="[
                                            ['name' => 'High',  'id' => 1],
                                            ['name' => 'Medium', 'id' => 2],
                                            ['name' => 'Low',   'id' => 3],
                                        ]"
                                        option-label="name"
                                        option-value="name"
                                    />
                                </div>
                            </div>
                        </div>

                        <div class="col-span-1 sm:col-span-2 my-3 mt-10 dashed-container-light">
                            <div class="flex">
                                <div class="w-1/2">
                                    <div id="hs-wrapper-for-copy-one" class="space-y-3">
                                        <p class="-mb-2 text-sm font-medium">Complainant/s <span class="text-xs italic text-green-500">(Must be added in client list)</span></p>
                                        @foreach ($complainants as $index => $complainant)
                                            <div id="copy-markup-item-one-{{ $index }}" class="space-y-3">
                                                <div class="flex space-x-3">
                                                    <x-select
                                                        wire:model.blur="complainants.{{ $index }}"
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
                                                    <!-- Only show delete button for inputs other than the first one -->
                                                    @if ($index > 0)
                                                        <button type="button" wire:click="removeComplainant({{ $index }})" class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
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
                                        <button type="button" wire:click="addComplainant" class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5v14"></path>
                                        </svg>
                                        Add Complainant
                                        </button>
                                    </p>
                                </div>
                                <div class="w-1 bg-slate-300 rounded-full mx-5">
        
                                </div>
                                <div class="w-1/2">
                                    <!-- Input Group -->
                                    <div id="hs-wrapper-for-copy" class="space-y-3">
                                        <p class="-mb-2 text-sm font-medium">Respondent/s <span class="text-xs italic text-green-500">(Name, Sex, Age, Address, separated by commas.)</span></p>
                                        @foreach ($respondents as $index => $respondent)
                                            <div id="copy-markup-item-{{ $index }}" class="space-y-3">
                                                <div class="flex space-x-3">
                                                    <input type="text" wire:model.blur="respondents.{{ $index }}" class="py-2 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Name, Sex, Age, Address">
                                                    
                                                    <!-- Only show delete button for inputs other than the first one -->
                                                    @if ($index > 0)
                                                        <button type="button" wire:click="removeRespondent({{ $index }})" class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
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
                                        <button type="button" wire:click="addRespondent" class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M5 12h14"></path>
                                            <path d="M12 5v14"></path>
                                        </svg>
                                        Add Respondent
                                        </button>
                                    </p>
                                    <!-- End Input Group -->
                                </div>
                            </div>                     
                        </div>
                        
                        <div class="col-span-1 sm:col-span-2">
                            <div class="w-full rounded-md mt-10 dashed-container-light">
                                <div class="grid grid-cols-1 gap-4 mb-3">
                                    <div class="flex">
                                        <div class="w-1/2">
                                            <div id="hs-wrapper-for-copy-one" class="space-y-3">
                                                <p class="-mb-2 text-sm font-medium">Law/s Violated <span class="text-xs italic text-green-500">(Must be added in Case Type list)</span></p>
                                                @foreach ($laws as $index => $law)
                                                    <div id="copy-markup-item-one-{{ $index }}" class="space-y-3">
                                                        <div class="flex space-x-3">
                                                            <x-select
                                                                wire:model.blur="laws.{{ $index }}"
                                                                placeholder="Ex: Murder"
                                                                :async-data="route('api.case.sub-types')"
                                                                option-label="name"
                                                                option-value="id"
                                                            />
                                                            <!-- Only show delete button for inputs other than the first one -->
                                                            @if ($index > 0)
                                                                <button type="button" wire:click="removeLaw({{ $index }})" class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
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
                                                <button type="button" wire:click="addLaw" class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                    <path d="M12 5v14"></path>
                                                </svg>
                                                Add Law
                                                </button>
                                            </p>
                                        </div>
                                        <div class="w-1 bg-slate-300 rounded-full mx-5">
                
                                        </div>
                                        <div class="w-1/2">
                                            <!-- Input Group -->
                                            <div id="hs-wrapper-for-copy" class="space-y-3">
                                                <p class="-mb-2 text-sm font-medium">Witness/es <span class="text-xs italic text-green-500">(Name, Sex, Age, Address, separated by commas.)</span></p>
                                                @foreach ($witnesses as $index => $witness)
                                                    <div id="copy-markup-item-{{ $index }}" class="space-y-3">
                                                        <div class="flex space-x-3">
                                                            <input type="text" wire:model.blur="witnesses.{{ $index }}" class="py-2 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Name, Sex, Age, Address">
                                                            
                                                            <!-- Only show delete button for inputs other than the first one -->
                                                            @if ($index > 0)
                                                                <button type="button" wire:click="removeWitness({{ $index }})" class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
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
                                                <button type="button" wire:click="addWitness" class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12h14"></path>
                                                    <path d="M12 5v14"></path>
                                                </svg>
                                                Add Witness
                                                </button>
                                            </p>
                                            <!-- End Input Group -->
                                        </div>
                                    </div>   
                                </div>
                            </div> 
                            <div class="w-full rounded-md mt-10 dashed-container-light">
                                <div class="grid grid-cols-2 gap-5">
                                    <x-datetime-picker
                                        label="Date & Time of Commission"
                                        placeholder="Ex: "
                                        wire:model.defer="dateTimeCommission"
                                    />
                                    <x-input label="Place of Commission" placeholder="Ex: Brgy. Zone III, Lucena City" wire:model="placeOfCommission" />
                                </div>
                            </div>  
                            <div class="w-full rounded-md mt-10 dashed-container-light">
                                <div class="grid grid-cols-1 gap-5">
                                    <div class="flex items-center gap-5">
                                        <p>1. Has a similar complaint been filed before any offices?</p>
                                        <div class="w-20 border-t-2 border-indigo-500 border-dashed"></div>
                                        <x-toggle label="Yes" left-label="No" wire:model.live="questionOne" />
                                    </div>
                                    <div class="flex items-center gap-5">
                                        <p>2. Is this complaint in the nature of counter-charge?</p>
                                        <div class="w-20 border-t-2 border-indigo-500 border-dashed"></div>
                                        <x-toggle label="Yes" left-label="No" wire:model.live="questionTwo" />
                                    </div>
                                    <div class="flex items-center gap-5">
                                        <p>2. Is this complaint related to another case before this Office?</p>
                                        <div class="w-20 border-t-2 border-indigo-500 border-dashed"></div>
                                        <x-toggle label="Yes" left-label="No" wire:model.live="questionThree" />
                                    </div>
                                </div>
                            </div>
                            <div class="w-full rounded-md mt-10 dashed-container-light">
                                <div class="grid grid-cols-2 gap-5">
                                    <x-input label="IS NO." placeholder="Ex: 237-22C-1333" wire:model="ISNo" />
                                    <x-input label="Handling Prosecutor" placeholder="Ex: John Kramer" wire:model="handlingProsecutor" />
                                </div>
                            </div>               
                        </div>
                    </div>
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" wire:click="cancel" />
                        <x-button primary label="Save" wire:click="createCase" />
                    </div>
                </div>
            </x-slot>
        </form>
    </x-modal.card> --}}
    
    {{-- EDIT CASE MODAL --}}
    <x-modal name="editCaseModal" blur wire:model.defer="editCaseModal" align="center" max-width="6xl">
        <x-card title="Edit Case">
            <form >
                <div class="grid grid-cols-12 sm:grid-cols-1 gap-4">
                    <div class="max-h-[600px] w-full overflow-y-auto
                    [&::-webkit-scrollbar]:w-2
                    [&::-webkit-scrollbar-track]:rounded-full
                    [&::-webkit-scrollbar-track]:bg-gray-100
                    [&::-webkit-scrollbar-thumb]:rounded-full
                    [&::-webkit-scrollbar-thumb]:bg-gray-300
                    dark:[&::-webkit-scrollbar-track]:bg-neutral-700
                    dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                        <div class="w-full rounded-md px-10">
                            <div class="col-span-1 sm:col-span-2 my-3">
                                <div class="grid grid-cols-2">
                                    <div class="pr-5 flex flex-col gap-3">
                                        <x-datetime-picker
                                            label="Date Received"
                                            placeholder="Ex: 23-07-2024"
                                            display-format="DD-MM-YYYY"
                                            wire:model="editDateReceived"
                                            without-time
                                        />
                                        <x-time-picker
                                            label="Time Received"
                                            placeholder="12:00 AM"
                                            format="24"
                                            wire:model="editTimeReceived"
                                        />
                                        <x-input label="Receiving Staff" placeholder="Ex: RTC - Branch III" wire:model="editReceivingStaff" />
                                        <x-select
                                            label="Case Stage"
                                            wire:model="editCaseStage"
                                            placeholder="Ex: On-Trial"
                                            :async-data="route('api.case.stage')"
                                            option-label="name"
                                            option-value="id"
                                        />
                                    </div>
                                    <div class="flex flex-col gap-3">
                                        <x-input label="NPS DOCKET NO." placeholder="Ex: 237-22C-1333" wire:model="editNPSDocketNumber" />
                                        <x-input label="Assigned To" placeholder="Ex: RTC - Branch III" wire:model="editAssignTo" />
                                        <x-datetime-picker
                                            label="Date Assigned"
                                            placeholder="Ex: 23-07-2024"
                                            display-format="DD-MM-YYYY"
                                            wire:model="editDateAssigned"
                                            without-time
                                        />
                                        <x-select
                                            wire:ignore
                                            label="Priority Level"
                                            placeholder="Ex: High"
                                            wire:model="editPriorityLevel"
                                            :options="[
                                                ['name' => 'High',  'id' => 1],
                                                ['name' => 'Medium', 'id' => 2],
                                                ['name' => 'Low',   'id' => 3],
                                            ]"
                                            option-label="name"
                                            option-value="name"
                                        />
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-span-1 sm:col-span-2 my-3 mt-10 dashed-container-light">
                                <div class="flex">
                                    <div class="w-1/2">
                                        <div id="hs-wrapper-for-copy-one" class="space-y-3">
                                            <p class="-mb-2 text-sm font-medium">Complainant/s <span class="text-xs italic text-green-500">(Must be added in client list)</span></p>
                                            @foreach ($editComplainants as $index => $complainant)
                                                <div id="copy-markup-item-{{ $index }}" class="space-y-3">
                                                    <div class="flex space-x-3">
                                                        <x-select
                                                            
                                                            wire:model="editComplainants.{{ $index }}"
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
                                                        @if ($index > 0)
                                                            <button type="button" wire:click="removeComplainant({{ $index }})" 
                                                                class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
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
                                            <button type="button" wire:click="addComplainant" class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                                <path d="M12 5v14"></path>
                                            </svg>
                                            Add Complainant
                                            </button>
                                        </p>
                                    </div>
                                    <div class="w-1 bg-slate-300 rounded-full mx-5">
            
                                    </div>
                                    <div class="w-1/2">
                                        <!-- Input Group -->
                                        <div id="hs-wrapper-for-copy" class="space-y-3">
                                            <p class="-mb-2 text-sm font-medium">Respondent/s <span class="text-xs italic text-green-500">(Name, Sex, Age, Address, separated by commas.)</span></p>
                                            @foreach ($editRespondents as $index => $respondent)
                                                <div id="copy-markup-item-{{ $index }}" class="space-y-3">
                                                    <div class="flex space-x-3">
                                                        <input type="text" wire:model.blur="editRespondents.{{ $index }}" 
                                                            class="py-2 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                                                            placeholder="Enter Name, Sex, Age, Address" 
                                                        >
                                                        @if ($index > 0)
                                                            <button type="button" wire:click="removeRespondent({{ $index }})" 
                                                                class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
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
                                            <button type="button" wire:click="addRespondent" class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                                <path d="M12 5v14"></path>
                                            </svg>
                                            Add Respondent
                                            </button>
                                        </p>
                                        <!-- End Input Group -->
                                    </div>
                                </div>                     
                            </div>
                            
                            <div class="col-span-1 sm:col-span-2">
                                <div class="w-full rounded-md mt-10 dashed-container-light">
                                    <div class="grid grid-cols-1 gap-4 mb-3">
                                        <div class="flex">
                                            <div class="w-1/2">
                                                <div id="hs-wrapper-for-copy-one" class="space-y-3">
                                                    <p class="-mb-2 text-sm font-medium">Law/s Violated <span class="text-xs italic text-green-500">(Must be added in Case Type list)</span></p>
                                                    @foreach ($editLaws as $index => $law)
                                                        <div id="copy-markup-item-one-{{ $index }}" class="space-y-3">
                                                            <div class="flex space-x-3">
                                                                <x-select
                                                                    wire:model.blur="editLaws.{{ $index }}"
                                                                    placeholder="Ex: Murder"
                                                                    :async-data="route('api.case.sub-types')"
                                                                    option-label="name"
                                                                    option-value="id"
                                                                />
                                                                <!-- Only show delete button for inputs other than the first one -->
                                                                @if ($index > 0)
                                                                    <button type="button" wire:click="removeLaw({{ $index }})" class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
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
                                                    <button type="button" wire:click="addLaw" class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M5 12h14"></path>
                                                        <path d="M12 5v14"></path>
                                                    </svg>
                                                    Add Law
                                                    </button>
                                                </p>
                                            </div>
                                            <div class="w-1 bg-slate-300 rounded-full mx-5">
                    
                                            </div>
                                            <div class="w-1/2">
                                                <!-- Input Group -->
                                                <div id="hs-wrapper-for-copy" class="space-y-3">
                                                    <p class="-mb-2 text-sm font-medium">Witness/es <span class="text-xs italic text-green-500">(Name, Sex, Age, Address, separated by commas.)</span></p>
                                                    @foreach ($editWitnesses as $index => $witness)
                                                        <div id="copy-markup-item-{{ $index }}" class="space-y-3">
                                                            <div class="flex space-x-3">
                                                                <input type="text" wire:model.blur="editWitnesses.{{ $index }}" class="py-2 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Name, Sex, Age, Address">
                                                                
                                                                <!-- Only show delete button for inputs other than the first one -->
                                                                @if ($index > 0)
                                                                    <button type="button" wire:click="removeWitness({{ $index }})" class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
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
                                                    <button type="button" wire:click="addWitness" class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M5 12h14"></path>
                                                        <path d="M12 5v14"></path>
                                                    </svg>
                                                    Add Witness
                                                    </button>
                                                </p>
                                                <!-- End Input Group -->
                                            </div>
                                        </div>   
                                    </div>
                                </div> 
                                <div class="w-full rounded-md mt-10 dashed-container-light">
                                    <div class="grid grid-cols-2 gap-5">
                                        <x-datetime-picker
                                            label="Date & Time of Commission"
                                            placeholder="Ex: "
                                            wire:model.defer="editDateTimeCommission"
                                        />
                                        <x-input label="Place of Commission" placeholder="Ex: Brgy. Zone III, Lucena City" wire:model="editPlaceOfCommission" />
                                    </div>
                                </div>  
                                <div class="w-full rounded-md mt-10 dashed-container-light">
                                    <div class="grid grid-cols-1 gap-5">
                                        <div class="flex items-center gap-5">
                                            <p>1. Has a similar complaint been filed before any offices?</p>
                                            <div class="w-20 border-t-2 border-indigo-500 border-dashed"></div>
                                            <x-toggle label="Yes" left-label="No" wire:model.defer="editQuestionOne" />
                                        </div>
                                        <div class="flex items-center gap-5">
                                            <p>2. Is this complaint in the nature of counter-charge?</p>
                                            <div class="w-20 border-t-2 border-indigo-500 border-dashed"></div>
                                            <x-toggle label="Yes" left-label="No" wire:model.defer="editQuestionTwo" />
                                        </div>
                                        <div class="flex items-center gap-5">
                                            <p>2. Is this complaint related to another case before this Office?</p>
                                            <div class="w-20 border-t-2 border-indigo-500 border-dashed"></div>
                                            <x-toggle label="Yes" left-label="No" wire:model.defer="editQuestionThree" />
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full rounded-md mt-10 dashed-container-light">
                                    <div class="grid grid-cols-2 gap-5">
                                        <x-input label="IS NO." placeholder="Ex: 237-22C-1333" wire:model="editISNo" />
                                        <x-input label="Handling Prosecutor" placeholder="Ex: John Kramer" wire:model="editHandlingProsecutor" />
                                    </div>
                                </div>               
                            </div>
                        </div>
                    </div>
                </div>
                <x-slot name="footer">
                    <div class="flex justify-end gap-x-4">
                        <div class="flex">
                            <x-button flat label="Cancel" x-on:click="close" wire:click="cancel" />
                            <x-button primary label="Save" wire:click="updateCaseDetails({{ $selectedCaseId }})" />
                        </div>
                    </div>
                </x-slot>
            </form>
        </x-card>
    </x-modal>
</div>
