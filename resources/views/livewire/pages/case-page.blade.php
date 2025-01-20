<div class="w-full h-full">
    <div class="container dashed-container flex flex-col-reverse md:flex-row md:flex">
        <div class="w-full flex md:justify-start md:mt-0 items-center justify-center mt-3 ">
            <button type="button" wire:loading.attr="disabled" wire:loading.class="!cursor-wait" onclick="$openModal('newCaseModal')" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55">
                {{-- <x-icon name="user-add" class="w-5 h-5" /> --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                </svg>
                  
                Create New Case
            </button>
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
                        Court Detail
                    </th>
                    <th scope="col" class="px-4 py-2 text-blue-950">
                        Petitioner vs Respondent
                    </th>
                    <th scope="col" class="px-4 py-2 text-blue-950">
                        Next Date
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
                                <x-icon name="information-circle" class="w-5 h-5" /><h1>No case found.</h1>
                            </div>
                        </td>
                    </tr>
                @else
                    @if ($caseList)
                        @foreach ($caseList as $case)
                            @if ($case->user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex flex-col">
                                            <div class="hs-tooltip inline-block"> 
                                                <a class="hs-tooltip-toggle underline cursor-pointer hover:text-blue-600">
                                                    <div class="flex items-center gap-1">
                                                        <img src="{{ asset($case->user->profile_picture) }}" alt="{{ $case->user->name }}" class="w-8 h-8">
                                                        {{ $case->user->name }}
                                                    </div>
                                                    <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                                                        Full Case Details
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="ml-9">
                                                <span class="text-gray-500 font-normal">No:</span> {{ $case->case_no }}
                                            </div>
                                            <div class="ml-9">
                                                <span class="text-gray-500 font-normal">Case:</span> 
                                                @if ($case->caseSubType)
                                                    {{ $case->caseSubType->name }}
                                                @endif 
                                            </div>
                                        </div>
                                    </td>
                                    <td scope="row" class="px-4 py-2 h-auto" >
                                       <div>
                                            <div>
                                                Court: <span class="font-medium text-gray-900">{{ $case->court }}</span>
                                            </div>
                                            <div>
                                                No: <span class="font-medium text-gray-900">{{ $case->court_number }}</span>
                                            </div>
                                            <div>
                                                Magistrate: <span class="font-medium text-gray-900">{{ $case->judge_name }}</span>
                                            </div>
                                       </div>
                                    </td>
                                    <td class="px-4 py-2">
                                        <div>
                                            <div class="flex items-center gap-1">
                                                <img src="{{ asset($case->user->profile_picture) }}" alt="{{ $case->user->name }}" class="w-8 h-8">
                                                <span class="font-medium text-gray-900">{{ $case->user->name }}</span>
                                            </div>
                                            <div class="py-1 flex items-center text-sm text-gray-800 before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:before:border-neutral-600 dark:after:border-neutral-600">VS</div>
                                            @foreach (json_decode($case->respondents) as $respondent)
                                                <div class="pl-9">
                                                    <span class="font-medium text-gray-900">{{ $respondent }}</span>
                                                </div>
                                            @endforeach
                                       </div>
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ \Carbon\Carbon::parse($case->first_hearing_date)->format('F j, Y') }}
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
                                        <div class="flex gap-5">
                                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="$openModal('editCaseModal')" wire:click="getSelectedCaseId({{ $case->id }})">Edit</a>
                                            <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" wire:click="deleteConfirmation({{ $case->id }}, '{{  $case->case_no }}')">Delete</a>
                                        </div>  
                                    </td>
                                </tr> 
                            @endif
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
    <x-modal.card title="New Case" name="newCaseModal" blur wire:model.defer="newCaseModal" align="center" max-width="6xl">
        <form >
            <div class="grid grid-cols-12 sm:grid-cols-1 gap-4">
                <div  class="w-full">
                    <ul class="relative flex flex-row justify-center items-center gap-x-2 mb-8">
                        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group">
                            <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                            <span class="size-7 flex justify-center items-center flex-shrink-0 font-medium text-gray-800 rounded-full {{ $currentStep == 1 || $isFinishedStepOne == true ? 'bg-blue-600 text-white' : 'text-gray-800'}}">
                                <span class="{{ $isFinishedStepOne == true ? 'hidden' : ''}}">1</span>
                                <svg class="flex-shrink-0 size-3 {{ $isFinishedStepOne == true ? 'block' : 'hidden'}}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <span class="ms-2 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                Setting Up
                            </span>
                            </span>
                            <div class="w-full h-px flex-1 {{ $isFinishedStepOne == true ? 'bg-blue-600' : 'bg-gray-200'}}"></div>
                        </li>
                    
                        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group">
                            <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                            <span class="size-7 flex justify-center items-center flex-shrink-0 font-medium text-gray-800 rounded-full {{ $currentStep == 2 || $isFinishedStepOne == true ? 'bg-blue-600 text-white' : 'text-gray-800'}}">
                                <span class="hs-stepper-success:hidden hs-stepper-completed:hidden">2</span>
                                <svg class="hidden flex-shrink-0 size-3 hs-stepper-success:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <span class="ms-2 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                Almost Done
                            </span>
                            </span>
                            <div class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-blue-600 hs-stepper-completed:bg-teal-600 dark:bg-neutral-700 dark:hs-stepper-success:bg-blue-600 dark:hs-stepper-completed:bg-teal-600"></div>
                        </li>
                        <!-- End Item -->
                    </ul>
                    @if ($currentStep == 1)
                        <div class="w-full rounded-md dashed-container">
                            <div class="col-span-1 sm:col-span-2 my-3">
                                <div class="flex">
                                    <div class="w-1/2">
                                        <x-select
                                            label="Petitioner"
                                            wire:model.blur="petitioner"
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
                                    <div class="w-1 bg-slate-300 rounded-full mx-5">
            
                                    </div>
                                    <div class="w-1/2">
                                        <!-- Input Group -->
                                        <div id="hs-wrapper-for-copy" class="space-y-3">
                                            <p class="-mb-2 text-sm font-medium">Respondent</p>
                                            @foreach ($respondents as $index => $respondent)
                                                <div id="copy-markup-item-{{ $index }}" class="space-y-3">
                                                    <div class="flex space-x-3">
                                                        <input type="text" wire:model.blur="respondents.{{ $index }}" class="py-2 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Enter Name">
                                                        
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
                                <div class="w-full rounded-md dashed-container-light">
                                    <div class="mb-3">
                                        <h1>Case Details</h1>
                                        <div class="w-24 h-1 rounded-full bg-blue-950"></div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4 mb-3">
                                        <x-input label="Case No." placeholder="Ex: 2024111000" wire:model.blur="caseNumber" />
                                        <x-select
                                            label="Case Type"
                                            wire:model.blur="caseType"
                                            placeholder="Ex: Criminal Case"
                                            :async-data="route('api.case.types')"
                                            option-label="name"
                                            option-value="id"
                                        />
                                        <x-select
                                            label="Case Sub Type"
                                            wire:model.blur="caseSubType"
                                            placeholder="Ex: Murder"
                                            :async-data="route('api.case.sub-types')"
                                            option-label="name"
                                            option-value="id"
                                        />
                                    </div>
                                    <div class="col-span-1 sm:col-span-2 mb-3">
                                        <div class="grid grid-cols-2 gap-4">
                                            <x-select
                                                label="Case Stage"
                                                wire:model.blur="caseStage"
                                                placeholder="Ex: On-Trial"
                                                :async-data="route('api.case.stage')"
                                                option-label="name"
                                                option-value="id"
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
                                    <div class="col-span-1 sm:col-span-2 mb-3">
                                        <div class="grid grid-cols-3 gap-4">
                                            <x-input label="Act" placeholder="Ex: Find Evidences" wire:model.blur="act" />
                                            <x-input label="Filing Number" placeholder="Ex: 2024111000" wire:model.blur="filingNumber" />
                                            <x-datetime-picker
                                                label="Filing Date"
                                                placeholder="Ex: 23-07-2024"
                                                display-format="DD-MM-YYYY"
                                                wire:model.blur="filingDate"
                                                without-time
                                            />
                                        </div>
                                    </div>
                                    <div class="col-span-1 sm:col-span-2 mb-3">
                                        <div class="grid grid-cols-3 gap-4">
                                            <x-input label="Registration Number" placeholder="Ex: 2024111000" wire:model.blur="registrationNumber" />
                                            <x-datetime-picker
                                                label="Registration Date"
                                                placeholder="Ex: 23-07-2024"
                                                display-format="DD-MM-YYYY"
                                                wire:model.blur="registrationDate"
                                                without-time
                                            />
                                            <x-datetime-picker
                                                label="First Hearing Date"
                                                placeholder="Ex: 23-07-2024"
                                                display-format="DD-MM-YYYY"
                                                wire:model.blur="firstHearingDate"
                                                without-time
                                            />
                                        </div>
                                    </div>
                                    <div class="col-span-1 sm:col-span-2 mb-3">
                                        <div class="grid grid-cols-2 gap-4">
                                            <x-input label="CNR Number" placeholder="Ex: 2024111000" wire:model.blur="CNRNumber" />
                                            <x-textarea label="Description" placeholder="write a description" wire:model.blur="description" />
                                        </div>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                    @elseif($currentStep == 2)
                        <div class="w-full rounded-md dashed-container">
                            <div class="col-span-1 sm:col-span-2">
                                <div class="w-full">
                                    <div class="mb-3">
                                        <h1>Court Details</h1>
                                        <div class="w-24 h-1 rounded-full bg-blue-950"></div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4 mb-3">
                                        <x-input label="Court No." placeholder="Ex: 2024111000" wire:model.blur="courtNumber" />
                                        <x-select
                                            label="Court Type"
                                            wire:model.blur="courtType"
                                            placeholder="Ex: Regional Trial Court"
                                            :async-data="route('api.court.types')"
                                            option-label="name"
                                            option-value="id"
                                        />
                                        @if ($courtType)
                                            <x-select
                                                label="Court"
                                                wire:model.blur="court"
                                                placeholder="Ex: RTC - Branch IV-A"
                                                :async-data="$courtType ? route('api.court.byType', ['courtTypeId' => $courtType]) : ''"
                                                option-label="name"
                                                option-value="id"
                                            />
                                        @else
                                            <x-select
                                                label="Court"
                                                wire:model.blur="court"
                                                placeholder="Ex: RTC - Branch IV-A"
                                                :async-data="$courtType ? route('api.court.byType', ['courtTypeId' => $courtType]) : ''"
                                                option-label="name"
                                                option-value="id"
                                                disabled
                                            />
                                        @endif
                                        
                                    </div>
                                    <div class="col-span-1 sm:col-span-2 mb-3">
                                        <div class="grid grid-cols-2 gap-4">
                                            {{-- <x-select
                                                label="Judge Type"
                                                wire:model.blur="judgeType"
                                                placeholder="Ex: On-Trial"
                                                :async-data="route('api.case.stage')"
                                                option-label="name"
                                                option-value="id"
                                            /> --}}
                                            <x-input label="Judge Type" placeholder="Ex: 2024111000" wire:model.blur="judgeType" />
                                            <x-input label="Judge Name" placeholder="Ex: Atty. Juan Dela Cruz" wire:model.blur="judgeName" />
                                        </div>
                                    </div>
                                    <div class="col-span-1 sm:col-span-2 mb-3">
                                        <x-textarea label="Remarks" placeholder="write a remarks" wire:model.blur="remarks" />
                                    </div>
                                </div>                    
                            </div>
                            <div class="col-span-1 sm:col-span-2">
                                <div class="rounded-md dashed-container-light">
                                    <div class="mb-3">
                                        <h1>FIR Details</h1>
                                        <div class="w-24 h-1 rounded-full bg-blue-950"></div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4 mb-3">
                                        <x-input label="Police Station" placeholder="Ex: Police District II" wire:model.blur="policeStation" />
                                        <x-input label="FIR Number" placeholder="Ex: 0000000" wire:model.blur="FIRNumber" />
                                        <x-datetime-picker
                                            label="FIR Date"
                                            placeholder="Ex: 23-07-2024"
                                            display-format="DD-MM-YYYY"
                                            wire:model.blur="FIRDate"
                                            without-time
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="flex">
                        @if ($currentStep > 1)
                            <button wire:click="backStep" type="button" class="justify-start py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                            {{  $currentStep == 1 ? 'disabled="disabled"' : '' }}
                            >
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"></path>    
                                </svg>
                                Back
                            </button>
                        @endif

                        @if ($currentStep < 2)
                            <button wire:click="nextStep" type="button" class="ml-auto py-2 px-3 inline-flex items-center gap-x-1 text-base font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            {{ !$petitioner || !$caseType || !$caseSubType || !$caseStage || !$priorityLevel || !$act || !$filingNumber || !$filingDate || !$registrationNumber || !$registrationDate || !$firstHearingDate || !$CNRNumber  ? 'disabled="disabled"' : '' }}
                            >
                                Next
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </button>
                        @endif
                        
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
    </x-modal.card>
    
    {{-- EDIT CASE MODAL --}}
    <x-modal name="editCaseModal" blur wire:model.defer="editCaseModal" align="center" max-width="6xl">
        <x-card title="Edit Case">
            <form >
                <div class="grid grid-cols-12 sm:grid-cols-1 gap-4">
                    <div  class="max-h-[500px] overflow-y-auto
                    [&::-webkit-scrollbar]:w-2
                    [&::-webkit-scrollbar-track]:rounded-full
                    [&::-webkit-scrollbar-track]:bg-gray-100
                    [&::-webkit-scrollbar-thumb]:rounded-full
                    [&::-webkit-scrollbar-thumb]:bg-gray-300
                    dark:[&::-webkit-scrollbar-track]:bg-neutral-700
                    dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                        <div class="w-full rounded-md dashed-container">
                            <div class="col-span-1 sm:col-span-2 my-3">
                                <div class="flex">
                                    <div class="w-1/2">
                                        <x-select
                                            label="Petitioner"
                                            wire:model="editPetitioner"
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
                                    <div class="w-1 bg-slate-300 rounded-full mx-5">
            
                                    </div>
                                    <div class="w-1/2">
                                        <!-- Input Group -->
                                        <div id="hs-wrapper-for-copy" class="space-y-3">
                                            <p class="-mb-2 text-sm font-medium">Respondent</p>
                                            @foreach ($editRespondents as $index => $respondent)
                                                <div id="copy-markup-item-{{ $index }}" class="space-y-3">
                                                    <div class="flex space-x-3">
                                                        <input type="text" wire:model.blur="editRespondents.{{ $index }}" class="py-2 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Enter Name">
                                                        
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
                                <div class="w-full rounded-md dashed-container-light">
                                    <div class="mb-3">
                                        <h1>Case Details</h1>
                                        <div class="w-24 h-1 rounded-full bg-blue-950"></div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4 mb-3">
                                        <x-input label="Case No." placeholder="Ex: 2024111000" wire:model="editCaseNumber" />
                                        <x-select
                                            label="Case Type"
                                            wire:model="editCaseType"
                                            placeholder="Ex: Criminal Case"
                                            :async-data="route('api.case.types')"
                                            option-label="name"
                                            option-value="id"
                                        />
                                        <x-select
                                            label="Case Sub Type"
                                            wire:model="editCaseSubType"
                                            placeholder="Ex: Murder"
                                            :async-data="route('api.case.sub-types')"
                                            option-label="name"
                                            option-value="id"
                                        />
                                    </div>
                                    <div class="col-span-1 sm:col-span-2 mb-3">
                                        <div class="grid grid-cols-2 gap-4">
                                            <x-select
                                                label="Case Stage"
                                                wire:model="editCaseStage"
                                                placeholder="Ex: On-Trial"
                                                :async-data="route('api.case.stage')"
                                                option-label="name"
                                                option-value="id"
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
                                    <div class="col-span-1 sm:col-span-2 mb-3">
                                        <div class="grid grid-cols-3 gap-4">
                                            <x-input label="Act" placeholder="Ex: Find Evidences" wire:model="editAct" />
                                            <x-input label="Filing Number" placeholder="Ex: 2024111000" wire:model="editFilingNumber" />
                                            <x-datetime-picker
                                                label="Filing Date"
                                                placeholder="Ex: 23-07-2024"
                                                display-format="DD-MM-YYYY"
                                                wire:model.defer="editFilingDate"
                                                without-time
                                            />
                                        </div>
                                    </div>
                                    <div class="col-span-1 sm:col-span-2 mb-3">
                                        <div class="grid grid-cols-3 gap-4">
                                            <x-input label="Registration Number" placeholder="Ex: 2024111000" wire:model="editRegistrationNumber" />
                                            <x-datetime-picker
                                                label="Registration Date"
                                                placeholder="Ex: 23-07-2024"
                                                display-format="DD-MM-YYYY"
                                                wire:model="editRegistrationDate"
                                                without-time
                                            />
                                            <x-datetime-picker
                                                label="First Hearing Date"
                                                placeholder="Ex: 23-07-2024"
                                                display-format="DD-MM-YYYY"
                                                wire:model="editFirstHearingDate"
                                                without-time
                                            />
                                        </div>
                                    </div>
                                    <div class="col-span-1 sm:col-span-2 mb-3">
                                        <div class="grid grid-cols-2 gap-4">
                                            <x-input label="CNR Number" placeholder="Ex: 2024111000" wire:model="editCNRNumber" />
                                            <x-textarea label="Description" placeholder="write a description" wire:model="editDescription" />
                                        </div>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                            
                        <div class="w-full rounded-md dashed-container">
                            <div class="col-span-1 sm:col-span-2">
                                <div class="mb-3">
                                    <h1>FIR Details</h1>
                                    <div class="w-24 h-1 rounded-full bg-blue-950"></div>
                                </div>
                                <div class="grid grid-cols-3 gap-4 mb-3">
                                    <x-input label="Police Station" placeholder="Ex: Police District II" wire:model="editPoliceStation" />
                                    <x-input label="FIR Number" placeholder="Ex: 0000000" wire:model="editFIRNumber" />
                                    <x-datetime-picker
                                        label="FIR Date"
                                        placeholder="Ex: 23-07-2024"
                                        display-format="DD-MM-YYYY"
                                        wire:model="editFIRDate"
                                        without-time
                                    />
                                </div>
                            </div>
                            <div class="col-span-1 sm:col-span-2">
                                <div class="w-full rounded-md dashed-container-light">
                                    <div class="mb-3">
                                        <h1>Court Details</h1>
                                        <div class="w-24 h-1 rounded-full bg-blue-950"></div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4 mb-3">
                                        <x-input label="Court No." placeholder="Ex: 2024111000" wire:model="editCourtNumber" />
                                        <x-select
                                            label="Court Type"
                                            wire:model="editCourtType"
                                            placeholder="Ex: Regional Trial Court"
                                            :async-data="route('api.court.types')"
                                            option-label="name"
                                            option-value="id"
                                        />
                                
                                        <x-select
                                            label="Court"
                                            wire:model="editCourt"
                                            placeholder="Ex: RTC - Branch III"
                                            :async-data="route('api.courts')"
                                            {{-- :async-data="$editCourtType ? route('api.court.byType', ['courtTypeId' => $editCourtType]) : ''" --}}
                                            option-label="name"
                                            option-value="id"
                                            always-fetch="true"
                                        />
                                    </div>
                                    <div class="col-span-1 sm:col-span-2 mb-3">
                                        <div class="grid grid-cols-2 gap-4">
                                            {{-- <x-select
                                                label="Judge Type"
                                                wire:model.blur="judgeType"
                                                placeholder="Ex: On-Trial"
                                                :async-data="route('api.case.stage')"
                                                option-label="name"
                                                option-value="id"
                                            /> --}}
                                            <x-input label="Judge Type" placeholder="Ex: 2024111000" wire:model="editJudgeType" />
                                            <x-input label="Judge Name" placeholder="Ex: Atty. Juan Dela Cruz" wire:model="editJudgeName" />
                                        </div>
                                    </div>
                                    <div class="col-span-1 sm:col-span-2 mb-3">
                                        <x-textarea label="Remarks" placeholder="write a remarks" wire:model="editRemarks" />
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
