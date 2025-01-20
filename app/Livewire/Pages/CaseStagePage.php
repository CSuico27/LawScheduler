<?php

namespace App\Livewire\Pages;

use App\Models\CaseStage;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CaseStagePage extends Component
{
    use Actions;
    use WithPagination;
    
    public $name;
    public bool $isActive = true;

    public $editName;
    public bool $editIsActive;

    public $selectedCaseStage;
    public $selectedCaseStageId;

    public $searchTerm;

    public function addNewCaseStage(){
        $this->validate([ 
            'name' => 'required|max:255',
        ]);

        $caseType = CaseStage::create([
            'name' => $this->name,
            'is_active' => $this->isActive
        ]);

        $this->dispatch('reload');
        $this->reset();
        return redirect()->back();
    }

    public function getSelectedCaseStageId($id){
        $this->selectedCaseStageId = $id;

        if($this->selectedCaseStageId){
            $this->selectedCaseStage = CaseStage::find($id);
        }

        if (!$this->selectedCaseStage) {
            $this->selectedCaseStage = null;
        } else {
            $this->editName = $this->selectedCaseStage->name;
            $this->editIsActive = $this->selectedCaseStage->is_active;
        }
    }

    public function updateCaseStageDetails($id){
        $this->selectedCaseStage = CaseStage::findOrFail($id);

        $this->selectedCaseStage->update([
            'name' => $this->editName,
            'is_active' => $this->editIsActive,
        ]);

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function deleteCaseStage($id){
        CaseStage::find($id)->delete();
        return redirect()->back();
    }

    public function resetModal(){
        $this->reset();
    }

    public function deleteConfirmation($id, $caseStageName){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this case type " . html_entity_decode('<span class="text-red-600 underline">' . $caseStageName . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteCaseType',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }

    public function render()
    {
        if ($this->searchTerm) {
            $searchItems = CaseStage::where('name', 'like', '%' . $this->searchTerm . '%')->latest()->paginate(8);
            $caseStageList = $searchItems;
        } else {
            $caseStageList = CaseStage::latest()->paginate(8);
        }

        return view('livewire.pages.case-stage-page', [
            'caseStageList' => $caseStageList
        ]);
    }
}
