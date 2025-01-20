<div class="w-full h-full">
    <div class="container dashed-container flex flex-col-reverse md:flex-row md:flex">
        <div class="w-full flex md:justify-start md:mt-0 items-center justify-center mt-3 ">
            <button type="button" wire:loading.attr="disabled" wire:loading.class="!cursor-wait" onclick="$openModal('newCourtTypeModal')" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55">
                <x-icon name="document-add" class="w-5 h-5" />
                New Court Type
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
                    <th scope="col" colspan="4" class="px-6 py-3 text-blue-950">
                        Name
                    </th>
                    <th scope="col" colspan="4" class="px-6 py-3 text-blue-950">
                        Status
                    </th>
                    <th scope="col" class="px-10 py-3 flex justify-end">
                        <span class="px-6 py-3">Actions</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($courtTypeList->isEmpty())
                    <tr>
                        <td colspan="12">
                            <div class="flex justify-center items-center text-center gap-2 py-10 w-full">
                                <x-icon name="information-circle" class="w-5 h-5" /><h1>No court type found.</h1>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach ($courtTypeList as $courtType)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" colspan="4">
                                {{ $courtType->name }}
                            </th>
                            <td class="px-6 py-4" colspan="4">
                                @if ($courtType->is_active)
                                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-green-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                        <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                                        <path d="m9 12 2 2 4-4"></path>
                                        </svg>
                                        Active
                                    </span>
                                @else
                                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>                                          
                                        Not Active
                                    </span>
                                @endif
                            </td>
                            <td class="px-12 py-4 flex justify-end gap-4" colspan="4">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="$openModal('editCourtTypeModal')" wire:click="getSelectedCourtTypeId({{ $courtType->id }})">Edit</a>
                                <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" wire:click="deleteConfirmation({{ $courtType->id }}, '{{ $courtType->name }}')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>            
        </table>
        <div class="w-full flex justify-end items-end py-5 px-2">
            {{ $courtTypeList->links() }}
        </div>
        
    </div>

    {{-- ADD MODAL --}}
    <x-modal blur name="newCourtTypeModal" align="center" max-width="md">
        <x-card title="Add New Court Type">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="col-span-1 sm:col-span-2">
                    <div class="grid grid-cols-1 gap-5">
                        <x-input label="Court Type Name" placeholder="Ex: Regional Trial Court" class="py-3 mt-1" wire:model="name" />
                        <x-toggle lg wire:model.defer="isActive" left-label="Is Active"/>
                    </div>
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" wire:click="addNewCourtType" />
                    </div>
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    {{-- EDIT MODAL --}}
    <x-modal blur name="editCourtTypeModal" align="center" max-width="md" persistent>
        <x-card title="Edit Court Type Details" >
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="col-span-1 sm:col-span-2">
                    <div class="grid grid-cols-1 gap-5">
                        @if ($editName)
                            <x-input label="Court Type Name" placeholder="Ex: Civil Cases" class="py-3 mt-1" wire:model="editName" />
                        @else
                            <div class="relative w-full h-full">
                                <x-input label="Court Type Name" placeholder="" wire:model="editName" disabled />
                                <div role="status" class="absolute top-6.5 left-4 pt-1">
                                    <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                    </svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        @endif
                    
                        <x-toggle lg wire:model="editIsActive" left-label="Is Active"/>
                    </div>
                </div>
            </div>
    
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" wire:click="resetModal" />
                        <x-button primary label="Save" wire:click="updateCourtTypeDetails({{ $selectedCourtTypeId }})" />
                    </div>
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
