<div class="w-full h-svh pt-32 flex flex-col items-center">
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
        <div class="p-4 md:p-5">
            <div class="flex justify-center items-center">
                <img src="{{ asset('/images/failed.gif')}}" alt="">

                <h1 class="font-semibold text-red-500">Payment Failed! Order Cancelled!</h1>
            </div>
        </div>
        <div class="bg-gray-100 border-t rounded-b-xl py-3 px-4 md:py-4 md:px-5 dark:bg-neutral-900 dark:border-neutral-700">
            <div class="flex items-center justify-end gap-4">
                <a href="/" class="w-full text-center px-4 py-2 bg-blue-500 rounded-md text-gray-50 md:w-auto dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 dark:bg-gray-800">
                  Back
                </a>
            </div>
        </div>
    </div>
</div>
