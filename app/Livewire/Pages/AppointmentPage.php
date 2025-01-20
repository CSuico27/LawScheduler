<?php

namespace App\Livewire\Pages;

use App\Models\AppointmentsModel;
use App\Models\BeneficiariesModel;
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
use Illuminate\Support\Facades\Validator;

class AppointmentPage extends LivewireCalendar
{
    use Actions;
    
    // ADD
    public $title;
    public $description;
    public $date;
    
    // EDIT
    public $editTitle;
    public $editDescription;
    public bool $isActive;
    public $eventID;
    public $cardModal;
    public $selectedEvent;

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


    public function resetModal(){
        $this->reset();
    }

    public function newEvent(){

        $this->recipients = BeneficiariesModel::pluck('phone')->toArray();
        
        $this->validate([ 
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'date' => 'required|date'
        ]);

        $event = AppointmentsModel::create([
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date
        ]);

        // $this->sendSingleSMS($this->title, $this->date);

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

        $this->dispatch('reload');

        return redirect()->back();
    }

    public function onEventClick($eventId)
    {
        $event = $this->events()->firstWhere('id', $eventId);

        if ($event) {
            $eventDate = Carbon::parse($event['date']);
            $this->dispatch('editEvent', [
                $this->editTitle => $event->title,
                $this->editDescription => $event->description,
                $this->eventID => $event->id,
                $this->isActive = $event->is_active,
            ]);
            $this->editTitle = $event->title;
            $this->editDescription = $event->description;
            $this->eventID = $event->id;
            $this->isActive = $event->is_active;
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
        AppointmentsModel::where('id', $eventId)->update(['date' => $year . '-' . $month . '-' . $day]);
        $event = AppointmentsModel::where('id',  $eventId)->first();

        $this->sendSingleUpdatedSMS($event->title, $event->date);
        
    }
    public function events() : Collection
    {
        return AppointmentsModel::whereNotNull('date')->get();
    }

    public function getParticipant(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $users = User::where('name', 'like', '%' . $search . '%')
                ->whereNotNull('profile_picture')
                ->get();
        } elseif ($selected) {

            $selectedUsers = User::where('id', $selected)
                ->whereNotNull('profile_picture')
                ->get();

            return response()->json($selectedUsers);
            
        } else {
            $caseTypes = User::whereNotNull('profile_picture')->get();
        }

        return response()->json($caseTypes);
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
                
                // $response = Http::withHeaders([
                //     'Authorization' => 'Bearer ' . $zoomToken,
                //     // 'Content-Type' => 'application/x-www-form-urlencoded',
                // ])->get("https://api.zoom.us/v2/users/me");

                // Check for successful response
                

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

                    ZoomMeeting::create([
                        'appointment_id' => $appointment->id,
                        'meeting_id' => strval($responseData['id']),
                        'topic' => $responseData['topic'],
                        'start_time' => strtotime($responseData['start_time']),
                        'duration' => $responseData['duration'],
                        'timezone' => $responseData['timezone'],
                        'join_url' => $responseData['join_url'],
                        'host_id' => $responseData['host_id'],
                        'password' => $responseData['password'] ?? null,
                        'agenda' => $this->meetingDescription,
                        'participants' => $participantToString
                    ]);

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
    public function sendSMS($eventTitle, $eventDate, $mobileNumbers){
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilioNumber = env('TWILIO_FROM');

        $client = new Client($sid, $token);

        foreach ($mobileNumbers as $number) {

            if (!preg_match('/^09\d{9}$/', $number)) {
                Log::error("Invalid phone number format: $number");
                continue; // Skip invalid numbers
            }

            $formattedNumber = '+63' . ltrim($number, '0');

            $message = "CSWD - City Social Welfare Departmen(Tayabas City) \n
                    There's an upcoming program titled '{$eventTitle}'. This program will be held in Tayabas City Municipal Covered Court \n 
                    Date: {$eventDate} \n
                    
                    For more info visit: https://egive-mo.com";
            $client->messages->create(
                '+63 930 655 8025',
                [
                    'from' => $twilioNumber,
                    'body' => $message
                ]
            );
        }
    }

    public function sendSingleSMS($eventTitle, $eventDate){
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilioNumber = env('TWILIO_FROM');

        $client = new Client($sid, $token);
        $message = "CSWD - City Social Welfare Departmen(Tayabas City) \n
                    There's an upcoming program titled '{$eventTitle}'. This program will be held in Tayabas City Municipal Covered Court \n 
                    Date: {$eventDate} \n
                    
                    For more info visit: https://egive-mo.com";
        $client->messages->create(
            '+63 930 655 8025',
            [
                'from' => $twilioNumber,
                'body' => $message
            ]
        ); 
    }

    public function sendSingleUpdatedSMS($eventTitle, $eventDate){
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilioNumber = env('TWILIO_FROM');

        $client = new Client($sid, $token);
        $message = "CSWD\nThere's an upcoming program titled '{$eventTitle}' \n Date: {$eventDate}";
        $client->messages->create(
            '+63 930 655 8025',
            [
                'from' => $twilioNumber,
                'body' => $message
            ]
        ); 
    }
}
