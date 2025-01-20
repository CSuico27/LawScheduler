<?php

namespace App\Livewire\Pages;

use App\Models\CourtType;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CourtTypePage extends Component
{
    use Actions;
    use WithPagination;
    
    public $name;
    public bool $isActive = true;

    public $editName;
    public bool $editIsActive;

    public $selectedCourtType;
    public $selectedCourtTypeId;

    public $searchTerm;

    public function addNewCourtType(){
        $this->validate([ 
            'name' => 'required|max:255',
        ]);

        $courtType = CourtType::create([
            'name' => $this->name,
            'is_active' => $this->isActive
        ]);

        $this->dispatch('reload');
        $this->reset();
        return redirect()->back();
    }

    public function getSelectedCourtTypeId($id){
        $this->selectedCourtTypeId = $id;

        if($this->selectedCourtTypeId){
            $this->selectedCourtType = CourtType::find($id);
        }

        if (!$this->selectedCourtType) {
            $this->selectedCourtType = null;
        } else {
            $this->editName = $this->selectedCourtType->name;
            $this->editIsActive = $this->selectedCourtType->is_active;
        }
    }

    public function updateCourtTypeDetails($id){
        $this->selectedCourtType = CourtType::findOrFail($id);

        $this->selectedCourtType->update([
            'name' => $this->editName,
            'is_active' => $this->editIsActive,
        ]);

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function deleteCourtType($id){
        CourtType::find($id)->delete();
        return redirect()->back();
    }

    public function resetModal(){
        $this->reset();
    }

    public function deleteConfirmation($id, $courtTypeName){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this court type " . html_entity_decode('<span class="text-red-600 underline">' . $courtTypeName . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteCourtType',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }
    
    public function render()
    {
        if ($this->searchTerm) {
            $searchItems = CourtType::where('name', 'like', '%' . $this->searchTerm . '%')->latest()->paginate(8);
            $courtTypeList = $searchItems;
        } else {
            $courtTypeList = CourtType::latest()->paginate(8);
        }

        return view('livewire.pages.court-type-page', [
            'courtTypeList' => $courtTypeList
        ]);
    }
}
