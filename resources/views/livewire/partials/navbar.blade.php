<header class="flex flex-wrap sm:justify-start sm:flex-nowrap w-full text-sm py-8 md:py-5 bg-transparent md:fixed z-10">
    <nav class="max-w-[97rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between" aria-label="Global">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse text-[#2b2b31] font-bold text-lg md:text-lg md:mx-auto md:mb-3 lg:text-3xl lg:mx-px">
            <img src="{{ asset('images/sched-logo.png') }}" class="h-14" alt="Flowbite Logo">
            LawScheduler
        </a>
      @if (!request()->is('login') && !request()->is('register') && !request()->is('forgot') && !request()->is('reset*'))
        <div class="sm:order-3 flex items-center gap-x-2">
          <button type="button" class="sm:hidden hs-collapse-toggle p-2.5 inline-flex justify-center items-center gap-x-2 rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-transparent dark:border-neutral-700 dark:text-white dark:hover:bg-white/10" data-hs-collapse="#navbar-alignment" aria-controls="navbar-alignment" aria-label="Toggle navigation">
            <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
            <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          </button>
          <div class="hidden lg:block">
              @guest
                  <a href="{{ route('login') }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold border border-transparent bg-transparent text-[#2b2b31] hover:bg-slate-300 disabled:opacity-50 disabled:pointer-events-none">
                      Login
                  </a>
                  <a href="{{ route('register') }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold border border-transparent bg-[#2b2b31] text-white hover:bg-slate-950 disabled:opacity-50 disabled:pointer-events-none">
                      Sign up
                  </a>
              @endguest
              @auth
                  <div class="flex items-center justify-center">
                      <div class="hs-dropdown relative inline-flex md:flex md:items-center md:justify-center">
                          <button id="hs-dropdown-default" type="button" class="hs-dropdown-toggle py-2 inline-flex items-center gap-x-2 text-base font-medium rounded-lg text-[#2b2b31]">
                            <div class="flex justify-center items-center gap-2">
                                <img src="{{ asset(auth()->user()->profile_picture) }}" alt="{{ auth()->user()->name }}" class="w-10 h-10">
                                {{ auth()->user()->name }}
                            </div>
                              
                            <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                          </button>
                      
                          <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full z-50" aria-labelledby="hs-dropdown-default">
                              {{-- <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="#">
                                  {{ __('Appointments') }}
                              </a> --}}
                              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="{{ route('client.account') }}">
                                  {{ __('My Account' )}}
                              </a>
                              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="{{ route('client.invoice') }}">
                                {{ __('My Invoice' )}}
                              </a>
                              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="/logout">
                                  {{ __('Logout' )}}
                              </a>
                          </div>
                      </div>
                  </div>
              @endauth
          </div>
        </div>
        
        <div id="navbar-alignment" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:grow-0 sm:basis-auto sm:block sm:order-2">
          <div class="flex flex-col gap-8 lg:gap-16 mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5">
            <a class="font-medium {{ request()->is('/') ? 'text-[#d6b685]' : 'text-[#2b2b31]'  }} text-base" href="/" aria-current="page">Home</a>
            {{-- <div class="hs-dropdown [--strategy:static] sm:[--strategy:fixed] [--adaptive:none] ">
              <button id="hs-mega-menu-basic-dr" type="button" class="flex items-center w-full text-[#2b2b31] hover:text-[#d6b685] font-medium dark:text-neutral-400 dark:hover:text-neutral-500 text-base">
                Practice Areas
                <svg class="ms-1 flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
              </button>
              <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 sm:w-48 z-10 bg-white sm:shadow-md rounded-lg p-2 dark:bg-neutral-800 sm:dark:border dark:border-neutral-700 dark:divide-neutral-700 before:absolute top-full sm:border before:-top-5 before:start-0 before:w-full before:h-5 hidden">
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-[#2b2b31] hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300" href="#">
                  Program
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-[#2b2b31] hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300" href="#">
                  Queue
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-[#2b2b31] hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300" href="#">
                  Report
                </a>
              </div>
            </div> --}}
            <a class="font-medium text-[#2b2b31] hover:text-[#d6b685] dark:text-neutral-400 dark:hover:text-neutral-500 text-base" href="#">Members</a>
            <a class="font-medium text-[#2b2b31] hover:text-[#d6b685] dark:text-neutral-400 dark:hover:text-neutral-500 text-base" href="#">About Us</a>
            <a class="font-medium text-[#2b2b31] hover:text-[#d6b685] dark:text-neutral-400 dark:hover:text-neutral-500 text-base" href="#">Contact</a>

            <div class="flex justify-center lg:hidden md:ml-10">
              {{-- <a href="{{ route('login') }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold border border-transparent bg-transparent text-[#2b2b31] hover:bg-slate-300 disabled:opacity-50 disabled:pointer-events-none">
                  Login
              </a>
              <a class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold border border-transparent bg-[#2b2b31] text-white hover:bg-slate-950 disabled:opacity-50 disabled:pointer-events-none">
                  Sign up
              </a> --}}
              @guest
                  <a href="{{ route('login') }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold border border-transparent bg-transparent text-[#2b2b31] hover:bg-slate-300 disabled:opacity-50 disabled:pointer-events-none">
                      Login
                  </a>
                  <a href="{{ route('register') }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold border border-transparent bg-[#2b2b31] text-white hover:bg-slate-950 disabled:opacity-50 disabled:pointer-events-none">
                      Sign up
                  </a>
              @endguest
              @auth
                  <div class="flex items-center justify-center">
                      <div class="hs-dropdown relative inline-flex md:flex md:items-center md:justify-center">
                          <button id="hs-dropdown-default" type="button" class="hs-dropdown-toggle py-2 inline-flex items-center gap-x-2 text-base font-medium rounded-lg text-[#2b2b31]">
                              {{ auth()->user()->name }}
                              <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                          </button>
                      
                          <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full z-50" aria-labelledby="hs-dropdown-default">
                              {{-- <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="#">
                                  {{ __('Appointments') }}
                              </a> --}}
                              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="{{ route('client.account') }}">
                                  {{ __('My Account' )}}
                              </a>
                              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="{{ route('client.invoice') }}">
                                {{ __('My Invoice' )}}
                              </a>
                              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:focus:bg-gray-700" href="/logout">
                                  {{ __('Logout' )}}
                              </a>
                          </div>
                      </div>
                  </div>
              @endauth
            </div>
          </div>
        </div>
      @endif
    </nav>
</header>
  