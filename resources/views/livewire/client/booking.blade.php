<div class="w-full h-svh pt-20 md:pt-32 flex flex-col items-center">
    <div class="w-full md:w-1/2 flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
        <div class="bg-gray-100 border-b rounded-t-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
            <p class="mt-1 text-sm text-gray-500 dark:text-neutral-500">
            Create Appointment
            </p>
        </div>
        <div class="p-4 md:p-5">
            <form wire:submit.prevent="createAppointment" class="w-full flex justify-center">
                <div  class="w-full md:w-[90%]">
                    <ul class="relative flex flex-row gap-x-2 mb-5">
                        <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group">
                            <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
                            <span class="size-7 flex justify-center items-center flex-shrink-0 font-medium text-gray-800 rounded-full {{ $currentStep == 1 || $isFinishedStepOne == true ? 'bg-blue-600 text-white' : 'text-gray-800'}}">
                                <span class="{{ $isFinishedStepOne == true ? 'hidden' : ''}}">1</span>
                                <svg class="flex-shrink-0 size-3 {{ $isFinishedStepOne == true ? 'block' : 'hidden'}}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </span>
                            <span class="ms-2 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                Appointment Date
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
                                Appointment Details
                            </span>
                            </span>
                            <div class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-blue-600 hs-stepper-completed:bg-teal-600 dark:bg-neutral-700 dark:hs-stepper-success:bg-blue-600 dark:hs-stepper-completed:bg-teal-600"></div>
                        </li>
                        <!-- End Item -->
                    </ul>
                    @if ($currentStep == 1)
                        <div class="border border-1 border-gray-500 border-dashed my-3 p-5 rounded-xl">
                            <x-datetime-picker
                                label="Appointment Date"
                                placeholder="Appointment Date"
                                parse-format="DD-MM-YYYY"
                                display-format="MMMM DD, YYYY"
                                wire:model.blur="appointmentDate"
                                :min="now()"
                                without-time="true"
                            />
            
                            <div class="col-span-1 sm:col-span-2 mt-5">
                                <span class="text-sm font-medium text-gray-700">Select Time:</span>
                                <ul class="grid w-full grid-cols-3 gap-4 md:grid-cols-6 mt-1">
                                    @foreach($timeSlots as $index => $time)
                                        <li>
                                            <input wire:model.live="selectedTimeSlot" class="hidden peer" id="timeslot-{{ $index }}" type="radio" value="{{ $time['storage'] }}" />
                                            <label class="inline-flex items-center justify-between w-full p-3 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="timeslot-{{ $index }}">
                                                <div class="block w-full">
                                                    <div class="w-full text-sm md:text-base font-medium text-center">
                                                        <span>{{ $time['display'] }}</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-6 text-sm font-medium border-t border-1 border-gray-400 pt-6">
                                Selected Date & Time: 
                                <span class="font-bold text-base text-blue-700">
                                    {{ $appointmentDate ? \Carbon\Carbon::parse($appointmentDate)->format('F j, Y') : '' }}
                                </span>
                                @if ($selectedTimeSlot)
                                    <span class="text-gray-500 text-xs">AT</span>
                                    <span class="font-bold text-base text-blue-700">
                                        {{ \Carbon\Carbon::createFromFormat('H:i', $selectedTimeSlot)->format('h:i A');}}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @elseif($currentStep == 2)
                        <div class="border border-1 border-gray-500 border-dashed my-3 p-5 rounded-xl">
                            <div class="col-span-1 sm:col-span-2">
                                <div id="hs-wrapper-for-copy-one" class="space-y-3">
                                    <p class="-mb-2 text-sm font-medium">Service/s</p>
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
                                <div class="col-span-1 sm:col-span-2 mt-5">
                                    <div class="py-3 flex items-center text-sm font-medium text-gray-800 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-neutral-600">Payment Method</div>
                                    <ul class="grid w-full gap-6 md:grid-cols-2">
                                        <li>
                                            <input wire:model="payment_method" class="hidden peer" id="hosting-small" required="" type="radio" value="Cash" />
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
                                            <input wire:model="payment_method" class="hidden peer" id="hosting-big" type="radio" value="Stripe">
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
                                </div>
                                <div class="mt-6 text-sm font-medium border-t border-1 border-gray-400 pt-6">
                                    Total Price: <span class="font-bold text-green-500">{{ number_format($this->totalPrice, 2) }}</span>
                                </div>

                            </div>
                            
                        </div>
                    @endif
                    <div class="flex">
                        @if ($currentStep > 1)
                            <button wire:click="backStep" type="button" class="justify-start mt-4 py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none"
                            {{  $currentStep == 1 ? 'disabled="disabled"' : '' }}
                            >
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"></path>
                                </svg>
                                Back
                            </button>
                        @endif

                        @if ($currentStep < 2)
                            <button wire:click="nextStep" type="button" class="ml-auto mt-4 py-2 px-3 inline-flex items-center gap-x-1 text-base font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            {{ !$appointmentDate || !$selectedTimeSlot  ? 'disabled="disabled"' : '' }}
                            >
                                Next
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </button>
                        @else
                            <button type="submit" class="ml-auto mt-4 py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                wire:loading.attr="disabled" wire:target="createAppointment"
                            >
                                <span wire:loading.remove class="flex items-center">
                                    Finish
                                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6"></path>
                                    </svg>
                                </span>
                                <span wire:loading>
                                    Processing...
                                    
                                </span>
                            </button>
                        @endif
                        
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
    
</div>
