<?php

namespace App\Livewire\Client;

use Livewire\Component;
use WireUi\Traits\Actions;

class CalendarView extends Component
{
    use Actions;
    
    public function render()
    {
        return view('livewire.client.calendar-view');
    }
}
