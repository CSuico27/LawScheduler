<?php

namespace App\Livewire\Pages;

use App\Models\BeneficiariesModel;
use App\Models\PHBarangays;
use App\Models\PHCities;
use App\Models\PHProvinces;
use App\Models\PHRegions;
use App\Models\TemporaryClient;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ClientPage extends Component
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
    public $region;
    public $province;
    public $municipality;
    public $barangay;
    public $state;

    // EDIT
    public $editFirstName;
    public $editLastName;
    public $editMiddleName;
    public $editPhone;
    public $editEmail;
    public $editRegion;
    public $editProvince;
    public $editMunicipality;
    public $editBarangay;
    public $editState;
    
    public $selectedClient;
    public $selectedClientId;

    public function mount(){
        $this->initialData();
    }

    public function initialData(){
        $this->state = 'Philippines';
    }

    public function addNewClient(){
        
        $this->validate([ 
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'middleName' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'region' => 'required|max:255',
            'province' => 'required|max:255',
            'municipality' => 'required|max:255',
            'barangay' => 'required|max:255',
            'state' => 'required|max:255',
        ]);

        $client = TemporaryClient::create([
            'first_name' => $this->firstName,
            'middle_name' => $this->middleName,
            'last_name' => $this->lastName,
            'phone' => $this->phone,
            'email' => $this->email,
            'region' => $this->region,
            'province' => $this->province,
            'municipality' => $this->municipality,
            'barangay' => $this->barangay,
            'state' => $this->state,
        ]);
        $this->dispatch('reload');
        $this->reset();
        return redirect()->back();
    }

    public function getSelectedClientId($id){
        $this->selectedClientId = $id;

        if($this->selectedClientId){
            $this->selectedClient = TemporaryClient::find($id);
        }

        if (!$this->selectedClient) {
            $this->selectedClient = null;
        } else {
            $this->editFirstName = $this->selectedClient->first_name;
            $this->editMiddleName = $this->selectedClient->middle_name;
            $this->editLastName = $this->selectedClient->last_name;
            $this->editPhone = $this->selectedClient->phone;
            $this->editEmail = $this->selectedClient->email;
            $this->editRegion = $this->selectedClient->region;
            $this->editProvince = $this->selectedClient->province;
            $this->editMunicipality = $this->selectedClient->municipality;
            $this->editBarangay = $this->selectedClient->barangay;
            $this->editState = $this->selectedClient->state;
        }
    }

    public function updateClientDetails($id){
        $this->selectedClient = TemporaryClient::findOrFail($id);

        $this->selectedClient->update([
            'first_name' => $this->editFirstName,
            'middle_name' => $this->editMiddleName,
            'last_name' => $this->editLastName,
            'phone' => $this->editPhone,
            'email' => $this->editEmail,
            'region' => $this->editRegion,
            'province' => $this->editProvince,
            'municipality' => $this->editMunicipality,
            'barangay' => $this->editBarangay,
        ]);

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function deleteConfirmation($id, $clientName){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this client " . html_entity_decode('<span class="text-red-600 underline">' . $clientName . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteClient',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }

    public function deleteClient($id){
        TemporaryClient::find($id)->delete();
        return redirect()->back();
    }

    public function resetModal(){
        $this->reset();
    }

    public function getRegions(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $regions = PHRegions::where('region_description', 'like', '%' . $search . '%')->get();
        } elseif ($selected) {

            $selectedRegion = PHRegions::where('region_description', $selected)->get();

            return response()->json($selectedRegion);
            
        } else {
            $regions = PHRegions::all();
        }

        return response()->json($regions);
    }

    public function getProvinces(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');
        
        if ($search) {
            $provinces = PHProvinces::where('province_description', 'like', '%' . $search . '%')->get();
        } elseif ($selected) {

            $selectedProvince = PHProvinces::where('province_description', $selected)->get();
            return response()->json($selectedProvince);
            
        } else {
            $provinces = PHProvinces::take(10)->get();
        }

        return response()->json($provinces);
    }

    public function getMunicipalities(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');
        
        if ($search) {
            $municipalities = PHCities::where('city_municipality_description', 'like', '%' . $search . '%')->get();
        } elseif ($selected) {

            $selectedMunicipality = PHCities::where('city_municipality_description', $selected)->get();
            return response()->json($selectedMunicipality);
            
        } else {
            $municipalities = PHCities::take(10)->get();
        }

        return response()->json($municipalities);
    }

    public function getBarangays(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');
        
        if ($search) {
            $barangays = PHBarangays::where('barangay_description', 'like', '%' . $search . '%')->get();
        } elseif ($selected) {

            $selectedBarangay = PHBarangays::where('barangay_description', $selected)->get();
            return response()->json($selectedBarangay);
            
        } else {
            $barangays = PHBarangays::take(10)->get();
        }

        return response()->json($barangays);
    }

    public function render()
    {
        
        if ($this->searchTerm) {
            $searchItems = TemporaryClient::where('last_name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('first_name', 'like', '%' . $this->searchTerm . '%')
                ->latest()
                ->paginate(8);

            $clientList = $searchItems;
        } else {
            $clientList = TemporaryClient::latest()->paginate(8);
        }

        return view('livewire.pages.client-page', [
            'clientList' => $clientList
        ]);
    }
}
