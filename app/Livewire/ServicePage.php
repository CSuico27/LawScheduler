<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Services')]
class ServicePage extends Component
{
    public function render()
    {
        return view('livewire.service-page');
    }
}
