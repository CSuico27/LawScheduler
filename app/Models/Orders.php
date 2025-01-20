<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_detail_id',
        'payment_method', 
        'services_ids',
        'payment_status',
        'grand_total',
        'status'
    ];

    public function appointment_detail(): BelongsTo
    {
        return $this->belongsTo(AppointmentDetails::class, 'appointment_details_id');
    }

}
