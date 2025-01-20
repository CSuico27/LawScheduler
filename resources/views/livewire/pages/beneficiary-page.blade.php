<div class="w-full h-full">
    <div class="container dashed-container flex flex-col-reverse md:flex-row md:flex">
        <div class="w-full flex md:justify-start md:mt-0 items-center justify-center mt-3 ">
            <button type="button" wire:loading.attr="disabled" wire:loading.class="!cursor-wait" onclick="$openModal('newBeneficiaryModal')" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55">
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
                    <input type="search" id="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required />
                    <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Full name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Contact
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
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
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-modal.card title="Add New Beneficiary" blur wire:model.defer="newBeneficiaryModal" align="center" max-width="3xl">
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
    </x-modal.card>
</div>
