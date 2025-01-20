<?php

namespace App\Livewire\Pages;

use App\Models\AppointmentsModel;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ScheduleList extends Component
{
    use Actions;
    use WithPagination;

    // SEARCH
    public $searchTerm;
    public $selectedScheduleId;

    // public function getSelectedScheduleId($id){
    //     $this->selectedScheduleId = $id;

    //     if($this->selectedScheduleId){
    //         $this->selectedCaseType = ModelsCaseType::find($id);
    //     }

    //     if (!$this->selectedCaseType) {
    //         $this->selectedCaseType = null;
    //     } else {
    //         $this->editName = $this->selectedCaseType->name;
    //         $this->editIsActive = $this->selectedCaseType->is_active;
    //     }
    // }

    public function deleteMeeting($id){
        $appointment = AppointmentsModel::with('zoomMeet')->findOrFail($id);

        $zoomMeeting = $appointment->zoomMeet;

        if ($zoomMeeting) {
            $this->deleteZoomMeeting($zoomMeeting->meeting_id);
        }

        if ($zoomMeeting) {
            $zoomMeeting->delete();
        }

        $appointment->delete();

        $this->notification()->success(
            $title = 'Meeting delete',
            $description = 'Your meeting was deleted!'
        );
        
        return redirect()->back();
    }

    public function deleteConfirmation($id, $meetingTopic){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this meeting " . html_entity_decode('<span class="text-red-600 underline">' . $meetingTopic . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteMeeting',
            'icon'        => 'error',
            'params'      => $id,
        ]);
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

    public function deleteZoomMeeting($meetingId)
    {
        try {
            // Generate the Zoom token
            $zoomTokenResponse = $this->generateToken();

            if ($zoomTokenResponse && isset($zoomTokenResponse['access_token'])) {
                $zoomToken = $zoomTokenResponse['access_token'];

                // Delete the Zoom meeting
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $zoomToken,
                    'Content-Type' => 'application/json',
                ])->delete("https://api.zoom.us/v2/meetings/{$meetingId}");

                if ($response->successful()) {
                    return response()->json(['message' => 'Meeting deleted successfully'], 200);
                } else {
                    return response()->json(['error' => 'Failed to delete Zoom meeting'], 500);
                }
            } else {
                return response()->json(['error' => 'Failed to generate Zoom token'], 500);
            }

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function render()
    {
        if ($this->searchTerm) {
            $searchItems = AppointmentsModel::whereHas('zoomMeet', function ($query) {
                $query->where('meeting_id', 'like', '%' . $this->searchTerm . '%');
            })
            ->latest()
            ->paginate(8);            

            $scheduleList = $searchItems;
        } else {
            $scheduleList = AppointmentsModel::with('zoomMeet')->latest()->paginate(8);
        }
        return view('livewire.pages.schedule-list',[
            'scheduleList' => $scheduleList
        ]);
    }
}
