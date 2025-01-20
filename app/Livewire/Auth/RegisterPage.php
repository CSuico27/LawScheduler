<?php

namespace App\Livewire\Auth;

use App\Models\PHBarangays;
use App\Models\PHCities;
use App\Models\PHProvinces;
use App\Models\PHRegions;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facade as Avatar;

#[Title('Register')]
class RegisterPage extends Component
{
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

    public $password;
    public $confirmPassword;

    public int $currentStep;
    public bool $isFinishedStepOne;
    public bool $isFinishedStepTwo;


    public function mount(){
        $this->initialData();
    }

    public function initialData(){
        $this->state = 'Philippines';
        $this->currentStep = 1;
        $this->isFinishedStepOne = false;
        $this->isFinishedStepTwo = false;
    }

    public function nextStep(){
        if($this->currentStep < 2 && $this->firstName && $this->lastName && $this->middleName){
            $this->currentStep = $this->currentStep + 1;
            $this->isFinishedStepOne = true;
        }
    }

    public function backStep(){
        if($this->currentStep > 1  && $this->firstName && $this->lastName && $this->middleName){
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
            'region' => 'required|max:255',
            'province' => 'required|max:255',
            'municipality' => 'required|max:255',
            'barangay' => 'required|max:255',
            'state' => 'required|max:255',
            'password' => 'required|min:8|max:255', 
            'confirmPassword' => 'required|same:password|min:8|max:255',
        ]);

        try {
            $user = User::create([
                'name' => $this->lastName . ", " . $this->firstName,
                'email' => $this->email,
                'role' => 'user',
                'password' => Hash::make($this->password)
            ]);

            // Generate the avatar
            $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
            $avatarPath = 'avatars/' . $user->id . '.png';
            Storage::disk('public')->put($avatarPath, (string) $avatar);

            $user->profile_picture = asset('storage/' . $avatarPath);
            $user->save();
    
            $userInfo = UserInfo::create([
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
    
            auth()->login($user);
    
            return redirect()->intended();
        } catch (\Exception $e) {
            Log::error('Error registering user: ' . $e->getMessage());
        }
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
        return view('livewire.auth.register-page');
    }
}
