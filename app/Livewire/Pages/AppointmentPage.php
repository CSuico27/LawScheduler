<?php

namespace App\Livewire\Pages;

use App\Models\AppointmentsModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use WireUi\Traits\Actions;
use Omnia\LivewireCalendar\LivewireCalendar;

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
    public $eventID;
    public $cardModal;
    public $selectedEvent;

    public function newEvent(){
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
            'description' => $this->editDescription
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
            ]);
            $this->editTitle = $event->title;
            $this->editDescription = $event->description;
            $this->eventID = $event->id;
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
    }
    public function events() : Collection
    {
        return AppointmentsModel::whereNotNull('date')->get();
    }

}
