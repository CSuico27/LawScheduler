<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CaseStage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'is_active', 
    ];

    public function caseStage(): HasOne
    {
        return $this->hasOne(Cases::class, 'case_stage');
    }
}
