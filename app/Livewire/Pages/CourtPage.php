<?php

namespace App\Livewire\Pages;

use App\Models\Court;
use App\Models\CourtType;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CourtPage extends Component
{
    use Actions;
    use WithPagination;
    
    public $name;
    public $courtTypeId;
    public bool $isActive = true;

    public $editName;
    public $editCourtTypeId;
    public bool $editIsActive;

    public $selectedCourt;
    public $selectedCourtId;

    public $searchTerm;

    public function addNewCourt(){
        $this->validate([ 
            'name' => 'required|max:255',
            'courtTypeId' => 'required|integer|max:255|exists:court_types,id'
        ]);

        $court = Court::create([
            'name' => $this->name,
            'court_type_id' => $this->courtTypeId,
            'is_active' => $this->isActive
        ]);

        $this->dispatch('reload');
        $this->reset();
        return redirect()->back();
    }

    public function getSelectedCourtId($id){
        $this->selectedCourtId = $id;

        if($this->selectedCourtId){
            $this->selectedCourt = Court::find($id);
        }

        if (!$this->selectedCourt) {
            $this->selectedCourt = null;
        } else {
            $this->editName = $this->selectedCourt->name;
            $this->editCourtTypeId = $this->selectedCourt->court_type_id;
            $this->editIsActive = $this->selectedCourt->is_active;
        }
    }

    public function updateCourtDetails($id){
        $this->selectedCourt = Court::findOrFail($id);

        $this->selectedCourt->update([
            'name' => $this->editName,
            'court_type_id' => $this->editCourtTypeId,
            'is_active' => $this->editIsActive,
        ]);

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function deleteCourt($id){
        Court::find($id)->delete();
        return redirect()->back();
    }

    public function resetModal(){
        $this->reset();
    }

    public function deleteConfirmation($id, $courtName){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this court named " . html_entity_decode('<span class="text-red-600 underline">' . $courtName . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteCourt',
            'icon'        => 'error',
            'params'      => $id,
        ]);
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


    public function render()
    {

        if ($this->searchTerm) {
            $searchItems = Court::with('courtType')->where('name', 'like', '%' . $this->searchTerm . '%')->latest()->paginate(8);
            $courtList = $searchItems;
        } else {
            $courtList = Court::with('courtType')->latest()->paginate(8);
        }

        return view('livewire.pages.court-page', [
            'courtList' => $courtList
        ]);
    }
}
