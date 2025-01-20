<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CaseStage;
use App\Models\CaseType;
use App\Models\Court;
use App\Models\CourtType;
use App\Models\PHBarangays;
use App\Models\PHCities;
use App\Models\PHProvinces;
use App\Models\PHRegions;
use App\Models\Services;
use App\Models\ServiceType;
use App\Models\SubCaseType;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
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

    public function getProvincesByRegion(Request $request, $regionCode){
        $search = $request->input('search');
        $selected = $request->input('selected');
        
        if ($search && $regionCode) {
            $provinces = PHProvinces::where('province_description', 'like', '%' . $search . '%' )
                ->where('region_code', $regionCode)
                ->get();
        } elseif ($selected && $regionCode) {

            $selectedProvince = PHProvinces::where('province_description', $selected)
                ->where('region_code', $regionCode)
                ->get();
            return response()->json($selectedProvince);
            
        } else {
            $provinces = PHProvinces::where('region_code', $regionCode)->get();
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

    public function getMunicipalitiesByProvince(Request $request, $provinceCode){
        $search = $request->input('search');
        $selected = $request->input('selected');
        
        if ($search && $provinceCode) {
            $municipalities = PHCities::where('city_municipality_description', 'like', '%' . $search . '%' )
                ->where('province_code', $provinceCode)
                ->get();
        } elseif ($selected && $provinceCode) {

            $selectedMunicipality = PHCities::where('city_municipality_description', $selected)
                ->where('province_code', $provinceCode)
                ->get();
            return response()->json($selectedMunicipality);
            
        } else {
            $municipalities = PHCities::where('province_code', $provinceCode)->get();
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

    // $search = $request->input('search');
    //     $selected = $request->input('selected');
        
    //     if ($search && $provinceCode) {
    //         $municipalities = PHCities::where('city_municipality_description', 'like', '%' . $search . '%' )
    //             ->where('province_code', $provinceCode)
    //             ->get();
    //     } elseif ($selected && $provinceCode) {

    //         $selectedMunicipality = PHCities::where('city_municipality_description', $selected)
    //             ->where('province_code', $provinceCode)
    //             ->get();
    //         return response()->json($selectedMunicipality);
            
    //     } else {
    //         $municipalities = PHCities::where('province_code', $provinceCode)->get();
    //     }

    //     return response()->json($municipalities);

    public function getBarangaysByMunicipality(Request $request, $municipalityCode){
        $search = $request->input('search');
        $selected = $request->input('selected');
        
        if ($search && $municipalityCode) {
            $barangays = PHBarangays::where('barangay_description', 'like', '%' . $search . '%')
                ->where('city_municipality_code', $municipalityCode)
                ->get();
        } elseif ($selected && $municipalityCode) {

            $selectedBarangay = PHBarangays::where('barangay_description', $selected)
                ->where('city_municipality_code', $municipalityCode)
                ->get();
            return response()->json($selectedBarangay);
            
        } else {
            $barangays = PHBarangays::where('city_municipality_code', $municipalityCode)->get();
        }

        return response()->json($barangays);
    }

    public function getCaseTypes(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $caseTypes = CaseType::where('name', 'like', '%' . $search . '%')->where('is_active', 1)->get();
        } elseif ($selected) {

            $selectedCaseType = CaseType::where('id', $selected)->get();

            return response()->json($selectedCaseType);
            
        } else {
            $caseTypes = CaseType::where('is_active', 1)->get();
        }

        return response()->json($caseTypes);
    }

    public function getCaseStage(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $caseStage = CaseStage::where('name', 'like', '%' . $search . '%')->where('is_active', 1)->get();
        } elseif ($selected) {

            $selectedCaseStage= CaseStage::where('id', $selected)->get();

            return response()->json($selectedCaseStage);
            
        } else {
            $caseStage = CaseStage::where('is_active', 1)->get();
        }

        return response()->json($caseStage);
    }

    public function getCaseSubTypes(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $caseSubTypes = SubCaseType::where('name', 'like', '%' . $search . '%')->where('is_active', 1)->get();
        } elseif ($selected) {

            $selectedCaseSubType = SubCaseType::where('id', $selected)->get();

            return response()->json($selectedCaseSubType);
            
        } else {
            $caseSubTypes = SubCaseType::where('is_active', 1)->get();
        }

        return response()->json($caseSubTypes);
    }

    public function getCourtTypes(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $courtTypes = CourtType::where('name', 'like', '%' . $search . '%')->where('is_active', 1)->get();
        } elseif ($selected) {

            $selectedCourtType = CourtType::where('id', $selected)->get();

            return response()->json($selectedCourtType);
            
        } else {
            $courtTypes = CourtType::where('is_active', 1)->get();
        }

        return response()->json($courtTypes);
    }

    public function getCourtsByType(Request $request, $courtTypeId)
    {
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $courts = Court::where('name', 'like', '%' . $search . '%')->where('is_active', 1)->get();
        } elseif ($selected) {

            $selectedCourt = Court::where('id', $selected)->get();

            return response()->json($selectedCourt);
            
        } else {
            $courts = Court::where('court_type_id', $courtTypeId)->where('is_active', 1)->get();
        }

        return response()->json($courts);
    }

    public function getCourts(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $courts = Court::where('name', 'like', '%' . $search . '%')->where('is_active', 1)->get();
        } elseif ($selected) {

            $selectedCourt = Court::where('id', $selected)->get();

            return response()->json($selectedCourt);

        } else {
            $courts = Court::where('is_active', 1)->get();
        }

        return response()->json($courts);
    }

    public function getParticipant(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $users = User::where('name', 'like', '%' . $search . '%')
                ->whereNotNull('profile_picture')
                ->get();
        } elseif ($selected) {

            $selectedUsers = User::where('id', $selected)
                ->whereNotNull('profile_picture')
                ->get();

            return response()->json($selectedUsers);
            
        } else {
            $users = User::whereNotNull('profile_picture')->get();
        }

        return response()->json($users);
    }

    public function getServiceTypes(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $serviceTypes = ServiceType::where('name', 'like', '%' . $search . '%')
                ->where('is_active', 1)
                ->get();
        } elseif ($selected) {

            $selectedServiceType = ServiceType::where('id', $selected)
                ->where('is_active', 1)
                ->get();

            return response()->json($selectedServiceType);
            
        } else {
            $serviceTypes = ServiceType::where('is_active', 1)->get();
        }

        return response()->json($serviceTypes);
    }

    public function getServices(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $services = Services::where('name', 'like', '%' . $search . '%')
                ->where('is_active', 1)
                ->get();
        } elseif ($selected) {

            $selectedService = Services::where('id', $selected)
                ->where('is_active', 1)
                ->get();

            return response()->json($selectedService);
            
        } else {
            $services = Services::where('is_active', 1)->get();
        }

        return response()->json($services);
    }
}
