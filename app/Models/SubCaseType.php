<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubCaseType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'case_type_id',
        'is_active', 
    ];

    public function caseType(): BelongsTo{
        return $this->belongsTo(CaseType::class);
    }

    public function caseSubType(): HasOne
    {
        return $this->hasOne(Cases::class, 'case_sub_type');
    }
}
