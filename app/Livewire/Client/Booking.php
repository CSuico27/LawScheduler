<?php

namespace App\Livewire\Client;

use App\Models\AppointmentDetails;
use App\Models\AppointmentsModel;
use App\Models\Orders;
use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session as FacadesSession;
use Livewire\Attributes\Title;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Title('Booking')]
class Booking extends Component
{
    public $appointmentDate;
    public $timeSlots = [];
    public $selectedTimeSlot;
    public $payment_method;
    public $payment_status;
    public $grand_total;
    public $services = [''];

    public $servicePrices = [];

    public int $currentStep;
    public bool $isFinishedStepOne;
    public bool $isFinishedStepTwo;

    public function mount()
    {
        $this->currentStep = 1;
        $this->isFinishedStepOne = false;
        $this->isFinishedStepTwo = false;

        $start = Carbon::createFromTimeString('08:00');
        $end = Carbon::createFromTimeString('17:00');

        while ($start->lessThanOrEqualTo($end)) {
            $this->timeSlots[] = [
            'display' => $start->format('h:i A'),
            'storage' => $start->format('H:i')
        ];
        $start->addMinutes(30);
        }

    }

    public function nextStep(){
        if($this->currentStep < 2){
            $this->currentStep = $this->currentStep + 1;
            $this->isFinishedStepOne = true;
        }
    }

    public function backStep(){
        if($this->currentStep > 1){
            $this->currentStep = $this->currentStep - 1;
            $this->isFinishedStepOne = false;
        }
    }

    public function addService()
    {
        $this->services[] = '';  
    }

    public function removeService($index)
    {
        if (count($this->services) > 1) {
            unset($this->services[$index]);
            unset($this->servicePrices[$index]);
            $this->services = array_values($this->services);
            $this->servicePrices = array_values($this->servicePrices);
        }

    }

    public function getServiceNames()
    {
        $services = Services::whereIn('id', $this->services)->pluck('name', 'id');
        $serviceNamesString = $services->implode(', ');

        return $serviceNamesString;
    }

    public function createAppointment(){
        
        $this->validate([ 
            'appointmentDate' => 'required|date',
            'selectedTimeSlot' => 'required|date_format:H:i',
            'services.*' => 'required|max:255',
            'payment_method' => 'required'
        ]);

        $redirect_url = '';

        if($this->payment_method == 'Stripe'){
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $sessionCheckout = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => auth()->user()->email,
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'PHP',
                            'product_data' => [
                                'name' => 'Appointment Services'
                            ],
                            'unit_amount' => self::getTotalPriceProperty() * 100,
                        ],
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'payment',
                'success_url' => route('success'). '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cancel'). '?session_id={CHECKOUT_SESSION_ID}',
            ]);

            $redirect_url = $sessionCheckout->url;
        } else {
            $redirect_url = route('success');
        }

        $event = AppointmentsModel::create([
            'title' => 'Appointment of ' . auth()->user()->name,
            'description' => auth()->user()->name . ', create a appointment. Purpose of Appointment: (' . $this->getServiceNames() . ').',
            'date' => Carbon::createFromFormat('d-m-Y', $this->appointmentDate)->format('Y-m-d')
        ]);

        $appointDetails = AppointmentDetails::create([
            'appointment_id' => $event->id,
            'client_id' => auth()->user()->id,
            'title' => 'Appointment of ' . auth()->user()->name,
            'date' => $this->appointmentDate,
            'time' => $this->selectedTimeSlot,
            'description' => auth()->user()->name . ', create a appointment. Purpose of Appointment: (' . $this->getServiceNames() . ').'
        ]);

        $order = Orders::create([
            'appointment_detail_id' => $appointDetails->id,
            'services_ids' => json_encode($this->services),
            'payment_method' => $this->payment_method,
            'payment_status' => 'Unpaid',
            'grand_total' => self::getTotalPriceProperty(),
            'status' => 'Unclaimed'
        ]);

        return redirect($redirect_url);
        // $this->sendSingleSMS($this->title, $this->date);
    }

    public function updatedServices($value, $index)
    {
        $service = Services::find($value);
    
        if ($service) {
            $this->servicePrices[$index] = $service->price;
        } else {
            $this->servicePrices[$index] = 0;
        }
    }
    
    

    public function getTotalPriceProperty()
    {
        return array_sum($this->servicePrices);
    }
    
    public function render()
    {
        return view('livewire.client.booking');
    }
}
