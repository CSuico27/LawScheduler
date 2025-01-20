<?php

namespace App\Livewire\Client;

use App\Models\AppointmentDetails;
use App\Models\Orders;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Title('Cancel')]
class CancelPage extends Component
{
    #[Url]
    public $session_id;
    
    public function render()
    {
        $latest_order = AppointmentDetails::with('orders')->where('client_id', auth()->user()->id)->latest()->first();

        if($this->session_id){
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $session_info = Session::retrieve($this->session_id);

            if($session_info->payment_status != 'paid'){
                $latest_order->orders->payment_status = 'Failed';
                $latest_order->orders->save();
            }
        }

        return view('livewire.client.cancel-page');
    }
}
