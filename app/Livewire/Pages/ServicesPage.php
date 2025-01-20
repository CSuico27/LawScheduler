<?php

namespace App\Livewire\Pages;

use App\Models\Services;
use Filament\Notifications\Notification;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ServicesPage extends Component
{
    use Actions;
    use WithPagination;
    
    public $serviceType;
    public $name;
    public $price;
    public bool $isActive = true;
    public $requirements;

    public $editServiceType;
    public $editName;
    public $editPrice;
    public bool $editIsActive;
    public $editRequirements;

    public $selectedService;
    public $selectedServiceId;

    public $searchTerm;

    public function addService(){
        $this->validate([ 
            'serviceType' => 'required',
            'name' => 'required|max:255',
            'price' => 'required|max:255',
        ]);
        
        $service = Services::create([
            'service_type_id' => $this->serviceType,
            'name' => $this->name,
            'price' => $this->price,
            'is_active' => $this->isActive,
            'requirements' => $this->requirements
        ]);

        Notification::make()
                ->title('Success!')
                ->body('New Service has been created.')
                ->success()
                ->send();
                
        $this->dispatch('reload');
        $this->reset();
        return redirect()->back();
    }

    public function getSelectedServiceId($id){
        $this->selectedServiceId = $id;

        if($this->selectedServiceId){
            $this->selectedService = Services::find($id);
        }

        if (!$this->selectedService) {
            $this->selectedService = null;
        } else {
            $this->editServiceType = $this->selectedService->service_type_id;
            $this->editName = $this->selectedService->name;
            $this->editPrice = $this->selectedService->price;
            $this->editIsActive = $this->selectedService->is_active;
            $this->editRequirements = $this->selectedService->requirements;
        }
    }

    public function updateServiceDetails($id){
        $this->selectedService = Services::findOrFail($id);

        $this->selectedService->update([
            'service_type_id' => $this->editServiceType,
            'name' => $this->editName,
            'price' => $this->editPrice,
            'is_active' => $this->editIsActive,
            'requirements' => $this->editRequirements
        ]);

        Notification::make()
                ->title('Success!')
                ->body('Service has been updated.')
                ->success()
                ->send();

        $this->dispatch('reload');
        return redirect()->back();
    }

    public function deleteService($id){
        Services::find($id)->delete();

        Notification::make()
                ->title('Success!')
                ->body('Service has been deleted.')
                ->success()
                ->send();
        return redirect()->back();
    }

    public function resetModal(){
        $this->reset();
    }

    public function deleteConfirmation($id, $serviceName){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this service " . html_entity_decode('<span class="text-red-600 underline">' . $serviceName . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteService',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }
    
    public function render()
    {
        if ($this->searchTerm) {
            $searchItems = Services::where('name', 'like', '%' . $this->searchTerm . '%')->with('service_type')->latest()->paginate(8);
            $servicesList = $searchItems;
        } else {
            $servicesList = Services::latest()->with('service_type')->paginate(8);
        }

        return view('livewire.pages.services-page', [
            'servicesList' => $servicesList
        ]);
    }
}
