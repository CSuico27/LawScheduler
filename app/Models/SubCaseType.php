<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
