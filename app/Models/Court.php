<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Court extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'court_type_id',
        'is_active', 
    ];

    public function courtType(): BelongsTo{
        return $this->belongsTo(CourtType::class);
    }
}
