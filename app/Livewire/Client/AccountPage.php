<?php

namespace App\Livewire\Client;

use App\Models\AppointmentDetails;
use App\Models\Cases;
use App\Models\SubCaseType;
use App\Models\User;
use App\Models\ZoomMeeting;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('My Account')]
class AccountPage extends Component
{
    public $accountDetails = [];
    public $selectedClientFullDetails;
    
    public function mount(){

        if(auth()->check()){
            $user_id = auth()->user()->id;
            $this->accountDetails = User::where('id',  $user_id)->with('info')->get();

            if ($user_id) {
                $zoomMeetings = ZoomMeeting::whereJsonContains('participants', $user_id)->get();
                $appointments = AppointmentDetails::where('client_id', $user_id)->get();
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

    public function render()
    {
        return view('livewire.client.account-page', [
            'accountDetails' => $this->accountDetails
        ]);
    }
}
