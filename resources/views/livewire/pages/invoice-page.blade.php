<div class="w-full h-full">
    <div class="container dashed-container flex flex-col-reverse md:flex-row md:flex">
        <div class="w-full flex md:justify-start md:mt-0 items-center justify-center mt-3 ">
            <button type="button" wire:loading.attr="disabled" wire:loading.class="!cursor-wait" wire:click="generateInvoiceNumber" onclick="$openModal('newInvoiceModal')" class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55">
                <x-icon name="document-add" class="w-5 h-5" />
                New Invoice
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
                        Invoice No.
                    </th>
                    <th scope="col" colspan="4" class="px-6 py-3 text-blue-950">
                        Client Name
                    </th>
                    <th scope="col" colspan="2" class="px-6 py-3 text-blue-950">
                        Total
                    </th>
                    <th scope="col" colspan="2" class="px-6 py-3 text-blue-950">
                        Paid
                    </th>
                    <th scope="col" colspan="2" class="px-6 py-3 text-blue-950">
                        Due
                    </th>
                    <th scope="col" colspan="2" class="px-6 py-3 text-blue-950">
                        Status
                    </th>
                    <th scope="col" colspan="2" class="px-6 py-3 text-blue-950 text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($invoiceList->isEmpty())
                    <tr>
                        <td colspan="100%">
                            <div class="flex justify-center items-center text-center gap-2 py-10 w-full">
                                <x-icon name="information-circle" class="w-5 h-5" /><h1>No invoice found.</h1>
                            </div>
                        </td>
                    </tr>
                @else
                    @foreach ($invoiceList as $invoice)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" colspan="4">
                                {{ $invoice->invoice_number }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" colspan="4">
                                <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                      
                                    {{ $invoice->client->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" colspan="2">  
                                {{ Number::currency($invoice->total_amount, 'PHP') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" colspan="2">  
                                {{ Number::currency($invoice->amount_paid, 'PHP') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" colspan="2">  
                                {{ Number::currency($invoice->balance_due, 'PHP') }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" colspan="2">  
                                @if ($invoice->status == 'Paid')
                                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-green-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                        <svg class="shrink-0 size-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                                        <path d="m9 12 2 2 4-4"></path>
                                        </svg>
                                        {{ $invoice->status }}
                                    </span>
                                @elseif($invoice->status == 'Partially Paid')
                                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-blue-800 text-white rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                          </svg>
                                          
                                        {{ $invoice->status }}
                                    </span>
                                @elseif($invoice->status == 'Overdue')
                                    <span class="py-[2px] px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>                                          
                                        {{ $invoice->status }}
                                    </span> 
                                @else
                                    <span class="py-1 px-2 inline-flex items-center gap-x-1 text-xs font-medium bg-gray-400 text-white rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                          </svg>
                                        {{ $invoice->status }}
                                    </span>
                                @endif
                               
                                
                            </td>
                            <td colspan="2">
                                <div class="flex justify-center gap-5">
                                    {{-- <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline" onclick="$openModal('editInvoice')">Edit</a>
                                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a> --}}
                                    <div class="hs-dropdown relative inline-flex">
                                        <button id="hs-dropdown-custom-icon-trigger" type="button" class="hs-dropdown-toggle flex justify-center items-center size-9 text-sm font-semibold rounded-lg border  text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none  disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                            <svg class="flex-none size-4 text-gray-600 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>
                                        </button>
                                        
                                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-1 space-y-0.5 mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 z-10" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-custom-icon-trigger">
                                            <a onclick="$openModal('viewInvoiceModal')" wire:click="selectInvoice({{ $invoice->id }})" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                                View
                                            </a>
                                            <a onclick="$openModal('editInvoiceModal')" wire:click="selectInvoice({{ $invoice->id }})" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg> 
                                                </span>
                                                Edit
                                            </a>
                                            
                                            <div class="border-t border-gray-700">
                                                @if ($invoice->status != 'Paid')
                                                    <a wire:click="selectedInvoceForPayment({{ $invoice->id }})" onclick="$openModal('paymentReceivedModal')" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                        <span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                                            </svg>                                                          
                                                        </span>
                                                        Payment Receive
                                                    </a>
                                                @endif
                                                
                                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                    <span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                                        </svg>
                                                    </span>
                                                    Payment History
                                                </a>
                                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-red-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
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
            </tbody>
        </table>        
        <div class="w-full flex justify-end items-end py-5 px-2">
            {{ $invoiceList->links() }}
        </div>
    </div>

    {{-- ADD MODAL --}}
    <x-modal blur name="newInvoiceModal" align="center" max-width="4xl">
        <x-card title="Create New Invoice">
            <x-select
                label="Client"
                wire:model.live="client"
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
            
            @if ($clientInfo->isNotEmpty())
                <div class="grid grid-cols-1 gap-4 mt-3">
                    @foreach ($clientInfo as $info)
                        <div class="w-1/2 border border-gray-400 border-dashed rounded-lg p-3">
                            <div class="flex items-center text-sm text-gray-800 font-semibold after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-neutral-600">Billed To</div>
                            <p class="text-gray-600 font-medium text-sm">{{ $info->name }}</p>
                            <p class="text-gray-500 font-medium text-sm italic">{{ $info->info->barangay }} {{ $info->info->municipality }} {{ $info->info->province }}, {{ $info->info->state }}</p>
                            <p class="text-blue-600 font-medium text-sm">{{ $info->email }}</p>
                            <p class="text-blue-600 font-medium text-sm">{{ $info->info->phone }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        
            <hr class="mt-5">
            <div class="grid grid-cols-1 gap-4 mt-3">
                <div>
                    <div>
                        <x-input label="Invoice No." placeholder="Ex: INV-001002" wire:model="invoiceNumber" disabled/>
                    </div>
                    <div class="mt-3">
                        <x-datetime-picker
                            label="Invoice Date"
                            placeholder="Invoice Date"
                            wire:model="invoiceDate"
                            without-time="true"
                            without-tips="true"
                            parse-format="YYYY-MM-DD"
                            display-format="MMMM DD, YYYY"
                        />
                    </div>
                    <div class="mt-3">
                        <x-datetime-picker
                            label="Invoice Due Date"
                            placeholder="Invoice Due Date"
                            wire:model="invoiceDueDate"
                            without-time="true"
                            without-tips="true"
                            parse-format="YYYY-MM-DD"
                            display-format="MMMM DD, YYYY"
                        />
                    </div>
                </div>
                {{-- <div>
                    <x-select
                        label="Payment Status"
                        placeholder="Ex: Pending"
                        :options="['Pending', 'Partially Paid', 'Paid', 'Overdue']"
                        wire:model.live="status"
                    />

                    <div class="mt-3">
                        @if ($status && $status == 'Partially Paid')
                            <x-inputs.maskable
                                label="Balance Due"
                                mask="['###', '##, ###', '###, ###', '#, ###']"
                                placeholder="Ex: 30, 000"
                                wire:model="balanceDue"
                            />
                        @else
                            
                        @endif
                    </div>

                    <div class="mt-3">
                        <x-inputs.maskable
                            label="Amount Paid"
                            mask="['###', '##, ###', '###, ###', '#, ###']"
                            placeholder="Ex: 30, 000"
                            wire:model="amountPaid"
                        />
                    </div>
                </div> --}}
            </div>
            <hr class="mt-5">
            <div class="grid grid-cols-1 mt-3">
                <div id="hs-wrapper-for-copy-one" class="space-y-3">
                    <p class="-mb-2 text-sm font-medium">Service/s</p>
                    @if ($services)
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
                    @endif
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
            </div>
            <div class="mt-6 text-sm font-medium border-t border-1 border-gray-400 pt-6">
                Total Price: <span class="font-bold text-green-500">{{ number_format($this->totalPrice, 2) }}</span>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" wire:click="createNewInvoice" />
                    </div>
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    <x-modal blur name="viewInvoiceModal" align="center" max-width="4xl">
        <x-card title="Invoice Details">
            @if ($selectedInvoice)
                {{-- @dump($selectedInvoice->services) --}}
                <div class="w-full h-auto">
                    <div class="w-full h-auto mb-3">
                        <h1 class="text-center font-semibold text-2xl">Invoice</h1>
                        <div class="flex justify-center items-center mt-1">
                            <img src="{{ asset('/images/sched-logo.png') }}" alt="" width="25" height="25">
                            <span class="text-sm">by LawScheduler</span>
                        </div>
                    </div>
                    <hr class="border-2">
                    <div class="w-full h-auto mt-3 mb-3">
                        <div class="grid grid-cols-2">
                            <div>
                                <p class="font-semibold">Billed To: <span class="text-sm text-gray-600 font-normal">{{$selectedInvoice->client->name}}</span></p>
                                <p class="font-semibold">Address: <span class="text-sm text-gray-600 font-normal italic uppercase">{{$selectedInvoice->client->info->barangay}} {{$selectedInvoice->client->info->municipality}} {{$selectedInvoice->client->info->province}}, {{$selectedInvoice->client->info->state}}</span></p>
                                <p class="font-semibold">Mobile: <span class="text-sm text-gray-600 font-normal">{{$selectedInvoice->client->info->phone}}</span></p>
                            </div>
                            
                            <div>
                                <p class="font-semibold text-lg">Invoice No: <span class="text-base text-gray-600 font-normal">{{$selectedInvoice->invoice_number}}</span></p>
                                <p class="font-semibold">Invoice Date: <span class="text-sm text-gray-600 font-normal">{{$selectedInvoice->invoice_date}}</span></p>
                                <p class="font-semibold">Invoice Due Date: <span class="text-sm text-gray-600 font-normal">{{$selectedInvoice->invoice_due_date}}</span></p>
                            </div>
                        </div>
                    </div>
                    <hr class="border-2">
                    <div class="w-full h-auto mt-10 pb-10">
                        @if ($selectedInvoice->services)
                            <div class="flex flex-col">
                                <div class="-m-1.5 overflow-x-auto">
                                    <div class="p-1.5 w-full inline-block align-middle">
                                        <div class="overflow-hidden">
                                            <table class="w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Service Name</th>
                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Price</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($selectedInvoice->services as $service)
                                                        <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-neutral-900 dark:even:bg-neutral-800">
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $service->name }}</td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ Number::currency($service->price, "PHP") }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <hr class="border-2">
                    <div class="w-full h-auto flex justify-end py-5 gap-4">
                        <div>Total:</div> 
                        <span class="font-bold text-green-500 mr-2">{{ Number::currency($selectedInvoice->total_amount, 'PHP') }}</span>
                    </div>
                </div>
            @else
                <div class="w-full h-auto py-8 flex justify-center items-center">
                    <div class="animate-spin inline-block size-8 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500"    role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            @endif
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Close" wire:click="closeModal" x-on:click="close" />
                        @if ($selectedInvoice)
                            <x-button primary label="Print" wire:click="generatePdf({{ $selectedInvoice->id }})" x-on:click="close"/>
                        @endif
                    </div>
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    {{-- EDIT MODAL --}}
    <x-modal blur name="editInvoiceModal" align="center" max-width="4xl">
        <x-card title="Edit Invoice">
            @if ($selectedInvoice)
                <x-select
                    label="Client"
                    wire:model.live="editClient"
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
                    disabled
                />
                
                @if ($editClient)
                    @if ($clientInfoEdit->isNotEmpty())
                        <div class="grid grid-cols-1 gap-4 mt-3">
                            @foreach ($clientInfoEdit as $info)
                                <div class="w-1/2 border border-gray-400 border-dashed rounded-lg p-3">
                                    <div class="flex items-center text-sm text-gray-800 font-semibold after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-neutral-600">Billed To</div>
                                    <p class="text-gray-600 font-medium text-sm">{{ $info->name }}</p>
                                    <p class="text-gray-500 font-medium text-sm italic">{{ $info->info->barangay }} {{ $info->info->municipality }} {{ $info->info->province }}, {{ $info->info->state }}</p>
                                    <p class="text-blue-600 font-medium text-sm">{{ $info->email }}</p>
                                    <p class="text-blue-600 font-medium text-sm">{{ $info->info->phone }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif
            
                <hr class="mt-5">
                <div class="grid grid-cols-1 gap-4 mt-3">
                    <div>
                        <div>
                            <x-input label="Invoice No." placeholder="Ex: INV-001002" wire:model="editInvoiceNumber" disabled/>
                        </div>
                        <div class="mt-3">
                            <x-datetime-picker
                                label="Invoice Date"
                                placeholder="Invoice Date"
                                wire:model="editInvoiceDate"
                                without-time="true"
                                without-tips="true"
                                parse-format="YYYY-MM-DD"
                                display-format="MMMM DD, YYYY"
                            />
                        </div>
                        <div class="mt-3">
                            <x-datetime-picker
                                label="Invoice Due Date"
                                placeholder="Invoice Due Date"
                                wire:model="editInvoiceDueDate"
                                without-time="true"
                                without-tips="true"
                                parse-format="YYYY-MM-DD"
                                display-format="MMMM DD, YYYY"
                            />
                        </div>
                    </div>
                </div>
                <hr class="mt-5">
                <div class="grid grid-cols-1 mt-3">
                    <div id="hs-wrapper-for-copy-one" class="space-y-3">
                        <p class="-mb-2 text-sm font-medium">Service/s</p>
                        @if ($editServices)
                            @foreach ($editServices as $index => $service)
                                <div id="copy-markup-item-one-{{ $service }}" class="space-y-3">
                                    <div class="flex space-x-3">
                                        <x-select
                                            wire:model.blur="editServices.{{ $index }}"
                                            placeholder="Ex: Consulation / Opinion Charge: Written (per hour/session)"
                                            :async-data="route('api.services')"
                                            option-label="name"
                                            option-value="id"
                                        />
                                        @if ($loop->first)

                                        @else
                                            <button type="button" wire:click="removeEditService({{ $index }})" class="py-2 px-3 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                                <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M19 13H5"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <p class="mt-3 text-end">
                        <button type="button" wire:click="addEditService" class="py-1.5 px-2 inline-flex items-center gap-x-1 text-xs font-medium rounded-full border border-dashed border-gray-200 bg-white text-gray-800 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                        Add Another Service
                        </button>
                    </p>
                </div>
                <div class="mt-6 text-sm font-medium border-t border-1 border-gray-400 pt-6">
                    Total Price: <span class="font-bold text-green-500">{{ number_format($editTotal, 2) }}</span>
                </div>
            @else
                <div class="w-full h-auto py-8 flex justify-center items-center">
                    <div class="animate-spin inline-block size-8 border-[3px] border-current border-t-transparent text-blue-600 rounded-full dark:text-blue-500"    role="status" aria-label="loading">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            @endif
            
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" wire:click="closeModal" x-on:click="close" />
                        @if ($selectedInvoice)
                            <x-button primary label="Save" wire:click="editInvoice({{ $selectedInvoice->id }})" />
                        @endif
                    </div>
                </div>
            </x-slot>
        </x-card>
    </x-modal>

    {{-- PAYMENT MODAL --}}
    <x-modal blur name="paymentReceivedModal" align="center" max-width="md">
        <x-card title="Create New Payment">
            <div class="grid grid-cols-1 gap-4 mt-3">
                <div>
                    <x-input label="Invoice No." placeholder="Ex: INV-001002" wire:model="refNo" disabled/>
                    
                </div>
                <div class="mt-3">
                    <x-inputs.maskable
                        label="Amount"
                        mask="['₱ ###', '₱ ##, ###', '₱ ###, ###', '₱ #, ###']"
                        placeholder="Ex: 30, 000"
                        wire:model="amountPaid"
                    />
                </div>
                <div class="mt-3">
                    <x-datetime-picker
                        label="Date Received"
                        placeholder="Received Date"
                        wire:model="receivingDate"
                        without-time="true"
                        without-tips="true"
                        parse-format="YYYY-MM-DD"
                        display-format="MMMM DD, YYYY"
                    />
                </div>
            </div>
            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        @if ($selectedInvoiceForPaymentId)
                            <x-button primary label="Save" wire:click="addPayment({{ $selectedInvoiceForPaymentId->id }})" x-on:click="close"/>
                        @endif
                    </div>
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
