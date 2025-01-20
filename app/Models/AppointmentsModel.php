<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AppointmentsModel extends Model
{
    protected $table = 'appointments_models';
    use HasFactory;
    protected $fillable = [
        'title',
        'description', 
        'date',
        'is_active'
    ];

    public function zoomMeet(): HasOne{
        return $this->hasOne(ZoomMeeting::class, 'appointment_id');
    }

    public function appointmentDetails(): HasOne{
        return $this->hasOne(AppointmentDetails::class, 'appointment_id');
    }
}
