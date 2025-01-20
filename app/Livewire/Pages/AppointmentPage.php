<?php

namespace App\Livewire\Pages;

use App\Models\AppointmentsModel;
use App\Models\BeneficiariesModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use WireUi\Traits\Actions;
use Omnia\LivewireCalendar\LivewireCalendar;
use Twilio\Rest\Client;

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

        $this->sendSingleSMS($this->title, $this->date);

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
