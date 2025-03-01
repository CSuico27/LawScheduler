<?php

namespace App\Livewire\Pages;

use App\Mail\AppointmentCreation;
use App\Mail\ZoomCreation;
use App\Mail\ZoomMeetingEmail;
use App\Models\AppointmentDetails;
use App\Models\AppointmentsModel;
use App\Models\BeneficiariesModel;
use App\Models\Orders;
use App\Models\Services;
use Filament\Notifications\Notification;
use App\Models\User;
use App\Models\ZoomMeeting;
use App\Models\ZoomToken;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use WireUi\Traits\Actions;
use Omnia\LivewireCalendar\LivewireCalendar;
use Twilio\Rest\Client;
use GuzzleHttp\Client as GuzClient;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AppointmentPage extends LivewireCalendar
{
    use Actions;
    
    // ADD
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

    public $timeSlots = [];
    public $selectedTimeSlot;
    
    // EDIT
    public $editTitle;
    public $editDescription;
    public bool $isActive;
    public $editPayment_method;
    public $editPayment_status;
    public $editGrand_total;
    public $editStatus;
    public $eventID;
    public $cardModal;
    public $selectedEvent;
    public $editServices = [''];

    public $recipients = [];

    // MEETING
    public $meetingTopic;
    public $meetingDescription;
    public $meetingParticipant = [];
    public $meetingDate;
    public $meetingId;
    public $meetingStartDate;
    public $meetingDurationFrom;
    public $meetingDurationTo;
    public $meetingJoinUrl;
    public $meetingHostId;
    public $meetingPassword;
    public $meetingAgenda;

    public $servicePrices = [];

    // Click Event
    public $clientId;
    public $selectedMeetingId;
    public $meetingFullDetails;

    public function slots(){
        $this->generateTimeSlots();
    }
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
            $isDisabled = in_array($timeSlotStorage, $bookedSlots) || $isPastSlot;

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
                ->with('zoomMeet')
                ->with('appointmentDetails.orders')
                ->get();
    
            foreach ($this->meetingFullDetails as $detail) {
                if($detail->zoomMeet){
                    $participantIds = json_decode($detail->zoomMeet->participants, true);
                    $participants = User::with('info')->whereIn('id', $participantIds)->get();
                    $detail->participantsDetails = $participants;
                } else {
                    $participantId = $detail->appointmentDetails->client_id;
                    $participants = User::with('info')->where('id', $participantId)->get();
                    $detail->participantsDetails = $participants;
                }
            }
        
        }
    }

    public function addService()
    {
        $this->services[] = '';  
        $this->editServices[] = '';  
    }

    public function removeService($index)
    {
        if (count($this->services) > 1) {
            unset($this->services[$index]);
            unset($this->servicePrices[$index]);
            $this->services = array_values($this->services);
            $this->servicePrices = array_values($this->servicePrices);
        }

        if (count($this->editServices) > 1) {
            unset($this->editServices[$index]);
            $this->editServices = array_values($this->editServices);
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

    public function resetModal(){
        $this->reset();
    }

    public function newEvent(){

        // $this->recipients = BeneficiariesModel::pluck('phone')->toArray();
        
        $this->validate([ 
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'date' => 'required|date',
            'client' => 'required|exists:users,id', 
            'selectedTimeSlot' => 'required|date_format:H:i',
            'services.*' => 'required|max:255',
            'payment_status' => 'required'
        ]);
        
        

        $event = AppointmentsModel::create([
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date
        ]);

        $appointDetails = AppointmentDetails::create([
            'appointment_id' => $event->id,
            'client_id' => $this->client,
            'title' => $this->title,
            'date' => Carbon::createFromFormat('Y-m-d', $this->date)->format('d-m-Y'),
            'time' => $this->selectedTimeSlot,
            'description' => $this->description,
            'is_viewed' => 'new',
            'is_accepted' => 'pending'
        ]);

        $order = Orders::create([
            'appointment_detail_id' => $appointDetails->id,
            'services_ids' => json_encode($this->services),
            'payment_method' => 'Cash',
            'payment_status' => $this->payment_status,
            'grand_total' => self::getTotalPriceProperty(),
            'status' => 'Unclaimed'
        ]);

        
        $serviceIds = array_filter($this->services);
        if (!empty($serviceIds)) {
            $requirements = Services::whereIn('id', $serviceIds)->pluck('requirements')->toArray();
            $filteredRequirements = implode(', ', $requirements);
        }

        if($this->client){
            $client = User::where('id', $this->client)->first();
        }
        
        try {
            $this->sendSMS($this->title, $this->date);
            
        } catch (\Throwable $e) {
            $this->dispatch('reload');
            // Log::error('Error sending SMS: ' . $e->getMessage());
            Notification::make()
                ->title('Error!')
                ->body('Failed to send SMS.')
                ->danger()
                ->send();
        }
        Mail::to($client->email)->send(new AppointmentCreation($filteredRequirements, Carbon::parse($appointDetails->time)->format('h:i A'), Carbon::createFromFormat('Y-m-d', $this->date)->format('d-m-Y'), $appointDetails->id));
        Notification::make()
            ->title('Success!')
            ->body('Appointment has been created.')
            ->success()
            ->send();

        $this->title = "";
        $this->description = "";
        $this->date = "";
    
        $this->dispatch('reload');

        return redirect()->back();
    }
    
    public function editEvent($id){

        $this->selectedEvent = AppointmentsModel::findOrFail($id);

        $this->selectedEvent->update([
            'title' => $this->editTitle,
            'description' => $this->editDescription,
            'is_active' => $this->isActive,
        ]);
        
        $appointmentDetails = AppointmentDetails::find($this->selectedEvent->id);

        dd($appointmentDetails);

        $this->dispatch('reload');

        return redirect()->back();
    }

    public function onEventClick($eventId)
    {
        $event = $this->events()->firstWhere('id', $eventId);

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
            $this->dispatch('showFullDetails', [
                'eventData' => $eventData
            ]);
        }
    }
    public function deleteConfirmation($id, $eventTitle){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this event " . html_entity_decode('<span class="text-red-600 underline">' . $eventTitle . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteEvent',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }

    public function deleteEvent($id){
        AppointmentsModel::find($id)->delete();
        $this->dispatch('reload');
        return redirect()->back();
    }

    public function onEventDropped($eventId, $year, $month, $day)
    {   
        $appointment  = AppointmentsModel::where('id', $eventId)->update(['date' => $year . '-' . $month . '-' . $day]);
        $event = AppointmentsModel::where('id', $eventId)->with('zoomMeet')->first();
        // $this->sendSingleUpdatedSMS($event->title, $event->date);

        $newDate = Carbon::create($year, $month, $day)->toDateString();

        if ($event->zoomMeet) {
            
            $zoomMeetingId = $event->zoomMeet->meeting_id;

             
            if (is_numeric($event->zoomMeet->start_time)) {
                $startTime = Carbon::createFromTimestamp($event->zoomMeet->start_time);
            } else {
                $startTime = Carbon::parse($event->zoomMeet->start_time);
            }

            $newStartTime = Carbon::parse("$newDate {$startTime->format('H:i:s')}")->format('Y-m-d\TH:i:s\Z');
        
            try {
                $zoomTokenResponse = $this->generateToken();
                if ($zoomTokenResponse && isset($zoomTokenResponse['access_token'])) {
                    $zoomToken = $zoomTokenResponse['access_token'];

                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $zoomToken,
                        'Content-Type' => 'application/json',
                    ])->patch("https://api.zoom.us/v2/meetings/{$zoomMeetingId}", [
                        'start_time' => $newStartTime,
                    ]);

                    if ($response->successful()) {
                        ZoomMeeting::where('appointment_id', $eventId)->update([
                            'start_time' => $newStartTime,
                        ]);
                        Notification::make()
                            ->title('Success!')
                            ->body('Meeting Date has been moved.')
                            ->success()
                            ->send();
                        return $response->json();
                    } else {
                        return response()->json(['error' => 'Failed to create Zoom meeting'], 500);
                    }

                } else {

                }
            } catch (\Throwable $th) {
                throw $th;
            }
        } else {
            Notification::make()
                ->title('Success!')
                ->body('Appointment Date has been moved.')
                ->success()
                ->send();
        } 
    }
    
    public function updatedclientId(){
        $this->events();
    }
    
    public function events(): Collection
    {
        // Use $clientId if set, otherwise fetch all appointments
        $clientId = $this->clientId ?? null;

        return AppointmentsModel::whereNotNull('date')
            ->where('date', '>=', Carbon::now()->startOfDay()->toDateString()) // Filter for upcoming events
            ->where(function ($query) use ($clientId) {
                if ($clientId) {
                    // If $clientId is provided, filter appointments based on client_id in appointmentDetails and zoomMeet
                    $query->whereHas('appointmentDetails', function ($query) use ($clientId) {
                        $query->where('client_id', $clientId)
                            ->where('is_accepted', 'accepted')
                            ->whereHas('orders', function ($query) {
                                // Filter based on payment status
                                $query->where('payment_status', 'Unpaid')
                                    ->orWhere(function ($query) {
                                        $query->where('status', 'Unclaimed')
                                            ->where('payment_status', '<>', 'Failed');
                                    });
                            });
                    })
                    // Check if the clientId is in the participants text field in zoomMeetings
                    ->orWhereHas('zoomMeet', function ($query) use ($clientId) {
                        $query->where('participants', 'like', '%' . $clientId . '%')
                              ->where('is_accepted', 'accepted'); // Only include zoomMeet with accepted status
                    });
                } else {
                    // If no clientId is provided, fetch appointments for all clients
                    $query->whereHas('appointmentDetails', function ($query) {
                        $query->where('is_accepted', 'accepted'); // Filter where is_accepted is 'accepted'
                    })
                    ->orWhereHas('zoomMeet', function ($query) {
                        $query->where('is_accepted', 'accepted'); // Only include zoomMeet with accepted status
                    });
                }
            })
            ->with([
                'appointmentDetails.orders' => function ($query) {
                    $query->where('payment_status', '<>', 'Failed');
                },
                'zoomMeet'  // Eager load the zoomMeet relationship
            ])
            ->get();
    }


    public function createMeeting()
    {
        $this->validate([
            'meetingTopic' => 'required|string',
            'meetingStartDate' => 'required|date',
            'meetingParticipant' => 'required',
            'meetingDurationFrom' => 'required',
            'meetingDurationTo' => 'required'
        ]);

        try {
            // Generate the Zoom token
            $zoomTokenResponse = $this->generateToken();

            if ($zoomTokenResponse && isset($zoomTokenResponse['access_token'])) {
                $zoomToken = $zoomTokenResponse['access_token'];

                $startTime = Carbon::parse($this->meetingStartDate)
                    ->setTimeFromTimeString($this->meetingDurationFrom)
                    ->toIso8601String();
            
                $endTime = Carbon::parse($this->meetingStartDate)
                    ->setTimeFromTimeString($this->meetingDurationTo)
                    ->toIso8601String();

                // Create the Zoom meeting
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $zoomToken,
                    'Content-Type' => 'application/json',
                ])->post("https://api.zoom.us/v2/users/me/meetings", [
                    'topic' => $this->meetingTopic,
                    'type' => 2, // 2 for scheduled meeting
                    'start_time' => Carbon::parse($this->meetingStartDate)->format('Y-m-d\TH:i:s\Z'),
                    'duration' => Carbon::parse($endTime)->diffInMinutes($startTime),
                    "settings" => [
                        "host_video" => true,
                        "join_before_host"=> false,
                        "mute_upon_entry"=> true
                    ]
                ]);
                
                if ($response->successful()) {
                    // Handle the successful response
                    $responseData = $response->json();
                    
                    $appointment = AppointmentsModel::create([
                        'title' => $this->meetingTopic,
                        'description' => $this->meetingDescription,
                        'date' => $this->meetingStartDate,
                        'is_active' => 1
                    ]);

                    $participantArray = [$this->meetingParticipant];
                    $participantToString = json_encode($participantArray);

                    $meeting = ZoomMeeting::create([
                        'appointment_id' => $appointment->id,
                        'meeting_id' => strval($responseData['id']),
                        'topic' => $responseData['topic'],
                        'start_time' => $responseData['start_time'],
                        'duration' => $responseData['duration'],
                        'timezone' => $responseData['timezone'],
                        'join_url' => $responseData['join_url'],
                        'host_id' => $responseData['host_id'],
                        'password' => $responseData['password'] ?? null,
                        'agenda' => $this->meetingDescription,
                        'participants' => $participantToString,
                        'is_viewed' => 'new',
                        'is_accepted' => 'pending'
                    ]);
                   
                    Notification::make()
                            ->title('Success!')
                            ->body('Meeting has been created.')
                            ->success()
                            ->send();

                    

                    try {
                        
                        $this->sendSMS($appointment->id, $this->meetingStartDate);
                        if ($participantArray[0]) {
                            $user = User::where('id', $participantArray[0])->first();
                            $date = Carbon::parse($meeting->start_time);
                            Mail::to($user->email)->send(new ZoomCreation($date->format('M. d, Y'), $meeting->id));
                        }
                       
                    } catch (\Throwable $e) {
                        $this->dispatch('reload');
                        // Log::error('Error sending SMS: ' . $e->getMessage());
                        Notification::make()
                            ->title('Error!')
                            ->body('Failed to send SMS.')
                            ->danger()
                            ->send();
                    }
                    
                    $this->dispatch('reload');
                   
                    return $response->json();
                    
                } else {
                    return response()->json(['error' => 'Failed to create Zoom meeting'], 500);
                }
            } else {
                return response()->json(['error' => 'Failed to generate Zoom token'], 500);
            }

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    protected function generateToken()
    {
        try {
            $base64String = base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET'));
            $accountId = env('ZOOM_ACCOUNT_ID');

            $responseToken = Http::withHeaders([
                "Content-Type" => "application/x-www-form-urlencoded",
                "Authorization" => "Basic {$base64String}"
            ])->post("https://zoom.us/oauth/token?grant_type=account_credentials&account_id={$accountId}");
            return $responseToken;

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // SMS
    public function sendSMS($appointmentNumber, $appointmentDate){
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilioNumber = env('TWILIO_FROM');

        $client = new Client($sid, $token);
        $message = "We created a Meeting!\n Date: {$appointmentDate}\nYour Meeting ID is: {$appointmentNumber}";
        $client->messages->create(
            '+639633366707',
            [
                'from' => $twilioNumber,
                'body' => $message
            ]
        ); 
    }

    public function cancel(){
        $this->reset();
    }

}
