<?php

namespace App\Livewire\Pages;

use App\Models\AppointmentDetails;
use App\Models\AppointmentsModel;
use App\Models\Orders;
use App\Models\Services;
use App\Models\User;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class AppointmentList extends Component
{
    use Actions;
    use WithPagination;

    public $client;
    public $title;
    public $description;
    public $date;
    // public $time;
    public $payment_method;
    public $payment_status;
    public $grand_total;
    public $status;
    public $services = [''];
    public bool $isActive;

    public $timeSlots = [];
    public $selectedTimeSlot;

    public $servicePrices = [];

    // SEARCH
    public $searchTerm;
    public $selectedMeetingId;
    public $meetingFullDetails;

    public function updatedDate()
    {
        $this->generateTimeSlots();
    }

    public function generateTimeSlots()
    {
        $this->timeSlots = [];
        
        $start = Carbon::createFromTimeString('09:00', 'Asia/Manila'); 
        $end = Carbon::createFromTimeString('18:00', 'Asia/Manila');

        $bookedSlots = [];
        $isToday = false;

        $manilaTimeZone = 'Asia/Manila';
        Carbon::setLocale('en'); 

        if ($this->date) {
            try {
                $formattedDate = Carbon::createFromFormat('Y-m-d', $this->date)->format('d-m-Y');
                $isToday = Carbon::createFromFormat('Y-m-d', $this->date)
                    ->timezone($manilaTimeZone)
                    ->isToday();
                $bookedSlots = AppointmentDetails::where('date', $formattedDate)
                    ->pluck('time')
                    ->map(function ($time) {
                        return Carbon::createFromFormat('H:i:s', $time)->format('H:i');
                    })
                    ->toArray();
                    
            } catch (\Exception $e) {
                $this->addError('date', 'Invalid date format.');
                return;
            }
        }

        while ($start->lessThanOrEqualTo($end)) {
            $timeSlotStorage = $start->format('H:i');
            
            $isPastSlot = $isToday && $start->timezone($manilaTimeZone)->isBefore(Carbon::now()->timezone($manilaTimeZone)); 
            $isDisabled = in_array($timeSlotStorage, $bookedSlots) && $timeSlotStorage !== $this->selectedTimeSlot || $isPastSlot;

            $this->timeSlots[] = [
                'display' => $start->format('h:i A'),  
                'storage' => $timeSlotStorage,
                'disabled' => $isDisabled,
            ];

            $start->addMinutes(30);
        }
    }

    public function getSelectedMeetingId($id){
       
        $this->selectedMeetingId = $id;
    
        if ($this->selectedMeetingId) {
            $this->meetingFullDetails = AppointmentsModel::where('id', $this->selectedMeetingId)
                ->with('appointmentDetails.orders')
                ->get();
            
            if($this->meetingFullDetails[0]->appointmentDetails){
                $this->client = $this->meetingFullDetails[0]->appointmentDetails->client_id;
                $this->title = $this->meetingFullDetails[0]->title;
                $this->description = $this->meetingFullDetails[0]->description;
                $this->date = $this->meetingFullDetails[0]->date;
                $this->selectedTimeSlot = Carbon::createFromFormat('H:i:s', $this->meetingFullDetails[0]->appointmentDetails->time)->format('H:i');
                $this->isActive = $this->meetingFullDetails[0]->is_active;
                $this->services = json_decode($this->meetingFullDetails[0]->appointmentDetails->orders->services_ids, true);
                $this->payment_status = $this->meetingFullDetails[0]->appointmentDetails->orders->payment_status;
                $this->payment_method = $this->meetingFullDetails[0]->appointmentDetails->orders->payment_method;
                $this->status = $this->meetingFullDetails[0]->appointmentDetails->orders->status;
                
                $order = $this->meetingFullDetails[0]->appointmentDetails->orders;
                if ($order && $order->services_ids) {
                    $serviceIds = json_decode($order->services_ids, true);
                    $this->services = array_combine($serviceIds, $serviceIds);
                    $this->servicePrices = Services::whereIn('id', $serviceIds)
                        ->pluck('price', 'id')
                        ->toArray();

                    $this->grand_total = $this->getTotalPriceProperty();
                }
            }
        
            foreach ($this->meetingFullDetails as $detail) {
                $participantId = $detail->appointmentDetails->client_id;
                $participants = User::with('info')->where('id', $participantId)->get();
                $detail->participantsDetails = $participants;
            }

            foreach ($this->meetingFullDetails as $detail) {
                $order = $detail->appointmentDetails->orders;
            
                if ($order && $order->services_ids) {
                    $serviceIds = json_decode($order->services_ids, true);
                    $services = Services::whereIn('id', $serviceIds)->get();
                    $order->services = $services;
                }
            }
        }
        $this->generateTimeSlots();
    }

    public function addService()
    {
        $this->services[] = '';  
        $this->servicePrices[] = 0;
        $this->grand_total = $this->getTotalPriceProperty(); 
    }

    public function removeService($index)
    {
        if (count($this->services) > 1) {
            unset($this->services[$index]);
            unset($this->servicePrices[$index]);
            $this->services = array_values($this->services);
            $this->servicePrices = array_values($this->servicePrices);
        }
    }

    public function updatedServices($value, $index)
    {
        $service = Services::find($value);
    
        if ($service) {
            $this->servicePrices[$index] = $service->price;
        } else {
            $this->servicePrices[$index] = 0;
        }
    }

    public function getTotalPriceProperty()
    {
        return array_sum($this->servicePrices);
    }

    public function editAppointment($id){

        $selectedAppointment = AppointmentsModel::with('appointmentDetails')->findOrFail($id);

        $selectedAppointment->update([
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'is_active' => $this->isActive,
        ]);
        
        $appointmentDetails = AppointmentDetails::where('id', $selectedAppointment->appointmentDetails->id);

        $appointmentDetails->update([
            'client_id' => $this->client,
            'title' => $this->title,
            'date' => $this->date,
            'time' => $this->selectedTimeSlot,
            'description' => $this->description,
        ]);

        $order = Orders::where('id', $selectedAppointment->appointmentDetails->orders->id);

        $order->update([
            'services_ids' => json_encode($this->services),
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'grand_total' => self::getTotalPriceProperty(),
            'status' => $this->status
        ]);

        

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function deleteMeeting($id){
        $appointment = AppointmentsModel::with('appointmentDetails')->findOrFail($id);

        $appointmentDetails = $appointment->appointmentDetails;

        if ($appointmentDetails) {
            $appointmentDetails->delete();
        }

        $appointment->delete();

        Notification::make()
            ->title('Success!')
            ->body('Appointment has been deleted.')
            ->success()
            ->send();
        
        return redirect()->back();
    }

    public function deleteConfirmation($id, $appointmentTitle){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this appointment " . html_entity_decode('<span class="text-red-600 underline">' . $appointmentTitle . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteMeeting',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }
    public function cancel(){
        $this->client = "";
        $this->title = "";
        $this->description = "";
        $this->date = "";
        $this->selectedTimeSlot = "";
        $this->payment_method = "";
        $this->payment_status = "";
        $this->grand_total = "";
        $this->status = "";
    }
    public function render()
    {
        if ($this->searchTerm) {
            $searchItems = AppointmentsModel::whereHas('appointmentDetails.orders', function ($query) {
                $query->where('title', 'like', '%' . $this->searchTerm . '%')
                      ->where('payment_status', '<>', 'Failed');
            })
            ->with(['appointmentDetails.orders' => function ($query) {
                $query->where('payment_status', '<>', 'Failed');
            }])
            ->latest()
            ->paginate(8);

            $appointmentList = $searchItems;
        } else {
            $appointmentList = AppointmentsModel::whereHas('appointmentDetails.orders', function ($query) {
                $query->where('payment_status', '<>', 'Failed');
            })
            ->with(['appointmentDetails.orders' => function ($query) {
                $query->where('payment_status', '<>', 'Failed');
            }])
            ->latest()
            ->paginate(8);
        }

        foreach ($appointmentList as $appointment) {
            if ($appointment->appointmentDetails) {
                $participantId = $appointment->appointmentDetails->client_id;

                // Fetch participants details along with user_info
                $participants = User::with('info')->where('id', $participantId)->get();

                // Attach participants details to the appointment
                $appointment->participantsDetails = $participants;
            } else {
                // Handle case where zoomMeet is null
                $appointment->participantsDetails = [];
            }
        }

        foreach ($appointmentList as $appointment) {
            if($appointment->appointmentDetails){
                $order = $appointment->appointmentDetails->orders;
        
                if ($order && $order->services_ids) {
                    $serviceIds = json_decode($order->services_ids, true);
                    $services = Services::whereIn('id', $serviceIds)->get();
                    $order->services = $services;
                }
            }
            
        }

        return view('livewire.pages.appointment-list',[
            'appointmentList' => $appointmentList,
            'grand_total' => $this->getTotalPriceProperty(),
        ]);
    }
}
