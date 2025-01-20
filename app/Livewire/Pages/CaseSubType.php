<?php

namespace App\Livewire\Pages;

use App\Models\CaseType as ModelsCaseType;
use App\Models\SubCaseType;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CaseSubType extends Component
{
    use Actions;
    use WithPagination;
    
    public $name;
    public $caseTypeId;
    public bool $isActive = true;

    public $editName;
    public $editCaseTypeId;
    public bool $editIsActive;

    public $selectedCaseSubType;
    public $selectedCaseSubTypeId;

    public $searchTerm;

    public function addNewCaseSubType(){
        $this->validate([ 
            'name' => 'required|max:255',
            'caseTypeId' => 'required|integer|max:255|exists:case_types,id'
        ]);

        $caseType = SubCaseType::create([
            'name' => $this->name,
            'case_type_id' => $this->caseTypeId,
            'is_active' => $this->isActive
        ]);

        $this->dispatch('reload');
        $this->reset();
        return redirect()->back();
    }

    public function getSelectedCaseSubTypeId($id){
        $this->selectedCaseSubTypeId = $id;

        if($this->selectedCaseSubTypeId){
            $this->selectedCaseSubType = SubCaseType::find($id);
        }

        if (!$this->selectedCaseSubType) {
            $this->selectedCaseSubType = null;
        } else {
            $this->editName = $this->selectedCaseSubType->name;
            $this->editCaseTypeId = $this->selectedCaseSubType->case_type_id;
            $this->editIsActive = $this->selectedCaseSubType->is_active;
        }
    }

    public function updateCaseSubTypeDetails($id){
        $this->selectedCaseSubType = SubCaseType::findOrFail($id);

        $this->selectedCaseSubType->update([
            'name' => $this->editName,
            'case_type_id' => $this->editCaseTypeId,
            'is_active' => $this->editIsActive,
        ]);

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function deleteCaseSubType($id){
        SubCaseType::find($id)->delete();
        return redirect()->back();
    }

    public function resetModal(){
        $this->reset();
    }

    public function deleteConfirmation($id, $caseSubTypeName){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this case sub type " . html_entity_decode('<span class="text-red-600 underline">' . $caseSubTypeName . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteCaseSubType',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }
    
    public function render()
    {
        if ($this->searchTerm) {
            $searchItems = SubCaseType::with('caseType')->where('name', 'like', '%' . $this->searchTerm . '%')->latest()->paginate(8);
            $caseSubTypeList = $searchItems;
        } else {
            $caseSubTypeList = SubCaseType::with('caseType')->latest()->paginate(8);
        }

        return view('livewire.pages.case-sub-type', [
            'caseSubTypeList' => $caseSubTypeList
        ]);
    }
}
