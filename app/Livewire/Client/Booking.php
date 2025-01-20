<?php

namespace App\Livewire\Client;

use App\Mail\AppointmentCreation;
use App\Mail\AppointmentCreationClient;
use App\Mail\AppointmentSuccess;
use App\Models\AppointmentDetails;
use App\Models\AppointmentsModel;
use App\Models\Orders;
use App\Models\Services;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session as FacadesSession;
use Livewire\Attributes\Title;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Twilio\Rest\Client;

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

        $this->generateTimeSlots();

    }

    public function updatedAppointmentDate()
    {
        $this->generateTimeSlots();
    }

    public function generateTimeSlots()
    {
        $this->timeSlots = [];
        
        $start = Carbon::createFromTimeString('09:00', 'Asia/Manila'); 
        $end = Carbon::createFromTimeString('18:00', 'Asia/Manila');

        $bookedSlots = [];
        $isToday = false;

        $manilaTimeZone = 'Asia/Manila';
        Carbon::setLocale('en'); 

        if ($this->appointmentDate) {
            try {
                $formattedDate = Carbon::createFromFormat('d-m-Y', $this->appointmentDate)->format('d-m-Y');
                $isToday = Carbon::createFromFormat('d-m-Y', $this->appointmentDate)
                    ->timezone($manilaTimeZone)
                    ->isToday();
                $bookedSlots = AppointmentDetails::where('date', $formattedDate)
                    ->pluck('time')
                    ->map(function ($time) {
                        return Carbon::createFromFormat('H:i:s', $time)->format('H:i');
                    })
                    ->toArray();
            } catch (\Exception $e) {
                $this->addError('appointmentDate', 'Invalid date format.');
                return;
            }
        }

        while ($start->lessThanOrEqualTo($end)) {
            $timeSlotStorage = $start->format('H:i');
            
            $isPastSlot = $isToday && $start->timezone($manilaTimeZone)->isBefore(Carbon::now()->timezone($manilaTimeZone)); 
            $isDisabled = in_array($timeSlotStorage, $bookedSlots) || $isPastSlot;

            $this->timeSlots[] = [
                'display' => $start->format('h:i A'),  
                'storage' => $timeSlotStorage,
                'disabled' => $isDisabled,
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
            'description' => auth()->user()->name . ', create a appointment. Purpose of Appointment: (' . $this->getServiceNames() . ').',
            'is_viewed' => 'new',
            'is_accepted' => 'accepted'
        ]);

        $order = Orders::create([
            'appointment_detail_id' => $appointDetails->id,
            'services_ids' => json_encode($this->services),
            'payment_method' => $this->payment_method,
            'payment_status' => 'Unpaid',
            'grand_total' => self::getTotalPriceProperty(),
            'status' => 'Unclaimed'
        ]);

        $serviceIds = array_filter($this->services);
        if (!empty($serviceIds)) {
            $requirements = Services::whereIn('id', $serviceIds)->pluck('requirements')->toArray();
            $filteredRequirements = implode(', ', $requirements);
        }

        Mail::to(request()->user())->send(new AppointmentCreationClient($filteredRequirements, Carbon::parse($appointDetails->time)->format('h:i A'), Carbon::createFromFormat('Y-m-d', $event->date)->format('d-m-Y'), $appointDetails->id));
        // Mail::to(request()->user())->send(new AppointmentSuccess($appointDetails));
        // self::sendSMS($appointDetails->id,$this->appointmentDate);
        return redirect($redirect_url);

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

    public function sendSMS($appointmentNumber, $appointmentDate){
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilioNumber = env('TWILIO_FROM');

        $client = new Client($sid, $token);
        $message = "LawScheduler\nWe received your appointment!\n Date: {$appointmentDate}\nYour appointment number is: {$appointmentNumber}";
        $client->messages->create(
            '+639633366707',
            [
                'from' => $twilioNumber,
                'body' => $message
            ]
        ); 
    }
    
    public function render()
    {
        return view('livewire.client.booking');
    }
}
