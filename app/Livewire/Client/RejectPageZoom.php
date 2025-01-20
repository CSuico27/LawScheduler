<?php

namespace App\Livewire\Client;

use App\Models\ZoomMeeting;
use Livewire\Component;

class RejectPageZoom extends Component
{
    public $zoomId;
    public $zoomStatus;

    public function mount($id)
    {
        $this->zoomId = $id;
        $this->loadZoomStatus();
    }

    public function loadZoomStatus()
    {
        $zoom = ZoomMeeting::find($this->zoomId);
        
        // Set the appointment status
        if ($zoom) {
            $this->zoomStatus = $zoom->is_accepted;
            if($zoom->is_accepted == 'pending') {
                $this->acceptZoom($this->zoomId);
            }
        }
    }

    public function acceptZoom($id)
    {
        $zoom = ZoomMeeting::find($id);

        if ($zoom) {
            $zoom->is_accepted = 'rejected';  // Or true if it's a boolean
            $zoom->save();
        }
    }
    
    public function render()
    {
        return view('livewire.client.reject-page-zoom');
    }
}
