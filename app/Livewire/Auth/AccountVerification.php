<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class AccountVerification extends Component
{
    public $user;
    public $otp = [];
    public $user_id;

    public function mount($user_id) {
        $this->user_id = $user_id;
        $this->user = User::findOrFail($this->user_id);
    }

    public function verifyOtp()
    {
        $enteredOtp = implode('', $this->otp);
        if ($this->user->otp === $enteredOtp) {
            $this->user->is_verified = true;
            $this->user->otp = null;
            $this->user->save();
            
            auth()->login($this->user);
            return redirect()->route('user.home');
        } else {
            session()->flash('error', 'Invalid OTP');
        }
    }
    
    public function render()
    {
        return view('livewire.auth.account-verification');
    }
}
