<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Register')]
class RegisterPage extends Component
{
    public $firstName;
    public $lastName;
    public $middleName;
    public $phone;
    public $email;
    public $streetAddress;
    public $barangay;
    public $city;
    public $state;
    public $zipCode;
    public $password;
    public $confirmPassword;

    public int $currentStep;
    public bool $isFinishedStepOne;
    public bool $isFinishedStepTwo;

    public function mount(){
        $this->initialData();
    }

    public function initialData(){
        $this->city = 'Tayabas City';
        $this->state = 'Philippines';
        $this->zipCode = '4306';
        $this->currentStep = 1;
        $this->isFinishedStepOne = false;
        $this->isFinishedStepTwo = false;
    }

    public function nextStep(){
        if($this->currentStep < 2 && $this->firstName && $this->lastName && $this->middleName && $this->streetAddress && $this->barangay){
            $this->currentStep = $this->currentStep + 1;
            $this->isFinishedStepOne = true;
        }
    }

    public function backStep(){
        if($this->currentStep > 1  && $this->firstName && $this->lastName && $this->middleName && $this->streetAddress && $this->barangay){
            $this->currentStep = $this->currentStep - 1;
            $this->isFinishedStepOne = false;
        }
    }

    public function register(){
        $this->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'middleName' => 'required|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|unique:users,email|max:255',
            'streetAddress' => 'required|max:255',
            'barangay' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'zipCode' => 'required|max:255',
            'password' => 'required|min:8|max:255', 
            'confirmPassword' => 'required|same:password|min:8|max:255',
        ]);

        try {
            $user = User::create([
                'name' => $this->lastName . ", " . $this->firstName,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
    
            $userInfo = UserInfo::create([
                'user_id' => $user->id,
                'first_name' => $this->firstName,
                'middle_name' => $this->middleName,
                'last_name' => $this->lastName,
                'phone' => $this->phone,
                'street_address' => $this->streetAddress,
                'barangay' => $this->barangay,
                'city' => $this->city,
                'state' => $this->state,
                'zip_code' => $this->zipCode,
            ]);
    
            auth()->login($user);
    
            return redirect()->intended();
        } catch (\Exception $e) {
            Log::error('Error registering user: ' . $e->getMessage());
        }

        
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
