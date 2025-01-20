<?php

namespace App\Livewire\Pages;

use App\Mail\ClientActivation;
use App\Models\AccountActivation;
use App\Models\BeneficiariesModel;
use App\Models\PHBarangays;
use App\Models\PHCities;
use App\Models\PHProvinces;
use App\Models\PHRegions;
use App\Models\TemporaryClient;
use App\Models\User;
use App\Models\UserInfo;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravolt\Avatar\Facade as Avatar;

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

        $user = User::create([
            'name' => $this->lastName . ", " . $this->firstName,
            'email' => $this->email,
            'role' => 'user',
        ]);

        // Generate the avatar
        $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
        $avatarPath = 'avatars/' . $user->id . '.png';
        Storage::disk('public')->put($avatarPath, (string) $avatar);

        $user->profile_picture = asset('storage/' . $avatarPath);
        $user->save();

        $client = UserInfo::create([
            'user_id' => $user->id,
            'first_name' => $this->firstName,
            'middle_name' => $this->middleName,
            'last_name' => $this->lastName,
            'phone' => '+63' . $this->phone,
            'region' => $this->region,
            'province' => $this->province,
            'municipality' => $this->municipality,
            'barangay' => $this->barangay,
            'state' => $this->state,
        ]);

        $token = Str::random(60);

        AccountActivation::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);

        Mail::to($user->email)->send(new ClientActivation($user, $token));
        
        $this->dispatch('reload');
        $this->reset();
        
        Notification::make()
            ->title('Success!')
            ->body('New client has been added.')
            ->success()
            ->send();

        return redirect()->back();
    }

    public function getSelectedClientId($id)
    {
        $this->selectedClientId = $id;

        if ($this->selectedClientId) {
            $this->selectedClient = User::with('info')->find($id);
        }

        if (!$this->selectedClient) {
            $this->selectedClient = null;
        } else {
            $userInfo = $this->selectedClient->info;

            if ($userInfo) {
                $this->editFirstName = $userInfo->first_name;
                $this->editMiddleName = $userInfo->middle_name;
                $this->editLastName = $userInfo->last_name;
                $this->editPhone = $userInfo->phone;
                $this->editRegion = $userInfo->region;
                $this->editProvince = $userInfo->province;
                $this->editMunicipality = $userInfo->municipality;
                $this->editBarangay = $userInfo->barangay;
                $this->editState = $userInfo->state;
            }

            $this->editEmail = $this->selectedClient->email;
        }
    }

    public function updateClientDetails($id){
        $this->selectedClient = User::with('info')->findOrFail($id);

        $this->selectedClient->update([
            'name' => $this->editLastName . ', ' . $this->editFirstName,
            'email' => $this->editEmail
        ]);

        $phone = $this->editPhone;
        if (!Str::startsWith($phone, '+63')) {
            $phone = '+63' . $phone;
        }

        $this->selectedClient->info()->update([
            'first_name' => $this->editFirstName,
            'middle_name' => $this->editMiddleName,
            'last_name' => $this->editLastName,
            'phone' => $phone,
            'region' => $this->editRegion,
            'province' => $this->editProvince,
            'municipality' => $this->editMunicipality,
            'barangay' => $this->editBarangay,
        ]);

        $this->dispatch('reload');

        Notification::make()
            ->title('Success!')
            ->body('Client details has been updated.')
            ->success()
            ->send();

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
        $user = User::find($id);
        if ($user) {
            // Get the avatar path
            $avatarPath = $user->profile_picture;

            $relativePath = str_replace('/storage/', '', $avatarPath);
    
            // Delete the avatar file from the storage if it exists
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
    
            // Delete the user record from the database
            $user->delete();
        }

        Notification::make()
            ->title('Success!')
            ->body('Client has been deleted.')
            ->success()
            ->send();
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
            $searchItems = User::whereHas('info', function ($query) {
                $query->where('last_name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('first_name', 'like', '%' . $this->searchTerm . '%');
            })
            ->latest()
            ->paginate(8);            

            $clientList = $searchItems;
        } else {
            $clientList = User::with('info')->latest()->paginate(8);
        }

        return view('livewire.pages.client-page', [
            'clientList' => $clientList
        ]);
    }
}
