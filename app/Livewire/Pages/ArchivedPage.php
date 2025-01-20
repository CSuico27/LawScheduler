<?php

namespace App\Livewire\Pages;

use App\Helpers\RespondentHelper;
use App\Models\Cases;
use App\Models\SubCaseType;
use App\Models\User;
use Filament\Notifications\Notification;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ArchivedPage extends Component
{
    use Actions;
    use WithPagination;

    // SEARCH
    public $searchTerm;
    
    public $NPSDocketNumber;
    public $dateReceived;
    public $timeReceived;
    public $receivingStaff;
    public $assignTo;
    public $dateAssigned;
    public $caseStage;
    public $priorityLevel;

    public $complainants = [''];
    public $respondents = [''];
    public $laws = [''];
    public $witnesses = [''];

    public $dateTimeCommission;
    public $placeOfCommission;

    public bool $questionOne;
    public bool $questionTwo;
    public bool $questionThree;

    public $ISNo;
    public $handlingProsecutor;
    
    // EDIT
    public $editNPSDocketNumber;
    public $editDateReceived;
    public $editTimeReceived;
    public $editReceivingStaff;
    public $editAssignTo;
    public $editDateAssigned;
    public $editCaseStage;
    public $editPriorityLevel;

    public $editComplainants = [''];
    public $editRespondents = [''];
    public $editLaws = [''];
    public $editWitnesses = [''];
    
    public $editDateTimeCommission;
    public $editPlaceOfCommission;

    public bool $editQuestionOne;
    public bool $editQuestionTwo;
    public bool $editQuestionThree;

    public $editISNo;
    public $editHandlingProsecutor;

    // STEP 2
   
    public $newCaseModal;

    public int $currentStep;
    public bool $isFinishedStepOne;
    public bool $isFinishedStepTwo;

    public $selectedCaseId;
    public $selectedCase;

    public $courts = [];

    public function mount(){
        $this->initialData();
        $this->questionOne = false;
        $this->questionTwo = false;
        $this->questionThree = false;
    }

    public function initialData(){
        $this->currentStep = 1;
        $this->isFinishedStepOne = false;
        $this->isFinishedStepTwo = false;
    }

    // public function createCase(){
    //     $this->validate([
    //         'NPSDocketNumber' => 'required|max:255',
    //         'dateReceived' => 'required|max:255',
    //         'timeReceived' => 'required|max:255',
    //         'receivingStaff' => 'required|max:255',
    //         'assignTo' => 'required|max:255',
    //         'dateAssigned' => 'required|max:255',
    //         'caseStage' => 'required|max:255',
    //         'priorityLevel' => 'required|max:255',

    //         'complainants.*' => 'required|max:255',
    //         'respondents.*' => 'required|max:255',
    //         'laws.*' => 'required|max:255',
    //         'witnesses.*' => 'required|max:255',
            
    //         'dateTimeCommission' => 'required|max:255',
    //         'placeOfCommission' => 'required|max:255',

    //         'questionOne' => 'required|boolean',
    //         'questionTwo' => 'required|boolean',
    //         'questionThree' => 'required|boolean',

    //         'ISNo' => 'required|max:255',
    //         'handlingProsecutor' => 'required|max:255',
    //     ]);

    //     $parsedRespondents = array_map(function($respondent) {
    //         $parts = explode(',', $respondent);
    //         return [
    //             'name' => trim($parts[0] ?? ''),
    //             'sex' => trim($parts[1] ?? ''),
    //             'age' => trim($parts[2] ?? ''),
    //             'address' => trim($parts[3] ?? ''),
    //         ];
    //     }, $this->respondents);

    //     $parsedWitnesses = array_map(function($witness) {
    //         $parts = explode(',', $witness);
    //         return [
    //             'name' => trim($parts[0] ?? ''),
    //             'sex' => trim($parts[1] ?? ''),
    //             'age' => trim($parts[2] ?? ''),
    //             'address' => trim($parts[3] ?? ''),
    //         ];
    //     }, $this->witnesses);

    //     $case = Cases::create([
    //         'nps_docket_no' => $this->NPSDocketNumber,
    //         'date_received' => $this->dateReceived,
    //         'time_received' => $this->timeReceived,
    //         'receiving_staff' => $this->receivingStaff,
    //         'assign_to' => $this->assignTo,
    //         'date_assigned' => $this->dateAssigned,
    //         'case_stage' => $this->caseStage,
    //         'priority_level' => $this->priorityLevel,

    //         'complainants' => json_encode($this->complainants),
    //         'respondents' => json_encode($parsedRespondents),
    //         'laws_violated' => json_encode($this->laws),
    //         'witnesses' => json_encode($parsedWitnesses),
            
    //         'date_time_commission' => $this->dateTimeCommission,
    //         'place_of_commission' => $this->placeOfCommission,

    //         'question_one' => $this->questionOne,
    //         'question_two' => $this->questionTwo,
    //         'question_three' => $this->questionThree,

    //         'is_no' => $this->ISNo,
    //         'handling_prosecutor' => $this->handlingProsecutor
    //     ]);

    //     Notification::make()
    //         ->title('Success!')
    //         ->body('Case has been created.')
    //         ->success()
    //         ->send();

    //     $this->dispatch('reload');
    //     $this->reset();
    //     return redirect()->back();
    // }

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
                $this->editNPSDocketNumber = $caseInfo->nps_docket_no;
                $this->editDateReceived = $caseInfo->date_received;
                $this->editTimeReceived = $caseInfo->time_received;
                $this->editReceivingStaff = $caseInfo->receiving_staff;
                $this->editAssignTo = $caseInfo->assign_to;
                $this->editDateAssigned = $caseInfo->date_assigned;
                $this->editCaseStage = $caseInfo->case_stage;
                $this->editPriorityLevel = $caseInfo->priority_level;
                
                $this->editComplainants = json_decode($caseInfo->complainants, true);
                $this->editRespondents = RespondentHelper::formatRespondents(json_decode($caseInfo->respondents, true));
                $this->editLaws = json_decode($caseInfo->laws_violated, true);
                $this->editWitnesses = RespondentHelper::formatRespondents(json_decode($caseInfo->witnesses, true));
                
                $this->editDateTimeCommission = $caseInfo->date_time_commission;
                $this->editPlaceOfCommission = $caseInfo->place_of_commission;

                $this->editQuestionOne = $caseInfo->question_one;
                $this->editQuestionTwo = $caseInfo->question_two;
                $this->editQuestionThree = $caseInfo->question_three;

                $this->editISNo = $caseInfo->is_no;
                $this->editHandlingProsecutor = $caseInfo->handling_prosecutor;
            }
        }
    }

    public function updateCaseDetails($id){
        $this->selectedCase = Cases::findOrFail($id);

        $parsedRespondents = array_map(function($respondent) {
            $parts = explode(',', $respondent);
            return [
                'name' => trim($parts[0] ?? ''),
                'sex' => trim($parts[1] ?? ''),
                'age' => trim($parts[2] ?? ''),
                'address' => trim($parts[3] ?? ''),
            ];
        }, $this->editRespondents);

        $parsedWitnesses = array_map(function($witness) {
            $parts = explode(',', $witness);
            return [
                'name' => trim($parts[0] ?? ''),
                'sex' => trim($parts[1] ?? ''),
                'age' => trim($parts[2] ?? ''),
                'address' => trim($parts[3] ?? ''),
            ];
        }, $this->editWitnesses);

        $this->selectedCase->update([
            'nps_docket_no' => $this->editNPSDocketNumber,
            'date_received' => $this->editDateReceived,
            'time_received' => $this->editTimeReceived,
            'receiving_staff' => $this->editReceivingStaff,
            'assign_to' => $this->editAssignTo,
            'date_assigned' => $this->editDateAssigned,
            'case_stage' => $this->editCaseStage,
            'priority_level' => $this->editPriorityLevel,

            'complainants' => json_encode($this->editComplainants),
            'respondents' => json_encode($parsedRespondents),
            'laws_violated' => json_encode($this->editLaws),
            'witnesses' => json_encode($parsedWitnesses),
            
            'date_time_commission' => $this->editDateTimeCommission,
            'place_of_commission' => $this->editPlaceOfCommission,

            'question_one' => $this->editQuestionOne,
            'question_two' => $this->editQuestionTwo,
            'question_three' => $this->editQuestionThree,

            'is_no' => $this->editISNo,
            'handling_prosecutor' => $this->editHandlingProsecutor
        ]);

        Notification::make()
            ->title('Success!')
            ->body('Client details has been updated.')
            ->success()
            ->send();

        $this->dispatch('reload');
        return redirect()->back();
    }
    
    public function unarchivedCase($id){
        $case = Cases::findOrFail($id);

        $case->update([
            'is_archived' => false,
        ]);

        Notification::make()
            ->title('Success!')
            ->body('Case has been unarchived.')
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

    public function addComplainant()
    {
        $this->complainants[] = '';  
        $this->editComplainants[] = '';  
    }

    public function addWitness()
    {
        $this->witnesses[] = '';  
        $this->editWitnesses[] = '';  
    }

    public function addLaw()
    {
        $this->laws[] = '';  
        $this->editLaws[] = '';  
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

    public function removeComplainant($index)
    {
        if (count($this->complainants) > 1) {
            unset($this->complainants[$index]);
            $this->complainants = array_values($this->complainants);
        }

        if (count($this->editComplainants) > 1) {
            unset($this->editComplainants[$index]);
            $this->editComplainants = array_values($this->editComplainants);
        }
    }

    public function removeWitness($index)
    {
        if (count($this->witnesses) > 1) {
            unset($this->witnesses[$index]);
            $this->witnesses = array_values($this->witnesses);
        }

        if (count($this->editWitnesses) > 1) {
            unset($this->editWitnesses[$index]);
            $this->editWitnesses = array_values($this->editWitnesses);
        }
    }

    public function removeLaw($index)
    {
        if (count($this->laws) > 1) {
            unset($this->laws[$index]);
            $this->laws = array_values($this->laws);
        }

        if (count($this->editLaws) > 1) {
            unset($this->editLaws[$index]);
            $this->editLaws = array_values($this->editLaws);
        }
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
            $searchItems = Cases::where('nps_docket_no', 'like', '%' . $this->searchTerm . '%')
            ->where('is_archived', true)
            ->with('caseSubType')
            ->with('caseStage')
            ->latest()
            ->paginate(5);
            
            foreach($searchItems as $case){
                $complainantIds = json_decode($case->complainants);
                $complainants = User::with('info')->whereIn('id', $complainantIds)->get();
                $case->complainantDetails = $complainants;
            }
            foreach($searchItems as $case){
                $lawsViolatedIds = json_decode($case->laws_violated);
                $laws = SubCaseType::whereIn('id', $lawsViolatedIds)->get();
                $case->lawsViolated = $laws;
            }

            $caseList = $searchItems;
        } else {
            $caseList = Cases::with('caseSubType')
                ->where('is_archived', true)
                ->with('caseStage')
                ->latest()
                ->paginate(5);

            foreach($caseList as $case){
                $complainantIds = json_decode($case->complainants);
                $complainants = User::with('info')->whereIn('id', $complainantIds)->get();
                $case->complainantDetails = $complainants;
            }
            foreach($caseList as $case){
                $lawsViolatedIds = json_decode($case->laws_violated);
                $laws = SubCaseType::whereIn('id', $lawsViolatedIds)->get();
                $case->lawsViolated = $laws;
            }
        }

        return view('livewire.pages.archived-page', [
            'caseList' => $caseList
        ]);
    }
}
