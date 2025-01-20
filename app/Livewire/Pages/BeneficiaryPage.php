<?php

namespace App\Livewire\Pages;

use App\Models\BeneficiariesModel;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class BeneficiaryPage extends Component
{
    use Actions;
    use WithPagination;
    // SEARCH
    public $searchTerm;

    // ADD
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

    // EDIT
    public $editFirstName;
    public $editLastName;
    public $editMiddleName;
    public $editPhone;
    public $editEmail;
    public $editStreetAddress;
    public $editBarangay;
    public $editCity;
    public $editState;
    public $editZipCode;
    public $selectedBeneficiary;
    public $selectedBeneficiaryId;

    public function mount(){
        $this->city = 'Tayabas City';
        $this->state = 'Philippines';
        $this->zipCode = '4306';
    }

    public function initialData(){
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
        $this->dispatch('reload');
        $this->reset();
        return redirect()->back();
    }

    public function getSelectedBeneficiaryId($id){
        $this->selectedBeneficiaryId = $id;

        if($this->selectedBeneficiaryId){
            $this->selectedBeneficiary = BeneficiariesModel::find($id);
        }

        if (!$this->selectedBeneficiary) {
            $this->selectedBeneficiary = null;
        } else {
            $this->editFirstName = $this->selectedBeneficiary->first_name;
            $this->editMiddleName = $this->selectedBeneficiary->middle_name;
            $this->editLastName = $this->selectedBeneficiary->last_name;
            $this->editPhone = $this->selectedBeneficiary->phone;
            $this->editEmail = $this->selectedBeneficiary->email;
            $this->editStreetAddress = $this->selectedBeneficiary->street_address;
            $this->editBarangay = $this->selectedBeneficiary->barangay;
            $this->editCity = $this->selectedBeneficiary->city;
            $this->editState = $this->selectedBeneficiary->state;
            $this->editZipCode = $this->selectedBeneficiary->zip_code;
        }
    }

    public function updateBeneficiaryDetails($id){
        $this->selectedBeneficiary = BeneficiariesModel::findOrFail($id);

        $this->selectedBeneficiary->update([
            'first_name' => $this->editFirstName,
            'middle_name' => $this->editMiddleName,
            'last_name' => $this->editLastName,
            'phone' => $this->editPhone,
            'email' => $this->editEmail,
            'street_address' => $this->editStreetAddress,
            'barangay' => $this->editBarangay,
        ]);

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function deleteConfirmation($id, $beneficiaryName){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this beneficiary " . html_entity_decode('<span class="text-red-600 underline">' . $beneficiaryName . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteBeneficiary',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }

    public function deleteBeneficiary($id){
        BeneficiariesModel::find($id)->delete();
        return redirect()->back();
    }

    public function resetModal(){
        $this->reset();
    }

    public function render()
    {
        
        if ($this->searchTerm) {
            $searchItems = BeneficiariesModel::where('last_name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('first_name', 'like', '%' . $this->searchTerm . '%')
                ->paginate(8);

            $beneficiariesList = $searchItems;
        } else {
            $beneficiariesList = BeneficiariesModel::paginate(8);
        }

        return view('livewire.pages.beneficiary-page', [
            'beneficiariesList' => $beneficiariesList
        ]);
    }
}
