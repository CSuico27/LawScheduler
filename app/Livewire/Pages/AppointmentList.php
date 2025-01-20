<?php

namespace App\Livewire\Pages;

use App\Models\AppointmentDetails;
use App\Models\AppointmentsModel;
use App\Models\User;
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
    public $time;
    public bool $isActive;

    // SEARCH
    public $searchTerm;
    public $selectedMeetingId;
    public $meetingFullDetails;

    public function getSelectedMeetingId($id){
        $this->selectedMeetingId = $id;
    
        if ($this->selectedMeetingId) {
            $this->meetingFullDetails = AppointmentsModel::where('id', $this->selectedMeetingId)
                ->with('appointmentDetails')
                ->get();
            
            if($this->meetingFullDetails[0]->appointmentDetails){
                $this->client = $this->meetingFullDetails[0]->appointmentDetails->client_id;
                $this->title = $this->meetingFullDetails[0]->title;
                $this->description = $this->meetingFullDetails[0]->description;
                $this->date = $this->meetingFullDetails[0]->date;
                $this->time = $this->meetingFullDetails[0]->appointmentDetails->time;
                $this->isActive = $this->meetingFullDetails[0]->is_active;
            }
        
            foreach ($this->meetingFullDetails as $detail) {
                $participantId = $detail->appointmentDetails->client_id;
                $participants = User::with('info')->where('id', $participantId)->get();
                $detail->participantsDetails = $participants;
            }
        }
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
            'time' => $this->time,
            'description' => $this->description,
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
        $this->reset();
    }
    public function render()
    {
        if ($this->searchTerm) {
            $searchItems = AppointmentsModel::whereHas('appointmentDetails', function ($query) {
                $query->where('title', 'like', '%' . $this->searchTerm . '%');
            })
            ->latest()
            ->paginate(8);

            $appointmentList = $searchItems;
        } else {
            $appointmentList = AppointmentsModel::with('appointmentDetails')->latest()->paginate(8);
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

        return view('livewire.pages.appointment-list',[
            'appointmentList' => $appointmentList
        ]);
    }
}
