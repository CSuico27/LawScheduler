<div class="w-full h-full flex flex-row">
    <div class="w-[40%] h-screen flex flex-col justify-center items-center gap-5">
        <h1 class="text-4xl font-medium">Choose new password</h1>
        <p>Almost done. Enter your new password and you're all set.</p>
        <form wire:submit.prevent="resetPass" class="w-full flex flex-col justify-center items-center mt-2">
            <div class="w-full flex flex-col justify-center items-center mb-2">
                <div class="space-y-6 w-[50%]">
                    <div class="relative">
                        <x-input type="password" icon="key" label="New password" placeholder="Enter your new password" class="py-3" wire:model="password"/>
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        </div>
                    </div>
                    <div class="relative">
                        <x-input type="password" icon="key" label="Confirm new password" placeholder="Confirm your new password" class="py-3" wire:model="password_confirmation"/>
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="w-[50%] mb-2 py-3 px-4 mt-5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#2b2b31] text-white hover:bg-slate-950 disabled:opacity-50 disabled:pointer-events-none">
                Reset Password
            </button>
            <a href="{{ route('login') }}" class="w-[50%] py-3 px-4 mt-5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:cursor-pointer hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                Back
            </a>
        </form>
    </div>
    <div class="w-[60%] h-screen rounded-l-[8%] overflow-hidden relative">
        <img src="{{ asset('images/building2.jpg') }}" alt="" class="object-cover object-right-bottom w-auto h-full">
        <a class="flex items-center justify-center text-white font-medium text-5xl absolute inset-0 m-auto">
            <img src="{{ asset('images/logo-white.png') }}" alt="">
            LawScheduler
        </a>
    </div>
</div>
