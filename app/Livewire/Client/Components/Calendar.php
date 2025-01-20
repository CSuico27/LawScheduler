<?php

namespace App\Livewire\Client\Components;

use App\Models\AppointmentDetails;
use App\Models\AppointmentsModel;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Omnia\LivewireCalendar\LivewireCalendar;
use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Auth;

class Calendar extends LivewireCalendar
{
    use Actions;
    public $selectedDate;

    // Click Event
    public $selectedMeetingId;
    public $meetingFullDetails;
    
    public function updatedSelectedDate()
    {
        $this->events();
    }

    public function onEventClick($eventId)
    {

        // Fetch the event associated with the logged-in user
        $event = $this->events()->where('id', $eventId)->first();

        if ($event) {
            // Get the meeting details with Zoom meeting data
            $this->meetingFullDetails = AppointmentsModel::where('id', $eventId)
                ->with('zoomMeet')
                ->with('appointmentDetails.orders')
                ->get();
        
            // Prepare data to pass to the event
            $eventData = [];
            foreach ($this->meetingFullDetails as $detail) {
                if($detail->zoomMeet){
                    $participantIds = json_decode($detail->zoomMeet->participants, true);
                    $participants = User::with('info')->whereIn('id', $participantIds)->get();
                    $detail->participantsDetails = $participants;
                } else {
                    $participantId = $detail->appointmentDetails->client_id;
                    $participants = User::with('info')->where('id', $participantId)->get();
                    $detail->participantsDetails = $participants;

                    $order = $detail->appointmentDetails->orders;
            
                    if ($order && $order->services_ids) {
                        $serviceIds = json_decode($order->services_ids, true);
                        $services = Services::whereIn('id', $serviceIds)->get();
                        $order->services = $services;
                    }
                }
                
                
                $eventData[] = [
                    'meetingDetails' => $detail,
                    'participants' => $participants
                ];
            }

            // Dispatch the event with the structured data
            $this->dispatch('showFullDetailsClient', [
                'eventData' => $eventData,
            ]);
        }
    }

    public function events(): Collection
    {
        $userId = Auth::id();

        return AppointmentsModel::whereNotNull('date')
            ->where(function ($query) use ($userId) {
                // Filter for client_id in AppointmentDetails and group conditions
                $query->whereHas('appointmentDetails', function ($query) use ($userId) {
                    $query->where('client_id', $userId)
                        ->whereHas('orders', function ($query) {
                            $query->where('payment_status', 'Unpaid')
                                    ->orWhere(function ($query) {
                                        $query->where('status', 'Unclaimed')
                                            ->where('payment_status', '<>', 'Failed');
                                    });
                        });
                })
                ->orWhereHas('zoomMeet', function ($query) use ($userId) {
                    $query->where('participants', 'like', '%' . $userId . '%');
                });
            })
            // Add the filter for selectedDate if it's provided
            ->when($this->selectedDate, function ($query) {
                $query->whereDate('date', Carbon::parse($this->selectedDate)->toDateString());
            })
            ->with(['appointmentDetails.orders' => function ($query) {
                $query->where('payment_status', '<>', 'Failed');
            }])
            ->get();
    }

}
