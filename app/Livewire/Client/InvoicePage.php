<?php

namespace App\Livewire\Client;

use App\Models\Invoice;
use App\Models\Services;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class InvoicePage extends Component
{
    use Actions;
    use WithPagination;
    
    public $searchTerm;
    

    public $selectedInvoice = null;
    public $paymentHistory;
    
    public function selectInvoice($invoiceId)
    {
        $this->selectedInvoice = Invoice::with(['client.info', 'payments'])->find($invoiceId);

        $invoice = Invoice::where('id', $invoiceId)
            ->with(['client.info', 'payments'])
            ->first();
        if ($invoice) {
            $this->paymentHistory = $invoice->payments
                ->groupBy('date_received')->toArray();
                if ($this->selectedInvoice->services_ids) {
                $serviceIds = json_decode($this->selectedInvoice->services_ids, true);
                $services = Services::whereIn('id', $serviceIds)->get();
                $this->selectedInvoice->services = $services;
            }
        } else {
            
            $this->paymentHistory = collect();
        }
        if ($this->selectedInvoice->services_ids) {
            $serviceIds = json_decode($this->selectedInvoice->services_ids, true);
            $services = Services::whereIn('id', $serviceIds)->get();
            $this->selectedInvoice->services = $services;
        }
    }

    public function render()
    {
        if ($this->searchTerm) {
            if(auth()->check()){
                $invoiceList = Invoice::where('client_id', auth()->user()->id)
                ->with(['payments', 'client.info'])
                ->where('invoice_number', 'like', '%' . $this->searchTerm . '%')
                ->latest()
                ->paginate(8);
            }
            
        } else {
            if(auth()->check()){
                $invoiceList = Invoice::where('client_id', auth()->user()->id)
                    ->with(['payments', 'client.info'])
                    ->latest()
                    ->paginate(8);
            }
        }
        return view('livewire.client.invoice-page', [
            'invoiceList' => $invoiceList
        ]);
    }
}
