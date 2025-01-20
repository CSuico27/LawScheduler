<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'date_received',
        'reference_no',
        'amount'
    ];


    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    
}
