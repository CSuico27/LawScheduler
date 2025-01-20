<?php

namespace App\Livewire;

use App\Models\Services;
use App\Models\User;
use Livewire\Component;

class AboutPage extends Component
{
    public function render()
    {
        $services = Services::where('is_active', 1)->get();
        return view('livewire.about-page', [
            'services' => $services
        ]);
    }
}
