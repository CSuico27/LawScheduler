<div>
    @if ($selectedInvoice)
        <div style="width: 100%; height: auto;">
            <div style="width: 100%; display: flex; flex-direction: column; justify-item:center;">
                <h1 class="text-center font-semibold text-2xl">Invoice</h1>
                <div class="flex justify-center items-center mt-1">
                    {{-- <img src="{{ asset('/images/sched-logo.png') }}" alt="" width="25" height="25"> --}}
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
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">PHP {{ $service->price }}</td>
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
                <span class="font-bold text-green-500 mr-2">PHP {{ $selectedInvoice->total_amount }}</span>
            </div>
        </div>
    @endif
</div>
