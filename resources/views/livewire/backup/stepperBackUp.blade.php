<div data-hs-stepper='' class="w-[80%]">
    <!-- Stepper Nav -->
    <ul class="relative flex flex-row gap-x-2">
    <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group" data-hs-stepper-nav-item='{
        "index": 1
    }'>
        <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
        <span class="size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full group-focus:bg-gray-200 hs-stepper-active:bg-blue-600 hs-stepper-active:text-white hs-stepper-success:bg-blue-600 hs-stepper-success:text-white hs-stepper-completed:bg-teal-500 hs-stepper-completed:group-focus:bg-teal-600 dark:bg-neutral-700 dark:text-white dark:group-focus:bg-gray-600 dark:hs-stepper-active:bg-blue-500 dark:hs-stepper-success:bg-blue-500 dark:hs-stepper-completed:bg-teal-500 dark:hs-stepper-completed:group-focus:bg-teal-600">
            <span class="hs-stepper-success:hidden hs-stepper-error:hidden hs-stepper-completed:hidden">1</span>
            <svg class="hidden flex-shrink-0 size-3 hs-stepper-success:block" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
        </span>
        <span class="ms-2 text-sm font-medium text-gray-800 dark:text-neutral-200">
            Personal Information
        </span>
        </span>
        <div class="w-full h-px flex-1 bg-gray-200 group-last:hidden hs-stepper-success:bg-blue-600 hs-stepper-completed:bg-teal-600 dark:bg-neutral-700 dark:hs-stepper-success:bg-blue-600 dark:hs-stepper-completed:bg-teal-600"></div>
    </li>

    <li class="flex items-center gap-x-2 shrink basis-0 flex-1 group"  data-hs-stepper-nav-item='{
        "index": 2
    }'>
        <span class="min-w-7 min-h-7 group inline-flex items-center text-xs align-middle">
        <span class="size-7 flex justify-center items-center flex-shrink-0 bg-gray-100 font-medium text-gray-800 rounded-full group-focus:bg-gray-200 hs-stepper-active:bg-blue-600 hs-stepper-active:text-white hs-stepper-success:bg-blue-600 hs-stepper-success:text-white hs-stepper-completed:bg-teal-500 hs-stepper-completed:group-focus:bg-teal-600 dark:bg-neutral-700 dark:text-white dark:group-focus:bg-gray-600 dark:hs-stepper-active:bg-blue-500 dark:hs-stepper-success:bg-blue-500 dark:hs-stepper-completed:bg-teal-500 dark:hs-stepper-completed:group-focus:bg-teal-600">
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
    <!-- End Stepper Nav -->

    <!-- Stepper Content -->
    <div class="mt-5 sm:mt-8">
    <!-- First Contnet -->
    <div data-hs-stepper-content-item='{
        "index": 1
    }'>
        <div class="p-4 h-auto bg-gray-50 flex justify-center items-center border border-dashed border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
            <div class="w-[90%]">
                <div class="w-full flex gap-2">
                    <div class="w-full space-y-3">
                        <div>
                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                            <div class="relative">
                                <x-input label="First name" placeholder="ex: John" class="py-3 -mt-1" wire:model="firstName" />
                            </div>
                        </div>
                    </div>
                    <div class="w-full space-y-3">
                        <div>
                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                            <div class="relative">
                                <x-input label="Middle name" placeholder="ex: Kramer" class="py-3 -mt-1" wire:model="middleName" />
                            </div>
                        </div>
                    </div>
                    <div class="w-full space-y-3">
                        <div>
                            <label for="hs-trailing-icon" class="block text-sm font-medium mb-2 dark:text-white"></label>
                            <div class="relative">
                                <x-input label="Last name" placeholder="ex: Doe" class="py-3 -mt-1" wire:model="lastName" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex gap-5 mt-5">
                    <x-select
                        label="Select Street"
                        placeholder="ex: Malabana St."
                        wire:model="streetAddress"
                    >
                        <x-select.user-option src="https://via.placeholder.com/500" label="Street 1" value="Street 1" />
                        <x-select.user-option src="https://via.placeholder.com/500" label="Street 2" value="Street 2" />
                        <x-select.user-option src="https://via.placeholder.com/500" label="Street 3" value="Street 3" />
                        <x-select.user-option src="https://via.placeholder.com/500" label="Street 4" value="Street 4" />
                    </x-select>

                    <x-select
                        label="Select Barangay"
                        placeholder="ex: Zone 1"
                        wire:model="barangay"
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
    </div>
    <!-- End First Contnet -->

    <!-- First Contnet -->
    <div data-hs-stepper-content-item='{
        "index": 2
    }' style="display: none;">
        <div class="p-4 h-auto bg-gray-50 flex justify-center items-center border border-dashed border-gray-200 rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
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
    </div>
    <!-- End First Contnet -->

    <!-- Button Group -->
    <div class="mt-5 flex justify-between items-center gap-x-2">
        <button type="button" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-stepper-back-btn="">
        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m15 18-6-6 6-6"></path>
        </svg>
        Back
        </button>
        <button type="button" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" data-hs-stepper-next-btn="" 
            {{-- {{ !$firstName || !$middleName || !$lastName || !$streetAddress || !$barangay  ? 'disabled="disabled"' : '' }} --}}
        >
        Next
        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="m9 18 6-6-6-6"></path>
        </svg>
        </button>
        <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" data-hs-stepper-finish-btn="" style="display: none;">
        Finish
        </button>
        {{-- <button type="reset" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none" data-hs-stepper-reset-btn="" style="display: none;">
        Reset
        </button> --}}
    </div>
    <!-- End Button Group -->
    </div>
    <!-- End Stepper Content -->
</div>