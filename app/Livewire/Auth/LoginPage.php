<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;
use WireUi\Traits\Actions;

#[Title('Login')]

class LoginPage extends Component
{
    use Actions;
    
    public $email;
    public $password;

    public function login(){
        $this->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255'
        ]);

        if(!auth()->attempt(['email' => $this->email, 'password' => $this->password])){
            $this->notification()->error(
                $title = 'Error!',
                $description = 'Invalid credentials'
            );
            return;
        }

        if (auth()->user()->is_verified == 0) {
            auth()->logout(); // Log out the user if they are not verified
            $this->notification()->error(
                $title = 'Error!',
                $description = 'Your account is not verified. Please verify your account to log in.'
            );
            return;
        }

        return redirect()->intended();
    }

    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
