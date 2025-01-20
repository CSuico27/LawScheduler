<div class="w-full h-full flex flex-row">
    <div class="w-[50%] h-screen flex flex-col justify-center items-center gap-5">
        <h1 class="text-4xl font-medium">Create your account</h1>
        <p>Sign up now and get an appointment.</p>
        <div class="w-full flex flex-col justify-center items-center mt-10">
            {{-- <div class="space-y-6 w-[50%]">
                <div class="relative">
                    <input type="email" class="peer py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" placeholder="Enter email">
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                    <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    </div>
                </div>
                
                <div class="relative">
                    <input type="password" class="peer py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" placeholder="Enter password">
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                    <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z"></path>
                        <circle cx="16.5" cy="7.5" r=".5"></circle>
                    </svg>
                    </div>
                </div>
                <div class="flex justify-end">
                    <a href="#" class="underline">Forgot password</a>
                </div>
            </div> --}}
            {{-- <div class="w-[80%] flex gap-2">
                <div class="w-full space-y-3">
                    <div>
                        <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                        <div class="relative">
                            <x-input label="First name" placeholder="ex: John" class="py-3 -mt-1" />
                        </div>
                    </div>
                </div>
                <div class="w-full space-y-3">
                    <div>
                        <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                        <div class="relative">
                            <x-input label="Middle name" placeholder="ex: Kramer" class="py-3 -mt-1" />
                        </div>
                    </div>
                </div>
                <div class="w-full space-y-3">
                    <div>
                        <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                        <div class="relative">
                            <x-input label="Last name" placeholder="ex: Doe" class="py-3 -mt-1" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-[80%] flex gap-2 mt-5">
                <div class="w-full space-y-3">
                    <div>
                        <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                        <div class="relative">
                            <x-input label="Email" placeholder="ex: johndoe@gmai.com" class="py-3 -mt-1" />
                        </div>
                    </div>
                </div>
                <div class="w-full space-y-3">
                    <div>
                        <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                        <div class="relative">
                            <x-inputs.phone label="Mobile No." placeholder="+63 912 345 6789" mask="['+63 ### ### ####']" class="py-3 -mt-1" />
                        </div>
                    </div>
                </div>
            </div> --}}
            <form wire:submit.prevent="register" class="w-full flex justify-center">
                <div  class="w-[80%]">
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
                                Personal Information
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
                                Create Account
                            </span>
                            </span>
                            <div class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-blue-600 hs-stepper-completed:bg-teal-600 dark:bg-neutral-700 dark:hs-stepper-success:bg-blue-600 dark:hs-stepper-completed:bg-teal-600"></div>
                        </li>
                        <!-- End Item -->
                    </ul>
                    @if ($currentStep == 2)
                        <div class="p-4 h-auto bg-gray-50 flex justify-center items-center border border-dashed border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                            <div class="w-[90%]">
                                {{ $streetAddress }}
                                {{ $barangay }}
                                <div class="w-full flex flex-col gap-2">
                                    <div class="w-full space-y-3 mb-2">
                                        <div>
                                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                                            <div class="relative">
                                                <x-input label="Email" placeholder="ex: johndoe@gmai.com" class="py-3 -mt-1" wire:model="email" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full space-y-3">
                                        <div>
                                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                                            <div class="relative">
                                                <x-inputs.phone label="Mobile No." placeholder="+63 912 345 6789" mask="['+63 ### ### ####']" class="py-3 -mt-1" wire:model="phone" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full flex gap-2 mt-4 mb-5">
                                    <div class="w-full space-y-3">
                                        <div>
                                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                                            <div class="relative">
                                                <x-input type="password" label="Password" placeholder="Enter your password" class="py-3 -mt-1" wire:model="password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full space-y-3">
                                        <div>
                                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                                            <div class="relative">
                                                <x-input type="password" label="Confirm Password" placeholder="Confirm password" class="py-3 -mt-1" wire:model="confirmPassword" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="p-4 h-auto bg-gray-50 flex justify-center items-center border border-dashed border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                            <div class="w-[90%]">
                                {{ $streetAddress }}
                                {{ $barangay }}
                                <div class="w-full flex gap-2">
                                    <div class="w-full space-y-3">
                                        <div>
                                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                                            <div class="relative">
                                                <x-input label="First name" placeholder="ex: John" class="py-3 -mt-1" wire:model.blur="firstName" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full space-y-3">
                                        <div>
                                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                                            <div class="relative">
                                                <x-input label="Middle name" placeholder="ex: Kramer" class="py-3 -mt-1" wire:model.blur="middleName" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full space-y-3">
                                        <div>
                                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                                            <div class="relative">
                                                <x-input label="Last name" placeholder="ex: Doe" class="py-3 -mt-1" wire:model.blur="lastName" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full flex gap-5 mt-5">
                                    <x-select
                                        label="Select Street"
                                        placeholder="ex: Malabana St."
                                        wire:model.blur="streetAddress"
                                    >
                                        <x-select.user-option src="https://via.placeholder.com/500" label="Street 1" value="Street 1" />
                                        <x-select.user-option src="https://via.placeholder.com/500" label="Street 2" value="Street 2" />
                                        <x-select.user-option src="https://via.placeholder.com/500" label="Street 3" value="Street 3" />
                                        <x-select.user-option src="https://via.placeholder.com/500" label="Street 4" value="Street 4" />
                                    </x-select>

                                    <x-select
                                        label="Select Barangay"
                                        placeholder="ex: Zone 1"
                                        wire:model.blur="barangay"
                                    >
                                        <x-select.user-option src="https://via.placeholder.com/500" label="Zone 1" value="Zone 1" />
                                        <x-select.user-option src="https://via.placeholder.com/500" label="Zone 2" value="Zone 2" />
                                        <x-select.user-option src="https://via.placeholder.com/500" label="Zone 3" value="Zone 3" />
                                        <x-select.user-option src="https://via.placeholder.com/500" label="Zone 4" value="Zone 4" />
                                    </x-select>
                                </div>

                                <div class="w-full flex gap-5 mt-5 mb-4">
                                    <x-select
                                        label="City"
                                        placeholder="Select City"
                                        wire:model.defer="city"
                                        disabled
                                    >
                                        <x-select.user-option src="https://via.placeholder.com/500" label="Tayabas City" value="Tayabas City" />
                                    </x-select>

                                    <x-select
                                        label="State"
                                        placeholder="Select State"
                                        wire:model.defer="state"
                                        disabled
                                    >
                                        <x-select.user-option src="https://via.placeholder.com/500" label="Philippines" value="Philippines" />
                                    </x-select>

                                    <x-select
                                        label="Zip Code"
                                        placeholder="Select Zip Code"
                                        wire:model.defer="zipCode"
                                        disabled
                                    >
                                        <x-select.user-option src="https://via.placeholder.com/500" label="4306" value="4306" />
                                    </x-select>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="flex">
                        @if ($currentStep > 1)
                            <button wire:click="backStep" type="button" class="ml-auto mt-4 py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            {{  $currentStep == 1 ? 'disabled="disabled"' : '' }}
                            >
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m15 18-6-6 6-6"></path>
                                </svg>
                                Back
                            </button>
                        @endif

                        @if ($currentStep < 2)
                            <button wire:click="nextStep" type="button" class="ml-auto mt-4 py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            {{ !$firstName || !$middleName || !$lastName || !$streetAddress || !$barangay  ? 'disabled="disabled"' : '' }}
                            >
                                Next
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </button>
                        @else
                            <button type="submit" class="ml-auto mt-4 py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                            >
                                Finish
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6"></path>
                                </svg>
                            </button>
                        @endif
                        
                    </div>
                    
                </div>
            </form>
        </div>
        <div class="flex flex-col mt-5 lg:-mt-11">
            <div class="flex gap-1">
                <p>Already have an account?</p>
                <a href="{{ route('login')}}">Sign in</a>
            </div>
            <img src="{{ asset('images/sign-2.png')}}" alt="" class="w-16 self-end -mt-1">
        </div>
    </div>
    <div class="w-[50%] h-screen rounded-l-[8%] overflow-hidden relative">
        <img src="{{ asset('images/building2.jpg') }}" alt="" class="object-cover object-right-bottom w-auto h-full">
        <a class="flex items-center justify-center text-white font-medium text-5xl absolute inset-0 m-auto">
            <img src="{{ asset('images/logo-white.png') }}" alt="">
            Law Scheduler
        </a>
    </div>
</div>
