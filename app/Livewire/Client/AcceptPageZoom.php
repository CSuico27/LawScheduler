<?php

namespace App\Livewire\Client;

use App\Mail\ZoomMeetingEmail;
use App\Models\User;
use App\Models\ZoomMeeting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class AcceptPageZoom extends Component
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
            $zoom->is_accepted = 'accepted';  // Or true if it's a boolean
            $zoom->save();
            $participantArray = json_decode($zoom->participants, true);
            $participantToString = $participantArray[0];
            
            if ($participantToString) {
                $user = User::where('id', $participantToString)->first();
                $date = Carbon::parse($zoom->start_time);
                Mail::to($user->email)->send(new ZoomMeetingEmail($zoom->join_url, $date->format('M. d, Y')));
            }
            
        }
    }

    public function render()
    {
        return view('livewire.client.accept-page-zoom');
    }
}
