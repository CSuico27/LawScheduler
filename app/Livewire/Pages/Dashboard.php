<?php

namespace App\Livewire\Pages;

use App\Models\AppointmentsModel;
use App\Models\Cases;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{

    public function render()
    {
        $upcomingZoomMeetings = AppointmentsModel::where('is_active', 1)->whereHas('zoomMeet')->with('zoomMeet')->get()->groupBy(function($item) {
            return $item->date;
        });

        foreach ($upcomingZoomMeetings as $date => $meetings) {
            foreach ($meetings as $meeting) {
               
                if ($meeting->zoomMeet) {
                    $participantIds = $meeting->zoomMeet->participants;
        
                    $participants = User::with('info')->whereIn('id', json_decode($participantIds))->get();
                    $meeting->participantsDetails = $participants;
                   
                } else {
                    
                    $meeting->participantsDetails = [];
                }
        
              
            }
        } 
        
        $upcomingAppointments = AppointmentsModel::where('is_active', 1)->whereHas('appointmentDetails')->with('appointmentDetails')->get()->groupBy(function($item) {
            return $item->date;
        });

        foreach ($upcomingAppointments as $date => $appointments) {
            foreach ($appointments as $appointment) {
                
                if ($appointment->appointmentDetails) {
                    $clientId = $appointment->appointmentDetails->client_id;

                    $client = User::with('info')->where('id', $clientId)->get();
                    $appointment->participantsDetails = $client;
                   
                } else {
                    $appointment->participantsDetails = [];
                }
            }
        } 

        $upcomingHearings = Cases::with('caseStage')->with('caseSubType')->with('caseType')->with('user')->get()->groupBy(function($item) {
            return $item->first_hearing_date;
        });

        $clientsCount = User::whereNotNull('profile_picture')->get()->count();
        $clientsAddedThisMonth = User::whereNotNull('profile_picture')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $allZoomMeetingsCount = AppointmentsModel::whereHas('zoomMeet')->with('zoomMeet')->get()->count();
        $zoomMeetingsAddedThisMonth = AppointmentsModel::whereHas('zoomMeet')->with('zoomMeet')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $allAppointmentsCount = AppointmentsModel::whereHas('appointmentDetails')->with('appointmentDetails')->get()->count();
        $appointmentsAddedThisMonth = AppointmentsModel::whereHas('appointmentDetails')->with('appointmentDetails')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        
        $allCases = Cases::all()->count();
        $casesAddedThisMonth = Cases::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        
        return view('livewire.pages.dashboard', [
            'upcomingZoomMeetings' => $upcomingZoomMeetings,
            'upcomingAppointments' => $upcomingAppointments,
            'upcomingHearings' => $upcomingHearings,
            'clientsCount' => $clientsCount,
            'clientsAddedThisMonth' => $clientsAddedThisMonth,
            'allZoomMeetingsCount' => $allZoomMeetingsCount,
            'zoomMeetingsAddedThisMonth' => $zoomMeetingsAddedThisMonth,
            'allAppointmentsCount' => $allAppointmentsCount,
            'appointmentsAddedThisMonth' => $appointmentsAddedThisMonth,
            'allCases' => $allCases,
            'casesAddedThisMonth' => $casesAddedThisMonth
        ]);
    }
}
