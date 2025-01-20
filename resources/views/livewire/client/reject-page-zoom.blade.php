<div class="h-screen w-full flex flex-col items-center justify-center p-6 max-w-sm mx-auto">
    <!-- Icon on top -->
    @if ($zoomStatus === 'accepted' || $zoomStatus === 'rejected')
        <div class="mb-4 p-3 bg-red-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-16 h-16 text-red-600">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
    @else
        <div class="mb-4 p-3 bg-red-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-16 h-16 text-red-600">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
    @endif
    
    @if ($zoomStatus === 'accepted' || $zoomStatus === 'rejected')
        <!-- Appointment Accepted Message -->
        <h1 class="text-2xl font-semibold text-gray-700 mb-2 text-center">Zoom Meeting Status Unavailable</h1>
        <p class="text-lg text-gray-600 text-center">This appointment is no longer in pending status and cannot be accepted or rejected.</p>
    @else
        <!-- Appointment Rejected Message -->
        <h1 class="text-2xl font-semibold text-red-700 mb-2 text-center">Zoom Meeting Rejected</h1>
        <p class="text-lg text-red-600 text-center">Your appointment has been rejected.</p>
    @endif
</div>
