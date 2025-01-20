<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cases extends Model
{
    use HasFactory;

    protected $fillable = [
        'petitioner_id',
        'respondents',
        'case_no',
        'case_type',
        'case_sub_type',
        'case_stage',
        'priority_level',
        'act',
        'filing_number',
        'filing_date',
        'registration_number',
        'registration_date',
        'first_hearing_date',
        'cnr_number',
        'description',
        'police_station',
        'fir_number',
        'fir_date',
        'court_number',
        'court_type',
        'court',
        'judge_type',
        'judge_name',
        'remarks',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petitioner_id');
    }

    public function caseType(): BelongsTo
    {
        return $this->belongsTo(CaseType::class, 'case_type');
    }

    public function caseSubType(): BelongsTo
    {
        return $this->belongsTo(SubCaseType::class, 'case_sub_type');
    }

    public function caseStage(): BelongsTo
    {
        return $this->belongsTo(CaseStage::class, 'case_stage');
    }

    public function courtName(): BelongsTo
    {
        return $this->belongsTo(Court::class, 'court');
    }
}
