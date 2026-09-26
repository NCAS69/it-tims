<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inspection extends Model
{
    protected $fillable = [
        'inspection_number',
        'tower_id',
        'template_id',
        'inspector_id',
        'inspection_date',
        'start_time',
        'end_time',
        'status',
        'overall_status',
        'notes',
    ];

    protected $casts = [
        'inspection_date' => 'date',
    ];

    public function tower(): BelongsTo
    {
        return $this->belongsTo(Tower::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(InspectionTemplate::class);
    }

    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }

    public function results(): HasMany
    {
        return $this->hasMany(InspectionResult::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(InspectionPhoto::class);
    }

    public function findings(): HasMany
    {
        return $this->hasMany(Finding::class);
    }
}