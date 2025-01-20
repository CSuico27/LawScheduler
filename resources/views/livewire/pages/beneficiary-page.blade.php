<div class="w-full h-full">
    <div class="container dashed-container flex flex-col-reverse md:flex-row md:flex">
        <div class="w-full flex md:justify-start md:mt-0 items-center justify-center mt-3 ">
            <button type="button" wire:loading.attr="disabled" wire:loading.class="!cursor-wait" wire:click="initialData" onclick="$openModal('newBeneficiaryModal')" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55">
                <x-icon name="user-add" class="w-5 h-5" />
                New Beneficiary
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
                    <th scope="col" class="px-6 py-3 text-blue-950">
                        Full name
                    </th>
                    <th scope="col" class="px-6 py-3 text-blue-950">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3 text-blue-950">
                        Contact
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="px-6 py-3">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($beneficiariesList)
                    @foreach ($beneficiariesList as $beneficiary)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $beneficiary->last_name }}, {{ $beneficiary->first_name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $beneficiary->barangay }} {{ $beneficiary->street_address }}, {{ $beneficiary->city }}({{ $beneficiary->zip_code }}) - {{ $beneficiary->state }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $beneficiary->phone }} / {{ $beneficiary->email }}
                            </td>
                            <td class="px-12 py-4 flex gap-4">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="$openModal('editBeneficiaryModal')" wire:click="getSelectedBeneficiaryId({{ $beneficiary->id }})">Edit</a>
                                <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" wire:click="deleteConfirmation({{ $beneficiary->id }}, '{{ $beneficiary->last_name }}, {{ $beneficiary->first_name }}')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- ADD MODAL --}}
    <x-modal blur name="newBeneficiaryModal" align="center" max-width="3xl">
        <x-card title="Add New Beneficiary">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="col-span-1 sm:col-span-2">
                    <div class="grid grid-cols-3 gap-3">
                        <x-input label="First name" placeholder="Your first name" wire:model="firstName" />
                        <x-input label="Middle name" placeholder="Your middle name" wire:model="middleName" />
                        <x-input label="Last name" placeholder="Your last name" wire:model="lastName" />
                    </div>
                </div>

                <x-inputs.maskable
                    label="Phone"
                    mask="###########"
                    wire:model="phone"
                    placeholder="Phone number"
                />
                <x-input label="Email" placeholder="example@mail.com" wire:model="email"/>
                
                <x-select
                    label="Street Address"
                    placeholder="Select Street Address"
                    wire:model.defer="streetAddress"
                >
                    <x-select.user-option src="https://via.placeholder.com/500" label="St. Zone 1" value="St. Zone 1" />
                    <x-select.user-option src="https://via.placeholder.com/500" label="St. Zone 1" value="St. Zone 2" />
                    <x-select.user-option src="https://via.placeholder.com/500" label="St. Zone 3" value="St. Zone 3" />
                    <x-select.user-option src="https://via.placeholder.com/500" label="St. Zone 4" value="St. Zone 4" />
                </x-select>

                <x-select
                    label="Barangay"
                    placeholder="Select Barangay"
                    wire:model.defer="barangay"
                >
                    <x-select.user-option src="https://via.placeholder.com/500" label="Brgy. 1" value="Brgy. 1" />
                    <x-select.user-option src="https://via.placeholder.com/500" label="Brgy. 2" value="Brgy. 2" />
                    <x-select.user-option src="https://via.placeholder.com/500" label="Brgy. 3" value="Brgy. 3" />
                    <x-select.user-option src="https://via.placeholder.com/500" label="Brgy. 4" value="Brgy. 4" />
                </x-select>
                
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

                <div class="col-span-1 sm:col-span-2">
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
        
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" wire:click="addNewBeneficiary" />
                    </div>
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    {{-- EDIT MODAL --}}
    <x-modal blur name="editBeneficiaryModal" align="center" max-width="3xl" persistent>
        <x-card title="Edit Beneficiary Details" >
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="col-span-1 sm:col-span-2">
                    <div class="grid grid-cols-3 gap-3">
                        @if ($editFirstName)
                            <x-input label="First name" placeholder="Your first name" wire:model="editFirstName"/>
                        @else
                            <div class="relative w-full h-full">
                                <x-input label="First name" placeholder="" wire:model="editFirstName" disabled />
                                <div role="status" class="absolute top-6.5 left-4 pt-1">
                                    <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        @endif
                        
                        @if ($editMiddleName)
                            <x-input label="Middle name" placeholder="Your middle name" wire:model="editMiddleName" />
                        @else
                            <div class="relative w-full h-full">
                                <x-input label="Middle name" placeholder="" wire:model="editMiddleName" disabled />
                                <div role="status" class="absolute top-6.5 left-4 pt-1">
                                    <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        @endif

                        @if ($editLastName)
                            <x-input label="Last name" placeholder="Your last name" wire:model="editLastName" />
                        @else
                            <div class="relative w-full h-full">
                                <x-input label="Last name" placeholder="" wire:model="editLastName" disabled />
                                <div role="status" class="absolute top-6.5 left-4 pt-1">
                                    <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($editPhone)
                    <x-inputs.maskable
                        label="Phone"
                        mask="###########"
                        wire:model="editPhone"
                        placeholder="Phone number"
                    />
                @else
                    <div class="relative w-full h-full">
                        <x-input label="Phone" placeholder="" disabled />
                        <div role="status" class="absolute top-6.5 left-4 pt-1">
                            <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                @endif
                
                @if ($editEmail)
                    <x-input label="Email" placeholder="example@mail.com" wire:model="editEmail"/>
                @else
                    <div class="relative w-full h-full">
                        <x-input label="Email" placeholder="" disabled/>
                        <div role="status" class="absolute top-6.5 left-4 pt-1">
                            <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                @endif
                
                <x-select
                    label="Street Address"
                    placeholder="Select Street Address"
                    wire:model.defer="editStreetAddress"
                >
                    <x-select.user-option src="https://via.placeholder.com/500" label="St. Zone 1" value="St. Zone 1" />
                    <x-select.user-option src="https://via.placeholder.com/500" label="St. Zone 2" value="St. Zone 2" />
                    <x-select.user-option src="https://via.placeholder.com/500" label="St. Zone 3" value="St. Zone 3" />
                    <x-select.user-option src="https://via.placeholder.com/500" label="St. Zone 4" value="St. Zone 4" />
                </x-select>
                
                <x-select
                    label="Barangay"
                    placeholder="Select Barangay"
                    wire:model.defer="editBarangay"
                >
                    <x-select.user-option src="https://via.placeholder.com/500" label="Brgy. 1" value="Brgy. 1" />
                    <x-select.user-option src="https://via.placeholder.com/500" label="Brgy. 2" value="Brgy. 2" />
                    <x-select.user-option src="https://via.placeholder.com/500" label="Brgy. 3" value="Brgy. 3" />
                    <x-select.user-option src="https://via.placeholder.com/500" label="Brgy. 4" value="Brgy. 4" />
                </x-select>
               
                <x-select
                    label="City"
                    placeholder="Select City"
                    wire:model.defer="editCity"
                    disabled
                >
                <x-select.user-option src="https://via.placeholder.com/500" label="Tayabas City" value="Tayabas City" />
                </x-select>

                <x-select
                    label="State"
                    placeholder="Select State"
                    wire:model.defer="editState"
                    disabled
                >
                    <x-select.user-option src="https://via.placeholder.com/500" label="Philippines" value="Philippines" />
                </x-select>

                <div class="col-span-1 sm:col-span-2">
                <x-select
                        label="Zip Code"
                        placeholder="Select Zip Code"
                        wire:model.defer="editZipCode"
                        disabled
                    >
                        <x-select.user-option src="https://via.placeholder.com/500" label="4306" value="4306" />
                    </x-select>
                </div>
            </div>
     
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" wire:click="resetModal" />
                        <x-button primary label="Save" wire:click="updateBeneficiaryDetails({{ $selectedBeneficiaryId }})" />
                    </div>
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
