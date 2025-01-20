<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiariesModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name', 
        'last_name',
        'phone',
        'email',
        'street_address',
        'barangay',
        'city',
        'state',
        'zip_code',
    ];
}
