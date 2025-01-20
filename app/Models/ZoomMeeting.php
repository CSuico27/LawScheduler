<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ZoomMeeting extends Model
{
    use HasFactory;
    protected $table = 'zoom_meetings';
    protected $fillable = [
        'appointment_id',
        'meeting_id', 
        'topic', 
        'start_time', 
        'duration', 
        'timezone',
        'join_url',
        'host_id',
        'password',
        'agenda',
        'participants'
    ];

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(AppointmentsModel::class, 'appointment_id');
    }
}
