<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'username',
    'email',
    'role',
    'password',
])]
#[Hidden([
    'password',
    'remember_token',
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function inspections(): HasMany
    {
        return $this->hasMany(
            Inspection::class,
            'inspector_id'
        );
    }

    public function uploadedInspectionPhotos(): HasMany
    {
        return $this->hasMany(
            InspectionPhoto::class,
            'uploaded_by'
        );
    }

    public function assignedFindings(): HasMany
    {
        return $this->hasMany(
            Finding::class,
            'assigned_to'
        );
    }

    public function uploadedFindingPhotos(): HasMany
    {
        return $this->hasMany(
            FindingPhoto::class,
            'uploaded_by'
        );
    }

    public function assignedWorkOrders(): HasMany
    {
        return $this->hasMany(
            WorkOrder::class,
            'assigned_to'
        );
    }

    public function maintenanceRecords(): HasMany
    {
        return $this->hasMany(
            MaintenanceRecord::class,
            'technician_id'
        );
    }
}