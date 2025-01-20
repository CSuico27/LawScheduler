<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AppointmentDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'client_id', 
        'title',
        'date',
        'time',
        'description',
        'is_viewed'
    ];

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(AppointmentsModel::class, 'appointment_id');
    }

    public function user(): HasOne{
        return $this->hasOne(User::class, 'client_id');
    }

    public function orders(): HasOne
    {
        return $this->hasOne(Orders::class, 'appointment_detail_id'); 
    }
}
