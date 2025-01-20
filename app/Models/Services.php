<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Services extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'service_type_id',
        'price',
        'requirements',
        'is_active', 
    ];

    public function service_type(): BelongsTo{
        return $this->belongsTo(ServiceType::class);
    }
}
