<?php

namespace App\Livewire\Pages;

use App\Models\BeneficiariesModel;
use Livewire\Component;

class BeneficiaryPage extends Component
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

    public function mount(){
        $this->city = 'Tayabas City';
        $this->state = 'Philippines';
        $this->zipCode = '4306';
    }

    public function addNewBeneficiary(){

        $this->validate([ 
            'firstName' => 'required|max:255',
            'lastName' => 'nullable|max:255',
            'middleName' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'nullable|email|unique:users,email|max:255',
            'streetAddress' => 'required|max:255',
            'barangay' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'zipCode' => 'required|max:255',
        ]);

        $beneficiary = BeneficiariesModel::create([
            'first_name' => $this->firstName,
            'middle_name' => $this->middleName,
            'last_name' => $this->lastName,
            'phone' => $this->phone,
            'email' => $this->email,
            'street_address' => $this->streetAddress,
            'barangay' => $this->barangay,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zipCode,
        ]);
        $this->reset();
        return redirect()->back();
    }

    public function render()
    {
        $beneficiariesList = BeneficiariesModel::all();
        return view('livewire.pages.beneficiary-page', [
            'beneficiariesList' => $beneficiariesList
        ]);
    }
}
