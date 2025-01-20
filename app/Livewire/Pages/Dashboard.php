<?php

namespace App\Livewire\Pages;

use App\Models\AppointmentsModel;
use App\Models\Cases;
use App\Models\Services;
use App\Models\SubCaseType;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $zoomMeetingId;
    public $zoomMeetingFullDetails;

    public function getMeetingFullDetails($id){
        $this->zoomMeetingId = $id;

        
        $this->zoomMeetingFullDetails = AppointmentsModel::where('id', $this->zoomMeetingId)
            ->with('zoomMeet')
            ->with('appointmentDetails.orders')
            ->get();

        foreach ($this->zoomMeetingFullDetails as $detail) {
            if($detail->zoomMeet){
                $participantIds = json_decode($detail->zoomMeet->participants, true);
                $participants = User::with('info')->whereIn('id', $participantIds)->get();
                $detail->participantsDetails = $participants;
            } else {
                $participantId = $detail->appointmentDetails->client_id;
                $participants = User::with('info')->where('id', $participantId)->get();
                $detail->participantsDetails = $participants;

                
                $order = $detail->appointmentDetails->orders;
            
                if ($order && $order->services_ids) {
                    $serviceIds = json_decode($order->services_ids, true);
                    $services = Services::whereIn('id', $serviceIds)->get();
                    $order->services = $services;
                }
                
            }
        }
    }

    public function resetDetails(){
        $this->zoomMeetingFullDetails = [];
    }

    public function render()
    {
        $upcomingZoomMeetings = AppointmentsModel::where('is_active', 1)
            ->whereHas('zoomMeet', function ($query) {
                $query->where('is_accepted', 'accepted');
            })
            ->with('zoomMeet')
            ->whereDate('date', '>=', Carbon::now())
            ->get()
            ->groupBy(function($item) {
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
        
        $upcomingAppointments = AppointmentsModel::where('is_active', 1)
            ->whereHas('appointmentDetails', function ($query) {
                $query->where('is_accepted', 'accepted')
                ->whereHas('orders', function ($query) {
                    $query->where('payment_status', '<>', 'Failed');
                });
            })
            ->whereDate('date', '>=', Carbon::now())
            ->with(['appointmentDetails.orders' => function ($query) {
                $query->where('payment_status', '<>', 'Failed');
            }])
            ->get()
            ->groupBy(function($item) {
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

        $upcomingHearings = Cases::with('caseStage')->get()->groupBy(function($item) {
            return $item->created_at;
        });

        foreach ($upcomingHearings as $date => $cases) {
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
