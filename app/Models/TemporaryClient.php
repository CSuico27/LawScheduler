<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name', 
        'last_name',
        'phone',
        'email',
        'region',
        'province',
        'municipality',
        'barangay',
        'state',
    ];
}
