<div class="w-full h-full flex flex-row justify-center">
    <div class="w-[90%] md:w-[50%] h-screen flex flex-col justify-center items-center gap-1 md:gap-0 mt-28 md:mt-0 md:pt-12">
        <h1 class="md:text-3xl text-2xl font-medium text-center">Create your account</h1>
        <p class="text-center">Sign up now and get an appointment.</p>
        <div class="w-full flex flex-col justify-center items-center">
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
                <div  class="w-full md:w-[90%]">
                    <ul class="relative flex flex-row gap-x-2 mb-3 md:mb-2">
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
                    @if ($currentStep == 1)
                        <div class="md:p-2 p-4 h-auto bg-gray-50 flex justify-center items-center border border-dashed border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                            <div class="w-full md:w-[95%]">
                                <div class="w-full flex flex-col md:flex-row gap-2">
                                    <div class="w-full space-y-3">
                                        <div>
                                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                                            <div class="relative">
                                                <x-input label="First name" placeholder="Ex: Juan" class="py-3 -mt-1" wire:model.blur="firstName" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full space-y-3">
                                        <div>
                                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                                            <div class="relative">
                                                <x-input label="Middle name" placeholder="Ex: Reyes" class="py-3 -mt-1" wire:model.blur="middleName" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full space-y-3">
                                        <div>
                                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                                            <div class="relative">
                                                <x-input label="Last name" placeholder="Ex: Dela Cruz" class="py-3 -mt-1" wire:model.blur="lastName" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full flex flex-col md:flex-row gap-5 mt-5">
                                    <x-select
                                        label="Select Region"
                                        wire:model.blur="region"
                                        placeholder="Ex: REGION IV-A (CALABARZON)"
                                        :async-data="route('api.regions.index')"
                                        :template="[
                                            'region_description'   => 'user-option',
                                        ]"
                                        option-label="region_description"
                                        option-value="region_description"
                                        {{-- option-description="region_description" --}}
                                        
                                    />
                                    @if (!$region)
                                        <x-select
                                            label="Select City/Province"
                                            wire:model.blur="province"
                                            placeholder="Ex: CITY OF MANILA"
                                            {{-- :async-data="route('location.region', ['regionCode' => $regionCode])" --}}
                                            :template="[
                                                'province_description'   => 'user-option',
                                            ]"
                                            option-label="province_description"
                                            option-value="province_description"
                                            {{-- option-description="province_description" --}}
                                            disabled
                                        />
                                    @else
                                        <x-select
                                            label="Select City/Province"
                                            wire:model.blur="province"
                                            placeholder="Ex: CITY OF MANILA"
                                            :async-data="route('location.province', ['regionCode' => $regionCode])"
                                            :template="[
                                                'province_description'   => 'user-option',
                                            ]"
                                            option-label="province_description"
                                            option-value="province_description"
                                            {{-- option-description="province_description" --}}
                                        />
                                    @endif

                                </div>

                                <div class="w-full flex flex-col md:flex-row gap-5 mt-5 mb-4">
                                    @if (!$province)
                                    
                                        <x-select
                                            label="Select Municipality"
                                            wire:model.blur="municipality"
                                            placeholder="Ex: ATIMONAN"
                                            {{-- :async-data="route('location.province', ['provinceCode' => $provinceCode])" --}}
                                            :template="[
                                                'city_municipality_description'   => 'user-option',
                                            ]"
                                            option-label="city_municipality_description"
                                            option-value="city_municipality_description"
                                            {{-- option-description="city_municipality_description" --}}
                                            disabled
                                        />
                                    @else
                                        <x-select
                                            label="Select Municipality"
                                            wire:model.blur="municipality"
                                            placeholder="Ex: ATIMONAN"
                                            :async-data="route('location.municipality', ['provinceCode' => $provinceCode])"
                                            :template="[
                                                'city_municipality_description'   => 'user-option',
                                            ]"
                                            option-label="city_municipality_description"
                                            option-value="city_municipality_description"
                                            {{-- option-description="city_municipality_description" --}}
                                        />
                                    @endif
                                    
                                    @if (!$region || !$province || !$municipality)
                                        <x-select
                                            label="Select Barangay"
                                            wire:model.blur="barangay"
                                            placeholder="Ex: Poblacion II"
                                            {{-- :async-data="route('api.barangays.index')" --}}
                                            :template="[
                                                'barangay_description'   => 'user-option',
                                            ]"
                                            option-label="barangay_description"
                                            option-value="barangay_description"
                                            {{-- option-description="barangay_description" --}}
                                            disabled
                                        />
                                    @else
                                        <x-select
                                            label="Select Barangay"
                                            wire:model.blur="barangay"
                                            placeholder="Ex: Poblacion II"
                                            :async-data="route('location.barangay', ['municipalityCode' => $municipalityCode])"
                                            :template="[
                                                'barangay_description'   => 'user-option',
                                            ]"
                                            option-label="barangay_description"
                                            option-value="barangay_description"
                                            {{-- option-description="barangay_description" --}}
                                        />
                                    @endif

                                    <x-select
                                        label="State"
                                        placeholder="Select State"
                                        wire:model.defer="state"
                                        disabled
                                        
                                    >
                                        <x-select.user-option src="https://via.placeholder.com/500" label="Philippines" value="Philippines" />
                                    </x-select>
                                </div>
                            </div>
                        </div>
                    @elseif($currentStep == 2)
                        <div class="md:p-2 p-4 h-auto bg-gray-50 flex justify-center items-center border border-dashed border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                            <div class="w-[90%]">
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
                                <div class="w-full flex gap-2 mt-4 mb-4">
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
                                            <div class="relative whitespace-nowrap">
                                                <x-input type="password" label="Confirm Password" placeholder="Confirm password" class="py-3 -mt-1" wire:model="confirmPassword" />
                                            </div>
                                        </div>
                                    </div>
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
                            {{ !$firstName || !$middleName || !$lastName  ? 'disabled="disabled"' : '' }}
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
        <div class="flex flex-col mt-2 -mb-3 md:mb-2 lg:-mt-11 pb-5">
            <div class="flex gap-1">
                <p>Already have an account?</p>
                <a href="{{ route('login')}}" class="font-bold">Sign in</a>
            </div>
            <img src="{{ asset('images/sign-2.png')}}" alt="" class="w-20 self-end pl-6">
        </div>
        
        <div class="flex flex-col w-[90%] md:w-[80%] md:mt-0">
            <hr>
            <div class="flex my-3 text-justify">
                <p>By signing in, creating an account, or checking out as a Guest you are agreeing to our <a href="{{ route('terms&condition')}}" class="font-base underline text-blue-500">Terms and Conditions.</a></p>
            </div>
        </div>
    </div>
    <div class="w-[50%] h-screen rounded-l-[8%] overflow-hidden relative hidden md:block">
        <img src="{{ asset('images/building2.jpg') }}" alt="" class="object-cover object-right-bottom w-auto h-full">
        <a class="flex items-center justify-center text-white font-medium text-5xl absolute inset-0 m-auto">
            <img src="{{ asset('images/logo-white.png') }}" alt="">
            LawScheduler
        </a>
    </div>
</div>
