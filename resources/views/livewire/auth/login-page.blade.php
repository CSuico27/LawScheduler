<div class="flex justify-center items-center md:flex">
    <div class="md:w-[40%] flex flex-col justify-center items-center gap-3 md:-mt-10">
        <h1 class="text-4xl md:text-4xl font-medium text-center md:mt-24">Welcome Back</h1>
        <p class="text-base text-center">Welcome Back, Please enter your details.</p>
        <form wire:submit.prevent="login" class="w-full flex flex-col justify-center items-center mt-10">
            <div class="w-full flex flex-col justify-center items-center">
                <div class="space-y-6 w-[90%] md:w-[70%]">
                    <div class="relative">
                        <x-input icon="user" label="Email" placeholder="Enter email" wire:model="email" class="py-3"/>
                        {{-- <input type="email" wire:model="email" class="peer py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" placeholder="Enter email"> --}}
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        {{-- <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg> --}}
                        </div>
                    </div>
                    
                    <div class="relative">
                        <x-inputs.password icon="key" label="Password" placeholder="Enter password" class="py-3" wire:model="password"/>
                        {{-- <input type="password" wire:model="password" class="peer py-3 pe-0 ps-8 block w-full bg-transparent border-t-transparent border-b-2 border-x-transparent border-b-gray-200 text-sm focus:border-t-transparent focus:border-x-transparent focus:border-b-blue-500 focus:ring-0 disabled:opacity-50 disabled:pointer-events-none dark:border-b-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 dark:focus:border-b-neutral-600" placeholder="Enter password"> --}}
                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-2 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                        {{-- <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 18v3c0 .6.4 1 1 1h4v-3h3v-3h2l1.4-1.4a6.5 6.5 0 1 0-4-4Z"></path>
                            <circle cx="16.5" cy="7.5" r=".5"></circle>
                        </svg> --}}
                        </div>
                    </div>
                    <div class="flex justify-end md:justify-end">
                        <a href="{{ route('password.request') }}" class="underline">Forgot password</a>
                    </div>
                </div>
            </div>
            <button type="submit" class="w-[90%] md:w-[70%] py-3 px-4 mt-5 inline-flex justify-center items-center gap-x-2 text-base font-medium rounded-lg border border-transparent bg-[#2b2b31] text-white hover:bg-slate-950 disabled:opacity-50 disabled:pointer-events-none">
                Log in
            </button>
        </form>
        <div class="flex flex-col text-sm">
            <div class="flex gap-1 pt-3 px-8">
                <p>Don't have an account?</p>
                <a href="{{ route('register') }}" class="font-bold">Sign up for free</a>
            </div>
            <img src="{{ asset('images/sign-2.png')}}" alt="" class="w-40 md:w-40 self-end -mt-1 pr-6">
        </div>
    </div>
    <div class="w-[60%] h-screen rounded-l-[8%] overflow-hidden relative hidden md:block">
        <img src="{{ asset('images/building2.jpg') }}" alt="" class="object-cover object-right-bottom w-auto h-full">
        <a class="flex items-center justify-center text-white font-medium text-5xl absolute inset-0 m-auto">
            <img src="{{ asset('images/logo-white.png') }}" alt="">
            LawScheduler
        </a>
    </div>
</div>
