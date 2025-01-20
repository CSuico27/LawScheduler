<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CaseType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active', 
    ];

    public function sub_case_types(): HasMany{
        return $this->hasMany(SubCaseType::class);
    }

    public function case(): HasOne
    {
        return $this->hasOne(Cases::class, 'case_type');
    }
}
