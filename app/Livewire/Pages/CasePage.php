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

    public $editRespondents = [''];
    public $editPetitioner;
    public $editCaseNumber;
    public $editCaseType;
    public $editCaseSubType;
    public $editCaseStage;
    public $editPriorityLevel;
    public $editAct;
    public $editFilingNumber;
    public $editFilingDate;
    public $editRegistrationNumber;
    public $editRegistrationDate;
    public $editFirstHearingDate;
    public $editCNRNumber;
    public $editDescription;
    // STEP 2
    public $editPoliceStation;
    public $editFIRNumber;
    public $editFIRDate;
    public $editCourtNumber;
    public $editCourtType;
    public $editCourt;
    public $editJudgeType;
    public $editJudgeName;
    public $editRemarks;

    public $newCaseModal;

    public int $currentStep;
    public bool $isFinishedStepOne;
    public bool $isFinishedStepTwo;

    public $selectedCaseId;
    public $selectedCase;

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

        Notification::make()
            ->title('Success!')
            ->body('Case has been created.')
            ->success()
            ->send();

        $this->dispatch('reload');
        $this->reset();
        return redirect()->back();
    }

    public function getSelectedCaseId($id)
    {
        $this->selectedCaseId = $id;
    
        if ($this->selectedCaseId) {
            $this->selectedCase = Cases::with('user')->find($id);
        }

        if (!$this->selectedCase) {
            $this->selectedCase = null;
        } else {
            $caseInfo = $this->selectedCase;
            
            if ($caseInfo) {
                $this->editPetitioner = $caseInfo->petitioner_id;
                
                $this->editRespondents = json_decode($caseInfo->respondents);
                $this->editCaseNumber = $caseInfo->case_no;
                $this->editCaseType = $caseInfo->case_type;
                $this->editCaseSubType = $caseInfo->case_sub_type;
                $this->editCaseStage = $caseInfo->case_stage;
                $this->editPriorityLevel = $caseInfo->priority_level;
                $this->editAct = $caseInfo->act;
                $this->editFilingNumber = $caseInfo->filing_number;
                $this->editFilingDate = $caseInfo->filing_date;
                $this->editRegistrationNumber = $caseInfo->registration_number;
                $this->editRegistrationDate = $caseInfo->registration_date;
                $this->editFirstHearingDate = $caseInfo->first_hearing_date;
                $this->editCNRNumber = $caseInfo->cnr_number;
                $this->editDescription = $caseInfo->description;
                $this->editPoliceStation = $caseInfo->police_station;
                $this->editFIRNumber = $caseInfo->fir_number;
                $this->editFIRDate = $caseInfo->fir_date;
                $this->editCourtNumber = $caseInfo->court_number;
                $this->editCourtType = $caseInfo->court_type;
                $this->editCourt = $caseInfo->court;
                $this->editJudgeType = $caseInfo->judge_type;
                $this->editJudgeName = $caseInfo->judge_name;
                $this->editRemarks = $caseInfo->remarks;
            }
        }
    }

    public function updateCaseDetails($id){
        $this->selectedCase = Cases::findOrFail($id);

        $this->selectedCase->update([
            'petitioner_id' => $this->editPetitioner,
            'respondents' => json_encode($this->editRespondents),
            'case_no' => $this->editCaseNumber,
            'case_type' => $this->editCaseType,
            'case_sub_type' => $this->editCaseSubType,
            'case_stage' => $this->editCaseStage,
            'priority_level' => $this->editPriorityLevel,
            'act' => $this->editAct,
            'filing_number' => $this->editFilingNumber,
            'filing_date' => $this->editFilingDate,
            'registration_number' => $this->editRegistrationNumber,
            'registration_date' => $this->editRegistrationDate,
            'first_hearing_date' => $this->editFirstHearingDate,
            'cnr_number' => $this->editCNRNumber,
            'description' => $this->editDescription,
            'police_station' => $this->editPoliceStation,
            'fir_number' => $this->editFIRNumber,
            'fir_date' => $this->editFIRDate,
            'court_number' => $this->editCourtNumber,
            'court_type' => $this->editCourtType,
            'court' => $this->editCourt,
            'judge_type' => $this->editJudgeType,
            'judge_name' => $this->editJudgeName,
            'remarks' => $this->editRemarks
        ]);

        Notification::make()
            ->title('Success!')
            ->body('Client details has been updated.')
            ->success()
            ->send();

        $this->dispatch('reload');
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
        $this->editRespondents[] = '';  
    }

    public function removeRespondent($index)
    {
        if (count($this->respondents) > 1) {
            unset($this->respondents[$index]);
            $this->respondents = array_values($this->respondents);
        }

        if (count($this->editRespondents) > 1) {
            unset($this->editRespondents[$index]);
            $this->editRespondents = array_values($this->editRespondents);
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

    public function cancel(){
        $this->dispatch('reload');
    }

    public function render()
    {
        if ($this->searchTerm) {
            $searchItems = Cases::where('case_no', 'like', '%' . $this->searchTerm . '%')
            ->with('user')
            ->with('caseType')
            ->with('caseSubType')
            ->with('caseStage') // Eager load the petitioner (user) relationship
            ->latest()
            ->paginate(5);

            $caseList = $searchItems;
        } else {
            $caseList = Cases::with('user')
            ->with('caseType')
            ->with('caseSubType')
            ->with('caseStage') // Eager load the petitioner (user) relationship
            ->latest()
            ->paginate(5);
        }

        return view('livewire.pages.case-page', [
            'caseList' => $caseList
        ]);
    }
}
