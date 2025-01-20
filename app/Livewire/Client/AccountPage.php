<?php

namespace App\Livewire\Client;

use App\Models\AppointmentDetails;
use App\Models\Cases;
use App\Models\Invoice;
use App\Models\Services;
use App\Models\SubCaseType;
use App\Models\User;
use App\Models\ZoomMeeting;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

#[Title('My Account')]
class AccountPage extends Component
{
    use Actions;
    use WithPagination;
    
    public $searchTerm;
    
    public $accountDetails = [];
    public $selectedClientFullDetails;

    public function mount(){
        if(auth()->check()){
            $user_id = auth()->user()->id;
            $this->accountDetails = User::where('id',  $user_id)->with('info')->get();

            if ($user_id) {
                $zoomMeetings = ZoomMeeting::whereJsonContains('participants', $user_id)->get();
                $appointments = AppointmentDetails::where('client_id', $user_id)
                    ->whereHas('orders', function ($query) {
                        $query->where('payment_status', '<>', 'Failed');
                    })->get();
                $cases = Cases::whereJsonContains('complainants',  $user_id)->with('caseStage')->get();

                foreach ($cases as $case) {
                    $complainantIds = json_decode($case->complainants, true);
                    if (is_array($complainantIds)) {
                        $complainants = User::with('info')->whereIn('id', $complainantIds)->get();
                        $case->complainantDetails = $complainants;
                    }

                    $lawsViolatedIds = json_decode($case->laws_violated, true);
                    if (is_array($lawsViolatedIds)) {
                        $laws = SubCaseType::whereIn('id', $lawsViolatedIds)->get();
                        $case->lawsViolated = $laws;
                    }
                }
            }

            $casesArray = $cases->toArray();
            $this->selectedClientFullDetails = [
                'zoom_meetings' => $zoomMeetings,
                'appointments' => $appointments,
                'cases' => $casesArray
            ];
        }
    }

    public function markAsViewed($meetingId)
    {
        $meeting = ZoomMeeting::find($meetingId);

        if ($meeting && $meeting->is_viewed === 'new') {
            $meeting->update(['is_viewed' => 'viewed']);
           
        } else {
        
        }
    }

    public function markAllAsViewed()
    {

        $updatedMeetings = ZoomMeeting::where('is_viewed', 'new')->update(['is_viewed' => 'viewed']);

    }

    public function markAllAsViewedAppointment()
    {

        $updatedAppointment = AppointmentDetails::where('is_viewed', 'new')->update(['is_viewed' => 'viewed']);

    }
    
    public function render()
    {
        return view('livewire.client.account-page', [
            'accountDetails' => $this->accountDetails
        ]);
    }
}
