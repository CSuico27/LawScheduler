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
        'date_received',
        'time_received',
        'receiving_staff',
        'nps_docket_no',
        'assign_to',
        'date_assigned',
        'case_stage',
        'priority_level',
        'complainants',
        'respondents',
        'laws_violated',
        'witnesses',
        'date_time_commission',
        'place_of_commission',
        'question_one',
        'question_two',
        'question_three',
        'is_no',
        'handling_prosecutor',
        'is_archived',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function caseType(): BelongsTo
    // {
    //     return $this->belongsTo(CaseType::class, 'case_type');
    // }

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
