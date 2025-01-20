<?php

namespace App\Livewire\Pages;

use App\Models\ServiceType;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ServicesTypePage extends Component
{
    use Actions;
    use WithPagination;
    
    public $name;
    public bool $isActive = true;

    public $editName;
    public bool $editIsActive;

    public $selectedServiceType;
    public $selectedServiceTypeId;

    public $searchTerm;

    public function addServiceType(){
        $this->validate([ 
            'name' => 'required|max:255',
        ]);

        $serviceType = ServiceType::create([
            'name' => $this->name,
            'is_active' => $this->isActive
        ]);

        $this->dispatch('reload');
        $this->reset();
        return redirect()->back();
    }
    
    public function getSelectedServiceTypeId($id){
        $this->selectedServiceTypeId = $id;

        if($this->selectedServiceTypeId){
            $this->selectedServiceType = ServiceType::find($id);
        }

        if (!$this->selectedServiceType) {
            $this->selectedServiceType = null;
        } else {
            $this->editName = $this->selectedServiceType->name;
            $this->editIsActive = $this->selectedServiceType->is_active;
        }
    }

    public function updateServiceTypeDetails($id){
        $this->selectedServiceType = ServiceType::findOrFail($id);

        $this->selectedServiceType->update([
            'name' => $this->editName,
            'is_active' => $this->editIsActive,
        ]);

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function deleteServiceType($id){
        ServiceType::find($id)->delete();
        return redirect()->back();
    }

    public function resetModal(){
        $this->reset();
    }

    public function deleteConfirmation($id, $serviceTypeName){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this service type " . html_entity_decode('<span class="text-red-600 underline">' . $serviceTypeName . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteServiceType',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }

    public function render()
    {
        if ($this->searchTerm) {
            $searchItems = ServiceType::where('name', 'like', '%' . $this->searchTerm . '%')->latest()->paginate(8);
            $serviceTypeList = $searchItems;
        } else {
            $serviceTypeList = ServiceType::latest()->paginate(8);
        }

        return view('livewire.pages.services-type-page', [
            'serviceTypeList' => $serviceTypeList
        ]);
    }
}
