<div class="w-full h-full">
    <div class="container dashed-container flex flex-col-reverse md:flex-row md:flex">
        <div class="w-full flex md:justify-start md:mt-0 items-center justify-center mt-3 ">
            <button type="button" wire:loading.attr="disabled" wire:loading.class="!cursor-wait" wire:click="initialData" onclick="$openModal('newClientModal')" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55">
                <x-icon name="user-add" class="w-5 h-5" />
                New Client
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
                    <th scope="col" class="px-6 py-3 text-blue-950">
                        Account Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="px-6 py-3">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if(!$clientList->isEmpty() && count($clientList) < 2)
                    <tr>
                        <td colspan="12">
                            <div class="flex justify-center items-center text-center gap-2 py-10 w-full">
                                <x-icon name="information-circle" class="w-5 h-5" /><h1>No client found.</h1>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach ($clientList as $client)
                        @if ($client->info)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="hs-tooltip inline-block">
                                        <a onclick="$openModal('fullClientDetialsModal')" wire:click="getSelectedClientFullDetails({{ $client->id }})"  class="hs-tooltip-toggle underline cursor-pointer hover:text-blue-600 font-semibold text-gray-950">
                                            <div class="flex items-center gap-2">
                                                <img src="{{ asset($client->profile_picture) }}" alt="{{ $client->name }}" class="w-8 h-8">
                                                {{ $client->name }}
                                            </div>
                                            <span class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded shadow-sm dark:bg-neutral-700" role="tooltip">
                                                Client Full Details
                                            </span>
                                        </a>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $client->info->barangay }} {{ $client->info->municipality }}, {{ $client->info->province }} - {{ $client->info->state }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $client->info->phone }} / {{ $client->email }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($client->password)
                                        <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-green-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                            <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                                            <path d="m9 12 2 2 4-4"></path>
                                            </svg>
                                            Activated
                                        </span>
                                    @else
                                        <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>                                          
                                            Not Activated
                                        </span>
                                    @endif
                                </td>
                                <td class="px-12 py-4 flex gap-4">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="$openModal('editClientModal')" wire:click="getSelectedClientId({{ $client->id }})">Edit</a>
                                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" wire:click="deleteConfirmation({{ $client->id }}, '{{ $client->info->last_name }}, {{ $client->info->first_name }}')">Delete</a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>            
        </table>
        <div class="w-full flex justify-end items-end py-5 px-2">
            {{ $clientList->links() }}
        </div>
        
    </div>

    {{-- ADD MODAL --}}
    <x-modal blur name="newClientModal" align="center" max-width="3xl">
        <x-card title="Add New Client">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="col-span-1 sm:col-span-2">
                    <div class="grid grid-cols-3 gap-3">
                        {{-- <x-input label="First name" placeholder="Your first name" wire:model="firstName" /> --}}
                        <x-input label="First name" placeholder="Ex: Juan" class="py-3 -mt-1" wire:model="firstName" />
                        <x-input label="Middle name" placeholder="Ex: Reyes" class="py-3 -mt-1" wire:model="middleName" />
                        <x-input label="Last name" placeholder="Ex: Cruz" class="py-3 -mt-1" wire:model="lastName" />
                    </div>
                </div>

                <x-inputs.phone label="Mobile No." placeholder="Ex: +63 912 345 6789" mask="['+63 ### ### ####']" class="py-3 -mt-1" wire:model="phone" />
                <x-input label="Email" placeholder="Ex: juanreyes@gmai.com" class="py-3 -mt-1" wire:model="email" />
                

                <div class="col-span-1 sm:col-span-2">
                    <div class="grid grid-cols-2 gap-3">
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
                                {{-- :async-data="route('api.provinces.index')" --}}
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
                </div>

                <div class="col-span-1 sm:col-span-2">
                    <div class="grid grid-cols-3 gap-3">
                        @if (!$region || !$province)
                            <x-select
                                label="Select Municipality"
                                wire:model.blur="municipality"
                                placeholder="Ex: ATIMONAN"
                                {{-- :async-data="route('api.municipalities.index')" --}}
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
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" wire:click="addNewClient" />
                    </div>
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    {{-- EDIT MODAL --}}
    <x-modal blur name="editClientModal" align="center" max-width="3xl" persistent>
        <x-card title="Edit Client Details" >
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="col-span-1 sm:col-span-2">
                    <div class="grid grid-cols-3 gap-3">
                        @if ($editFirstName)
                            <x-input label="First name" class="py-3 -mt-1" placeholder="Ex: Juan" wire:model="editFirstName"/>
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
                        mask="['+63 ### ### ####']"
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
                
                <div class="col-span-1 sm:col-span-2">
                    <div class="grid grid-cols-2 gap-3">
                        
                        <x-select
                            label="Select Region"
                            wire:model="editRegion"
                            option-key-value="id"
                            placeholder="Ex: REGION IV-A (CALABARZON)"
                            :async-data="route('api.regions.client')"
                            :template="[
                                'region_description'   => 'user-option',
                            ]"
                            option-label="region_description"
                            option-value="region_description"
                            option-description="region_description"
                            
                        />
                        @if (!$editRegion)
                            <x-select
                                label="Select City/Province"
                                wire:model.blur="editProvince"
                                placeholder="Ex: CITY OF MANILA"
                                :async-data="route('api.provinces.client')"
                                :template="[
                                    'province_description'   => 'user-option',
                                ]"
                                option-label="province_description"
                                option-value="province_description"
                                option-description="province_description"
                                disabled
                            />
                        @else
                            <x-select
                                label="Select City/Province"
                                wire:model.blur="editProvince"
                                placeholder="Ex: CITY OF MANILA"
                                :async-data="route('api.provinces.client')"
                                :template="[
                                    'province_description'   => 'user-option',
                                ]"
                                option-label="province_description"
                                option-value="province_description"
                                option-description="province_description"
                            />
                        @endif
                    </div>
                </div>

                <div class="col-span-1 sm:col-span-2">
                    <div class="grid grid-cols-2 gap-3">
                        @if (!$editRegion || !$editProvince)
                            <x-select
                                label="Select Municipality"
                                wire:model.blur="editMunicipality"
                                placeholder="Ex: ATIMONAN"
                                :async-data="route('api.municipalities.client')"
                                :template="[
                                    'city_municipality_description'   => 'user-option',
                                ]"
                                option-label="city_municipality_description"
                                option-value="city_municipality_description"
                                option-description="city_municipality_description"
                                disabled
                            />
                        @else
                            <x-select
                                label="Select Municipality"
                                wire:model.blur="editMunicipality"
                                placeholder="Ex: ATIMONAN"
                                :async-data="route('api.municipalities.client')"
                                :template="[
                                    'city_municipality_description'   => 'user-option',
                                ]"
                                option-label="city_municipality_description"
                                option-value="city_municipality_description"
                                option-description="city_municipality_description"
                            />
                        @endif

                        @if (!$editRegion || !$editProvince || !$editMunicipality)
                            <x-select
                                label="Select Barangay"
                                wire:model.blur="editBarangay"
                                placeholder="Ex: Poblacion II"
                                :async-data="route('api.barangays.client')"
                                :template="[
                                    'barangay_description'   => 'user-option',
                                ]"
                                option-label="barangay_description"
                                option-value="barangay_description"
                                option-description="barangay_description"
                                disabled
                            />
                        @else
                            <x-select
                                label="Select Barangay"
                                wire:model.blur="editBarangay"
                                placeholder="Ex: Poblacion II"
                                :async-data="route('api.barangays.client')"
                                :template="[
                                    'barangay_description'   => 'user-option',
                                ]"
                                option-label="barangay_description"
                                option-value="barangay_description"
                                option-description="barangay_description"
                            />
                        @endif
                    </div>
                </div>
                <div class="col-span-1 sm:col-span-2">
                    <x-select
                        label="State"
                        placeholder="Select State"
                        wire:model.defer="editState"
                        disabled
                    >
                        <x-select.user-option src="https://via.placeholder.com/500" label="Philippines" value="Philippines" />
                    </x-select>
                </div>
            </div>
     
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" wire:click="resetModal" />
                        <x-button primary label="Save" wire:click="updateClientDetails({{ $selectedClientId }})" />
                    </div>
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    {{-- FULL DETAILS MODAL --}}
    <x-modal blur wire:model.defer="fullClientDetialsModal" align="center" max-width="3xl" persistent>
        <x-card title="Client Full Details">
            <div class="flex justify-center">
                <div class="grid grid-cols-4 bg-gray-100 hover:bg-gray-200 rounded-full transition p-1 dark:bg-neutral-700 dark:hover:bg-neutral-600 w-full">
                    <button 
                        type="button" 
                        wire:click="changeTab('userDetailsTab')" 
                        class="{{ $currentTab == 'userDetailsTab' ? 'bg-white text-gray-700 dark:bg-neutral-800 dark:text-neutral-400 py-3 px-4 inline-flex items-center justify-center gap-x-2 text-sm hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-full disabled:opacity-50 disabled:pointer-events-none dark:hover:text-white dark:focus:text-white text-center' : 'py-3 px-4 inline-flex items-center justify-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-blue-600' }}">
                        Client Profile
                    </button>
                    <button type="button" wire:click="changeTab('zoomMeetings')" class="{{ $currentTab == 'zoomMeetings' ? 'bg-white text-gray-700 dark:bg-neutral-800 dark:text-neutral-400 py-3 px-4 inline-flex items-center justify-center gap-x-2 text-sm  hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-full hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none  dark:hover:text-white dark:focus:text-white' : 'py-3 px-4 inline-flex items-center justify-center gap-x-2 bg-transparent text-sm text-gray-500 hover:hover:text-blue-600'}}">
                        Zoom Meetings
                    </button>
                    <button type="button" wire:click="changeTab('appointments')" class="{{ $currentTab == 'appointments' ? 'bg-white text-gray-700 dark:bg-neutral-800 dark:text-neutral-400 py-3 px-4 inline-flex items-center justify-center gap-x-2 text-sm  hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-full hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none  dark:hover:text-white dark:focus:text-white' : 'py-3 px-4 inline-flex items-center justify-center gap-x-2 bg-transparent text-sm text-gray-500 hover:hover:text-blue-600'}}">
                        Appointments
                    </button>
                    <button type="button" wire:click="changeTab('cases')" class="{{ $currentTab == 'cases' ? 'bg-white text-gray-700 dark:bg-neutral-800 dark:text-neutral-400 py-3 px-4 inline-flex items-center justify-center gap-x-2 text-sm  hover:text-gray-700 focus:outline-none focus:text-gray-700 font-medium rounded-full hover:hover:text-blue-600 disabled:opacity-50 disabled:pointer-events-none  dark:hover:text-white dark:focus:text-white' : 'py-3 px-4 inline-flex items-center justify-center gap-x-2 bg-transparent text-sm text-gray-500 hover:hover:text-blue-600'}}">
                        Cases
                    </button>
                </div>
            </div>
              
            <div class="mt-3">
                @if ($currentTab == 'userDetailsTab')
                    <div class="w-full">
                        @if ($selectedClientFullDetails)
                            <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 p-10">
                                <div class="flex gap-6">
                                    <img src="{{$selectedClientFullDetails['user']->profile_picture}}" alt="{{$selectedClientFullDetails['user']->name}}" width="120" height="120" class="object-contain">
                                    <div class="flex flex-col gap-3">
                                        <div>
                                            <div class="flex items-center gap-3">
                                                <h3 class="text-lg text-gray-900 capitalize font-semibold">{{$selectedClientFullDetails['user']->name}}</h3>
                                                @if ($selectedClientFullDetails['user']->password)
                                                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-green-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                                        <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                                                        <path d="m9 12 2 2 4-4"></path>
                                                        </svg>
                                                        Activated
                                                    </span>
                                                @else
                                                    <span class="py-[2px] px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>                                          
                                                        Not Activated
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-xs text-gray-500 uppercase mt-1">{{$selectedClientFullDetails['user']->info->barangay}}, {{$selectedClientFullDetails['user']->info->municipality}} {{$selectedClientFullDetails['user']->info->province}}, {{$selectedClientFullDetails['user']->info->state}}</p>
                                        </div>
                                        <div class="self-baseline flex flex-col gap-2">
                                            <div class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                                                </svg>
                                                <p class="text-sm text-blue-500">{{$selectedClientFullDetails['user']->email}}</p>
                                            </div>
                                            
                                            <div class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                                  </svg>                                                  
                                                <p class="text-sm text-blue-500">{{$selectedClientFullDetails['user']->info->phone}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="w-full flex justify-center items-center py-10">
                                <div class="animate-spin inline-block size-8 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500" role="status" aria-label="loading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                @if ($currentTab == 'zoomMeetings')
                    <div class="w-full">
                        @if ($selectedClientFullDetails)
                            @if (count($selectedClientFullDetails['zoom_meetings']) > 0)
                                <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 p-10">
                                    <div class="py-3 flex items-center text-sm text-gray-800 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-neutral-600">Upcoming Meetings</div>
                                    @foreach ($selectedClientFullDetails['zoom_meetings'] as $meeting)
                                        @if (\Carbon\Carbon::parse($meeting->start_time)->startOfDay()->gte(\Carbon\Carbon::now()->startOfDay()))
                                            <div class="w-full rounded-lg shadow-md flex items-center p-2 gap-3 border mt-2">
                                                <img src="{{ asset('/images/zoom-logo.webp') }}" alt="zoom" class="w-8 h-8">
                                                <div>
                                                    <h3 class="font-semibold text-base">
                                                        {{ $meeting->topic }}
                                                    </h3>
                                                    <p class="text-xs italic text-blue-500">{{$meeting->agenda}}</p>
                                                </div>
                                                <div class="ml-auto">
                                                    {{ \Carbon\Carbon::parse($meeting->start_time)->format('F j, Y') }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="py-3 flex items-center text-sm text-gray-800 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-neutral-600 mt-5">Appointments History</div>
                                    @foreach ($selectedClientFullDetails['zoom_meetings'] as $meeting)
                                        @if (\Carbon\Carbon::parse($meeting->start_time)->startOfDay()->lt(\Carbon\Carbon::now()->startOfDay()))
                                            <div class="w-full rounded-lg shadow-md flex items-center p-2 gap-3 border mt-2">
                                                <img src="{{ asset('/images/zoom-logo.webp') }}" alt="zoom" class="w-8 h-8">
                                                <div>
                                                    <h3 class="font-semibold text-base">
                                                        {{ $meeting->topic }}
                                                    </h3>
                                                    <p class="text-xs italic text-blue-500">{{$meeting->agenda}}</p>
                                                </div>
                                                <div class="ml-auto">
                                                    {{ \Carbon\Carbon::parse($meeting->start_time)->format('F j, Y') }}
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
                @endif
                
                @if ($currentTab == 'appointments')
                    <div class="w-full">
                        @if ($selectedClientFullDetails)
                            @if (count($selectedClientFullDetails['appointments']) > 0)
                                <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 p-10">
                                    
                                    <div class="py-3 flex items-center text-sm text-gray-800 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-neutral-600 mt-5">Upcoming Appointments</div>
                                    @foreach ($selectedClientFullDetails['appointments'] as $appointment)
                                        @if (\Carbon\Carbon::parse($appointment->date)->startOfDay()->gte(\Carbon\Carbon::now()->startOfDay()))
                                            <div class="w-full rounded-lg shadow-md flex items-center p-2 gap-3 border mt-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                                                </svg>
                                                
                                                <div>
                                                    <h3 class="font-semibold text-base">
                                                        {{ $appointment->title }}
                                                    </h3>
                                                    <p class="text-xs italic text-blue-500">{{$appointment->description}}</p>
                                                </div>
                                                <div class="ml-auto">
                                                    {{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="py-3 flex items-center text-sm text-gray-800 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-neutral-600 mt-5">Appointments History</div>
                                    @foreach ($selectedClientFullDetails['appointments'] as $appointment)
                                        @if (\Carbon\Carbon::parse($appointment->date)->startOfDay()->lt(\Carbon\Carbon::now()->startOfDay()))
                                            <div class="w-full rounded-lg shadow-md flex items-center p-2 gap-3 border mt-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 2.994v2.25m10.5-2.25v2.25m-14.252 13.5V7.491a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v11.251m-18 0a2.25 2.25 0 0 0 2.25 2.25h13.5a2.25 2.25 0 0 0 2.25-2.25m-18 0v-7.5a2.25 2.25 0 0 1 2.25-2.25h13.5a2.25 2.25 0 0 1 2.25 2.25v7.5m-6.75-6h2.25m-9 2.25h4.5m.002-2.25h.005v.006H12v-.006Zm-.001 4.5h.006v.006h-.006v-.005Zm-2.25.001h.005v.006H9.75v-.006Zm-2.25 0h.005v.005h-.006v-.005Zm6.75-2.247h.005v.005h-.005v-.005Zm0 2.247h.006v.006h-.006v-.006Zm2.25-2.248h.006V15H16.5v-.005Z" />
                                                </svg>
                                                <div>
                                                    <h3 class="font-semibold text-base">
                                                        {{ $appointment->title }}
                                                    </h3>
                                                    <p class="text-xs italic text-blue-500">{{$appointment->description}}</p>
                                                </div>
                                                <div class="ml-auto">
                                                    {{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="flex justify-center items-center bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 p-10">
                                    <x-icon name="information-circle" class="w-5 h-5" />
                                    <h1>No Appointments found.</h1>
                                </div>
                            @endif
                        @endif
                    </div>
                @endif

                @if ($currentTab == 'cases')
                    <div class="w-full">
                        @if ($selectedClientFullDetails)
                            @if (count($selectedClientFullDetails['cases']) > 0)
                                <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70 p-10">
                                    @foreach ($selectedClientFullDetails['cases'] as $case)
                                        <div class="grow pt-0.5 pb-8">
                                            <h3 class="flex gap-x-1.5 font-semibold text-gray-800 dark:text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                                                </svg>
                                                
                                                {{ $case['nps_docket_no'] }}
                                                <span class="inline-flex items-center gap-x-1.5 py-1 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">{{ $case['case_stage']['name'] }}</span>
                                            </h3>
                                            <p class="mt-1 text-sm text-gray-600 dark:text-neutral-400">
                                                {{-- {{ $case->act }} --}}
                                            </p>
                                            
                                            <div class="dashed-container-no-padding mt-1">
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
                @endif
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Close" x-on:click="close" wire:click="resetTab" />
                    </div>
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
