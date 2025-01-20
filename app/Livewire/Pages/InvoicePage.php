<?php

namespace App\Livewire\Pages;

use App\Models\Invoice;
use App\Models\Payments;
use App\Models\Services;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class InvoicePage extends Component
{
    use Actions;
    use WithPagination;
    
    public $searchTerm;

    public $client;
    public $invoiceNumber;
    public $invoiceDate;
    public $invoiceDueDate;
    public $services = [''];
    public $total;
    public $balanceDue;
    public $status;

    public $editClient;
    public $editInvoiceNumber;
    public $editInvoiceDate;
    public $editInvoiceDueDate;
    public $editServices = [''];
    public $editTotal;
    public $editAmountPaid;
    public $editBalanceDue;
    public $editStatus;

    public $servicePrices = [];
    public $serviceEditPrices = [];

    public $clientInfo;
    public $clientInfoEdit;

    public $selectedInvoice = null;

    public $amountPaid;
    public $receivingDate;
    public $refNo;

    public $selectedInvoiceForPaymentId;

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
        } else {
            
            $this->paymentHistory = collect();
        }

        if ($this->selectedInvoice) {
            if ($this->selectedInvoice->services_ids) {
                $serviceIds = json_decode($this->selectedInvoice->services_ids, true);
                $services = Services::whereIn('id', $serviceIds)->get();
                $this->selectedInvoice->services = $services;
            }
            
            $this->editClient = $this->selectedInvoice->client->id;
            $this->editInvoiceNumber = $this->selectedInvoice->invoice_number;
            $this->editInvoiceDate = $this->selectedInvoice->invoice_date;
            $this->editInvoiceDueDate = $this->selectedInvoice->invoice_due_date;
            $this->editServices = json_decode($this->selectedInvoice->services_ids, true);
            $this->editStatus = $this->selectedInvoice->status;
            
            if ($this->editServices) {
                $serviceIds = json_decode($this->selectedInvoice->services_ids, true);
                $this->editServices = array_combine($serviceIds, $serviceIds);
                $this->serviceEditPrices = Services::whereIn('id', $serviceIds)
                    ->pluck('price', 'id')
                    ->toArray();
                $this->editTotal = $this->getTotalPricePropertyEdit();
            }
            $this->updatedClientEdit();
            
        } else {
            $this->selectedInvoice = null;
        }
    }

    public function mount(){
        $this->clientInfo = collect();
    }
    public function createNewInvoice(){
        $this->validate([
            'client' => 'required|max:255',
            'invoiceNumber' => 'required|max:255',
            'invoiceDate' => 'required|max:255',
            'invoiceDueDate' => 'required|max:255',
            'services.*' => 'required|max:255',
        ]);

        $invoice = Invoice::create([
            'client_id' => $this->client,
            'invoice_number' => $this->invoiceNumber,
            'invoice_date' => $this->invoiceDate,
            'invoice_due_date' => $this->invoiceDueDate,
            'services_ids' => json_encode($this->services),
            'total_amount' => self::getTotalPriceProperty(),
            'amount_paid' => 0,
            'balance_due' => self::getTotalPriceProperty(),
            'status' => 'Pending'
        ]);

        Notification::make()
            ->title('Success!')
            ->body('Invoice has been created.')
            ->success()
            ->send();

        $this->dispatch('reload');
        
        return redirect()->back();
    }

    public function getSelectedClientInfo()
    {
        if ($this->client) {
            $this->clientInfo = User::with('info')->where('id', $this->client)->get();
        } else {
            $this->clientInfo = collect(); 
        }

        
    }

    public function getSelectedClientInfoForEdit(){
        if($this->editClient){
            $this->clientInfoEdit = User::with('info')->where('id', $this->editClient)->get();
        } else {
            $this->clientInfoEdit = null;
        }
    }
    
    public function updatedClient($value)
    {
        $this->getSelectedClientInfo();
    }

    public function updatedClientEdit()
    {
        $this->getSelectedClientInfoForEdit();
    }

    public function generateInvoiceNumber()
    {
        $this->invoiceNumber = 'INV-' . Str::upper(Str::random(6)) . '-' . now()->format('YmdHis');
    }

    public function generateReferenceNumber()
    {
        $this->refNo = 'REF-' . strtoupper(uniqid());
    }

    public function addService()
    {
        $this->services[] = '';  
        $this->servicePrices[] = 0;
    }

    public function addEditService(){
        $newIndex = count($this->editServices) + 1;
        $this->editServices[] = '';
        $this->serviceEditPrices[] = 0;
        $this->editTotal = $this->getTotalPricePropertyEdit();
    }

    public function removeService($index)
    {
        if (count($this->services) > 1) {
            unset($this->services[$index]);
            unset($this->servicePrices[$index]);
            $this->services = array_values($this->services);
            $this->servicePrices = array_values($this->servicePrices);
        }

    }

    public function removeEditService($index){
        if (isset($this->editServices[$index])) {
            unset($this->editServices[$index]);
            unset($this->serviceEditPrices[$index]);
            
            $this->editServices = array_values($this->editServices);
            $this->serviceEditPrices = array_values($this->serviceEditPrices);
            
            // Adjust indices to start from 1
            $this->editServices = array_combine(range(1, count($this->editServices)), $this->editServices);
            $this->serviceEditPrices = array_combine(range(1, count($this->serviceEditPrices)), $this->serviceEditPrices);

            $this->editTotal = $this->getTotalPricePropertyEdit();
        }
    }

    public function updatedEditServices($value, $index)
    {
        $service = Services::find($value);
    
        if ($service) {
            $this->serviceEditPrices[$index] = $service->price;
        } else {
            $this->serviceEditPrices[$index] = 0;
        }

        $this->editTotal = $this->getTotalPricePropertyEdit();
    }

    public function updatedServices($value, $index)
    {
        $service = Services::find($value);
    
        if ($service) {
            $this->servicePrices[$index] = $service->price;
        } else {
            $this->servicePrices[$index] = 0;
        }

        $this->editTotal = $this->getTotalPriceProperty();
    }
    
    public function getTotalPriceProperty()
    {
        return array_sum($this->servicePrices);
    }

    public function getTotalPricePropertyEdit()
    {
        return array_sum($this->serviceEditPrices);
    }

    public function editInvoice($id){

        $selectedInvoice = Invoice::with(['client.info', 'payments'])->findOrFail($id);

        $selectedInvoice->update([
            'client_id' => $this->editClient,
            'invoice_date' => $this->editInvoiceDate,
            'invoice_due_date' => $this->editInvoiceDueDate,
            'services_ids' => $this->editServices,
            'invoice_number' => $this->editInvoiceNumber,
            'total_amount' => $this->editTotal,
            'balance_due' => $this->editTotal
        ]);

        Notification::make()
            ->title('Success!')
            ->body('Invoice has been updated.')
            ->success()
            ->send();
        
        self::closeModal();
        $this->dispatch('reload');
        return redirect()->back();
    }

    public function generatePdf($invoiceId)
    {
        $invoice = Invoice::with(['client.info', 'payments'])->find($invoiceId);

        if ($invoice) {
            if ($invoice->services_ids) {
                $serviceIds = json_decode($invoice->services_ids, true);
                $services = Services::whereIn('id', $serviceIds)->get();
                $invoice->services = $services;
            }

            $invoiceData = [
                'selectedInvoice' => $invoice,
            ];
            
            $pdf = Pdf::loadView('livewire.pdf.invoice', $invoiceData)
                ->setPaper('a4')
                ->setWarnings(false)
                ->setOption('isHtml5ParserEnabled', true)
                ->setOption('isRemoteEnabled', true);


            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->stream();
                }, 'invoice_' . $invoiceId . '.pdf');
                
            self::closeModal();

        } else {
            
            abort(404, 'Invoice not found');
        }
        
    }

    public function selectedInvoceForPayment($invoiceId)
    {
        $this->selectedInvoiceForPaymentId = Invoice::with(['client.info', 'payments'])->find($invoiceId);
        self::generateReferenceNumber();
    }
    public function addPayment($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);

        if ($invoice) {
            
            $currentBalanceDue = $invoice->balance_due;
            if ($this->amountPaid > $currentBalanceDue) {
               
                Notification::make()
                    ->title('Error!')
                    ->body('Payment amount exceeds the balance due.')
                    ->danger()
                    ->send();
                return redirect()->back();
            }

            $payment = new Payments([
                'invoice_id' => $invoiceId,
                'date_received' => $this->receivingDate,
                'reference_no' => $this->refNo,
                'amount' => $this->amountPaid,
            ]);

            $payment->save();

            $invoice->updateBalanceAndStatus();

            Notification::make()
                ->title('Success!')
                ->body('Payment has been created.')
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('Error!')
                ->body('Invoice not found.')
                ->danger()
                ->send();
        }

        $this->dispatch('reload');
        
        return redirect()->back();
    }

    public function deleteConfirmation($id, $invoiceNumber){
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => "Do you want to delete this invoice " . html_entity_decode('<span class="text-red-600 underline">' . $invoiceNumber . '</span>') . " ?",
            'acceptLabel' => 'Yes, delete it',
            'method'      => 'deleteInvoice',
            'icon'        => 'error',
            'params'      => $id,
        ]);
    }

    public function deleteInvoice($id){
        $invoice = Invoice::with(['client.info', 'payments'])->findOrFail($id);

        $invoice->delete();

        Notification::make()
            ->title('Success!')
            ->body('Invoice has been deleted.')
            ->success()
            ->send();
        
        return redirect()->back();
    }


    public function closeModal(){
        $this->selectedInvoice = null;
        $this->selectedInvoiceForPaymentId = null;
        $this->clientInfoEdit = null;
        $this->paymentHistory = null;
    }

    public function render()
    {
        if ($this->searchTerm) {
            $invoiceList = Invoice::with(['payments', 'client.info'])
                ->where('invoice_number', 'like', '%' . $this->searchTerm . '%')
                ->latest()
                ->paginate(8);
        } else {
            $invoiceList = Invoice::with(['payments', 'client.info'])
                ->latest()
                ->paginate(8);
        }
        return view('livewire.pages.invoice-page', [
            'invoiceList' => $invoiceList
        ]);
    }
}
