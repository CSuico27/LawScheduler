<?php

namespace App\Livewire\Pages;

use App\Models\CaseType as ModelsCaseType;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CaseType extends Component
{
    use Actions;
    use WithPagination;
    
    public $name;
    public bool $isActive = true;

    public $editName;
    public bool $editIsActive;

    public $selectedCaseType;
    public $selectedCaseTypeId;

    public $searchTerm;

    public function addNewCaseType(){
        $this->validate([ 
            'name' => 'required|max:255',
        ]);

        $caseType = ModelsCaseType::create([
            'name' => $this->name,
            'is_active' => $this->isActive
        ]);

        $this->dispatch('reload');
        $this->reset();
        return redirect()->back();
    }

    public function getSelectedCaseTypeId($id){
        $this->selectedCaseTypeId = $id;

        if($this->selectedCaseTypeId){
            $this->selectedCaseType = ModelsCaseType::find($id);
        }

        if (!$this->selectedCaseType) {
            $this->selectedCaseType = null;
        } else {
            $this->editName = $this->selectedCaseType->name;
            $this->editIsActive = $this->selectedCaseType->is_active;
        }
    }

    public function updateCaseTypeDetails($id){
        $this->selectedCaseType = ModelsCaseType::findOrFail($id);

        $this->selectedCaseType->update([
            'name' => $this->editName,
            'is_active' => $this->editIsActive,
        ]);

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function deleteCaseType($id){
        ModelsCaseType::find($id)->delete();
        return redirect()->back();
    }

    public function resetModal(){
        $this->reset();
    }

    public function deleteConfirmation($id, $caseTypeName){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this case type " . html_entity_decode('<span class="text-red-600 underline">' . $caseTypeName . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteCaseType',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }

    public function render()
    {
        if ($this->searchTerm) {
            $searchItems = ModelsCaseType::where('name', 'like', '%' . $this->searchTerm . '%')->latest()->paginate(8);
            $caseTypeList = $searchItems;
        } else {
            $caseTypeList = ModelsCaseType::latest()->paginate(8);
        }

        return view('livewire.pages.case-type', [
            'caseTypeList' => $caseTypeList
        ]);
    }
}
