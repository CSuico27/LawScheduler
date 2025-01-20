<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'invoice_date',
        'invoice_due_date',
        'services_ids',
        'invoice_number',
        'total_amount',
        'amount_paid',
        'balance_due',
        'status'
    ];

    public function updateBalanceAndStatus()
    {
        
        $totalPaid = $this->payments()->sum('amount');

        $this->amount_paid = $totalPaid;
        $this->balance_due = $this->total_amount - $totalPaid;

        if ($this->balance_due <= 0) {
            $this->status = 'Paid';
        } elseif ($totalPaid > 0 && $totalPaid < $this->total_amount) {
            $this->status = 'Partially Paid';
        } elseif ($this->balance_due > 0 && $this->invoice_due_date < now()) {
            $this->status = 'Overdue';
        } else {
            $this->status = 'Pending';
        }

        $this->save();
    }

    public function payments()
    {
        return $this->hasMany(Payments::class);
    }

    public function client(): BelongsTo{
        return $this->belongsTo(User::class, 'client_id');
    }
}
