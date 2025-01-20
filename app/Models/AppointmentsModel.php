<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AppointmentsModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description', 
        'date',
        'is_active'
    ];

    public function zoomMeeting(): HasOne{
        return $this->hasOne(ZoomMeeting::class);
    }
}
