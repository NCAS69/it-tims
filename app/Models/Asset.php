<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    protected $fillable = [
        'tower_id',
        'category_id',
        'asset_code',
        'name',
        'brand',
        'model',
        'serial_number',
        'ip_address',
        'mac_address',
        'installation_date',
        'status',
        'description',
    ];

    protected $casts = [
        'installation_date' => 'date',
    ];

    public function tower(): BelongsTo
    {
        return $this->belongsTo(Tower::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(AssetCategory::class);
    }
}