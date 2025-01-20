<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
        'otp', 
        'is_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function info(): HasOne{
        return $this->hasOne(UserInfo::class);
    }

    public function cases(): HasMany
    {
        return $this->hasMany(Cases::class, 'petitioner_id');
    }

    public function appointmentDetails(): BelongsTo
    {
        return $this->belongsTo(AppointmentDetails::class, 'client_id');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $allowedIds = [1, 2, 3];

        return in_array($this->id, $allowedIds);
    }

    public function invoice(): HasMany{
        return $this->hasMany(Invoice::class, 'client_id');
    }
}
