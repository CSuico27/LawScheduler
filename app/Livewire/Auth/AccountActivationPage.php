<?php

namespace App\Livewire\Auth;

use App\Models\AccountActivation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AccountActivationPage extends Component
{
    public $token;
    public $password;
    public $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function setPassword()
    {
        $this->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $activation = AccountActivation::where('token', $this->token)->first();

        if (!$activation) {
            session()->flash('error', 'Invalid activation link.');
            return redirect()->route('login');
        }

        $user = User::find($activation->user_id);
        $user->password = Hash::make($this->password);
        $user->save();

        $activation->delete();

        session()->flash('success', 'Your account has been activated. You can now log in.');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.account-activation-page');
    }
}
