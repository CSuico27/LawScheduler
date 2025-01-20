<div class="w-full h-svh pt-32 flex flex-col items-center">
    @if ($order)
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="p-4 md:p-5">
                <h1 class="text-lg font-bold text-gray-800 dark:text-white">
                    Thank you. Your appointment has been received.
                </h1>
                <div class="flex flex-col mt-5">
                    @foreach ($userInfo as $info)
                        <p class="mt-2 text-black dark:text-neutral-400 font-semibold">
                        {{ $info->name }}
                        </p>
                        <p class="text-gray-500 dark:text-neutral-400 font-medium text-xs uppercase">
                            {{ $info->info->barangay }} {{ $info->info->province }} {{ $info->info->municipality }}, {{ $info->info->state }}
                        </p>
                        <p class="text-blue-500 dark:text-neutral-400 font-medium text-xs">
                            {{ $info->email }}
                        </p>
                        <p class="text-blue-500 dark:text-neutral-400 font-medium text-xs">
                            <span class="text-gray-500">Phone: </span>{{ $info->info->phone }}
                        </p>
                    @endforeach
                </div>
                <div class="py-3 flex items-center text-sm text-gray-800 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:after:border-neutral-600">Order Details</div>
                <div class="flex flex-col mt-5">
                    <p class="text-black dark:text-neutral-400 font-semibold">Appointment Number</p>
                    <p>{{$order->id}}</p>
                </div>
                <div class="flex flex-col mt-5">
                    <p class="text-black dark:text-neutral-400 font-semibold">Date</p>
                    <p>{{ \Carbon\Carbon::parse($order->date)->format('F j, Y') }}</p>
                </div>
                <div class="flex flex-col mt-5">
                    <p class="text-black dark:text-neutral-400 font-semibold">Total</p>
                    <p>{{ Number::currency($order->orders->grand_total, 'PHP') }}</p>
                </div>
                <div class="flex flex-col mt-5">
                    <p class="text-black dark:text-neutral-400 font-semibold">Payment Method</p>
                    @if ($order->orders->payment_method == 'Stripe')
                        Stripe
                    @else
                        Cash
                    @endif
                </div>
            </div>
            <div class="bg-gray-100 border-t rounded-b-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
                <div class="flex items-center justify-end gap-4">
                    <a href="/my-account" class="w-full text-center px-4 py-2 bg-blue-500 rounded-md text-gray-50 md:w-auto dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 dark:bg-gray-800">
                      View My Appointments
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
