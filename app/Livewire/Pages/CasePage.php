<?php

namespace App\Livewire\Pages;

use App\Models\Cases;
use App\Models\CaseStage;
use App\Models\SubCaseType;
use App\Models\User;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CasePage extends Component
{
    use Actions;
    use WithPagination;

    // SEARCH
    public $searchTerm;
    
    // STEP 1
    public $respondents = [''];
    public $petitioner;
    public $caseNumber;
    public $caseType;
    public $caseSubType;
    public $caseStage;
    public $priorityLevel;
    public $act;
    public $filingNumber;
    public $filingDate;
    public $registrationNumber;
    public $registrationDate;
    public $firstHearingDate;
    public $CNRNumber;
    public $description;
    // STEP 2
    public $policeStation;
    public $FIRNumber;
    public $FIRDate;
    public $courtNumber;
    public $courtType;
    public $court;
    public $judgeType;
    public $judgeName;
    public $remarks;

    public $newCaseModal;

    public int $currentStep;
    public bool $isFinishedStepOne;
    public bool $isFinishedStepTwo;

    public function mount(){
        $this->initialData();
    }

    public function initialData(){
        $this->currentStep = 1;
        $this->isFinishedStepOne = false;
        $this->isFinishedStepTwo = false;
    }

    public function createCase(){
        $this->validate([
            'respondents.*' => 'required|max:255',
            'petitioner' => 'required|exists:users,id',
            'caseNumber' => 'required|max:255',
            'caseType' => 'required|max:255',
            'caseSubType' => 'required|max:255',
            'caseStage' => 'required|max:255',
            'priorityLevel' => 'required|max:255',
            'act' => 'required|max:255',
            'filingNumber' => 'required|max:255',
            'filingDate' => 'required|date',
            'registrationNumber' => 'required|max:255',
            'registrationDate' => 'required|date',
            'firstHearingDate' => 'required|date',
            'CNRNumber' => 'required|max:255',
            'description' => 'nullable|max:255',
            'policeStation' => 'required|max:255',
            'FIRNumber' => 'required|max:255',
            'FIRDate' => 'required|date',
            'courtNumber' => 'required|max:255',
            'courtType' => 'required|max:255',
            'court' => 'required|max:255',
            'judgeType' => 'required|max:255',
            'judgeName' => 'required|max:255',
            'remarks' => 'nullable|max:255',
        ]);

        $case = Cases::create([
            'petitioner_id' => $this->petitioner,
            'respondents' => json_encode($this->respondents),
            'case_no' => $this->caseNumber,
            'case_type' => $this->caseType,
            'case_sub_type' => $this->caseSubType,
            'case_stage' => $this->caseStage,
            'priority_level' => $this->priorityLevel,
            'act' => $this->act,
            'filing_number' => $this->filingNumber,
            'filing_date' => $this->filingDate,
            'registration_number' => $this->registrationNumber,
            'registration_date' => $this->registrationDate,
            'first_hearing_date' => $this->firstHearingDate,
            'cnr_number' => $this->CNRNumber,
            'description' => $this->description,
            'police_station' => $this->policeStation,
            'fir_number' => $this->FIRNumber,
            'fir_date' => $this->FIRDate,
            'court_number' => $this->courtNumber,
            'court_type' => $this->courtType,
            'court' => $this->court,
            'judge_type' => $this->judgeType,
            'judge_name' => $this->judgeName,
            'remarks' => $this->remarks
        ]);

        $this->dispatch('reload');
        $this->reset();
        return redirect()->back();
    }
    

    public function nextStep(){
        if($this->currentStep < 2 && $this->respondents && $this->petitioner && $this->caseType && $this->caseSubType && $this->caseStage && $this->priorityLevel && $this->act && $this->filingNumber && $this->filingDate && $this->registrationNumber && $this->registrationDate && $this->firstHearingDate && $this->CNRNumber){
            $this->currentStep = $this->currentStep + 1;
            $this->isFinishedStepOne = true;
        }
    }

    public function backStep(){
        if($this->currentStep > 1 && $this->respondents && $this->petitioner && $this->caseType && $this->caseSubType && $this->caseStage && $this->priorityLevel && $this->act && $this->filingNumber && $this->filingDate && $this->registrationNumber && $this->registrationDate && $this->firstHearingDate && $this->CNRNumber){
            $this->currentStep = $this->currentStep - 1;
            $this->isFinishedStepOne = false;
        }
    }

    public function addRespondent()
    {
        $this->respondents[] = '';  
    }

    public function removeRespondent($index)
    {
        if (count($this->respondents) > 1) {
            unset($this->respondents[$index]);
            $this->respondents = array_values($this->respondents);
        }
    }

    public function getCaseSubTypes(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $caseSubTypes = SubCaseType::where('name', 'like', '%' . $search . '%')->get();
        } elseif ($selected) {

            $selectedCaseSubType = SubCaseType::where('id', $selected)->get();

            return response()->json($selectedCaseSubType);
            
        } else {
            $caseSubTypes = SubCaseType::all();
        }

        return response()->json($caseSubTypes);
    }

    public function getCaseStage(Request $request){
        $search = $request->input('search');
        $selected = $request->input('selected');

        if ($search) {
            $caseStage = CaseStage::where('name', 'like', '%' . $search . '%')->get();
        } elseif ($selected) {

            $selectedCaseStage= CaseStage::where('id', $selected)->get();

            return response()->json($selectedCaseStage);
            
        } else {
            $caseStage = CaseStage::all();
        }

        return response()->json($caseStage);
    }

    public function deleteCase($id){
        Cases::find($id)->delete();

        Notification::make()
            ->title('Success!')
            ->body('Case has been deleted.')
            ->success()
            ->send();

        return redirect()->back();
    }

    public function deleteConfirmation($id, $caseNumber){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this case with no. " . html_entity_decode('<span class="text-red-600 underline">' . $caseNumber . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteCase',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }

    public function render()
    {
        if ($this->searchTerm) {
            $searchItems = Cases::where('case_no', 'like', '%' . $this->searchTerm . '%')
            ->with('user') // Eager load the petitioner (user) relationship
            ->latest()
            ->paginate(8);;

            $caseList = $searchItems;
        } else {
            $caseList = Cases::with('user') // Eager load the petitioner (user) relationship
            ->latest()
            ->paginate(8);
        }

        return view('livewire.pages.case-page', [
            'caseList' => $caseList
        ]);
    }
}
