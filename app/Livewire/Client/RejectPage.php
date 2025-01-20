<?php

namespace App\Livewire\Client;

use App\Models\AppointmentDetails;
use Livewire\Component;

class RejectPage extends Component
{
    public $appointmentId;
    public $appointmentStatus;

    public function mount($id)
    {
        $this->appointmentId = $id;
        $this->loadAppointmentStatus();
    }

    public function loadAppointmentStatus()
    {
        $appointment = AppointmentDetails::find($this->appointmentId);
        
        // Set the appointment status
        if ($appointment) {
            $this->appointmentStatus = $appointment->is_accepted;
            if($appointment->is_accepted == 'pending') {
                $this->rejectAppointment($this->appointmentId);
            }
        }
    }

    public function rejectAppointment($id)
    {
        $appointment = AppointmentDetails::find($id);

        if ($appointment) {
            $appointment->is_accepted = 'rejected';  // Or true if it's a boolean
            $appointment->save();
        }
    }

    public function render()
    {
        return view('livewire.client.reject-page');
    }
}
