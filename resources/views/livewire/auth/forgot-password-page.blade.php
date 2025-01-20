<div class="w-full h-full flex flex-row">
    <div class="w-full md:w-[40%] h-screen flex flex-col justify-center items-center gap-5 -mt-32 md:-mt-10">
        <h1 class="text-2xl md:text-4xl font-medium text-center">Forgot Password</h1>
        <p class="text-center">No worries, We'll send you instruction for reset.</p>
        <form wire:submit.prevent="forgot" class="w-full flex flex-col justify-center items-center mt-2">
            <div class="w-full flex flex-col justify-center items-center mb-2">
                <div class="space-y-6 w-[80%] md:w-[50%]">
                    <div class="relative">
                        <x-input icon="mail" label="Email" placeholder="Enter your email" wire:model="email" class="py-3"/>
                    </div>
                </div>
            </div>
            <button type="submit" class="w-[80%] md:w-[50%] mb-2 py-3 px-4 mt-5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#2b2b31] text-white hover:bg-slate-950 disabled:opacity-50 disabled:pointer-events-none">
                Reset Password
            </button>
            <a href="{{ route('login') }}" class="w-[80%] md:w-[50%] py-3 px-4 mt-5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:cursor-pointer hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                Back
            </a>
        </form>
    </div>
    <div class="w-[60%] h-screen rounded-l-[8%] overflow-hidden relative hidden md:block">
        <img src="{{ asset('images/building2.jpg') }}" alt="" class="object-cover object-right-bottom w-auto h-full">
        <a class="flex items-center justify-center text-white font-medium text-5xl absolute inset-0 m-auto">
            <img src="{{ asset('images/logo-white.png') }}" alt="">
            LawScheduler
        </a>
    </div>
</div>
