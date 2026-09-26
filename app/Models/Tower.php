<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tower extends Model
{
    protected $fillable = [
        'site_id',
        'code',
        'name',
        'tower_type',
        'height',
        'installation_date',
        'description',
        'status',
    ];

    protected $casts = [
        'height' => 'decimal:2',
        'installation_date' => 'date',
    ];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Site::class);
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }

    public function inspections(): HasMany
    {
        return $this->hasMany(Inspection::class);
    }
}