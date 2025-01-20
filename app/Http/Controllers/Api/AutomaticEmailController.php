<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AutomaticEmailer;
use App\Mail\CaseEmailer;
use App\Mail\ZoomEmailer;
use App\Models\AppointmentDetails;
use App\Models\Cases;
use App\Models\CaseStage;
use App\Models\User;
use App\Models\ZoomMeeting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class AutomaticEmailController extends Controller
{
    public function index(): JsonResponse
    {
        $appointments = AppointmentDetails::where('is_accepted', 'accepted')
            ->get(['title', 'client_id', 'date', 'time']);

        $parsedAppointments = $appointments->map(function ($appointment) {
            $datetime = Carbon::createFromFormat(
                strpos($appointment['date'], '-') === 4 ? 'Y-m-d' : 'd-m-Y',
                $appointment['date']
            )->setTimeFromTimeString($appointment['time']);

            $user = User::find($appointment->client_id);
            $email = $user ? $user->email : null;

            return [
                'title' => $appointment->title,
                'email' => $email,
                'datetime' => $datetime->toIso8601String(), 
                'timestamp' => $datetime->timestamp
            ];
        });

        return response()->json($parsedAppointments);
    }

    public function getCaseDetails(): JsonResponse
    {
        $cases = Cases::all(['date_assigned', 'case_stage', 'nps_docket_no', 'complainants']);
        
        $parsedCases = $cases->map(function ($case) {
            $date = Carbon::createFromFormat(
                strpos($case['date_assigned'], '-') === 4 ? 'Y-m-d' : 'd-m-Y',
                $case['date_assigned']
            );

            $complainants = is_string($case->complainants) ? json_decode($case->complainants, true) : $case->complainants;
            $caseState = CaseStage::find($case->case_stage);
            $stage = $caseState ? $caseState->name : null;
            
            if (is_array($complainants)) {
                $complainantEmails = User::whereIn('id', $complainants)
                                        ->pluck('email')
                                        ->toArray(); 

                return [
                    'date_assigned' => $date,
                    'case_stage' => $stage,
                    'nps_docket_no' => $case->nps_docket_no,
                    'complainants' => $complainantEmails,
                ];
            } else {
                
                return [
                    'date_assigned' => $date,
                    'case_stage' => $stage,
                    'nps_docket_no' => $case->nps_docket_no,
                    'complainants' => [],
                ];
            }
        });

        return response()->json($parsedCases);
    }

    public function getZoomDetails(): JsonResponse
    {
        $zooms = ZoomMeeting::where('is_accepted', 'accepted')->get(['meeting_id', 'topic', 'start_time', 'participants']);
        
        $parsedZoom = $zooms->map(function ($zoom) {
           
            $participants = json_decode($zoom->participants, true); 
            $user = User::find($participants[0]);
            $email = $user ? $user->email : null;
            
            return [
                'meeting_id' => $zoom->meeting_id,
                'topic' => $zoom->topic,
                'start_time' => $zoom->start_time,
                'participants' => $email
            ];
           
        });

        return response()->json($parsedZoom);
    }

    public function sendAppointmentReminder(Request $request)
    {
       
        $data = $request->validate([
            'title' => 'required|string',
            'email' => 'required|email',
            'datetime' => 'required|date',
            'time' => 'required|integer'
        ]);
        $formattedDatetime = Carbon::parse($data['datetime'])->format('F d, Y');
        $formattedTime = Carbon::createFromTimestamp($data['time'])->format('h:i A');
        
        try {
            Mail::to($data['email'])->send(new AutomaticEmailer($formattedTime, $formattedDatetime, $data['title']));
        } catch (\Exception $e) {
            
            return response()->json(['error' => 'Failed to send email reminder: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Reminder email sent successfully']);
    }

    public function sendCaseReminder(Request $request)
    {
        $data = $request->validate([
            'date_assigned' => 'required|date',
            'case_stage' => 'required|string',
            'nps_docket_no' => 'required|string',
            'complainants' => 'required|array',
            'complainants.*' => 'email',
        ]);

        foreach ($data['complainants'] as $complainantEmail) {
            Mail::to($complainantEmail)->send(new CaseEmailer(
                Carbon::parse($data['date_assigned'])->format('F d, Y'),
                $data['nps_docket_no'],
                $data['case_stage']
            ));
        }

        return response()->json(['message' => 'Reminder email(s) sent successfully']);
    }

    public function sendZoomReminder(Request $request)
    {
        $data = $request->validate([
            'meeting_id' => 'required',
            'topic' => 'required|string',
            'start_time' => 'required|date',
            'participants' => 'required|email',
        ]);

        $formattedDatetime = Carbon::parse($data['start_time'])->format('F d, Y');
        
        try {
            Mail::to($data['participants'])->send(new ZoomEmailer($data['meeting_id'], $data['topic'], $formattedDatetime));
        } catch (\Exception $e) {
            
            return response()->json(['error' => 'Failed to send email reminder: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'Reminder email sent successfully']);
    }
}
