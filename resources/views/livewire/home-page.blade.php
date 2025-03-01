<div class="w-full h-screen px-10 md:px-24">
    {{-- HERO SECTION --}}
    <div class="flex flex-col h-full md:flex md:flex-row ">
        <div class="flex flex-col justify-center gap-5 w-full mt-5 md:mt-16">
            <p class="font-medium text-sm">-GETTING IT DONE.</p>
            <p class="font-serif text-4xl font-semibold md:text-5xl">Trusted legal solutions for the real world.</p>
            <p class="md:pr-20">
                Organize your tasks, lists and reminders in one app, it will help you a lot.
            </p>
            <div class="flex flex-col items-center gap-5 mt-5 md:flex md:flex-row">
                <a href="{{ route('client.booking') }}" class="py-3 px-6 inline-flex items-center gap-x-2 text-sm font-semibold border border-transparent bg-[#d1ab70] text-white hover:bg-[#d6b685] disabled:opacity-50 hover:cursor-pointer">
                    Book Appointment
                </a>
                <div class="flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 3.75v4.5m0-4.5h-4.5m4.5 0-6 6m3 12c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                    </svg>    
                    <div class="">
                        <p class="text-sm font-normal">Or call us at</p>
                        <p class="font-medium">0123 567 8901</p>
                    </div>                  
                </div>
            </div>   
        </div>  
        <div class="w-full relative mt-24 md:mb-14">
            <div class="w-full h-full ">
                <img src="{{ asset('images/justice.jpg')}} " alt="" class="w-full h-full object-contain object-center hidden md:block">
                <div class="absolute inset-0 bg-gradient-to-r from-[#f1f4f6] via-transparent to-transparent"></div>
            </div> 
           
            {{-- <div class="w-48 h-36 md:w-72 md:h-44 flex flex-col justify-center items-center gap-1 md:gap-2 absolute -right-5 bottom-20 bg-white shadow-2xl opacity-95 md:rounded-md ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#d1ab70" class="size-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                </svg>
                <div class="flex justify-center items-center">
                    <span class="text-2xl md:text-5xl font-semibold">10</span>
                    <span class="text-xl md:text-3xl font-extralight">+</span>
                </div>
                <p class="text-center text-xs px-5 md:text-base">
                    Years of experience in this field.
                </p>
            </div>   --}}
        </div>
    </div>
    
    {{-- SERVICES SECTION --}}
    
</div>
