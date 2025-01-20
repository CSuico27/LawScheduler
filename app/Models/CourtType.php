<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourtType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active', 
    ];

    public function courts(): HasMany{
        return $this->hasMany(Court::class);
    }

}
